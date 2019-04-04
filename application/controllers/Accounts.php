<?php

class Accounts extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('xcrud');
        if (empty($this->getOTAdata())) {
            redirect('login');
        }
    }
    public function index()
    {
        $data['metas'] = home_meta();
        render('front/index', $data);
    }
    public function vendors()
    {
        $xcrud = Xcrud::get_instance();
        $xcrud->table('suppliers');
        $xcrud->unset_title();
        $xcrud->join('account_id', 'accounts', 'id', null, ['no_insert']);
        $xcrud->where('ota_id',$this->getOTAdata()->ota_id);
        $xcrud->columns(array("accounts.first_name","accounts.last_name","accounts.email","suppliers.ota_approved"));
        $xcrud->fields(array("accounts.first_name","accounts.last_name","accounts.email","suppliers.ota_approved","suppliers.is_hotel_allow","suppliers.is_package_tour_allow"));
        $xcrud->label(array("suppliers.is_hotel_allow"=>"Allow Hotels","suppliers.is_package_tour_allow"=>"Allow Packages"));
        $result = $xcrud->render();
        $data['data']['list'] = $result;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Suppliers Account   ";
        render('ota/blog_category', $data);
    }
    public function customers()
    {
        $xcrud = Xcrud::get_instance();
        $xcrud->table('users');
        $xcrud->unset_title();
        $xcrud->unset_add();
        $xcrud->join('account_id', 'accounts', 'id', null, ['no_insert']);
        $xcrud->where('users.ota_id',$this->getOTAdata()->ota_id);
        $xcrud->columns(array("accounts.first_name","accounts.last_name","accounts.email"));
        $xcrud->fields(array("accounts.first_name","accounts.last_name","accounts.email"));
        $result = $xcrud->render();
        $data['data']['list'] = $result;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Suppliers Account   ";
        render('ota/blog_category', $data);
    }
    public function guest_customers()
    {
        $xcrud = Xcrud::get_instance();
        $xcrud->table('guest');
        $xcrud->unset_title();
        $xcrud->unset_add();
        $xcrud->join('account_id', 'accounts', 'id', null, ['no_insert']);
        $xcrud->where('guest.ota_id',$this->getOTAdata()->ota_id);
        $xcrud->columns(array("accounts.first_name","accounts.last_name","accounts.email"));
        $xcrud->fields(array("accounts.first_name","accounts.last_name","accounts.email"));
        $result = $xcrud->render();
        $data['data']['list'] = $result;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Suppliers Account   ";
        render('ota/blog_category', $data);
    }
}