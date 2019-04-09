<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('server_request')) {

    function server_request($params, $url){

        $postdata = http_build_query($params);
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);
        return file_get_contents($url, false, $context);
    }
}
if (!function_exists('curl_server_request')) {

    function curl_server_request($params, $url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return array('status' => "error", "data" => $err);
        } else {
            return array('status' => "success", "data" => $response);
        }
    }
}
if (!function_exists('render')) {

    function render($view, $data) {
        $CI =& get_instance();
        $data['content'] = $view;
        $data['data'] = $data;
        $CI->load->view('front/main', $data);
    }

}
if (!function_exists('ota_auth')) {

    function ota_auth() {
        $params = array(
            "ota_id" => $this->getOTAdata()->ota_id,
            "secret" => $this->getOTAdata()->secret,
        );
        return $params;
    }

}

if (!function_exists('dd')) {

    function dd($result) {

       echo '<pre>'; print_r($result); die;
    }

}
if (!function_exists('getOta')) {

    function getOta()
    {
        $CI =& get_instance();
        return $CI->session->userdata("otadata");
    }
}
if (!function_exists('paddle_helper')) {

    function paddle_helper($webhook_url,$callback,$price) {

        $data['vendor_id'] = 28632;
        $data['vendor_auth_code'] = '47b2e26d2eb36236d438c2138a33f6fb70531875e9e95944d0';

        $data['title'] = 'Ota Billing'; // name of product
        $data['webhook_url'] = $webhook_url; // URL to call when product is purchased

        // You must provide at least one price for the checkout, here we are setting multiple for different currencies.
        $data['prices'] = $price;

        // Setting some other (optional) data.
        $data['custom_message'] = '100% Money Back Guarantee!';
        $data['return_url'] = $callback;

        // Here we make the request to the Paddle API
        $url = 'https://vendors.paddle.com/api/2.0/product/generate_pay_link';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);

        // And handle the response...
        $data = json_decode($response);
       return $data;
    }

}