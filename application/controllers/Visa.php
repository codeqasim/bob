<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visa extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $params['ota_id'] = $this->getOTAdata()->ota->ota_id;
        $params['model_name'] = 'ivisa';
        $params['from'] = $this->uri->segment(2);
        $params['to'] = $this->uri->segment(3);
        $data['application_html'] = json_decode(server_request($params, APPURL . 'ota/ivisa/listing'))->data;
        if($data['application_html'] == "404")
        {
            redirect('404_override');
        }
        $data['countires'] = json_decode(file_get_contents(APPURL . "global/countries?token=" . TOKEN))->data;
        foreach ($data ['countires'] as $country)
        {
            if($country->sortname == $params['from'])
            {
                $data['from'] = $country->name;
            }
            if ($country->sortname == $params['to']) {
                $data['to'] = $country->name;
            }
        }
        $session_boj = (object)array("from" => $data["from"], "to" => $data["to"], "from_code" => $params["from"], "to_code" => $params["to"]);
        $this->session->set_userdata('ivisa_data', $session_boj);
        $data["ivisa_s"] = $this->session->userdata("ivisa_data");
        $data["title"] = $data["from"] . "-" . $data["to"];
        $this->theme->view('modules/visa/index', $data);
    }
}