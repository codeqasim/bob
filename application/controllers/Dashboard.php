<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Dashboard extends CI_Controller {

	public function index() {
		$this->load->view( 'dashboard' );
	}

	public function settings() {
		$this->load->view( 'adminsettings' );
	}

	public function change_curr() {
		$main_arr = (object) array(
			"name"         => $this->input->post( 'name' ),
			"code"         => $this->input->post( 'code' ),
			"country_name" => $this->input->post( 'country_name' ),
			"id"           => $this->input->post( 'id' ),
			"is_default"   => $this->input->post( 'is_default' ),
		);
		$this->session->set_userdata( 'curr_session', $main_arr );
		echo base_url( $this->session->userdata( "prev_page" ) );
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

		$data['stops'] = $stops;
		$data['flights'] = $all;
		$this->theme->partial( 'flights/partials/flights_filter', $data );
	}


}