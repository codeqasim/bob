<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitemap extends MY_Controller {


    /**
     * Sitemap constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //select urls from DB to Array
        $params['ota_id'] = $this->getOTAdata()->ota->ota_id;
        $data["urls"] = [
            "login/",
            "signup/",
            "contact/",
            "about/",
            "policy/",
            "terms/"
        ];
        $params['offset'] =  0;
        $params['limit'] =  1000;
        $blog_list = json_decode(server_request($params, APPURL.'ota/get_blogs'))->data;
        $categoris = json_decode(server_request($params, APPURL.'ota/get_categories'))->data;
        foreach ($categoris as $cat)
        {
            array_push($data["urls"],'blog/'.strtolower(str_replace(' ','-',$cat->category)));
        }
        foreach ($blog_list as $bl)
        {
            array_push($data["urls"],'blog/'.strtolower(str_replace(' ','-',$bl->category).'/'.str_replace(' ','-',$bl->title)));
        }
        $params = array(
            'ota_id' => $this->getOTAdata()->ota->ota_id,
            'city' => "",
            'from' => date('Y-m-d'),
            'to' => date('Y-m-d', strtotime(date('Y-m-d') . "+1 day")),
            'adults' => 1,
            'childs' => 0,
        );
        $hotel_data = json_decode(server_request($params, APPURL . 'ota/hotels/list'))->data;
        foreach ($hotel_data as $hd)
        {
            array_push($data["urls"],"hotel/".$hd->hotel_slug);
        }
        $hotel_data_cities = json_decode(server_request($params, APPURL . 'sitemap/hotels'))->data;
        foreach ($hotel_data_cities as $hd)
        {
            array_push($data["urls"],"hotels/".str_replace(" ","-",strtolower($hd->name)));
        }
        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("sitemap",$data);
    }

}
