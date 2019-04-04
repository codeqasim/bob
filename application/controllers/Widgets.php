<?php

class Widgets extends MY_Controller {

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
        $params["ota_id"] = $this->getOTAdata()->ota_id;
        $data["result"] = json_decode(server_request($params,SERVERNAME."ota/widgets/list"))->data;
        $data['head'] = 'ota/head';
        $data["b_title"] = "widgets Integration";
        render('ota/widget', $data);
    }
    public function update_widgets()
    {
        $params = array();
        $post = $this->input->post();
        $params["name"] = $post["name"];
        unset($post["name"]);
        if(isset($post["check"]))
        {
            $params["widget_status"] = 1;
            unset($post["check"]);
        }else{
            $params["widget_status"] = 0;
        }
        $params["credentials"] = json_encode($post);
        $params["ota_id"] = $this->getOTAdata()->ota_id;
        $result = json_decode(server_request($params,SERVERNAME."ota/widgets/update"));
        if($result->status)
        {
            echo "done";
        }else{
            echo "error";
        }
    }

}