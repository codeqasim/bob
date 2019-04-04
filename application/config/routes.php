<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// homepage
$route['default_controller'] = 'home';
$route['sitemap\.xml'] = "Sitemap";

$route['domain_verify/(:any)'] = "dashboard/checkdns_view/$1";
$route['customizations'] = "dashboard/customizations";
$route['domains'] = "dashboard/ota_domian";
$route['gateways'] = "PaymentGateways/index";
$route['modules'] = "dashboard/modules";
$route['modules/feature/cities'] = "dashboard/feature_cities";
$route['modules/(:any)'] = "dashboard/modules_settings/$1";
$route['demo'] = "home/demo";
$route['documentation'] = "home/documentation";
$route['documentation/(:any)/(:any)'] = "home/documentation_details/$1/$1";
$route['features'] = "home/features";
$route['login'] = "home/login";
$route['signup'] = "home/signup";
$route['cms/(:any)'] = "dashboard/update_pages";
$route['pricing'] = "home/pricing";
$route['policy'] = "home/policy";
$route['terms'] = "home/terms";
$route['contact'] = "home/contact";
$route['policy'] = "home/policy";
$route['about'] = "home/about";
$route['settings'] = "dashboard/settings";
$route['team'] = "home/team";
$route['logout'] = "home/logout";
$route['social'] = "dashboard/social";
$route['cms'] = "dashboard/cms";
$route['blogs'] = "dashboard/blog";
$route['pages'] = "dashboard/pages";
$route['hotels'] = "dashboard/hotels";
$route['hotels/rooms'] = "dashboard/hotels_rooms";
$route['packages'] = "dashboard/packages";
$route['packages/groups'] = "dashboard/packages_groups";
$route['newslatters'] = "dashboard/newslatters";
$route['page/(:any)'] = "dashboard/page";
$route['account'] = "dashboard/account";
$route['blogs/settings'] = "dashboard/blog_settings";
$route['blogs/categories'] = "dashboard/categories";
$route['verification/(:any)'] = "home/verification/$1";
$route['media-kit'] = "home/media";
$route['email_verify'] = "home/email_verify";
$route['newsletter_confirmation'] = "home/newsletter";

$route['404_override'] = 'home/error';
$route['translate_uri_dashes'] = FALSE;

