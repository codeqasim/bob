<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('xcrud');
//        define('SUPPLIER_HOTELS', XCRUD_UPLOAD_PATH.$this->getOTAdata()->ota_id.'/supplier/'.$this->session->userdata('supplier_data')->supplier_id."/hotels");
    }
    
    public function checkLogin(){
        if(!empty($this->session->userdata('supplier_data'))){
            redirect('supplier/dashboard');
        }
    }
    public function login() {
        $this->checkLogin();
        if (!isset($_POST['login-submit'])) {
            $this->load->view('supplier/login');
        }
        // when form submitted
        else {
            // form validation 
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
            // If form is invalid 
            if ($this->form_validation->run() == FALSE) {
                $data['error'] = validation_errors();
                $this->load->view('supplier/login', $data);
            } else {
                $payload = $this->input->post();
                $parms = array();
                $parms["email"] = $payload["email"];
                $parms["password"] = $payload["password"];
                $parms["ota_id"] = $this->getOTAdata()->ota_id;
                $result = json_decode(server_request($parms,APPURL.'supplier/login'));
                if($result->status == "success"){
                        $this->session->set_userdata("supplier_data",$result->data);
                        redirect('supplier/dashboard');
                } else {
                    $data['error'] = $result->data;
                }
                $this->load->view('supplier/login', $data);
            }
        }
    }

    public function logout() {

        $this->session->unset_userdata('supplier_data');
        redirect('supplier/login');
    }

    public function signup() {
        
        $this->checkLogin();

        $data['countries'] = json_decode(file_get_contents(APPURL . "global/countries?token=" . TOKEN))->data;;
//        $data['types'] = json_decode(file_get_contents(APPURL.'getTypes'))->data;

        if ($_SERVER['REQUEST_METHOD'] == 'GET' || isset($_POST['ota'])) {

            $this->theme->view('supplier/signup', $data);
        } else {
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean');
            $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean');
            $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address_one', 'Adderss 1', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean');
//            $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data["error"] = validation_errors();
                $this->theme->view('supplier/signup', $data);
            } else {
                $payload = $this->input->post();
                foreach ($payload as $key => $val) {
                    set_value($key, $val);
                }
                // check ota id is valid
                $payload["ota_id"] = $this->getOTAdata()->ota_id;
                $payload["token"] = "123";
                $result = json_decode(server_request($payload,APPURL.'supplier/signup'));
                if($result->status == "Success")
                {
                    $this->session->set_userdata('success', 'Successfully Registered');
                    $data['message'] = 'Your account has been registered with us. we will send you email shortly.';
                }else{
                    $data['error'] = $result->data;
                }
                $this->theme->view('supplier/signup', $data);
            }
        }
    }

    public function verification(){

        $code = $this->uri->segment(2);
        $result = json_decode(file_get_contents(APPURL."global/verifications?token=123&code=".$code));
        if($result->status == "success")
        {
            $data["supplier_data"] = $result->data;
            $this->session->set_userdata("supplier_data",$data["supplier_data"]);

            if(!is_dir(FCPATH.'uploads/ota/'.$this->getOTAdata()->ota_id.'/supplier/'.$data["supplier_data"]->supplier_id))
            {
                mkdir(FCPATH.'uploads/ota/'.$this->getOTAdata()->ota_id.'/supplier/'.$data["supplier_data"]->supplier_id, 0777, true);
                mkdir(FCPATH.'uploads/ota/'.$this->getOTAdata()->ota_id.'/supplier/'.$data["supplier_data"]->supplier_id.'/hotels', 0777, true);
                mkdir(FCPATH.'uploads/ota/'.$this->getOTAdata()->ota_id.'/supplier/'.$data["supplier_data"]->supplier_id.'/hotels/thumbs', 0777, true);
                mkdir(FCPATH.'uploads/ota/'.$this->getOTAdata()->ota_id.'/supplier/'.$data["supplier_data"]->supplier_id.'/rooms', 0777, true);
                mkdir(FCPATH.'uploads/ota/'.$this->getOTAdata()->ota_id.'/supplier/'.$data["supplier_data"]->supplier_id.'/rooms/thumbs', 0777, true);
            }
            redirect("supplier/dashboard");
        }else{
            echo "Code is wrong";
        }
    }

    public function getStates(){
       echo json_encode(json_decode(file_get_contents(APPURL . "global/states?token=".TOKEN."&country_id=".$this->input->post('country_id')))->data);
    }
    public function getCities(){
       echo json_encode(json_decode(file_get_contents(APPURL . "global/cities?token=".TOKEN."&state_id=".$this->input->post('state_id')))->data);
    }
    public function dashboard() {
        
        if($this->session->userdata('supplier_data') == FALSE){
            redirect('supplier/login');
        }
        
//        $xcrud = Xcrud::get_instance();
//        $xcrud->unset_title();
//        $xcrud->unset_add();
//        $xcrud->before_update('booking_status');
//        $xcrud->table('bookings');
//        $xcrud->join('room_id', 'rooms', 'id', [], 'not_insert');
//        $xcrud->join('rooms.hotel_id', 'hotels', 'id', [], 'not_insert');
//        $xcrud->columns(array('booking_code', 'first_name', 'last_name', 'checkin', 'checkout', 'price', 'status'));
//        $xcrud->fields(array('status', 'booking_code', 'checkin', 'checkout', 'price'));
//        $xcrud->change_type('status', 'radio', 'pending', 'pending,confirmed,canceled');
//        $xcrud->where('hotels.user_id', $this->session->userdata('ota_user_id'));
//        $xcrud->order_by('id', 'desc');
//        $xcrud->multiDelUrl = base_url() . 'supplier/deleteSelectedBookings';
//        $data['list'] = $xcrud->render();
        $this->theme->view('supplier/dashboard', null);
    }

    public function deleteSelectedBookings() {
        
        if (!$this->input->is_ajax_request()) {
            return false;
        } else {
            $ids = implode(',', $this->input->post('items'));
            $this->Home->deleteRecord('bookings', ['string' => "id in ($ids)"]);
            return true;
        }
        
    }
    
    public function hotels(){

        // get module id
       // $hotel = $this->Home->checkRecord('modules', ['name' => $this->uri->segment(2)]);
        $supplier = $this->session->userdata('supplier_data');

        $xcrud = Xcrud::get_instance();
        $xcrud->unset_title();
        $xcrud->table('hotels');
        $xcrud->validation_required('company_name');
        $xcrud->validation_required('description');
        $xcrud->validation_required('rating');
        $xcrud->validation_required('coords');
        $xcrud->validation_required('hotel_images.image_url');
        $xcrud->validation_required('hotels.city_id');
        $xcrud->join('id', 'hotel_images', 'hotel_id');
        $xcrud->join('city_id', 'cities', 'id', [], 'not_insert');
//        $xcrud->join('user_id','ota_registration','id');
        $xcrud->change_type('hotel_images.image', 'image', '', array(
            'path' => SUPPLIER_HOTELS,
            'thumbs' => array(
                array('width' => 250, 'height' => 250, 'folder' => 'thumbs')
            )));
        $xcrud->fk_relation('Amenities', 'id', 'hotel_amenities', 'hotel_id', 'amenity_id', 'amenities', 'id', array('title'));
        $xcrud->columns(array('company_name', 'supplier_id', 'rating', 'cities.name', 'hotels_status'));
        $xcrud->column_callback('status', 'room_status');
        $xcrud->column_callback('hotel_images.image', 'image_thumb');
        $xcrud->column_callback('hotels.hotel_domain', 'add_domain');
        $xcrud->column_callback('hotels.subdomain', 'add_domain');
        $xcrud->fields(array("hotel_images.image", "company_name", "description", "hotels.hotel_domain","cities.name", "hotels.address", "coords", "rating" , "Amenities"));
        $xcrud->label(array('hotel_images.image' => 'Thumbnail', 'supplier_id' => 'Supplier Name', 'name' => 'Hotel Name', 'coords' => 'Map Location'));
        $xcrud->field_callback('cities.name', 'city_select2');
        $xcrud->change_type('rating', 'select', '5', '1,2,3,4,5');
        $xcrud->change_type('coords', 'point', '29.836422956608384,69.82085562499992', array('zoom' => 5, 'search_text' => 'Type Your Location', 'search' => true, 'coords' => false));
        $xcrud->where('hotels.supplier_id', $supplier->supplier_id);
        $xcrud->order_by('id', 'desc');
        $xcrud->multiDelUrl = base_url() . 'supplier/deleteSelectedHotels';
        $data['list'] = $xcrud->render();
        $this->theme->view('supplier/xcrud_view', $data);
    }
    public function booking() {
        $hotel = $this->Home->checkRecord('modules', ['name' => $this->uri->segment(2)]);
        $xcrud = Xcrud::get_instance();
        $xcrud->unset_title();
        $xcrud->table('bookings');
        $xcrud->columns(array('status','booking_code','first_name','checkin','checkout','price'),false);
        $xcrud->join('room_id', 'rooms', 'id', [], 'not_insert');
        $xcrud->join('rooms.hotel_id', 'hotels', 'id', [], 'not_insert');
        $xcrud->where('hotels.supplier_id', $this->session->userdata('supplier_id'));

        $data['list'] = $xcrud->render();
        $this->theme->view('supplier/booking', $data);
    }

}
