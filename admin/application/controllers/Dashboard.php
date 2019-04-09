<?php
/**
 *
 * Created by PhpStorm.
 * User: qasimhussain
 * Date: 9/19/18
 * Time: 11:36 AM
 */

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper('xcrud');
        if (empty($this->getOTAdata())) {
            redirect('login');
        }
        define('XCRUD_UPLOAD_PATH', '../../uploads/ota/' . $this->getOTAdata()->ota_id);
    }

    public function index()
    {
        $data["otadata"] = $this->getOTAdata();
//        if (!$data["otadata"]->dns_status) {
//            $data['dnsData'] = $this->checkdns($data["otadata"]->ota_domain);
//            if ($data['dnsData']->data->match) {
//                $data["otadata"]->dns_status = 1;
//                $this->session->set_userdata("otadata", $data["otadata"]);
//            }
//        }
        $data['head'] = 'ota/head';
        $data["b_title"] = "Dashboard";
        render('ota/dashboard', $data);
    }

    public function account()
    {
        $data['countries'] = json_decode(file_get_contents(SERVERNAME . "global/countries?token=" . TOKEN))->data;
        $post = $this->input->post();
        if (!empty($post)) {
            if (!empty($this->input->post('amount'))) {

                $post = array();
                $post["token"] = "123";
                $post["amount"] = $this->input->post('amount');
                $price = $this->input->post('amount');
                $post["ota_id"] = $this->getOTAdata()->ota_id;
                $prices = [
                    "USD:$price",
                ];
                $transaction = json_decode(server_request($post, SERVERNAME . "ota/wallet/make_invoice"))->data;
                $post["tranx_id"] = $transaction->tranx_id;
                dd(SERVERNAME . 'ota/wallet/update?' . http_build_query($post));
                $result = paddle_helper(SERVERNAME . 'ota/wallet/update?' . http_build_query($post), base_url('account'), $prices);
                if (!empty($result->success)) {
                    redirect($result->response->url);
                } else {
                    $data["message"] = $result->error->message;
                    $data["class"] = "danger";
                }
            } else {
                $post["account_id"] = $this->getOTAdata()->account_id;
                $post["ota_id"] = $this->getOTAdata()->ota_id;
                $post["TOKEN"] = TOKEN;
                $check = json_decode(server_request($post, SERVERNAME . 'ota/account/update'))->status;
                if ($check == "error") {
                    $data["message"] = "Email has been already taken.";
                    $data["class"] = "danger";
                } else {
                    $data["message"] = "Save Successfully.";
                    $data["class"] = "success   ";
                }
            }
        }
        $post = array();
        $post["token"] = "123";
        $post["ota_id"] = $this->getOTAdata()->ota_id;
        $data["transactions"] = $this->transactions();
        $data["account_data"] = json_decode(server_request($post, SERVERNAME . 'ota/account'))->data;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Account";
        render('ota/account', $data);
    }

    public function checkdns($domain_name)
    {
        $result = json_decode(file_get_contents(SERVERNAME . "global/checkdns?token=123&domain=" . $domain_name));
        return $result;
    }

    public function checkdns_view()
    {
        $data['head'] = 'ota/head';
        $data["b_title"] = "Check Dns";
        $data['dnsData'] = $this->checkdns($this->uri->segment(2));
        $data['ota_domain'] = $this->uri->segment(2);
        render('ota/checkdns', $data);
    }

    public function settings()
    {
        $post = $this->input->post();
        $data['head'] = 'ota/head';
        $data["b_title"] = "Settings";
        $main_obj = json_decode(file_get_contents(SERVERNAME . 'ota/getsettings?ota_id=' . $this->getOTAdata()->ota_id . '&secret=' . $this->getOTAdata()->secret))->data;
        $data["settings_data"] = $main_obj->ota_settings;
        $data["ota_languages"] = $main_obj->ota_languages;
        $data["ota_currencies"] = $main_obj->ota_currencies;
        $data["package"] = $main_obj->package;
        $data["themes"] = json_decode(file_get_contents(THEMEURL . 'getThemesList', false));
        if (empty($post)) {
            $data["b_title"] = "Settings";
            render('ota/settings', $data);
        } else if ($post["type_settings"] == "settings") {
            $config['upload_path'] = "uploads/ota";
            $config['allowed_types'] = 'png|jpg|gif';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            $error = false;
            $params = array();
            if (!empty($_FILES['favicon']['name'])) {
                if (!$this->upload->do_upload('favicon')) {
                    $data['errors'] = $this->upload->display_errors();
                    $error = true;
                }
                $favicon = $this->upload->data("file_name");
                if (empty($data['errors'])) {
                    if (!empty($favicon)) {
                        $imagedata = file_get_contents(FCPATH . "/uploads/ota/" . $favicon);
                        $params["favicon"] = base64_encode($imagedata);
                        unlink(FCPATH . "/uploads/ota/" . $favicon);
                    }
                }
            }
            if (!empty($_FILES['logo']['name'])) {
                if (!$this->upload->do_upload('logo')) {
                    $data['errors'] = $this->upload->display_errors();
                    $error = true;
                }
                $logo = $this->upload->data("file_name");
                if (empty($data['errors'])) {
                    if (!empty($logo)) {
                        $imagedata = file_get_contents(FCPATH . "/uploads/ota/" . $logo);
                        $params["logo"] = base64_encode($imagedata);
                        unlink(FCPATH . "/uploads/ota/" . $logo);
                    }
                }
            }
            if (!$error) {
                $params["ota_id"] = $this->getOTAdata()->ota_id;
                $params["secret"] = $this->getOTAdata()->secret;
                $params["business_name"] = $post["business_name"];
                $params["user_restrication"] = $post["user_restrication"];
                $params["is_ota_currency_detection"] = $post["is_ota_currency_detection"];
                $params["registration_restrication"] = $post["registration_restrication"];
                $params["copyrights"] = $post["copyrights"];
                $params["business_slogan"] = $post["business_slogan"];
                $data["message"] = "Save Successfully.";
                $data["class"] = "success";
                $params["type_settings"] = "settings";
                $data["settings_data"] = json_decode(server_request($params, SERVERNAME . 'ota/settings'))->data->ota_settings;
            } else {
                $data["message"] = $data["errors"];
                $data["class"] = "danger";
            }
            render('ota/settings', $data);
        } else if ($post["type_settings"] == "themes") {
            $config['upload_path'] = "uploads/ota/";
            $config['allowed_types'] = 'png|jpg|gif';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            $error = false;
            $params = array();
            if (!empty($_FILES['slider']['name'])) {
                if (!$this->upload->do_upload('slider')) {
                    $data['errors'] = $this->upload->display_errors();
                    $error = true;
                }
                $slider = $this->upload->data("file_name");
                if (empty($data['errors'])) {
                    if (!empty($slider)) {
                        $imagedata = file_get_contents(FCPATH . "/uploads/ota/" . $slider);
                        $params["slider"] = base64_encode($imagedata);
                        unlink(FCPATH . "/uploads/ota/" . $slider);
                    }
                }
            }
            if (!$error) {
                $params["ota_id"] = $this->getOTAdata()->ota_id;
                $params["secret"] = $this->getOTAdata()->secret;
                $params["theme"] = $post["theme"];
                $params["color"] = $post["color"];
                $params["type_settings"] = "themes";
                $data["message"] = "Save Successfully.";
                $data["class"] = "success";
                $main_obj = json_decode(server_request($params, SERVERNAME . 'ota/settings'))->data;
                $data["settings_data"] = $main_obj->ota_settings;
            } else {
                $data["message"] = $data["errors"];
                $data["class"] = "danger";
            }
            render('ota/settings', $data);
        }
    }

    public function blog()
    {
        $posts = $this->input->post();
        $data = [];
        if (!empty($posts)) {
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = "uploads/ota/";
            $config['allowed_types'] = 'png|jpg|gif';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            $params = array();
            if (!empty($_FILES['image_blog']['name'])) {
                if (!$this->upload->do_upload('image_blog')) {
                    $data['errors'] = $this->upload->display_errors();
                    $error = true;
                }
                $name = $this->upload->data("file_name");
                if (empty($data['errors'])) {
                    if (!empty($name)) {
                        $imagedata = file_get_contents(FCPATH . "/uploads/ota/" . $name);
                        $imagedata = base64_encode($imagedata);
                        unlink(FCPATH . "/uploads/ota/" . $name);
                        $params["image"] = $imagedata;
                        $params["id"] = $this->input->post('blog_id');
                        $params["ota_id"] = $this->getOTAdata()->ota_id;
                        $main_obj = json_decode(server_request($params, SERVERNAME . 'ota/blog/image'));
                        $data["message"] = "Save Successfully.";
                        $data["class"] = "success";
                    }
                } else {
                    $data["message"] = $data["errors"];
                    $data["class"] = "danger";
                }
            }
        }
        $xcrud = Xcrud::get_instance();
        $xcrud->table('blogs');
        $xcrud->order_by('id', 'desc');
        $xcrud->unset_title();
        $xcrud->column_class('image', 'zoom_img');
        $xcrud->relation('blog_category_id', 'blog_categories', 'id', 'category', array('blog_categories.ota_id' => $this->getOTAdata()->ota_id));
        $xcrud->columns(array('image', 'title', 'blog_category_id', 'created_at'));
        $xcrud->fields(array('title', 'blog_category_id', 'created_at', 'keywords', 'description', 'ota_id'));
        $xcrud->set_attr('title', array('id' => 'avoidCharacter'));
        $xcrud->before_insert('add_blog');
        $xcrud->before_remove('delete_blog_image', 'functions.php');
        $xcrud->column_callback('image', 'image_thumb');
        $xcrud->before_update('add_blog');
        $xcrud->button("javascript: upload_image('{blogs.id}')", 'Upload Image', 'glyphicon glyphicon-picture', 'btn-default', array('target' => '_self', 'id' => '{blogs.id}'));
        $xcrud->change_type('ota_id', 'hidden', $this->getOTAdata()->ota_id, array('readonly' => 'readonly'));
        $xcrud->where('ota_id', $this->getOTAdata()->ota_id);
        $xcrud->label(array("blog_category_id" => "Category", "ota_id" => "OTA Id", "created_at" => "Date"));
        $result = $xcrud->render();
        $data['data']['list'] = $result;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Articles";
        render('ota/blog_category', $data);
    }

    public function blog_settings()
    {
        $post = $this->input->post();
        $data["settings_data"] = json_decode(file_get_contents(SERVERNAME . "ota/blog/get_settings?ota_id=" . $this->getOTAdata()->ota_id))->data;
        if (!empty($post)) {
            $post["ota_id"] = $this->getOTAdata()->ota_id;
            $data["settings_data"] = json_decode(server_request($post, SERVERNAME . 'ota/blog/update_settings'))->data;
            $data["save"] = "done";
        }
        $data['head'] = 'ota/head';
        $data["b_title"] = "Articles";
        render('ota/blog_settings', $data);
    }

    public function update_hotel_feature()
    {
        $numbers = $this->input->post('order_number[]');
        $cities_id = $this->input->post('feature_cities[]');
        $image_binaries = [];
        $file = $_FILES['cities_images'];
        $files = is_array($file['name']) ? $file : [$file];
        for ($i = 0; $i < count($files['name']); $i++) {
            $resp = getMultiImageBinary("cities_images", $i);
            if ($resp['status'] == 'success') {
                array_push($image_binaries, $resp['data']);
            }
        }
        $params = [
            "images" => json_encode($image_binaries),
            "number_array" => json_encode($numbers),
            "cities_array" => json_encode($cities_id),
            "module_id" => $this->input->post('module_id'),
            "ota_id" => $this->getOTAdata()->ota_id,
        ];
        echo json_decode(server_request($params, SERVERNAME . 'ota/hotels/feature_cities'))->status;
    }

    public function delete_hotel_feature()
    {
        $params = [
            "city_id" => $this->input->post('name'),
            "module_id" => $this->input->post('module_id'),
            "ota_id" => $this->getOTAdata()->ota_id
        ];
        $data = curl_server_request($params, SERVERNAME . 'ota/hotels/delete_feature_cities');
        if ($data["status"] == "success") {
            echo $data["status"];
        } else {
            echo $data;
        }
    }

    public function change_number_hotel_feature()
    {
        $params = [
            "city_id" => $this->input->post('city_id'),
            "module_id" => $this->input->post('module_id'),
            "number" => $this->input->post('number'),
            "ota_id" => $this->getOTAdata()->ota_id
        ];
        echo json_decode(server_request($params, SERVERNAME . 'ota/hotels/features/change_number'))->status;
    }

    public function add_language()
    {
        $params = array();
        $params["ota_id"] = $this->getOTAdata()->ota_id;
        $params["language_id"] = $this->input->post("language_id");
        json_decode(server_request($params, SERVERNAME . 'ota/languages/add_language'))->data;
        echo "done";

    }

    public function delete_language()
    {
        $params = array();
        $params["ota_id"] = $this->getOTAdata()->ota_id;
        $params["language_id"] = $this->input->post("language_id");
        json_decode(server_request($params, SERVERNAME . 'ota/languages/delete_language'))->data;
        echo "done";

    }

    public function change_default()
    {
        $params = array();
        $params["ota_id"] = $this->getOTAdata()->ota_id;
        $params["language_id"] = $this->input->post("language_id");
        json_decode(server_request($params, SERVERNAME . 'ota/languages/change_default'))->data;
        echo "done";
    }

    public function add_currency()
    {
        $params = array();
        $params["ota_id"] = $this->getOTAdata()->ota_id;
        $params["currency_id"] = $this->input->post("currency_id");
        json_decode(server_request($params, SERVERNAME . 'ota/currencies/add_currency'))->data;
        echo "done";

    }

    public function delete_currency()
    {
        $params = array();
        $params["ota_id"] = $this->getOTAdata()->ota_id;
        $params["currency_id"] = $this->input->post("currency_id");
        json_decode(server_request($params, SERVERNAME . 'ota/currencies/delete_currency'))->data;
        echo "done";
    }

    public function change_default_currency()
    {
        $params = array();
        $params["ota_id"] = $this->getOTAdata()->ota_id;
        $params["currency_id"] = $this->input->post("currency_id");
        json_decode(server_request($params, SERVERNAME . 'ota/currencies/change_default'))->data;

        echo "done";
    }

    public function modules()
    {
        $params = array("ota_id" => $this->getOTAdata()->ota_id);
        $data["modules"] = json_decode(server_request($params, SERVERNAME . 'ota/modules/getsettings'))->data;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Modules";
        render('ota/modules', $data);
    }

    public function update_pages()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $post["ota_id"] = $this->getOTAdata()->ota_id;
            $result = json_decode(server_request($post, SERVERNAME . 'ota/cms/update'));
            if ($result->status != "success") {
                $data["message"] = "Some Thing Errors.";
                $data["class"] = "errors";
            } else {
                $data["message"] = "Save Successfully.";
                $data["class"] = "success";
            }
        }
        $data["cms_id"] = $this->uri->segment(2);
        $params = array("ota_id" => $this->getOTAdata()->ota_id, 'cms_id' => $data["cms_id"]);
        $data["cms"] = json_decode(server_request($params, SERVERNAME . 'ota/cms/page'))->data;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Content Management";
        render('ota/cms_page', $data);

    }

    public function update_modules()
    {
        $params = array('is_active' => $this->input->post("is_active"), 'module_id' => $this->input->post('module_id'), "ota_id" => $this->getOTAdata()->ota_id);
        $result = json_decode(server_request($params, SERVERNAME . 'ota/modules/update'));
        if ($result->status == "success") {
            $data["modules"] = json_decode(server_request($params, SERVERNAME . 'ota/modules/getsettings'))->data;
            $this->session->set_userdata("modules_ota", $data["modules"]);
            echo "done";
        } else {
            echo "error";
        }
    }

    public function module_update_features()
    {
        $params = array('is_feature_cities' => $this->input->post("is_active"), 'module_id' => $this->input->post('module_id'), "ota_id" => $this->getOTAdata()->ota_id);
        $result = json_decode(server_request($params, SERVERNAME . 'ota/modules/update_features'));
        if ($result->status == "success") {
            $data["modules"] = json_decode(server_request($params, SERVERNAME . 'ota/modules/getsettings'))->data;
            $this->session->set_userdata("modules_ota", $data["modules"]);
            echo "done";
        } else {
            echo "error";

        }
    }

    public function update_modules_order()
    {
        $params = array('order' => $this->input->post("order"), 'module_id' => $this->input->post('module_id'),
            "ota_id" => $this->getOTAdata()->ota_id);
        $result = json_decode(server_request($params, SERVERNAME . 'ota/modules/update_order'))->status;
        if ($result == "success") {
            echo "done";
        } else {
            echo "error";

        }
    }

    public function cms_enable()
    {
        $params = array('status' => $this->input->post("status"), 'cms_id' => $this->input->post('cms_id'), "ota_id" => $this->getOTAdata()->ota_id);
        $result = json_decode(server_request($params, SERVERNAME . 'ota/cms/update'))->status;
        if ($result == "success") {
            echo "done";
        } else {
            echo "error";

        }
    }

    public function transactions()
    {
        $xcrud = Xcrud::get_instance();
        $xcrud->table('transactions');
        $xcrud->unset_title();
        $xcrud->unset_add();
        $xcrud->unset_edit();
        $xcrud->columns(array("tranx_id", "trxn_type", "amount", "created_at"));
        $xcrud->fields(array("tranx_id", "trxn_type", "amount", "created_at"));
        $xcrud->where('status', 1);
        $xcrud->order_by('id', 'desc');
        $xcrud->label(array("tranx_id" => "Transaction ID", "trxn_type" => "Transaction Type", "amount" => "Amount", "created_at" => "Date"));
        $xcrud->where('account_id', $this->getOTAdata()->ota_id);
        $xcrud->where('type', "ota");
        return $xcrud->render();
    }

    public function ota_domian()
    {
        $xcrud = Xcrud::get_instance();
        $xcrud->table('domains');
        $xcrud->before_insert("refresh");
        $xcrud->unset_title();
        $xcrud->change_type('account_id', 'hidden', $this->getOTAdata()->ota_id);
//        $xcrud->fields(array('status'), true);
        $xcrud->change_type('type', 'hidden', 'ota');
//        $xcrud->change_type('status','hidden','1');
        $xcrud->before_insert('add_domain');
        $xcrud->column_callback('status', 'domain_check');
        $xcrud->where('account_id', $this->getOTAdata()->ota_id);
        $data['data']['list'] = $xcrud->render();
        $data['head'] = 'ota/head';
        $data["b_title"] = "Domains";
        render('ota/blog_category', $data);
    }


    public function categories()
    {
        $xcrud = Xcrud::get_instance();
        $xcrud->table('blog_categories');
        $xcrud->change_type('ota_id', 'text', $this->getOTAdata()->ota_id, array('readonly' => 'readonly'));
        $xcrud->label(array("category" => "Name", "ota_id" => "OTA Id", "created_at" => "Date"));
        $xcrud->columns(array('updated_at', 'ota_id'), true);
        $xcrud->unset_title();
        $xcrud->before_insert('add_category');
        $xcrud->before_update('add_category');
        $xcrud->order_by('id', 'desc');
        $xcrud->where('ota_id', $this->getOTAdata()->ota_id);
        $xcrud->fields(array('updated_at'), true);
        $xcrud->show_primary_ai_column(false);
        $result = $xcrud->render();
        $data['data']['list'] = $result;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Categories";
        render('ota/xview', $data);
    }

    public function newslatters()
    {
        $xcrud = Xcrud::get_instance();
        $xcrud->table('ota_newslatters');
        $xcrud->change_type('account_id', 'hidden', $this->getOTAdata()->ota_id, array('readonly' => 'readonly'));
        $xcrud->columns(array('updated_at', 'account_id'), true);
        $xcrud->fields(array('updated_at', 'created_at'), true);
        $xcrud->unset_title();
        $xcrud->order_by('id', 'desc');
        $xcrud->where('account_id', $this->getOTAdata()->ota_id);
        $xcrud->fields(array('updated_at'), true);
        $xcrud->show_primary_ai_column(false);
        $result = $xcrud->render();
        $data['data']['list'] = $result;
        $data['head'] = 'ota/head';
        $data["b_title"] = "News Latters";
        render('ota/xview', $data);
    }

    public function packages()
    {
        $xcrud = Xcrud::get_instance();
        $xcrud->table('tours');
        $orderdetails = $xcrud->nested_table('Tour Itinerary', 'id', 'tours_itinerary', 'tour_id');
        $orderdetails->change_type('tour_id', 'hidden', $this->getOTAdata()->ota_id, array('readonly' => 'readonly'));
        $xcrud->fk_relation('Amenities Inclusive', 'id', 'tours_inclusive', 'tour_id', 'amenity_id', 'amenities', 'id', array('title'), 'amenities.amenity_id=3');
        $xcrud->fk_relation('Amenities Exclusive', 'id', 'tours_exclusive', 'tour_id', 'amenity_id', 'amenities', 'id', array('title'), 'amenities.amenity_id=3');
        $xcrud->change_type('ota_id', 'hidden', $this->getOTAdata()->ota_id, array('readonly' => 'readonly'));
        $xcrud->columns(array('tours.name', 'location_id', 'stars', 'nights'));
        $xcrud->label(array('tours.name' => "Name", 'location_id' => "Location", 'adultprice' => "Adult price", 'childprice' => "Child price", 'infantprice' => "Infants price"));
        $xcrud->relation('location_id', 'package_locations', 'id', 'name');
        $xcrud->fields(array('updated_at', 'created_at'), true);
        $xcrud->change_type('stars', 'select', '1', '1,2,3,4,5');
        $xcrud->unset_title();
        $xcrud->order_by('id', 'desc');
        $xcrud->where('ota_id', $this->getOTAdata()->ota_id);
        $xcrud->fields(array('updated_at'), true);
        $xcrud->show_primary_ai_column(false);
        $result = $xcrud->render();
        $data['data']['list'] = $result;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Packages";
        render('ota/xview', $data);
    }

    public function packages_groups()
    {
        $xcrud = Xcrud::get_instance();
        $xcrud->table('package_locations');
        $xcrud->columns(array('name'));
        $xcrud->fields(array('updated_at', 'created_at'), true);
        $xcrud->unset_title();
        $xcrud->order_by('id', 'desc');
        $xcrud->where('ota_id', $this->getOTAdata()->ota_id);
        $xcrud->fields(array('updated_at'), true);
        $result = $xcrud->render();
        $data['data']['list'] = $result;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Packages";
        render('ota/xview', $data);
    }

    public function hotels()
    {

        $xcrud = Xcrud::get_instance();
        $xcrud->unset_title();
        $xcrud->unset_add();
        $xcrud->unset_edit();
        $xcrud->unset_remove();
        $xcrud->table('hotels');
        $xcrud->column_class('thumb', 'zoom_img');
        $xcrud->join('city_id', 'cities', 'id', null, ['no_insert']);
        $xcrud->relation('property_type_id', 'property_types', 'id', 'type');
        $xcrud->relation('currency_id', 'currencies', 'id', 'name');
        $xcrud->columns(array('thumb', 'company_name', 'cities.name', 'property_type_id', 'hotels.id', 'ota_id', 'cities.id', 'cities.created_at', 'rating', 'status'));
        $xcrud->fields('hotels.city_id,hotels.status,company_name, hotels.hotel_slug,property_type_id ,markup,deposit,description,hotels.hotel_policy,hotels.currency_id , checkin,checkout,hotels.latitude,hotels.longitude ,rating, ota_id,supplier_id, Amenities', false, "General");
        $xcrud->fields('email_address,mobile_number,phone_number,whatsapp_number,address', false, 'Contact Us');
        $xcrud->fields('facebook,twitter,instagram,youtube,googleplus,linkedin,snapchat', false, 'Social Accounts');
        $xcrud->fields('policy,term,about_us,contact_us', false, 'CMS');
        $xcrud->label(array('cities.id' => "Availability", 'hotel_domain' => "Domain", 'cities.created_at' => "pricing", 'hotels.id' => 'Gallery', 'hotels.city_id' => "Location", "hotels.currency_id" => "Currencies", 'hotels.property_type_id' => "Property Type", 'cities.name' => 'City', 'company_name' => 'Hotel Name', 'user_id' => 'OTA Name', 'supplier_id' => 'Supplier Name'));
        $xcrud->before_insert("insert_hotels");
        $xcrud->column_callback('thumb', 'image_thumb_hotel');
        $xcrud->button("javascript: upload_image('{hotels.id}')", 'Upload Image', 'glyphicon glyphicon-picture', 'btn btn-default', array('target' => '_self'));
        $xcrud->field_callback('hotels.city_id', 'city_select2');
        $xcrud->field_callback('facebook', 'social');
        $xcrud->field_callback('twitter', 'social');
        $xcrud->field_callback('instagram', 'social');
        $xcrud->field_callback('youtube', 'social');
        $xcrud->field_callback('googleplus', 'social');
        $xcrud->field_callback('linkedin', 'social');
        $xcrud->field_callback('snapchat', 'social');
        $xcrud->set_attr('Amenities', array('id' => 'multi_select123'));
        $xcrud->set_attr('currency_id', array('id' => 'multi_currency'));
        $xcrud->before_remove('delete_hotels_image', 'functions.php');
        $xcrud->change_type('ota_id', 'hidden', getOta()->ota_id, array('readonly' => 'readonly'));
        $xcrud->change_type('checkin', 'text', '', array('placeholder' => '02:00 PM'));
        $xcrud->change_type('checkout', 'text', '', array('placeholder' => '02:00 AM'));
        $xcrud->change_type('rating', 'select', '1', '1,2,3,4,5');
        $xcrud->change_type('status', 'radio', '0', array('0' => 'Disable', '1' => 'Enable'));
        $xcrud->order_by('hotels.id', 'desc');
        $xcrud->limit(10);
        $xcrud->where('ota_id', $this->getOTAdata()->ota_id);
        $result = $xcrud->render();
        $data['data']['list'] = $result;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Hotels";
        render('ota/xview', $data);
    }

    public function hotels_rooms()
    {
        $xcrud = Xcrud::get_instance();
        $xcrud->table('rooms');
        $xcrud->columns(array('room_status', 'refundable', 'breakfast'));
        $xcrud->fields(array('updated_at', 'created_at'), true);
        $xcrud->unset_title();
        $xcrud->order_by('id', 'desc');
        //   $xcrud->where('ota_id', $this->getOTAdata()->ota_id);
        $xcrud->fields(array('updated_at'), true);
        $xcrud->show_primary_ai_column(false);
        $result = $xcrud->render();
        $data['data']['list'] = $result;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Hotels Rooms";
        render('ota/xview', $data);
    }


    public function blog_add()
    {
        dd($this->input->post());
    }

    public function blog_Categories()
    {
        $data['head'] = 'ota/head';
        $data["b_title"] = "Blog Category";
        render('ota/blog_category', $data);
    }

    public function update_social()
    {
        $post = $this->input->post();
        $post["ota_id"] = $this->getOTAdata()->ota_id;
        $result = json_decode(server_request($post, SERVERNAME . 'ota/social/update'));
        if ($result->status == "success") {
            echo "done";
        } else {
            echo "error";
        }
    }

    public function cms()
    {
        $params = array("ota_id" => $this->getOTAdata()->ota_id);
        $data["cmspages"] = json_decode(server_request($params, SERVERNAME . 'ota/cms/pages'))->data;
        $data["ota_id"] = $this->getOTAdata()->ota_id;
        $data['head'] = 'ota/head';
        $data["b_title"] = "CMS Pages";
        render('ota/cms', $data);
    }

    public function pages()
    {
        $params = array("ota_id" => $this->getOTAdata()->ota_id);
        $data["pages"] = json_decode(server_request($params, SERVERNAME . 'ota/meta/pages'))->data;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Pages";
        render('ota/pages', $data);
    }

    public function page()
    {
        $posts = $this->input->post();
        if (!empty($posts)) {
            $params = $posts;
            $params["ota_id"] = $this->getOTAdata()->ota_id;
            $params["name"] = $this->uri->segment(2);
            $config['upload_path'] = "uploads/ota";
            $config['allowed_types'] = 'png|jpg|gif';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!empty($_FILES['image']['name'])) {
                if (!$this->upload->do_upload('image')) {
                    $data['errors'] = $this->upload->display_errors();
                    $error = true;
                }
                $image = $this->upload->data("file_name");
                if (empty($data['errors'])) {
                    if (!empty($image)) {
                        $imagedata = file_get_contents(FCPATH . "/uploads/ota/" . $image);
                        $params["image"] = base64_encode($imagedata);
                        unlink(FCPATH . "/uploads/ota/" . $image);
                    }
                }
            }
            if (empty($data['errors'])) {
                $result = json_decode(server_request($params, SERVERNAME . 'ota/meta/update/page'));
                if ($result->status == "success") {
                    $data["message"] = "Save Successfully";
                    $data["class"] = "success";
                }
            } else {
                $data["message"] = $data["errors"];
                $data["class"] = "danger";
            }
        }
        $params = array("ota_id" => $this->getOTAdata()->ota_id, "name" => $this->uri->segment(2));
        $data["page"] = json_decode(server_request($params, SERVERNAME . 'ota/meta/page'))->data;
        $data['head'] = 'ota/head';
        $data["b_title"] = "Pages";
        render('ota/page', $data);
    }

    public function social()
    {
        $params = array("ota_id" => $this->getOTAdata()->ota_id);
        $data["socials"] = json_decode(server_request($params, SERVERNAME . 'ota/social/list'))->data;
        usort($data["socials"], function ($item1, $item2) {
            if (property_exists($item1, "social_order") && property_exists($item2, "social_order")) {
                return $item1->social_order <=> $item2->social_order;
            }
            return -1;
        });
        $data['head'] = 'ota/head';
        $data["b_title"] = "Social Management";
        render('ota/social', $data);
    }

    public function clients()
    {
        $result = json_decode(server_request(["ota_id" => $this->getOTAdata()->ota_id], SERVERNAME . 'ota/dashboard/clients'))->data;
        echo json_encode($result);
    }

    public function customizations()
    {
        if (!empty($this->input->post())) {
            $header_html = preg_replace('/<script\b[^>]*>(.*?)<\/script>/i', "", $this->input->post("header_html", false));
            $footer_html = preg_replace('/<script\b[^>]*>(.*?)<\/script>/i', "", $this->input->post("footer_html", false));
            $global_css = preg_replace('/<script\b[^>]*>(.*?)<\/script>/i', "", $this->input->post("global_css", false));
            $params = [
                "header_html" => $header_html,
                "footer_html" => $footer_html,
                "global_css" => $global_css,
                "ota_id" => $this->getOTAdata()->ota_id
            ];
            $data["result"] = json_decode(server_request($params, SERVERNAME . 'ota/customizations_update'))->data;
            $data['head'] = 'ota/head';
            $data["b_title"] = "Customizations";
            $data["class"] = "success";
            $data["message"] = "Save Successfully";
            render('ota/customizations', $data);
        } else {
            $params = [
                "ota_id" => $this->getOTAdata()->ota_id
            ];
            $data["result"] = json_decode(server_request($params, SERVERNAME . 'ota/customizations'))->data;
            $data['head'] = 'ota/head';
            $data["b_title"] = "Customizations";
            render('ota/customizations', $data);
        }


    }


}