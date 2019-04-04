<?php
/**
 * Created by PhpStorm.
 * User: qasimhussain
 * Date: 1/17/19
 * Time: 12:46 AM
 */

class Flights extends  MY_Controller
{

    /**
     * Flights constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function settings()
    {

        $post = $this->input->post();
//        dd($_FILES["cities_images"]);
        if(!empty($post))
        {
            $credentials = [];
//            if(!empty($post["key_credentials"]))
//            {
//                foreach ($post["key_credentials"] as $index=>$k)
//                {
//                    $credentials[$k] = $post["values_credentials"][$index];
//                }
//            }
            $params["ota_id"] = $this->getOTAdata()->ota_id;
            $params["title"] = $this->uri->segment(1);
            $params = array_merge($params,$post);
//            if(empty($post["is_own_credentials"]))
//            {
//                $params["is_own_credentials"] = 0;
//            }else{
//                $params["is_own_credentials"] = 1;
//            }
//            if(empty($post["is_active"]))
//            {
//                $params["is_active"] = 0;
//            }else{
//                $params["is_active"] = 1;
//            }
            if(empty($post["is_feature_cities"]))
            {
                $params["is_feature_cities"] = 0;
            }else{
                $params["is_feature_cities"] = 1;
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
            if(!empty($params["airlines"]))
            {
                $params["airlines"] = json_encode($params["airlines"]);
                $params["froms"] =    json_encode($params["froms"]);
                $params["tos"] =      json_encode($params["tos"]);
                $params["numbers"] =  json_encode($params["numbers"]);
            }
            $response = json_decode(server_request($params, SERVERNAME . 'ota/modules/update/settings'));
            if($response->status != "success")
            {
                redirect('404_override');
            }else{
                $data["message"] = "Save Successfully.";
                $data["class"] = "success";
            }
        }
        $params = array();
        $params["ota_id"] = $this->getOTAdata()->ota_id;
        $params["title"] = $this->uri->segment(1);
        $response = json_decode(server_request($params, SERVERNAME . 'ota/modules/settings'));
        $data["data"] = $response->data;
        if(!empty($data["data"]->feature_cities))
        {
            usort($data["data"]->feature_cities, function ($item1, $item2) { return $item1->number<=> $item2->number;});
        }
        if($response->status != "success")
        {
            redirect('404_override');
        }
        $data['head'] = 'ota/head';
        $data["b_title"] = "Modules Settings";
        render('ota/flights_settings', $data);

    }

}