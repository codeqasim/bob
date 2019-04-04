<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{


    /**
     * Home constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Blog_model');
    }

    public function invalidAuth()
    {
        $this->load->view('errors/html/error_404');
    }
    public function index()
    {

        $blog_settings = $this->Blog_model->getBlogSettings();
        if(empty($blog_settings->show_home_page)){
            $data['blog'] = [];
        }else{
            $params['limit'] = $blog_settings->number_home_page;
            $data['blog'] =  $this->Blog_model->getBlogs();
        }
        $data["query"] = $this->session->userdata('hotel_search');
        if(empty($data["query"]))
        {
            $data["query"] = array("city"=>"","from"=>date("Y-m-d"),"to"=> date("Y-m-d", strtotime(date('Y-m-d')."+1 day")),"adults"=>2,"children"=>0);
        }

        $this->load->model('SearchForm');
        $searchForm = new SearchForm();
        $data["searchForm"] = $searchForm;
        $this->theme->view('home', $data);
    }
    public function subscribe()
    {
        $params = array(
            "email"=>$this->input->post("email"),
            "ota_id"=>$this->getOTAdata()->ota->ota_id);
        $result = json_decode(server_request($params, APPURL . 'ota/subscribe'));
        if($result->status == "success")
        {
            echo true;
        }else{
            echo  false;
        }
    }
    public function refresh()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
    public function get_cities()
    {
        $input = $this->input->get('query');
        $data = json_decode(file_get_contents(APPURL . "global/airports?code=" . $input . "&token=123"), true);

        if ($data['status'] == "success" && $data['code'] == "200") {
            foreach ($data['data'] as $value) {
                $json[] = array(
                    'countrycode' => $value['countryCode'],
                    'citycode' => $value['cityCode'],
                    'cityname' => $value['cityName'],
                    'airportname' => $value['name']
                );
            }
        } else {
            $json = "";
        }
        echo json_encode($json);
    }
    public function errors()
    {
    $data = array();
    $data["title"] = "Not Found!";
    $this->theme->view('404', $data);

    }
    public function getStates(){
        echo json_encode(json_decode(file_get_contents(APPURL . "global/states?token=".TOKEN."&country_id=".$this->input->post('country_id')))->data);
    }
    public function getCities(){
        echo json_encode(json_decode(file_get_contents(APPURL . "global/cities?token=".TOKEN."&state_id=".$this->input->post('state_id')))->data);
    }

    public function livechat()
    {
    $data = array();
    $data["title"] = "LiveChat Support!";
    $this->theme->view('livechat', $data);

    }
}
