<?php

class Bookings extends MY_Controller {

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
        $xcrud = Xcrud::get_instance();
        $xcrud->table('super_booking');
        $xcrud->join('account_id', 'accounts', 'id', null, ['no_insert']);
        $xcrud->join('model_id', 'modules', 'id', null, ['no_insert']);
        $xcrud->order_by('super_booking.id', 'desc');
        $xcrud->label(array("super_booking.id"=>"Invoice #","modules.name"=>"Model","super_booking.device_type"=>"Invoice"));
        $xcrud->columns(array("super_booking.id","accounts.first_name","modules.name","accounts.last_name","accounts.email","super_booking.booking_status","super_booking.device_type"));
        $xcrud->fields(array("super_booking.id","accounts.first_name","modules.name","accounts.last_name","accounts.email","super_booking.booking_status","super_booking.id"));
        $xcrud->column_callback('device_type','invoice_url');
        $xcrud->unset_title();
        $xcrud->unset_add();
        $xcrud->unset_view();        $result = $xcrud->render();
        $data['data']['list'] = $result;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Booking";
        render('ota/blog_category', $data);
    }
}