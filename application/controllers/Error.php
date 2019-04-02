<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {

    public function index() {
        
        $data['json'] = $this->session->userdata('json');
        $data['heading'] = $data['json']['status'];
        
        $this->load->view('error', $data);
    }
}
