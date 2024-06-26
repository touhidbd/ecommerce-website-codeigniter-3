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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Login & Register for User & Admin
$route['register']['GET'] = 'Auth/RegisterController/index';
$route['register']['POST'] = 'Auth/RegisterController/register';
$route['login']['GET'] = 'Auth/LoginController/index';
$route['login']['POST'] = 'Auth/LoginController/login';
$route['logout']['GET'] = 'Auth/LogoutController/index';

//User 
$route['account'] = 'frontend/PageController/index';

//Dashboard
$route['admin/dashboard'] = 'backend/DashboardController/index';

//Categories
$route['admin/categories']['GET'] = 'backend/CategoryController/index';
$route['admin/add-category']['GET'] = 'backend/CategoryController/insert';
$route['admin/add-category']['POST'] = 'backend/CategoryController/create';
$route['admin/edit-category/(:num)']['GET'] = 'backend/CategoryController/edit/$1';
$route['admin/edit-category/(:num)']['POST'] = 'backend/CategoryController/update/$1';
$route['admin/delete-category/(:num)']['GET'] = 'backend/CategoryController/delete/$1';

//ParagonIE_Sodium_Core_SecretStream_State
$route['admin/products']['GET'] = 'backend/ProductController/index';
$route['admin/add-product']['GET'] = 'backend/ProductController/insert';
$route['admin/add-product']['POST'] = 'backend/ProductController/create';
$route['admin/edit-product/(:num)']['GET'] = 'backend/ProductController/edit/$1';
$route['admin/edit-product/(:num)']['POST'] = 'backend/ProductController/update/$1';
$route['admin/delete-product/(:num)']['GET'] = 'backend/ProductController/delete/$1';
