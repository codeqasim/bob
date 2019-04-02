<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Flight extends MY_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function invalidAuth() {
		$this->load->view( 'errors/html/error_404' );
	}


	function flight_curl_call( $params, $url, $method = "POST", $headers = array() ) {
		$curl = curl_init();
		curl_setopt_array( $curl, array(
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => "",
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => $method,
			CURLOPT_POSTFIELDS     => $params,
			CURLOPT_HTTPHEADER     => $headers,
		) );

		$response = curl_exec( $curl );
		$err      = curl_error( $curl );
		curl_close( $curl );
		if ( $err ) {
			return array( 'status' => 'error', 'data' => $err );
		} else {
			return array( 'status' => 'success', 'data' => $response );
		}
	}

	public function index() {
		$data['title'] = '';
		if ( ! empty( $this->uri->segment( 2 ) ) && ! empty( $this->uri->segment( 4 ) ) ) {
			$city_code  = array(
				'ota_id' => $this->getOTAdata()->ota->ota_id,
				'from'   => $this->uri->segment( 2 ),
				'to'     => $this->uri->segment( 4 )
			);
			$validation = $this->flight_curl_call( $city_code, APPURL . "ota/flights/validate", "POST" );

			if ( $validation['data'] == true ) {
				$params = array(
					'kcityfrom' => str_replace( "-", " ", $this->uri->segment( 3 ) ) . "-" . $this->uri->segment( 2 ),
					'kcityto'   => str_replace( "-", " ", $this->uri->segment( 5 ) ) . "-" . $this->uri->segment( 4 ),
					'dep_date'  => $this->uri->segment( 6 ),
					'adults'    => intval( $this->uri->segment( 7 ) ),
					'child'     => intval( $this->uri->segment( 8 ) ),
					'infants'   => intval( $this->uri->segment( 9 ) ),
					'triptype'  => $this->uri->segment( 10 ),
				);

				if ( $this->uri->segment( 10 ) == "return" ) {
					$params['ret_date'] = $this->uri->segment( 11 );
				}

				$this->session->set_userdata( 'params', $params );
				$data['params'] = $this->session->userdata( 'params' );
				$data['title']  = 'Flights';
				$this->theme->view( 'flight/list', $data );
			} else {
				redirect(site_url());
			}
		} else {
			redirect(site_url());
		}
	}


	public function get_airlines() {
		$post          = $this->input->post();
		$flyFrom_array = explode( "-", $post['kcityfrom'] );
		$flyFrom_code  = trim( $flyFrom_array[1] );

		$kcityto_array = explode( "-", $post['kcityto'] );
		$to            = trim( $kcityto_array[1] );

		if ( $post['triptype'] == "return" ) {
			$dates    = explode( " ", $post['dep_date'] );
			$dep_date = trim( $dates[0] );
			$ret_date = trim( $dates[2] );
		} else {
			$dep_date = $post['dep_date'];
			$ret_date = '';
		}

		if ( ! empty( $post ) ) {
			$params = array(
				'from_code'  => $flyFrom_code,
				'to_code'       => $to,
				'date_from' => date( "d/m/Y", strtotime( $dep_date ) ),
				'date_to'   => date( "d/m/Y", strtotime( $dep_date ) ),
				'adults'   => $post['adults'],
				'children' => $post['children'],
				'infants'  => $post['infants'],
				'currency'     => $this->session->userdata( 'curr_session' )->code,
				'ota_id'   => $this->session->userdata( 'ota_data' )->ota->ota_id,
				'partner'  => 'phptravels',
			);


			if ( $post['triptype'] == "return" ) {

				$params['flight_type'] = "round";
				$params['return_from'] = date( "d/m/Y", strtotime( $ret_date ) );
				$params['return_to']   = date( "d/m/Y", strtotime( $ret_date ) );

			} else {
				$params['flight_type'] = "oneway";
			}

			$this->session->set_userdata( 'params', $post );

			$headers = array(
				"cache-control: no-cache"
			);
			dd($params);
			$api_esponse = $this->flight_curl_call( "", APPURL . "ota/flights/searching?" . http_build_query( $params ), "GET",$headers );

			dd($api_esponse);
			$response = $api_esponse['data'];

		} else {
			$response = "";
		}

		dd(json_decode($response,true));

		$data['flights'] = json_decode( $response, true );
		$this->session->set_userdata( 'flights', $data['flights'] );
		$this->theme->partial( 'flights/flights', $data );
	}

	function filter() {
		$response = $this->session->userdata( 'flights' );
		$post     = $this->input->post();

		$price = explode( ",", $post['price'] );
		$min   = $price[0];
		$max   = $price[1];
		$all   = [];

		if ( ! empty( $post['flights'] ) && ! empty( $post['stop'] ) ) {
			foreach ( $response['data'] as $value ) {
				$stops_return = 0;
				$stops        = 0;
				$airline      = array();
				foreach ( $value['route'] as $route ) {
					if ( $route['return'] == 1 ) {
						$stops_return ++;
						if ( ! in_array( $route['airline'], $airline ) ) {
							array_push( $airline, $route['airline'] );
						}
					} else {
						if ( ! in_array( $route['airline'], $airline ) ) {
							array_push( $airline, $route['airline'] );
						}
						$stops ++;
					}
				}
				if ( $stops_return == 0 ) {
					$stops_array = array( $stops );
				} else {
					$stops_array = array( $stops, $stops_return );
				}
				if ( ! empty( array_intersect( $stops_array, $post['stop'] ) ) && ! empty( array_intersect( $airline, $post['flights'] ) ) && $value['flight_price'] >= $min && $value['flight_price'] <= $max ) {
					$all[] = $value;
				}
			}
		} else if ( ! empty( $post['flights'] ) ) {
			foreach ( $response['data'] as $value ) {
				$stops_return = 0;
				$stops        = 0;
				$airline      = array();
				foreach ( $value['route'] as $route ) {
					if ( $route['return'] == 1 ) {
						$stops_return ++;
						if ( ! in_array( $route['airline'], $airline ) ) {
							array_push( $airline, $route['airline'] );
						}
					} else {
						if ( ! in_array( $route['airline'], $airline ) ) {
							array_push( $airline, $route['airline'] );
						}
						$stops ++;
					}
				}
				if ( ! empty( array_intersect( $airline, $post['flights'] ) ) && $value['flight_price'] >= $min && $value['flight_price'] <= $max ) {
					$all[] = $value;
				}
			}
		} else if ( ! empty( $post['stop'] ) ) {
			foreach ( $response['data'] as $value ) {
				$stops_return = 0;
				$stops        = 0;
				$airline      = array();
				foreach ( $value['route'] as $route ) {
					if ( $route['return'] == 1 ) {
						$stops_return ++;
						if ( ! in_array( $route['airline'], $airline ) ) {
							array_push( $airline, $route['airline'] );
						}
					} else {
						if ( ! in_array( $route['airline'], $airline ) ) {
							array_push( $airline, $route['airline'] );
						}
						$stops ++;
					}
				}
				if ( $stops_return == 0 ) {
					$stops_array = array( $stops );
				} else {
					$stops_array = array( $stops, $stops_return );
				}
				if ( ! empty( array_intersect( $stops_array, $post['stop'] ) ) && $value['flight_price'] >= $min && $value['flight_price'] <= $max ) {
					$all[] = $value;
				}
			}
		} else {
			foreach ( $response['data'] as $value ) {
				$count = count( $value['route'] );
				if ( $value['flight_price'] >= $min && $value['flight_price'] <= $max ) {
					$all[] = $value;
				}
			}
		}
		$data['flights'] = $all;
		$this->theme->partial( 'flights/partials/flights_filter', $data );
	}

	public function get_cities() {
		$input = $this->input->get( 'query' );
		$data  = json_decode( file_get_contents( APPURL . "global/airports?code=" . $input . "&token=123" ), true );

		if ( $data['status'] == "success" && $data['code'] == "200" ) {
			foreach ( $data['data'] as $value ) {
				$json[] = array(
					'countrycode' => $value['countryCode'],
					'citycode'    => $value['cityCode'],
					'cityname'    => $value['cityName'],
					'airportname' => $value['name']
				);
			}
		} else {
			$json = "";
		}
		echo json_encode( $json );
	}

	function booking() {
		if ( empty( $this->input->post() ) ) {
			redirect( site_url() );
		} else {

			if ( ! empty( $this->session->userdata( 'user_data' ) ) ) {
				$user_data                   = $this->session->userdata( 'user_data' );
				$params_user_request         = array(
					"ota_id"  => $this->getOTAdata()->ota->ota_id,
					"user_id" => $user_data['user_id']
				);
				$data["user_data"]           = json_decode( server_request( $params_user_request, APPURL . "ota/user/userdata" ) )->data;
				$data['user_data']->is_login = true;
				unset( $data['user_data']->password );
			} else {
				$data['user_data'] = (object) array(
					'user_id'  => 0,
					'is_login' => false
				);
			}

			$params_data = $this->session->userdata( 'params' );
			$pnum        = $params_data['adults'] + $params_data['child'] + $params_data['infants'];
			$params      = array(
				'bnum'           => $pnum,
				'pnum'           => $pnum,
				'flight_id'      => $this->input->post( 'flight_id' ),
				'booking_token'  => $this->input->post( 'booking_token' ),
				'visitor_uniqid' => $this->input->post( 'visitor_uniqid' ),
				'adults'         => $params_data['adults'],
				'children'       => $params_data['child'],
				'infants'        => $params_data['infants'],
				'ota_id'         => $this->getOTAdata()->ota->ota_id,

			);

			$content = curl_call( APPURL . "ota/kiwi/booking", $params );

			$data['params']       = $params;
			$data['passengers']   = array(
				'adults'   => $params_data['adults'],
				'children' => $params_data['child'],
				'infants'  => $params_data['infants']
			);
			$data['title']        = 'Ajubia - Booking';
			$data['payment_info'] = array(
				'flight_price' => $this->input->post( 'flight_price' ),
				'currency'     => $this->input->post( 'currency' )
			);
			$data['booking']      = $content;
			$countries            = json_decode( file_get_contents( APPURL . 'global/countries?token=123' ), true );
			$data['countries']    = $countries['data'];
			$this->theme->view( 'flights/booking', $data );
		}
	}

	function check_login() {
		$post         = $this->input->post();
		$params       = array(
			'ota_id'   => $this->getOTAdata()->ota->ota_id,
			'email'    => $post['email'],
			'password' => $post['password'],
		);
		$api_response = curl_server_request( $params, APPURL . "ota/user/login" );
		$api_response = json_decode( $api_response['data'], true );
		if ( $api_response['status'] == 'error' ) {
			$data['status'] = $api_response['status'];
			$data['msg']    = $api_response['data'];
		} else {
			$this->session->set_userdata( "user_data", $api_response['data'] );
			$data['status'] = 'success';
		}
		echo json_encode( $data );
	}

	function save_booking() {
		$return = [];
		$post   = $this->input->post();

		$return['payment_method'] = $post['payment_method'];
		$flight_ids               = explode( "|", $post['flight_id'] );
		// --------------- Passengers Information ----------  //

		$bags       = array( 1 => array( "1" => 1, "2" => 0 ), 2 => array( "1" => 1, "2" => 1 ) );
		$total_bags = 0;
		$passengers = [];
		if ( ! empty( $post['adults'] ) ) {
			foreach ( $post['adults'] as $key => $value ) {
				$value['birthday']   = strtotime( $value['birthday'] );
				$value['expiration'] = strtotime( $value['expiration'] );
				$hold_bag_flights    = [];
				$total_bags ++;
				foreach ( $flight_ids as $flight_id ) {
					$hold_bag_flights[ $flight_id ] = $bags[ $value['hold_bags'] ];
				}
				$value['hold_bags'] = $hold_bag_flights;
				$passengers[]       = $value;
			}
		}

		if ( ! empty( $post['children'] ) ) {
			foreach ( $post['children'] as $key => $value ) {
				$value['birthday']   = strtotime( $value['birthday'] );
				$value['expiration'] = strtotime( $value['expiration'] );
				$hold_bag_flights    = [];
				$total_bags ++;
				foreach ( $flight_ids as $flight_id ) {
					$hold_bag_flights[ $flight_id ] = $bags[ $value['hold_bags'] ];
				}
				$value['hold_bags'] = $hold_bag_flights;
				$passengers[]       = $value;
			}
		}

		if ( ! empty( $post['infants'] ) ) {
			foreach ( $post['infants'] as $key => $value ) {
				$value['birthday']   = strtotime( $value['birthday'] );
				$value['expiration'] = strtotime( $value['expiration'] );
				$hold_bag_flights    = [];
				$total_bags ++;
				foreach ( $flight_ids as $flight_id ) {
					$hold_bag_flights[ $flight_id ] = $bags[ $value['hold_bags'] ];
				}
				$value['hold_bags'] = $hold_bag_flights;
				$passengers[]       = $value;
			}
		}
		// ------------- End - Passengers Information ------------ //

		// ------------- Send date to Api to Insert Booking into Database -------- //
		if ( $post['user_login_status'] == 'guest' ) {
			$account            = $post["account"];
			$post['account_id'] = 0;
		} else {
			$account            = $this->session->userdata( 'user_data' );
			$post['account_id'] = $account['account_id'];
		}

		$data_to_save_database = array(
			'ota_id'         => $this->getOTAdata()->ota->ota_id,
			'account'        => json_encode( $account ),
			'passengers'     => json_encode( $passengers ),
			'flight'         => json_encode( $post["flight_data"] ),
			'payment_method' => $post['payment_method'],
			'account_id'     => $post['account_id'],
			'user_type'      => $post['user_login_status'],
			'ip_address'     => $_SERVER['REMOTE_ADDR']

		);
		$content_internal      = curl_call( APPURL . "ota/kiwi/invoice", $data_to_save_database );
		//dd($content_internal);

		$return['content_internal'] = $content_internal['data'];
		$save_id                    = $content_internal["data"]["save_id"];
		$passengers[0]['email']     = 'alerts@travelhope.com';
		// ------------- End - Send date to Api to Insert Booking into Database -------- //

		if ( $post['payment_method'] == 'pay_now' && $content_internal['status'] == 'success' && $content_internal['code'] == 200 ) {
			// Send data to kiwi API //
			$params = array(
				'ota_id'                 => $this->getOTAdata()->ota->ota_id,
				'lang'                   => "en",
				'bags'                   => $total_bags,
				'passengers'             => $passengers,
				'locale'                 => "en",
				'booking_token'          => $_POST['booking_token'],
				"immediate_confirmation" => false,
				"save_id"                => $save_id,
			);

			$headers = array( 'Content-Type:application/json' );
			$content = curl_call( APPURL . "ota/kiwi/savebooking", json_encode( $params ), $headers );

			// End - Send data to Kiwi Api //

			//  ------------------------------------------ Send data to send it to Zooz to initialize payment  //

			$content_data = json_decode( $content['data'], true );


			if ( ! empty( $content_data['zooz_token'] ) ) {
				$return['kiwi_response'] = 1;
				$zooz_token              = $content_data['zooz_token'];
				$headers                 = array(
					'Origin: https://sandbox.zooz.com',
					'Connection:keep-alive',
					'Pragma:no-cache',
					'productType:Checkout API',
					'Content-Type:application/json',
					'Accept: application/json',
					'ZooZ-Token:' . $zooz_token,
					'ZooZResponseType:JSon',

				);

				$params_init_payment = array(

					'cmd'          => 'init',
					'paymentToken' => $zooz_token,
					"save_id"      => $save_id,
				);

				$data = array(
					'ota_id'             => $this->getOTAdata()->ota->ota_id,
					'params'             => json_encode( $params_init_payment ),
					'header'             => json_encode( $headers ),
					"save_id"            => $save_id,
					"check_init_payment" => 1,

				);

				$payment_init_content = curl_call( APPURL . "ota/kiwi/make_payment", $data );

				$payment_init_content = json_decode( $payment_init_content['data'], true );


				//dd($payment_init_content['responseStatus']);

				// ------ End - Send data to send it to Zooz to initialize payment  ---- //

				$return['payment_init_content'] = 1;

				// ---- Send data to send it to Zooz to Add Payment Method ---- //

				// If ResponseStatus is 0 then payment initiated successfully.

				if ( $payment_init_content['responseStatus'] == 0 ) {
					$params_make_payment = array(
						'ota_id'        => $this->getOTAdata()->ota->ota_id,
						'cmd'           => 'addPaymentMethod',
						'paymentToken'  => $zooz_token,
						'paymentMethod' => array(
							'paymentMethodType'    => 'CreditCard',
							'paymentMethodDetails' => array(
								'cardNumber'     => $post['card_no'],
								'cardHolderName' => $post['name_card'],
								'expirationDate' => $post['year'] . '/' . $post['month'],
								'cvvNumber'      => $post['security_code'],
							),
						),
						'email'         => 'alerts@travelhope.com',
						'zooz_token'    => $zooz_token,
						'exp'           => $post['year'] . '/' . $post['month'],
					);

					$data                 = array(
						'ota_id'             => $this->getOTAdata()->ota->ota_id,
						'params'             => json_encode( $params_make_payment ),
						'header'             => json_encode( $headers ),
						"save_id"            => $save_id,
						"check_init_payment" => 0,

					);
					$content_make_payment = curl_call( APPURL . "ota/kiwi/make_payment", $data );

					$content_make_payment = json_decode( $content_make_payment['data'], true );

					//  End - Send data to send it to Zooz to Add Payment Method  //
					//  Send data to Kiwi to confirm payment //
					if ( ! empty( $content_make_payment['responseStatus'] ) == 0 ) {
						$return['content_make_payment'] = 1;
						$headers_payment_confirm        = array( 'Content-Type:application/json' );
						$payment_method_token           = $content_make_payment['responseObject']['paymentMethodToken'];
						$params_payment_confirm         = array(
							'ota_id'             => $this->getOTAdata()->ota->ota_id,
							'paymentToken'       => $zooz_token,
							'paymentMethodToken' => $payment_method_token,
							"save_id"            => $save_id,
						);

						$content_payment_confirm = curl_call( APPURL . "ota/kiwi/confirm_payment", json_encode( $params_payment_confirm ), $headers_payment_confirm );
						//dd($content_payment_confirm);
						$content_payment_confirm = json_decode( $content_payment_confirm['data'], true );

						if ( $content_payment_confirm['status'] == 0 ) {
							// ------ Insert data to API ------ //
							$return['content_payment_confirm'] = 1;

						} else {
							$return['content_payment_confirm'] = 0;
						}
						//  Send data to Kiwi to confirm payment //

					} else {
						$return['content_make_payment'] = 0;
					}
				} else {
					$return['payment_init_content'] = 0;
				}
			} else {
				$return['kiwi_response'] = $content;
			}
		}
		echo json_encode( $return );
	}

	function flight_recheck() {
		$post    = $this->input->post();
		$content = curl_call( APPURL . "ota/kiwi/booking", $post );
		if ( $content['data']['flights_checked'] == true && $content['data']['flights_invalid'] == false ) {
			echo 1;
		} else {
			echo 0;
		}
	}

	function voucher( $id = 0 ) {
		if ( $id == 0 ) {
			redirect( site_url() );
		}
		$param         = array(
			'ota_id'     => $this->getOTAdata()->ota->ota_id,
			'voucher_id' => $id
		);
		$data['title'] = "Flights - Voucher";
		if ( $voucher = file_get_contents( APPURL . 'ota/kiwi/voucher?' . http_build_query( $param ) ) ) {
			$voucher_data    = json_decode( $voucher, true );
			$data['voucher'] = $voucher_data;
			$this->theme->view( 'flights/voucher', $data );
		}
	}

}