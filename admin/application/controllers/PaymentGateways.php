<?php

class PaymentGateways extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        if (empty($this->getOTAdata())) {
            redirect('login');
        }
    }

    public function index()
    {
        $params = array('ota_id' => $this->getOTAdata()->ota_id);
        $data["gateways"] = json_decode(server_request($params, SERVERNAME . 'gateways/all'))->data;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Gateways";
        render('ota/gateways', $data);
    }
    public function update_gateways()
    {
        $params = array(
            'ota_id' => $this->getOTAdata()->ota_id,
            'status'=>$this->input->post('is_active'),
            'id'=>$this->input->post('gateway_id'),
            'gateway_id'=>$this->input->post('ota_gateway_id')
        );
        $data["gateways"] = json_decode(server_request($params, SERVERNAME . 'gateways/update_gateway'))->data;
        echo  "done";
    }
}