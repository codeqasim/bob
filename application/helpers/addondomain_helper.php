<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('addonDomain')) {

    function addonDomain($domain, $subdomain, $type=null) {

        $type = ($type==null) ? 'addaddondomain' : $type;
        $new = ($type=='addaddondomain') ? 'newdomain' : 'domain';

        $whmusername = "root";
        $whmpassword = "Allah4ever";

        $query = "https://li1814-79.members.linode.com:2087/json-api/cpanel?cpanel_jsonapi_user=travelnet&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=AddonDomain&cpanel_jsonapi_func=".$type."&dir=public_html&".$new."=".$domain."&subdomain=".$subdomain;

        $curl = curl_init();                                // Create Curl Object
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);        // Allow self-signed certs
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);        // Allow certs that do not match the hostname
        curl_setopt($curl, CURLOPT_HEADER, 0);                // Do not include header in output
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);        // Return contents of transfer on curl_exec
        $header[0] = "Authorization: Basic " . base64_encode($whmusername.":".$whmpassword) . "\n\r";
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password
        curl_setopt($curl, CURLOPT_URL, $query);            // execute the query
        $result = curl_exec($curl);
        $result = json_decode($result);
        if ($result == false)
        {
            error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query"); // log error if curl exec fails
            exit("Error occur contact to admin.");
        }
        curl_close($curl);
        if(empty($result->cpanelresult->data[0]->result)){
            exit($result->cpanelresult->data[0]->reason);
        }
        return $result;
    }
}