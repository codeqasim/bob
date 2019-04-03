<?php

$ota_currencies = [];
$ota_languages = [];
$ota_cms = [];
$ota_social = [];
$customization = [];
$feature_tours = [];
$blog_settings = [];

if (!empty($_SESSION['curr_session'])) {
    $curr_session = $_SESSION["curr_session"];
}
if (!empty($_SESSION['lang_session'])) {
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