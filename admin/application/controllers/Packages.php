<?php

class Packages extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function add()
    {
        $data['head'] = 'ota/head';
        $data['b_title'] = 'Add Packages';
        render('ota/packages/manage', $data);
    }


}