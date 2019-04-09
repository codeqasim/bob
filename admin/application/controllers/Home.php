<?php

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    public function test1()
    {
        ini_set('zlib.output_compression', 1);
        $ch = curl_init();
        $url = "https://open.pkfare.com/apitest/shopping?param=ew0KICAgICJhdXRoZW50aWNhdGlvbiI6IHsNCiAgICAgICAgInBhcnRuZXJJZCI6ICJLVWplazZVOVJlQSs5YUFwZ1pwNTZIRlU0b2M9IiwNCiAgICAgICAgInNpZ24iOiAiNWE4MTIwNmM5NDUwMTZlMTFkMDgyODhkYWVkMTg3YzkiDQogICAgfSwNCiAgICAic2VhcmNoIjogew0KICAgICAgICAiYWR1bHRzIjogMSwNCiAgICAgICAgImFpcmxpbmUiOiAiIiwNCiAgICAgICAgImNoaWxkcmVuIjogMSwNCiAgICAgICAgIm5vbnN0b3AiOiAwLA0KICAgICAgICAic2VhcmNoQWlyTGVncyI6IFsNCiAgICAgICAgICAgIHsNCiAgICAgICAgICAgICAgICAiY2FiaW5DbGFzcyI6ICJFY29ub215IiwNCiAgICAgICAgICAgICAgICAiZGVwYXJ0dXJlRGF0ZSI6ICIyMDE5LTA0LTEwIiwNCiAgICAgICAgICAgICAgICAiZGVzdGluYXRpb24iOiAiTUVMIiwNCiAgICAgICAgICAgICAgICAib3JpZ2luIjogIkhLRyINCiAgICAgICAgICAgIH0NCiAgICAgICAgXSwNCiAgICAgICAgInNvbHV0aW9ucyI6IDANCiAgICB9DQp9";
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_ENCODING,'gzip');  // Needed by API
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $data = curl_exec($ch);
        dd(gzdecode($data ));
    }

    public function index()
    {
        $data['metas'] = home_meta();
        render('front/index', $data);
    }

    public function demo()
    {
        $data['metas'] = demo_meta();
        $data['title'] = "Demo Web Application";
        $data['tag'] = "The Public Demo of Travel Agency Software is set up so that you have the ability to quickly review the overall features";
        $data['head'] =  'front/head';
        render('front/demo', $data);
    }

    public function features()
    {
        $data['metas'] = features_meta();
        $data['title'] = "Features";
        $data['tag'] = "Checkout platform features";
        $data['head'] =  'front/head';
        render('front/features', $data);
    }

    public function documentation()
    {
        $params = array("token"=>123);
        $documentations = json_decode(server_request($params, SERVERNAME . 'documentation/list'));
        $data["documentations"] = $documentations->data;
        $data["categories"] = $documentations->categories;
        $data['metas'] = documentation_meta();
        $data['title'] = "Documentation";
        $data['tag'] = "All technical and general information available here to manage your portal";
        $data['head'] =  'front/head';
        $data["check_doc"] = "sdf";
        render('front/docs_index', $data);
    }
    public function documentation_details()
    {
        $params = array("token"=>123,"search"=>$this->uri->segment(3));
        $documentations = json_decode(server_request($params, SERVERNAME . 'documentation/details'));
        $data["documentations"] = $documentations->data;
        $desc = str_replace("\n" ,"",trim(str_replace("&nbsp;", '',(strip_tags(substr($data["documentations"]->content,0,150))))));
        $desc = strip_tags($desc);
        $data['metas'] = global_meta($data["documentations"]->title,$desc,base_url(uri_string()),"","");
        $data["categories"] = $documentations->categories;
        $data['metas'][0]->pcontent = $data["documentations"]->title;
        $data['tag'] = "All technical and general information available here to manage your portal";
        $data['head'] =  'front/head';
        $data["check_doc"] = "sdf";
        render('front/docs_details', $data);
    }

    public function cities()
    {
        $json = array();
        $response = json_decode(file_get_contents(SERVERNAME.'hotels/locations?token=123&value='.$this->input->get('q')),true);
        if ($response['status'] == "success" && $response['code'] == "200") {
            foreach ($response['data'] as $value) {
                $json[] = array(
                    'id'=> $value['id'],
                    'text' => $value['name'].' - '.$value['country_name']
                );
            }
        } else {
            $json = array();
        }
        echo json_encode($json);
    }
    public function airports()
    {
        $json = array();
        $response = json_decode(file_get_contents(SERVERNAME.'global/airports?token=123&code='.$this->input->get('q')),true);
        if ($response['status'] == "success" && $response['code'] == "200") {
            foreach ($response['data'] as $value) {
                $json[] = array(
                    'id'=> $value['id'],
                    'text' => $value['cityName']. "(" .$value['code'] . ")"
                );
            }
        } else {
            $json = array();
        }
        echo json_encode($json);
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
        $data['tag'] = "Use mainly the color logo whenever possible to represent <strong>travelhope</strong>";
        $data['head'] =  'front/head';
        render('front/media_kit', $data);
    }

    public function pricing() {
        $data['metas'] =  pricing_meta();
        $data["results"] = json_decode(file_get_contents(SERVERNAME."global/packages?token=123"))->data;
        $data['title'] = "Cloud Software Pricing";
        $data['tag'] = "Simple pricing no surprises subscribe and get started today";
        $data['head'] =  'front/head';
        render('front/pricing', $data);
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
    public function verification(){

        $code = $this->uri->segment(2);
        $result = json_decode(file_get_contents(SERVERNAME."global/verify?token=123&code=".$code));
        if($result->status == "success")
        {
            $data["otadata"] = $result->data;
            $this->session->set_userdata("otadata", $data["otadata"]);
            $params = array("ota_id"=>$result->data->ota_id);
            $modules_ota = json_decode(server_request($params, SERVERNAME . 'ota/modules/getsettings'))->data;
            $this->session->set_userdata("modules_ota", $modules_ota);
            if(!is_dir(FCPATH.'uploads/ota/'.$data["otadata"]->ota_id))
            {
                mkdir(FCPATH.'uploads/ota/'.$data["otadata"]->ota_id, 0777, true);
                mkdir(FCPATH.'uploads/ota/'.$data["otadata"]->ota_id.'/blogs', 0777, true);
                mkdir(FCPATH.'uploads/ota/'.$data["otadata"]->ota_id.'/blogs/thumbs', 0777, true);
                mkdir(FCPATH.'uploads/ota/'.$data["otadata"]->ota_id.'/slider', 0777, true);
            }
//            if(!$data["otadata"]->dns_status)
//            {
//                $data['dnsData'] = $this->checkdns($data["otadata"]->ota->ota_domain);
//                if($data['dnsData']->data->match)
//                {
//                    $data["otadata"]->dns_status = 1;
//                    $this->session->set_userdata("otadata", $data["otadata"]);
//                }
//            }
            redirect("dashboard");
        }else{
            echo $result->data;
        }
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
    public function checkdns($domain_name)
    {
        $result = json_decode(file_get_contents(SERVERNAME."global/checkdns?token=123&domain=".$domain_name));
        return $result;
    }
    public function get_cities()
    {
        $input = $this->input->get('q');
        $data = json_decode(file_get_contents(SERVERNAME . "global/airlines?name=" . $input . "&token=123"), true);
        if ($data['status'] == "success" && $data['code'] == "200") {
            foreach ($data['data'] as $value) {
                $json[] = array(
                    'text' => $value['name'],
                    'id' => $value['id']
                );
            }
        } else {
            $json = "";
        }
        echo json_encode($json);
    }
}