<?php
/**
 * Created by PhpStorm.
 * User: qasimhussain
 * Date: 8/3/18
 * Time: 12:21 AM
 */

class MY_Controller extends CI_Controller
{

    private $otadata;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->otadata = $this->session->userdata('otadata');
        $data["otadata"] = $this->getOTAdata();
        $data["ota_modules"] = $this->session->userdata('modules_ota');
        if(empty($data["otadata"]))
        {
            redirect('login');
        }
        if(($data["otadata"]->debit_balance > 0) && uri_string() != "account" )
        {
            redirect(base_url("account"));
        }
        $this->load->vars($data);
    }
    function getOTAdata(){
        return $this->otadata;
    }
}