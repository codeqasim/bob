<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitemap extends MX_Controller {


  function __construct(){

    }

	public function index()
    {
        $params = array("token"=>123);
        $documentations = json_decode(server_request($params, SERVERNAME . 'documentation/list'));
        $data["documentations"] = $documentations->data;
        $categories = $documentations->categories;
        $data["urls"] = site_map();
        foreach ($categories as $category)
        {
            foreach ($category->categories as $sub_cat){
                array_push($data["urls"],"documentation/".strtolower(str_replace(" ","-",$category->name))."/".$sub_cat->slug);
            }
        }
        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("sitemap",$data);
    }

}
