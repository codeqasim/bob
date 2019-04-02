<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Flights extends MY_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function invalidAuth() {
		$this->load->view( 'errors/html/error_404' );
	}

	public function index() {

		/**
		 * Function Short Description
		 * This function is the listing page.
		 * Once user search for flight, he comes to this page.
		 * First we get from city code and to city code from URL and
		 * send them to booking engine to validate them either these are valid or not.
		 * If validation success, system creates a payload for flight search.
		 * In next step system checks flight type if it is return then system add the return date to payload.
		 * Save this payload to session named “params”.
		 * Load a view “flights/list” while passing payload to it.
		 * If city validation fails then user redirected to home page.
		 */

		$data['title'] = '';
		$city_code     = array(
			'ota_id' => $this->getOTAdata()->ota->ota_id,
			'from'   => $this->uri->segment( 2 ),
			'to'     => $this->uri->segment( 4 )
		);
		$validation    = curl_call( APPURL . "ota/flights/validate", $city_code );
		$validation    = json_decode( $validation, true );

		if ( $validation['data'] == true ) {
			/**
			 * System creates an array of params
			 */
			$params = array(
				'kcityfrom' => str_replace( "-", " ", $this->uri->segment( 3 ) ) . "-" . $this->uri->segment( 2 ),
				'kcityto'   => str_replace( "-", " ", $this->uri->segment( 5 ) ) . "-" . $this->uri->segment( 4 ),
				'dep_date'  => $this->uri->segment( 6 ),
				'adults'    => intval( $this->uri->segment( 7 ) ),
				'child'     => intval( $this->uri->segment( 8 ) ),
				'infants'   => intval( $this->uri->segment( 9 ) ),
				'triptype'  => $this->uri->segment( 10 ),
			);

			/**
			 * If flight type is return . Then add return date to params
			 */

			if ( $this->uri->segment( 10 ) == "return" ) {
				$params['ret_date'] = $this->uri->segment( 11 );
			}

			/**
			 * store the params to session
			 */


			$this->session->set_userdata( 'params', $params );

			$data['params'] = $this->session->userdata( 'params' );
			$data['title']  = 'Flights';
			$data['active_tab'] = "flights";
			$this->theme->view( 'flights/list', $data );
		} else {

			/**
			 * if city code validation is false then user redirected to home page.
			 */

			redirect( site_url() );
		}
	}

	public function get_cities() {

		/**
		 * Function Description
		 * This function is an Ajax call.
		 * This function get list of cities from booking engine.
		 * Return data type is JSON.
		 * This is select2 call.
		 */

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

	public function get_airlines() {

		/**
		 * Function Details
		 * This function is an Ajax call.
		 * This function get list of available flights from booking engine.
		 * Post parameters are stored in variable $post.
		 * If $post is not empty then it creates a payload to pass it to booking engine.
		 * Once result received from booking engine then it loads a partial view “flights/flights”.
		 */


		// Post parameters are stored in variable $post.
		$post          = $this->input->post();
		$flyFrom_array = explode( "-", $post['kcityfrom'] );
		$flyFrom_code  = trim( $flyFrom_array[1] );

		$kcityto_array = explode( "-", $post['kcityto'] );
		$to            = trim( $kcityto_array[1] );

		/**
		 * If flight type is return . Then add return date to params
		 */

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
                'children' => $post['child'],
                'infants'  => $post['infants'],
                'currency'     => $this->session->userdata( 'curr_session' )->code,
                'ota_id'   => $this->session->userdata( 'ota_data' )->ota->ota_id,
                'partner'  => 'phptravels',
                'api_name'  => '5',
            );
			if ( $post['triptype'] == "return" ) {
				$params['flight_type'] = "round";
				$params['return_from'] = date( "d/m/Y", strtotime( $ret_date ) );
				$params['return_to']   = date( "d/m/Y", strtotime( $ret_date ) );

			} else {
				$params['flight_type'] = "oneway";
			}

			$this->session->set_userdata( 'params', $post );
			/**
			 * Curl call to booking engine.
			 */

			$curl = curl_init();
			curl_setopt_array( $curl, array(
				CURLOPT_URL            => APPURL . "ota/flights/searching?" . http_build_query( $params ),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING       => "",
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_TIMEOUT        => 30,
				CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST  => "GET",
				CURLOPT_POSTFIELDS     => "",
				CURLOPT_HTTPHEADER     => array(
					"cache-control: no-cache"
				),
			) );

			$response = curl_exec( $curl );
			$err      = curl_error( $curl );
			curl_close( $curl );
			if ( $err ) {
				$response = $err;
			}
		} else {
			$response = "";
		}


		/**
		 * Response from booking engine is stored in a variable $response
		 */

		$data['active_tab'] = "flights";
		$data['flights'] = json_decode( $response, true );
		$this->session->set_userdata( 'flights', $data['flights'] ); //  setting session of flight data
		$this->theme->partial( 'flights/flights', $data ); // Partial view of flights
	}

	public function booking() {
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
			if ( empty( $params_data ) ) {
				redirect( site_url() );
			}
			$pnum                 = $params_data['adults'] + $params_data['child'] + $params_data['infants'];
			$params               = array(
				'bnum'           => $pnum,
				'pnum'           => $pnum,
				'custom_payload' => array(
					'booking_token'  => $this->input->post( 'booking_token' ),
					'visitor_uniqid' => $this->input->post( 'visitor_uniqid' ),
				),
				'flight_id'      => $this->input->post( 'flight_id' ),
				'adults'         => $params_data['adults'],
				'children'       => $params_data['child'],
				'infants'        => $params_data['infants'],
				'ota_id'         => $this->getOTAdata()->ota->ota_id,
				'api_name'       => 5

			);
			$content              = curl_call( APPURL . "ota/flights/booking", json_encode( $params ), array( "Content-Type:application/json" ) );
			$content              = json_decode( $content, true );
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
			$data['active_tab'] = "flights";
			$countries         = json_decode( file_get_contents( APPURL . 'global/countries?token=123' ), true );
			$data['countries'] = $countries['data'];
			$this->theme->view( 'flights/booking', $data );
		}
	}

	public function check_login() {
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

	public function save_booking() {
		$post               = $this->input->post();
		$post['ota_id']     = $this->getOTAdata()->ota->ota_id;
		$post['api_name']   = 5;
		$post['ip_address'] = $_SERVER['REMOTE_ADDR'];

		if ( $post['payment_method'] == "pay_now" ) {
			$post['booking_status'] = "confirmed";
			$post['payment_status'] = "full";
		} else {
			$post['booking_status'] = "pending";
			$post['payment_status'] = "unpaid";
		}

		//dd($post);

		$post['device_type']       = "web_ota_user";
		$post['api_name']          = 5;
		$post['url']               = site_url();
		$content                   = curl_call( APPURL . "ota/flights/savebooking", json_encode( $post ), array( "Content-Type:application/json" ) );
		$content                   = json_decode( $content, true );
		$content                   = json_decode( $content['data'], true );
		$content['payment_method'] = $post['payment_method'];
		dd($content                   );
		echo json_encode( $content );
	}

	public function flight_recheck() {
		$post    = $this->input->post();
		$content = curl_call( APPURL . "ota/flights/booking", json_encode( $post ), array( "Content-Type:application/json" ) );
		$content = json_decode( $content, true );
		if ( $content['data']['flights_checked'] == true && $content['data']['flights_invalid'] == false ) {
			echo 1;
		} else {
			echo 0;
		}
	}

	public function voucher() {
		$id = $this->uri->segment( 3 );
		if ( $id == 0 ) {
			redirect( site_url() );
		}
		$param         = array(
			'ota_id'     => $this->getOTAdata()->ota->ota_id,
			'voucher_id' => $id
		);
		$data['title'] = "Flights - Voucher";
		$data['active_tab'] = "flights";
		if ( $voucher = file_get_contents( APPURL . 'ota/flights/voucher?' . http_build_query( $param ) ) ) {
			$voucher_data    = json_decode( $voucher, true );
			$data['voucher'] = $voucher_data;
			$this->theme->view( 'flights/voucher', $data );
		}
	}

}