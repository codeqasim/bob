<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'home/errors';
$route['404'] = 'home/errors';
$route['translate_uri_dashes'] = FALSE;
$route['sitemap\.xml'] = "Sitemap";

$route['packages'] = 'flights/list';
$route['packages'] = 'packages';
$route['refresh'] = 'home/refresh';

$route['admin'] = "";
$route['hotels/booking/verification'] = 'hotels/verification';
$route['hotels/invoice/:num'] = 'hotels/booking_status/$1';
$route['hotels/booking(.*)'] = 'hotels/booking/$1';
//$route['visa'] = "visa";
$route['packages'] = "packages";
$route['contact'] = "cms";
$route['about'] = "cms";
$route['policy'] = "cms";
$route['terms'] = "cms";
$route['supplier/verification/(:any)'] = "supplier/verification/$1";
$route['home'] = 'home/index';
$route['getCities'] = 'home/getCities';
$route['hotel/(.*)'] = 'hotels/detail';

$route['hotels/get_hotels'] = 'hotels/get_hotels';
$route['hotels/more_hotel'] = 'hotels/more_hotel';
$route['hotels/payment_success'] ='hotels/payment_success';
$route['hotels/pagination'] = 'hotels/pagination';
$route['hotels/sort'] = 'hotels/sort';
$route['hotels/getlocation'] = 'hotels/getlocation';
$route['hotels/countries'] = 'hotels/countries';
$route['hotels/currency'] = 'hotels/currency';
$route['hotels/save_booking'] = 'hotels/save_booking';
$route['hotels/:any/:any/:num/:num'] = 'hotels/index/$1/$1/$1/$1/$1';
$route['hotels/:any/:any/:any/:any/:any/:num/:num'] = 'hotels/detail/$1/$1/$1/$1/$1/$1/$1';
$route['hotels/filter'] = 'hotels/filter';
$route['hotels/search/(.*)'] = 'hotels/search/$1';
$route['hotels/:any/:any'] = 'hotels/hotels_by_city/$1/$1';
//$route['booking/:num'] = 'hotels/booking_status/$1';
$route['hotels/(.*)'] = 'hotels/index/';
//$route['hotels/:any'] = 'hotels/country_cities';
//$route['hotels/:any'] = 'hotels/country_cities';

$route['visa(.*)'] = 'visa/index$1';
$route['livechat'] = 'home/livechat';
$route['blog'] = 'blog/index';
$route['blog/page'] = 'blog/index';
$route['blog/page/:num'] = 'blog/index/$1';
$route['blog/search/:any'] = 'blog/search/$1';
$route['blog/search/:any/:num'] = 'blog/search/$1/$1';
$route['blog/:any'] = 'blog/category_posts';
$route['blog/:any/page/:num'] = 'blog/category_posts/$1';
$route['blog/:any/page'] = 'blog/category_posts/$1';
$route['blog/:any/:any'] = 'blog/detail';
$route['get_cities'] = "flights/get_cities";
$route['url_set'] = "flights/url_set";

$route['flights/get_airlines'] = "flights/get_airlines";
$route['filter'] = "flights/filter";
$route['flights/check_login'] = "flights/check_login";
$route['flights/booking'] = "flights/booking";
$route['flights/save_booking'] = "flights/save_booking";
$route['flights/flight_recheck'] = "flights/flight_recheck";
$route['flights/invoice/:num'] = 'flights/voucher/';
$route['flights(.*)'] = "flights/index$1";


//$route[':any'] = 'home';


