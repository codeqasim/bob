<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// homepage
$route['default_controller'] = 'home';
$route['sitemap\.xml'] = "Sitemap";

$route['login'] = "home/login";
$route['signup'] = "home/signup";
$route['cms/(:any)'] = "dashboard/update_pages";
$route['policy'] = "home/policy";
$route['terms'] = "home/terms";
$route['contact'] = "home/contact";
$route['policy'] = "home/policy";
$route['about'] = "home/about";
$route['team'] = "home/team";
$route['logout'] = "home/logout";
$route['cms'] = "dashboard/cms";
$route['blogs'] = "dashboard/blog";
$route['pages'] = "dashboard/pages";
$route['newslatters'] = "dashboard/newslatters";
$route['account'] = "dashboard/account";
$route['verification/(:any)'] = "home/verification/$1";
$route['media-kit'] = "home/media";
$route['email_verify'] = "home/email_verify";
$route['newsletter_confirmation'] = "home/newsletter";

$route['404_override'] = 'home/error';
$route['translate_uri_dashes'] = FALSE;

