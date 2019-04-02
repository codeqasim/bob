<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends MY_Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $params['ota_id'] = $this->getOTAdata()->ota->ota_id;
        $blog_settings = $this->getOTAdata()->blog_settings;
        if(empty($this->uri->segment(3)))
        {
            $params['offset'] =  0;
        }else{
            $params['offset'] =  $this->uri->segment(3);
        }
        $params['limit'] = $blog_settings->number_list_posts;
        $params['number_popular_posts'] = $blog_settings->number_popular_posts;
        $blog = json_decode(server_request($params, APPURL.'ota/get_blogs'));
        $params["number_category_result"] = $blog_settings->number_category_result;
        $categoris = json_decode(server_request($params, APPURL.'ota/get_categories'))->data;
        $data["links"] = pagination(base_url('blog/page'), $blog->total_records, $blog->limit, 3,$params['offset']);
        $data['categories'] = $categoris;
        $data['blog'] = $blog->data;
        $data['popular_posts'] = $blog->popular_posts;
        $this->theme->view('blog/list', $data);
    }
    public function detail()
    {
        $blog_settings = $this->getOTAdata()->blog_settings;
        $params['category'] = str_replace('-', ' ', $this->uri->segment(2));
        $params['title'] = str_replace('-', ' ', $this->uri->segment(3));
        $params['ota_id'] = $this->getOTAdata()->ota->ota_id;
        $params['number_popular_posts'] = $blog_settings->number_popular_posts;
        $blog = json_decode(server_request($params, APPURL.'ota/get_blog_details'))->data;
        $data["meta"] = default_meta($blog->description,$blog->title,$blog->keywords,$blog->image);
        $data["title"] = $data["meta"]["title"];
        $params['offset'] = 0;
        $params['limit'] = $blog_settings->number_list_posts;
        $blog_list = json_decode(server_request($params, APPURL.'ota/get_blogs'));
        $params["number_category_result"] = $blog_settings->number_category_result;
        $data['categories'] =  json_decode(server_request($params, APPURL.'ota/get_categories'))->data;
        $data['blog'] = $blog;
        $data['popular_posts'] = $blog_list->popular_posts;
        $this->theme->view('blog/detail', $data);
    }

    public function category_posts()
    {
        $blog_settings = $this->getOTAdata()->blog_settings;
        $params['ota_id'] =  $this->getOTAdata()->ota->ota_id;
        $params['category'] = str_replace('-', ' ', $this->uri->segment(2));
        $params['number_popular_posts'] = $blog_settings->number_popular_posts;
        if(empty($this->uri->segment(4)))
        {
            $params['offset'] =  0;
        }else{
            $params['offset'] =  $this->uri->segment(4);
        }
        $params['limit'] = $blog_settings->number_list_posts;
        $blog = json_decode(server_request($params, APPURL.'ota/get_blogs'));
        $data["links"] = pagination(base_url('blog/'.$this->uri->segment(2)).'/page', $blog->total_records, $blog->limit, 4, $params['offset']);
        $params["number_category_result"] = $blog_settings->number_category_result;
        $data['categories'] =  json_decode(server_request($params, APPURL.'ota/get_categories'))->data;
        $data['blog'] = $blog->data;
        $data['popular_posts'] = $blog->popular_posts;
        $this->theme->view('blog/list', $data);
    }

    public function search()
    {
        $blog_settings = $this->getOTAdata()->blog_settings;
        $params['number_popular_posts'] = $blog_settings->number_popular_posts;
        $params['ota_id'] = $this->getOTAdata()->ota->ota_id;
        $params['keyword'] = str_replace('-', ' ', $this->uri->segment(3));
        if(empty($this->uri->segment(5)))
        {
            $params['offset'] =  0;
        }else{
            $params['offset'] =  $this->uri->segment(5);
        }
//        if(isset($params['keyword'])){
//            $params['keyword'] = str_replace('-', ' ', $this->uri->segment(3));
//            $this->session->set_userdata('keyword', $params['keyword']);
//        }else{
//            $params['keyword'] = $this->session->userdata('keyword');
//        }
        $params['limit'] = $blog_settings->number_list_posts;
        $params["number_category_result"] = $blog_settings->number_category_result;
        $data['categories'] =  json_decode(server_request($params, APPURL.'ota/get_categories'))->data;
        $blog = json_decode(server_request($params, APPURL.'ota/get_blogs'));
        $data["links"] = pagination(base_url('blog/search/'.$this->uri->segment(3)).'/page', $blog->total_records, $blog->limit, 5,$params['offset']);
        $data['category'] = 'Search';
        $data['blog'] = $blog->data;
        $data['popular_posts'] = $blog->popular_posts;
        $this->theme->view('blog/list', $data);
    }

}
