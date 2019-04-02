<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('server_request')) {

    function server_request($params, $url)
    {

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
if ( ! function_exists( "dd" ) ) {
	function dd( $data ) {
		echo "<pre>";
		print_r( $data );
		echo "</pre>";
		die();
	}
}
if (!function_exists('render')) {

    function render($view, $data)
    {
        $CI =& get_instance();
        $data['content'] = $view;
        $data['data'] = $data;
        $CI->load->view('admin/main', $data);
    }

    if (!function_exists("get_airline_name")) {
        function get_airline_name($k)
        {
            $data = file_get_contents("log/airlines.json");
            $data = json_decode($data, true);
            $final = array_filter($data, function ($a) use ($k) {
                return (in_array($a['id'], (array)$k));
            });
            foreach ($final as $value) {
                $name = $value['name'];
            }
            return $name;
        }
    }
}


if (!function_exists('curl_call')) {
    function curl_call($url, $params, $headers = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $content = curl_exec($ch);
	    $err = curl_error($ch);

	    curl_close($ch);

	    if ($err) {
		    return $err;
	    } else {
		    return $content;
	    }
    }
}

if (!function_exists('currency_converter')) {
    function currency_converter($currency1,$currency2,$amount)
    {
        $data = $_SESSION['currencies_data'];
        foreach ($data['data'] as $currencies_array){
            if ($currencies_array['name'] == $currency1){
                $currencies_array1 = $currencies_array;
            }

            if ($currencies_array['name'] == $currency2){
                $currencies_array2 = $currencies_array;
            }
        }
        //return $currencies_array2;
        $currency1_rate = 1/$currencies_array1['rate'];
        $currency2_rate = 1/$currencies_array2['rate'];
        $new_rate = $currency1_rate/$currency2_rate;
        return $new_rate*$amount;
    }
}


if (!function_exists('validateDate')) {
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
}