<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Hotels extends MY_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {


		$this->session->set_userdata( 'currencies_data', json_decode( file_get_contents( APPURL . 'global/currencies?token=123' ), true ) );
		if ( empty( $this->uri->segment( 2 ) ) ) {
			if ( ! empty( $this->session->userdata( 'hotel_search' ) ) ) {
				$params = $this->session->userdata( 'hotel_search' );
			} else {
				$params = array(
					'ota_id'   => $this->getOTAdata()->ota->ota_id,
					'city'     => "",
					'from'     => date( 'Y-m-d' ),
					'to'       => date( 'Y-m-d', strtotime( date( 'Y-m-d' ) . "+1 day" ) ),
					'adults'   => 1,
					'childs'   => 0,
					'api_name' => 1,
				);
			}



			$hotel_data = curl_server_request( $params, APPURL . 'ota/hotels/list' );
			if ( $hotel_data['status'] == 'success' ) {
				$hotel_data = json_decode( $hotel_data['data'], true );

				function sort_method( $a, $b ) {
					return ( $a["price"] <= $b["price"] ) ? - 1 : 1;
				}

				usort( $hotel_data['data'], "sort_method" );

				$this->session->set_userdata( 'hotel_search', $params );
				$data['search']     = $this->session->userdata( 'hotel_search' );
				$data["list"]       = $hotel_data['data'];
				$data['hotel_city'] = $params['city'];
				$data['total']      = count( $hotel_data['data'] );
				$data["amenities"]  = $hotel_data['amenities'];
				$data['travelers']  = $params['adults'] + $params['childs'];
				$data['nights']     = date_diff( date_create( $params['from'] ), date_create( $params['to'] ) );
				$data['checkin']    = $params['from'];
				$data['checkout']   = $params['to'];
				$data["title"]      = "Hotels";
				$this->theme->view( 'modules/hotels/all_hotels', $data );
			} else {
				echo $hotel_data['data'];
			}
		} else {
			$params = array(
				'ota_id'   => $this->getOTAdata()->ota->ota_id,
				'city'     => $this->uri->segment( 2 ),
				'from'     => date( 'Y-m-d' ),
				'to'       => date( 'Y-m-d', strtotime( date( 'Y-m-d' ) . "+1 day" ) ),
				'adults'   => 1,
				'childs'   => 0,
				'api_name' => 1
			);

			$this->session->set_userdata( 'hotel_search', $params );
			$params_allowed_api = array(
				'ota_id'    => $this->getOTAdata()->ota->ota_id,
				'module_id' => 1
			);

			$allowed_apis = curl_server_request( $params_allowed_api, APPURL . 'ota/modules/suppliers/all' );
			if ( $allowed_apis['status'] == "success" ) {
				$allowed_apis_data = json_decode( $allowed_apis['data'], true );
				$allowed_apis_data = $allowed_apis_data['data'];
			}

			$list_allowed_apis = [];

			foreach ( $allowed_apis_data as $allowed_api_list ) {
				array_push( $list_allowed_apis, $allowed_api_list['module_supplier_id'] );
			}

			$data['allow_apis']       = $list_allowed_apis;
			$data['allow_apis_count'] = count($list_allowed_apis);
			$data['search']    = $params;
			$data['travelers'] = $params['adults'] + $params['childs'];
			$data['nights']    = date_diff( date_create( $params['from'] ), date_create( $params['to'] ) );
			$data['checkin']   = $params['from'];
			$data['checkout']  = $params['to'];
			$data['active_tab'] = "hotels";
			$data["title"]     = "Hotels - " . ucwords( $params['city'] );
			$this->theme->view( 'modules/hotels/listing', $data );
		}
	}

		public function getlocation() {
		$json     = array();
		$response = json_decode( file_get_contents( APPURL . 'hotels/locations?token=123&value=' . $this->input->get( 'q' ) ), true );
		if ( $response['status'] == "success" && $response['code'] == "200" ) {
			foreach ( $response['data'] as $value ) {
				$json[] = array(
					'id'   => $value['name'],
					'text' => '<i class="flag ' . strtolower( $value['sortname'] ) . '"></i>' . $value['name'] . " - " . $value['country_name']
				);
			}
		} else {
			$json = array();
		}
		echo json_encode( $json );
	}

	public function search() {
		$this->session->set_userdata( 'currencies_data', json_decode( file_get_contents( APPURL . 'global/currencies?token=123' ), true ) );
		$this->session->unset_userdata( 'hotel_data' );
		$segments = $this->uri->segment_array();
		if ( empty( $segments[3] ) ) {
			redirect( site_url() );
		} else {

			// Date Validations
			if ( ! empty( $segments[4] ) ) {
				if ( validateDate( $segments[4], "Y-m-d" ) && validateDate( $segments[5], "Y-m-d" ) ) {
					$from = $segments[4];
					$to   = $segments[5];
				} else {
					redirect( '404' );
				}
			} else {
				redirect( '404' );
			}
			// Date Validation - End

			$params = array(
				'ota_id'   => $this->getOTAdata()->ota->ota_id,
				'city'     => $segments[3],
				'from'     => $from,
				'to'       => $to,
				'adults'   => ( ! empty( $segments[6] ) ) ? $segments[6] : 1,
				'childs'   => ( ! empty( $segments[7] ) ) ? $segments[7] : 0,
				'api_name' => 1
			);


			$params_allowed_api = array(
				'ota_id'    => $this->getOTAdata()->ota->ota_id,
				'module_id' => 1
			);

			$allowed_apis = curl_server_request( $params_allowed_api, APPURL . 'ota/modules/suppliers/all' );
			if ( $allowed_apis['status'] == "success" ) {
				$allowed_apis_data = json_decode( $allowed_apis['data'], true );
				$allowed_apis_data = $allowed_apis_data['data'];
			}

			$list_allowed_apis = [];

			foreach ( $allowed_apis_data as $allowed_api_list ) {
				array_push( $list_allowed_apis, $allowed_api_list['module_supplier_id'] );
			}

			$data['allow_apis']       = $list_allowed_apis;
			$data['allow_apis_count'] = count( $list_allowed_apis );


			$this->session->set_userdata( 'hotel_search', $params );
			$data['search']    = $this->session->userdata( 'hotel_search' );
			$data['travelers'] = $params['adults'] + $params['childs'];
			$data['nights']    = date_diff( date_create( $params['from'] ), date_create( $params['to'] ) );
			$data['checkin']   = $params['from'];
			$data['checkout']  = $params['to'];
			$data['active_tab'] = "hotels";
			$data["title"]     = "Hotels - " . ucwords( $params['city'] );
			$this->theme->view( 'modules/hotels/listing', $data );
		}
	}

	public function get_hotels() {
		$params                  = $this->input->post();
		$params['currency_name'] = $this->session->userdata( 'curr_session' )->code;
		$parms                   = array( "city_name" => $params['city'], "token" => '123' );
		$city_response           = curl_server_request( $parms, APPURL . 'global/supplier/city_name' );
		$all_aminities           = array();
		$all_aminities_id        = array();

		if($params['request_number'] == 0){
			$this->session->unset_userdata('aminities');
			$this->session->unset_userdata('hotel_data');
		}

		// ---- Internal Hotels  ---- //

		if ( $params['api_name'] == 1 ) {
			$hotel_data = curl_server_request( $params, APPURL . 'ota/hotels/search' );
			if ( $hotel_data['status'] == 'success' ) {
				$hotel_data['data'] = json_decode( $hotel_data['data'], true );
				if ( ! empty( $hotel_data['data']['data'] ) ) {
					$hotels = $hotel_data['data']['data'];
				} else {
					$hotels = "";
				}

				if ( ! empty( $hotels ) ) {
					foreach ( $hotels as $hotel ) {
						foreach ( $hotel['amenities'] as $aminity ) {
							//$all_aminities[] = $aminity;
							if ( ! in_array( $aminity['id'], $all_aminities_id ) ) {
								array_push( $all_aminities_id, $aminity['id'] );
								$all_aminities[] = $aminity;
							}
						}
					}
					$this->session->set_userdata('aminities',$all_aminities);
				}
			}
		}


		if ( $params['api_name'] == 2 ) {
			// ---- JAC Hotels --- //
			if ( ! empty( $city_response['data']['jac_id'] ) ) {
				$params['api_name'] = 2;
				$params['city']     = $city_response['data']['jac_id'];
				$hotel_data_jac     = json_decode( curl_server_request( $params, APPURL . 'ota/hotels/search' ), true );
				//file_put_contents('data.json', json_encode($hotel_data_jac['data']));
				if ( ! empty( $hotel_data_jac['data'] ) ) {
					$hotels = $hotel_data_jac['data'];
				}
			}
		}


		// ---- Expedia Hotels --- //
		if ( $params['api_name'] == 3 ) {
			$params['api_name']          = 3;
			$params['customerIpAddress'] = $_SERVER['REMOTE_ADDR'];
			$params['customerUserAgent'] = $_SERVER['HTTP_USER_AGENT'];
			$api_response_expedia        = curl_server_request( $params, APPURL . 'ota/hotels/search' );
			$hotel_data_expedia          = json_decode( $api_response_expedia['data'], true );
			if ( $hotel_data_expedia['status'] == 'success' && $hotel_data_expedia['code'] == 200 ) {
				$hotels = $hotel_data_expedia['hotels'];
			} else {
				$hotels = array();
			}
		}

		if ( ! empty( $hotels ) ) {

			function invenDescSort($item1,$item2)
			{
				if ($item1['price'] <= $item2['price']) return 0;
				return ($item1['price'] >= $item2['price']) ? 1 : -1;
			}
			usort($hotels,'invenDescSort');

			if ( ! empty( $this->session->userdata( 'hotel_data' ) ) ) {
				$previous_data = $this->session->userdata( 'hotel_data' );
				$hotels        = array_merge( $previous_data, $hotels );
			}
			$this->session->set_userdata( 'hotel_data', $hotels );

			$data['total']      = count( $hotels );
			$data['min'] = $hotels[0]['price'];
			$data['max'] = $hotels[$data['total']-1]['price'];
			$data['hotel_city'] = $params['city'];
			$data['params']     = $params;
			$data['search']     = $this->session->userdata( 'hotel_search' );
			$data["amenities"]  = $this->session->userdata( 'aminities' );
			$data['list'] = array_slice($hotels, 0, 20);
			$this->theme->partial( 'modules/hotels/list', $data );

		}
	}

	function pagination(){
		$offset = $this->input->post('offset');

		if(!empty($this->session->userdata('hotel_data_filter'))){
			$hotels = $this->session->userdata('hotel_data_filter');
		} else {
			$hotels = $this->session->userdata('hotel_data');
		}

		$data['total']      = count( $hotels );
		$data['search'] = $this->session->userdata( 'hotel_search' );
		$data['list']   = array_slice($hotels, $offset, 20);
		$this->theme->partial( 'modules/hotels/partials/hotels', $data );
	}

	function sort(){
		$order = $this->input->post('order');
		if($order == "asc"){
			function invenDescSort($item1,$item2)
			{
				if ($item1['price'] <= $item2['price']) return 0;
				return ($item1['price'] >= $item2['price']) ? 1 : -1;
			}
		} else {
			function invenDescSort($item1,$item2)
			{
				if ($item1['price'] >= $item2['price']) return 0;
				return ($item1['price'] <= $item2['price']) ? 1 : -1;
			}
		}

		if(!empty($this->session->userdata('hotel_data_filter'))){
			$hotels = $this->session->userdata('hotel_data_filter');
			usort($hotels,'invenDescSort');
			$this->session->set_userdata( 'hotel_data_filter', $hotels );
		} else {
			$hotels = $this->session->userdata('hotel_data');
			usort($hotels,'invenDescSort');
			$this->session->set_userdata( 'hotel_data', $hotels );
		}



		$data['total']      = count( $hotels );
		$data['search']     = $this->session->userdata( 'hotel_search' );
		$data['list'] = array_slice($hotels, 0, 20);
		$this->theme->partial( 'modules/hotels/partials/hotels', $data );
	}


	public function detail() {
        $this->session->set_userdata( 'currencies_data', json_decode( file_get_contents( APPURL . 'global/currencies?token=123' ), true ) );
		$segments = $this->uri->segment_array();
		$data     = [];
		if ( empty( $segments[2] ) ) {
			redirect( site_url() );
		}

		// Date Validations
		if ( ! empty( $segments[3] ) ) {
			if ( validateDate( $segments[3], "Y-m-d" ) && validateDate( $segments[4], "Y-m-d" ) ) {
				$from = $segments[3];
				$to   = $segments[4];
			} else {
				redirect( '404' );
			}
		} else {
			redirect( '404' );
		}
		// Date Validation - End


		if ( empty( $this->uri->segment( 7 ) ) ) {
			$params['api_name'] = 1;
			$params['title']    = str_replace( '-', ' ', $segments[2] );
		} else {
			$params['api_name'] = $segments[7];
			if ( $params['api_name'] == 1 ) {
				$params['title'] = str_replace( '-', ' ', $segments[2] );
			}
		}
		$params['currency_name'] = $this->session->userdata( 'curr_session' )->code;
		$params['ota_id']        = $this->getOTAdata()->ota->ota_id;
		$params['hotel_slug']    = $this->uri->segment( 2 );
		$params['from']          = $from;
		$params['to']            = $to;
		$params['adults']        = ( ! empty( $segments[5] ) ) ? $segments[7] : 1;
		$params['childs']        = ( ! empty( $segments[6] ) ) ? $segments[6] : 0;
		$data['nights']          = date_diff( date_create( $params['from'] ), date_create( $params['to'] ) );

		if ( $params['api_name'] == 1 ) {
				$data["data"] = json_decode( server_request( $params, APPURL . 'ota/hotels/detail' ) )->data;
		} else if ( $params['api_name'] == 2 ) {
			$hotel_data = $this->session->userdata( 'hotel_data' );
			foreach ( $hotel_data as $hotels ) {
				if ( $hotels['type'] == "Jac" && $hotels['id'] == $params['hotel_slug'] ) {
					$rooms = array();
					foreach ( $hotels['rooms'] as $room ) {
						$rooms[] = (object) array(
							'room_status'       => "",
							'refundable'        => "",
							'id'                => $room['PropertyRoomTypeID'],
							'type_id'           => $room['PropertyRoomTypeID'],
							'price'             => $room['Total'],
							'hotel_id'          => $params['hotel_slug'],
							'room_descriptions' => "",
							'image'             => "",
							'created_at'        => "",
							'updated_at'        => "",
							'room_name'         => $room['RoomType'],
							'room_slug'         => $room['RoomType'],
							'supplier_id'       => "",
							'adults'            => $room['Adults'],
							'childs'            => $room['Children'],
							'type'              => $room['RoomType'],
							'images'            => "",
						);
					}
					$data["data"]->rooms = $rooms;
					break;
				}
			}
		} else if ( $params['api_name'] == 3 ) {
			$params_expdia_details = array(
				'minorRev'          => "30",
				'customerIpAddress' => $_SERVER['REMOTE_ADDR'],
				'currencyCode'      => $this->session->userdata( 'curr_session' )->code,
				'api_name'          => 3,
				'customerUserAgent' => $_SERVER['HTTP_USER_AGENT'],
				'hotel_id'          => $this->uri->segment( 2 ),
				'arrivalDate'       => date( 'm/d/Y', strtotime( $params['from'] ) ),
				'departureDate'     => date( 'm/d/Y', strtotime( $params['to'] ) ),
				'ota_id'            => $this->getOTAdata()->ota->ota_id,
				'includeDetails'    => "true",
				'includeRoomImages' => "true"
			);


			$api_response_expedia = curl_server_request( $params_expdia_details, APPURL . 'ota/hotels/detail' );
			$data['data'] = json_decode( $api_response_expedia['data'] );
			$this->session->set_userdata( 'expedia_hotel_data', $data['data'] );
		}

		$data["title"]          = "Ajubia - " . $data['data']->company_name;
		$data['query']          = $params;
		$data['active_tab'] = "hotels";
		$data["meta"]           = (object) default_meta( str_replace( "\n", "", strip_tags( $data['data']->description ) ), $data['data']->company_name, "", $data['data']->slider_image );
		$data["meta"]->link_url = base_url( "hotel/" . $segments[2] );

		$this->theme->view( 'modules/hotels/detail', $data );
	}

	public function filter() {
		$all_hotel_id     = array();
		$all_aminities_id = array();
		$params           = $this->input->post();
		$list             = array();
		$price = explode(",",$params['price']);
		$hotel_data       = $this->session->userdata( 'hotel_data' );
		if ( ! empty( $params['rating'] ) && ! empty( $params['amenity'] ) ) {
			foreach ( $hotel_data as $hotels ) {
				$curren_hotel_aminities = array();
				if(!empty($hotels['amenities'])){
					foreach ( $hotels['amenities'] as $aminity ) {
						array_push( $curren_hotel_aminities, $aminity['id'] );
					}
					$result = array_intersect( $curren_hotel_aminities, $params['amenity'] );
					if ( $hotels['rating'] == $params['rating'] && count( $result ) > 0 && $hotels['price'] > $price[0] && $hotels['price'] < $price[1] ) {
						$list[] = $hotels;
					}
				}
			}
		} else if ( ! empty( $params['amenity'] ) ) {
			foreach ( $hotel_data as $hotels ) {
				$curren_hotel_aminities = array();
				foreach ( $hotels['amenities'] as $aminity ) {
					array_push( $curren_hotel_aminities, $aminity['id'] );
				}
				$result = array_intersect( $curren_hotel_aminities, $params['amenity'] );
				if ( count( $result ) > 0 && $hotels['price'] > $price[0] && $hotels['price'] < $price[1]) {
					$list[] = $hotels;
				}
			}
		} else if ( ! empty( $params['rating'] ) ) {
			foreach ( $hotel_data as $hotels ) {
				if ( $hotels['rating'] == $params['rating'] && $hotels['price'] > $price[0] && $hotels['price'] < $price[1] ) {
					$list[] = $hotels;
				}
			}
		} else {
			$list = $hotel_data;
		}


		$this->session->set_userdata('hotel_data_filter',$list);
		$data['total']      = count( $list );
		$data['search'] = $this->session->userdata( 'hotel_search' );
		$data['list'] = array_slice($list, 0, 20);
		$this->theme->partial( 'modules/hotels/partials/hotels', $data );
	}

	/**
	 *
	 */
	public
	function booking() {

		$params          = $this->input->post();
		$customer_ip     = $_SERVER['REMOTE_ADDR'];
		$api_response_ip = ( curl_server_request( array( 'ip_address' => $customer_ip ), APPURL . 'global/check/ip?token=123&ip_address=' . $customer_ip ) );
		$api_response_ip = json_decode( $api_response_ip['data'], true );
		$data['count']   = $api_response_ip['data'];

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

		// Internal Hotels

		if ( $params['api_name'] == 1 ) {
			$rooms = array();
			if ( ! empty( $params['check'] ) ) {
				foreach ( $params['check'] as $checked_room ) {
					$rooms[] = array(
						'room_id'     => $params['room_id'][ $checked_room ],
						'quantity'    => $params['quantity'][ $checked_room ],
						'price'       => $params['price'][ $checked_room ],
						'image'       => $params['image'][ $checked_room ],
						'room_type'   => $params['room_type'][ $checked_room ],
						'breakfast'   => $params['breakfast'][ $checked_room ],
						'refundable'  => $params['refundable'][ $checked_room ],
						'room_adults' => $params['room_adults'][ $checked_room ],
						'room_childs' => $params['room_childs'][ $checked_room ],
						'room_policy' => $params['room_policy'][ $checked_room ],
					);
				}
			} else {
				redirect( site_url() );
			}

			if ( $data['count'] > 9 && ( $_SERVER['HTTP_HOST'] != 'ajubia.com' || $_SERVER['HTTP_HOST'] != 'localhost' ) ) {
				$this->theme->view( 'modules/hotels/booking', $data );
			} else {

				$params['ota_id'] = $this->getOTAdata()->ota->ota_id;
				$data['params']   = $params;
				//$data['detail']   = json_decode( server_request( $params, APPURL . 'ota/hotels/room/details' ) )->data;
				$data['formated_checkin']  = date( 'l, F jS, Y', strtotime( $params['checkin'] ) );
				$data['formated_checkout'] = date( 'l, F jS, Y', strtotime( $params['checkout'] ) );
				$data['nights']            = date_diff( date_create( $params['checkin'] ), date_create( $params['checkout'] ) );
                $data['checkin'] = $params['checkin'];
				$data['checkout'] = $params['checkout'];
			}


			// Expedia Hotels
		} else if ( $params['api_name'] == 3 ) {
			$data['params'] = $params;
			$hotel_data     = $this->session->userdata( 'expedia_hotel_data' );
			foreach ( $hotel_data->rooms as $room ) {
				if ( $room->id == $params['room_id'] ) {
					$rooms = $room;
					break;
				}
			}
			$data['params']['image']         = $rooms->image[0];
			$data['params']['address']       = $hotel_data->address;
			$data['params']['hotel_name']    = $hotel_data->company_name;
			$data['params']['currency_code'] = $this->session->userdata( 'curr_session' )->code;
			$data['params']['currency_name'] = $this->session->userdata( 'curr_session' )->code;
			$data['params']['slider_image']  = $hotel_data->thumb;
			$data['active_tab'] = "hotels";
			$data['formated_checkin']        = date( 'l, F jS, Y', strtotime( $params['checkin'] ) );
			$data['formated_checkout']       = date( 'l, F jS, Y', strtotime( $params['checkout'] ) );
			$data['nights']                  = date_diff( date_create( $params['checkin'] ), date_create( $params['checkout'] ) );
		}

		$payment_gateways         = file_get_contents( APPURL . 'gateways/list?ota_id=' . $this->getOTAdata()->ota->ota_id );
		$data['payment_gateways'] = json_decode( $payment_gateways, true );
		$countries                = json_decode( file_get_contents( APPURL . 'global/countries?token=123' ), true );
		$data['countries']        = $countries['data'];
		$data['rooms']            = $rooms;
		$this->theme->view( 'modules/hotels/booking', $data );
	}

	function countries() {
		$query     = $this->input->get( 'q' );
		$countries = json_decode( file_get_contents( APPURL . 'global/countries?token=123&search=' . $query ), true );
		$this->session->set_userdata( 'countries' );
		$json = [];
		foreach ( $countries['data'] as $data ) {
			$json[] = [ 'id' => $data['sortname'], 'text' => "+" . $data['phonecode'] . " " . $data['name'] ];
		}
		echo json_encode( $json );
	}

	public
	function save_booking() {
		$post               = $this->input->post();
		$post['user_type']  = $post['user_login_status'];
		$post['ip_address'] = $_SERVER['REMOTE_ADDR'];

		if ( $post['payment_method'] == "pay_online" && $post['payment_gateway'] == 0 ) {
			$post['booking_status'] = "confirmed";
			$post['payment_status'] = "full";
		} else {
			$post['booking_status'] = "pending";
			$post['payment_status'] = "unpaid";
		}

		//dd($post);

		$post['device_type'] = "web_ota_user";
		$post['site_url']    = site_url();
		$post['currency']    = $this->session->userdata( 'curr_session' )->code;


		if ( $post['api_name'] == 3 ) {
			$hotel_data = $this->session->userdata( 'expedia_hotel_data' );

			foreach ( $hotel_data->rooms as $room ) {
				if ( $room->id == $post['rooms'][0]['room_id'] ) {
					$room_data = $room;
					break;
				}
			}
			$post['aminities']                           = json_encode( $hotel_data->amenities );
			$post['hotel_data_expedia']['hotel_id']      = $hotel_data->id;
			$post['hotel_data_expedia']['room_id']       = $room_data->id;
			$post['hotel_data_expedia']['room_name']     = $room_data->room_name;
			$post['hotel_data_expedia']['company_name']  = $hotel_data->company_name;
			$post['hotel_data_expedia']['rating']        = $hotel_data->rating;
			$post['hotel_data_expedia']['address']       = $hotel_data->address;
			$post['hotel_data_expedia']['mobile_number'] = $hotel_data->mobile_number;
			$post['hotel_data_expedia']['longitude']     = $hotel_data->longitude;
			$post['hotel_data_expedia']['latitude']      = $hotel_data->latitude;
		}

		if ( $post['user_login_status'] == 'guest' ) {
			$account            = $post["account"];
			$post['account_id'] = 0;
		} else {
			$account            = $this->session->userdata( 'user_data' );
			$post['account_id'] = $account['account_id'];
		}
		unset( $post['user_login_status'] );
		$post['ota_id']   = $this->getOTAdata()->ota->ota_id;
		$post['account']  = json_encode( $post['account'] );
		$post['base_url'] = site_url();
        $api_response     = ( curl_server_request( $post, APPURL . "ota/hotels/bookings" ) );
		$data             = json_decode( $api_response['data'], true );
		echo json_encode( $data );
	}

	public function verification() {
		$data['booking_id'] = $this->input->post( "booking_id" );
		$this->theme->view( 'modules/hotels/verification', $data );
	}

	public function booking_status() {
		$booking_id   = $this->uri->segment( 3 );
		$post         = [
			'ota_id'     => $this->getOTAdata()->ota->ota_id,
			'invoice_id' => $booking_id,
		];
		$api_response = ( curl_server_request( $post, APPURL . "ota/hotels/invoice" ) );
		dd($api_response['data']);
		$api_response = json_decode( $api_response['data'], true );
		if ( $api_response['status'] == "success" ) {
			$data['invoice'] = $api_response['data'];
			//dd($data);
			$this->theme->view( 'modules/hotels/booking_status', $data );
		} else {
			redirect( '404' );
		}
	}
}
