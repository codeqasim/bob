<<<<<<< HEAD
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
=======
<?php

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['metas'] = home_meta();
        render('front/index', $data);
    }

    public function login()
    {
        if(!empty(getOta())){
            redirect('dashboard');
        }
        if(!empty($this->input->post()))
        {
            $post = $this->input->post();
            $post["token"] = "123";
            $response = json_decode(server_request($post, SERVERNAME . "global/login"));
            if($response->status == "success")
            {
                $this->session->set_userdata("otadata", $response->data);
                $params = array("ota_id"=>$response->data->ota_id);
                $modules_ota = json_decode(server_request($params, SERVERNAME . 'ota/modules/getsettings'))->data;
                $this->session->set_userdata("modules_ota", $modules_ota);
                redirect('dashboard');
            }else{
                $data["error"] = $response->data;
            }

        }
        $data['metas'] =  login_meta();
        render('front/login', $data);
    }
    public function forget_password()
    {
        $params = array("email"=>$this->input->post('email'),"token"=>123,"user_type"=>"ota");
        $result = json_decode(server_request($params, SERVERNAME . "global/resetpasswrod"))->data;
        if($result->status == "success")
        {
            echo true;
        }else{
            echo false;
        }
    }

    public function signup()
    {
        $otadata = $this->session->userdata('otadata');
        if(empty($otadata)) {
            $data['metas'] = signup_meta();
            $post = $this->input->post();
            if (!empty($post)) {
                $data["email"] = $this->input->post('email_pass');
                $data["package_id"] = $this->input->post('package_id');
                if (count($post) > 1) {
                    $post = array(
                        "first_name" => $this->input->post('first_name'),
                        "last_name" => $this->input->post('last_name'),
                        "email" => $this->input->post('email'),
                        "password" => $this->input->post('password'),
                        "country_id" => $this->input->post('country_id'),
                        //"ota_domain" => $this->input->post('ota_domain'),
                        "package_id" => $this->input->post('package_id'),
                        "business_name" => $this->input->post('business_name'),
                        "token" => TOKEN,
                    );
                    $response = json_decode(server_request($post, SERVERNAME . "global/signup"));
                    if ($response->status == "success") {
                        redirect('email_verify');
                    } else {
                        $data["error"] = $response->data;
                    }
                }
            } else {
                $data["email"] = "";
            }
            $data['countries'] = json_decode(file_get_contents(SERVERNAME . "global/countries?token=" . TOKEN))->data;
            $data['packages'] = json_decode(file_get_contents(SERVERNAME . "global/packages?token=" . TOKEN))->data;
            render('front/signup', $data);
        }else{
            redirect('dashboard');
        }

    }

    public function policy() {
        $data['metas'] =  policy_meta();
        $data['title'] = "Privacy Policy";
        $data['tag'] = "Please read carefully our policy";
        $data['head'] =  'front/head';
        render('front/policy', $data);
    }

    public function terms() {
        $data['metas'] =  terms_meta();
        $data['title'] = "Terms and Conditions";
        $data['tag'] = "Please read our terms before using our service";
        $data['head'] =  'front/head';
        render('front/terms', $data);
    }

    public function contact()
    {
        $data['title'] = "Contact Us";
        $data['tag'] = "Get in touch";
        $data['head'] =  'front/head';
        $data['metas'] =  contact_meta();
        render('front/contact', $data);
    }

    public function about()
    {
        $data['title'] = "About Us";
        $data['tag'] = "Why Choose travelhope";
        $data['head'] =  'front/head';
        $data['metas'] =  about_meta();
        render('front/about', $data);
    }

    public function newsletter()
    {
        $data['metas'] =  newsletter_meta();
        render('front/newsletter', $data);
    }

    public function subscribe()
    {
        $result = json_decode(file_get_contents(SERVERNAME."global/subscribe?token=123&email=".$this->input->post('email')));
        if($result->status == "success")
        {
            echo true;
        }else{
            echo  false;
        }
    }

    public function team() {
        $data['metas'] =  team_meta();
        $data['title'] = "Our Team";
        $data['tag'] = "What we are made of";
        $data['head'] =  'front/head';
        render('front/team', $data);
    }

    public function error(){
        $this->output->set_status_header('404');
        $data['metas'] =  error_meta();
        render('front/404', $data);
    }

     public function media() {
        $data['metas'] =  media_meta();
        $data['title'] = "Brand Logo";
        $data['tag'] = "Use mainly the color logo whenever possible to represent";
        $data['head'] =  'front/head';
        render('front/media_kit', $data);
    }

    public function checkEmail()
    {
        $postData = array(
            "email"=>$this->input->post('email'),
            "token"=>TOKEN
        );
        $response = json_decode(server_request($postData,SERVERNAME."global/checkemail"));
        if($response->status=="success"){
            echo "done";
        }else{
            echo "Email Already Found";
        }

    }

    public function email_verify()
    {
        $data['metas'] =  verify_meta();
        $data['title'] = "Account registered";
        $data['tag'] = "Verification sent to mailbox.";
        $data['head'] =  'front/head';
        render('front/signup_completed', $data);
    }

    public function logout(){
        $params = array(
            "ota_id" => getOta()->ota_id,
            "secret" => getOta()->secret,
        );
        json_decode(server_request($params,SERVERNAME.'ota/logout'));
        $this->session->unset_userdata("otadata");
        redirect('login');
    }

}
>>>>>>> 00aa54c04b51b2ae497af0dc074d40bba53c6db2
