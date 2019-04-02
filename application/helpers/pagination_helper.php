<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('pagination')) {

    function pagination($url, $total_records, $limit, $segment,$curr_page){
        $ci =& get_instance();
        $ci->load->library('pagination');
        
        $config['base_url'] = $url;
        $config['total_rows'] = $total_records;
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = $segment;
        $config['full_tag_open'] = '<ul class="nav nav-pills nav-justified" role="tablist">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '<i class="glyphicon-chevron-right fa fa-angle-left"></i>
                        <i class="glyphicon-chevron-right fa fa-angle-left"></i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</a></li>';
        $config['next_link'] = '<i class="glyphicon-chevron-right fa fa-angle-right"></i>
                        <i class="glyphicon-chevron-right fa fa-angle-right"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_page'] = $curr_page;
        $config['cur_tag_close'] = '</a></li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $ci->pagination->initialize($config);
        return $ci->pagination->create_links();
    }
}
