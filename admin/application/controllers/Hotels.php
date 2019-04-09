<?php
/**
 * Created by PhpStorm.
 * User: qasimhussain
 * Date: 1/17/19
 * Time: 12:45 AM
 */

class Hotels extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

    }
    public function settings()
    {
        $post = $this->input->post();
        if(!empty($post))
        {
            $credentials = [];
            if(!empty($post["key_credentials"]))
            {
                foreach ($post["key_credentials"] as $index=>$k)
                {
                    $credentials[$k] = $post["values_credentials"][$index];
                }
            }
            $params["ota_id"] = $this->getOTAdata()->ota_id;
            $params["title"] = $this->uri->segment(1);
            if(empty($post["is_own_credentials"]))
            {
                $params["is_own_credentials"] = 0;
            }else{
                $params["is_own_credentials"] = 1;
            }
            if(empty($post["pay_later"]))
            {
                $params["pay_later"] = 0;
            }else{
                $params["pay_later"] = 1;
            }
            if(empty($post["pay_now"]))
            {
                $params["pay_now"] = 0;
            }else{
                $params["pay_now"] = 1;
            }
            if(empty($post["is_active"]))
            {
                $params["is_active"] = 0;
            }else{
                $params["is_active"] = 1;
            }
            if(empty($post["is_feature_cities"]))
            {
                $params["is_feature_cities"] = 0;
            }else{
                $params["is_feature_cities"] = 1;
            }
            $response = json_decode(server_request($params, SERVERNAME . 'ota/modules/update/settings'));
            if($response->status != "success")
            {
                exit("sdfsd");
                dd($response);
//                redirect('404_override');
            }else{
                $data["message"] = "Save Successfully.";
                $data["class"] = "success";
            }
        }
        $params = array();
        $params["ota_id"] = $this->getOTAdata()->ota_id;
        $params["title"] = $this->uri->segment(1);
        $response = curl_server_request($params, SERVERNAME . 'ota/modules/settings');
        if($response["status"] == "success")
        {
         $response = json_decode($response["data"]);
        }else{
            exit("Contact To Admin");
        }
        if(!empty($response->data->feature_cities))
        {
            usort($response->data->feature_cities, function ($b, $a) {
                return $b->number - $a->number;
            });
        }
        $data["data"] = $response->data;
        if($response->status != "success")
        {
            dd($response);
//            redirect('404_override');
        }
        $data['head'] = 'ota/head';
        $data["b_title"] = "Modules Settings";
        render('ota/hotels_settings', $data);

    }
}