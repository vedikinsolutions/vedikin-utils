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
// $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$route['default_controller'] = 'controller_user_login/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['login'] = 'controller_user_login/login';
$route['forgot-password'] = 'controller_user_login/forgot_password';
$route['profile'] = 'controller_user_login/profile';
$route['change-password'] = 'controller_user_login/change_password';
$route['logout'] = 'controller_user_login/logout';
$route['dashboard'] = 'controller_dashboard/index';
$route['login-process'] = 'controller_user_login/login_process';

$route['menu-list']='controller_menu';
$route['menu-list/(:num)']='controller_menu/index/$1';
$route['menu-add']='controller_menu/add';
$route['menu-update/(:num)']='controller_menu/edit/$1';
$route['menu-delete/(:num)']='controller_menu/delete/$1';
$route['search_menu']='controller_menu/search_menu';
$route['menu_delete_all'] = 'controller_menu/delete_all';

$route['user-role-list']='controller_user_role';
$route['user-role-list/(:num)']='controller_user_role/index/$1';
$route['user_role-add']='controller_user_role/add';
$route['user-role-update/(:num)']='controller_user_role/edit/$1';
$route['user-role-delete/(:num)']='controller_user_role/delete/$1';
$route['search_user_role']='controller_user_role/search_user_role';
$route['user_role_delete_all'] = 'controller_user_role/delete_all';

$route['user-right-list']='controller_user_right';
$route['user-right-list/(:num)']='controller_user_right/index/$1';
$route['user_right-add']='controller_user_right/add';
$route['user-right-update/(:num)/(:num)']='controller_user_right/edit/$1/$2';
$route['user-right-delete/(:num)/(:num)']='controller_user_right/delete/$1/$2';
$route['search_user_right']='controller_user_right/search_user_right';
$route['user_right_delete_all'] = 'controller_user_right/delete_all';

$route['user-list']='controller_user';
$route['user-list/(:num)']='controller_user/index/$1';
$route['user-add']='controller_user/add';
$route['user-update/(:num)']='controller_user/edit/$1';
$route['user-delete/(:num)']='controller_user/delete/$1';
$route['search_user']='controller_user/search_user';
$route['user_delete_all'] = 'controller_user/delete_all';

$route['reminder-list']='Controller_reminder';
$route['reminder-list/(:num)']='Controller_reminder/index/$1';
$route['reminder-add']='controller_reminder/add';
$route['reminder-update/(:num)']='controller_reminder/edit/$1';
$route['reminder-delete/(:num)']='controller_reminder/delete/$1';
$route['search_reminder']='controller_reminder/search_reminder';
$route['reminder_delete_all'] = 'controller_reminder/delete_all';
$route['reminder_sorting/(:any)'] = 'controller_reminder/reminder_sorting/$1';

$route['update-history-list']='Controller_update_history';
$route['update-history-list/(:num)']='Controller_update_history/index/$1';
$route['update_history_add']='Controller_update_history/add';
$route['update-history-update/(:num)']='Controller_update_history/edit/$1';
$route['update-history-delete/(:num)']='Controller_update_history/delete/$1';
$route['search_update_history']='Controller_update_history/search_update_history';
$route['update_history_delete_all'] = 'Controller_update_history/delete_all';
$route['history_sorting/(:any)'] = 'Controller_update_history/history_sorting/$1';

$route['cron_job']='Controller_cron';

$route['point-category-list']='Controller_point_category';
$route['point-category-list/(:num)']='Controller_point_category/index/$1';
$route['point_category_add']='Controller_point_category/add';
$route['point-category-update/(:num)']='Controller_point_category/edit/$1';
$route['point-category-delete/(:num)']='Controller_point_category/delete/$1';
$route['search_point_category']='Controller_point_category/search_point_category';
$route['point_category_delete_all'] = 'Controller_point_category/delete_all';

$route['points-list']='Controller_point';
$route['points-list/(:num)']='Controller_point/index/$1';
$route['points-add']='Controller_point/add';
$route['points-update/(:num)']='Controller_point/edit/$1';
$route['points-delete/(:num)']='Controller_point/delete/$1';
$route['search_points']='Controller_point/search_points';
$route['points_delete_all'] = 'Controller_point/delete_all';
$route['point-report-list'] = 'Controller_point/point_report';
$route['points_filter'] = 'Controller_point/points_filter';
$route['point_report_sorting/(:any)']='Controller_point/points_report_sorting/$1';


