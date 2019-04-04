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