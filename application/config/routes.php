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

/*
 * Default.
 */

$route['default_controller'] = 'home/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['vn'] = 'home/index/$1';
$route['en'] = 'home/index/$1';

$route['vn/tim-kiem'] = 'home/search/$1';
$route['en/tim-kiem'] = 'home/search/$1';


$route['vn/gio-hang'] = 'home/cart/$1';
$route['en/gio-hang'] = 'home/cart/$1';

$route['vn/dat-hang'] = 'home/order/$1';
$route['en/dat-hang'] = 'home/order/$1';

$route['vn/success'] = 'home/success/$1';
$route['en/success'] = 'home/success/$1';


// chuyên mục
$route['vn/(:any)'] = 'home/category/$1';
$route['en/(:any)'] = 'home/category/$1';
// phân trang
$route['vn/(:any)/(:num)'] = 'home/category/$1/$2';
$route['en/(:any)/(:num)'] = 'home/category/$1/$2';
// detail news
$route['vn/(:any)/(:any)-n/(:num)'] = 'home/detailnews/$1/$2/$3';
$route['en/(:any)/(:any)-n/(:num)'] = 'home/detailnews/$1/$2/$3';
// detail products
$route['vn/(:any)/(:any)-p/(:num)'] = 'home/detailproducts/$1/$2/$3';
$route['en/(:any)/(:any)-p/(:num)'] = 'home/detailproducts/$1/$2/$3';


/* 
 * GCMS Route.
*/
$route['gcms'] = 'gcmslogin/login';