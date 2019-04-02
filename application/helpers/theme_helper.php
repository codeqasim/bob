<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('default_theme')) {

    function default_theme() {

    }
    function default_meta($description,$title,$keyword,$img){

        return array("description"=>$description,"title"=>$title,"keywords"=>$keyword,"img"=>$img);
    }
}
if(!function_exists('getUserData')) {
    function getUserData()
    {
        $ci = get_instance();
        if (!empty($ci->session->userdata('user_data'))) {
            return $ci->session->userdata('user_data');
        }
    }
}

if (!function_exists('default_currency')) {
    function default_currency () {
        $ota_currencies = array_filter($_SESSION['ota_data']->ota_currencies, function($obj) {
            return $obj->is_default == 1;
        });
        return current($ota_currencies);
    }
}