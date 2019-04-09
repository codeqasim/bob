<?php

class Reports extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('xcrud');
    }

    public function load_dashboard_report()
    {
        $parms = [
            "ota_id"=>$this->getOTAdata()->ota_id,
            "month"=>$this->input->post('month_id'),
        ];
        $data["reports"] = json_decode(server_request($parms, SERVERNAME . "ota/reports/list"))->data;
        $this->load->view('ota/vendor_booking_status',$data);
    }
    public function load_dashboard_report_current()
    {
        $parms = [
            "ota_id"=>$this->getOTAdata()->ota_id,
            "month"=>$this->input->post('month_id'),
        ];
         echo json_encode(json_decode(server_request($parms, SERVERNAME . "ota/reports/current"))->data);
    }

}