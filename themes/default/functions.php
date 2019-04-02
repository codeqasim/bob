<?php
if(!empty($_SESSION['ota_data']))
{
//    dd($_SESSION['ota_data']);
    $ota_data = $_SESSION['ota_data']->ota;
    $widgets = $_SESSION['ota_data']->widgets;
    $main_model = (array)$_SESSION['ota_data']->main_modules;
    $ota_modules = $_SESSION['ota_data']->ota_modules;
    if(!empty($_SESSION['ota_data']->ota_languages))
    {
        $ota_languages = $_SESSION['ota_data']->ota_languages;
    }else{
        $ota_languages = [];
    }
    if(!empty($_SESSION['ota_data']->ota->multi_currency))
    {
        $ota_currencies = $_SESSION['ota_data']->ota_currencies;

    }else{
        $ota_currencies = [];
    }
    $ota_cms = $_SESSION['ota_data']->ota_cms;
    $ota_social = $_SESSION['ota_data']->ota_socials;
    $customization = $_SESSION['ota_data']->customization;
    $feature_tours = $_SESSION['ota_data']->feature_tours;
    $blog_settings = $_SESSION['ota_data']->blog_settings;
    usort($ota_modules->hotels->feature_cities, function ($item1, $item2) { return $item1->number<=> $item2->number;});
    usort($ota_modules->flights->feature_cities, function ($item1, $item2) { return $item1->number<=> $item2->number;});
    $feature_cities = array();
    foreach ($ota_modules->flights->feature_cities as &$feature_city)
    {
        $url = base_url("flights/$feature_city->airports_code/".
            preg_replace('/\s+/','-',$feature_city->airports_name)."/$feature_city->airports_des_code/".
            preg_replace('/\s+/','-',$feature_city->airports_des_name).'/'.date("Y-m-d",strtotime(date('Y-m-d')."+6 day"))."/1/0/0/oneway");
        $feature_city->url = $url;
    }
}
if(!empty($_SESSION['curr_session']))
{
    $curr_session = $_SESSION["curr_session"];
}
if(!empty($_SESSION['lang_session']))
{
    $lang_session = $_SESSION["lang_session"];
}

if (!empty($_SESSION['params'])) {
	$params = $_SESSION['params'];
}
if (!empty($_SESSION['user_data'])) {
    $user_session = $_SESSION['user_data'];
}

if (!empty($_SESSION['hotel_search'])) {
    $search = $_SESSION['hotel_search'];
}