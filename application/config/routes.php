<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
if(System::Installed()){
$route[modules::admin_route().'/configs'] = 'admin/configs';
$route[modules::admin_route().'/login'] = 'admin/login';
$route[modules::admin_route().'/install'] = 'admin/install';
$route[modules::admin_route().'/update'] = 'admin/update';
$route[modules::admin_route().'/trys'] = 'admin/trys';
$route[modules::admin_route().'/erase'] = 'admin/erase';
$route[modules::admin_route().'/erasetop'] = 'admin/erasetop';
$route[modules::admin_route().'/display'] = 'admin/display';
$route[modules::admin_route().'/displaytopmenu'] = 'admin/displaytopmenu';
$route[modules::admin_route().'/logout'] = 'admin/logout';
$route[modules::admin_route().'/addstudent'] = 'admin/addstudent';
$route[modules::admin_route().'/adddept'] = 'admin/adddept';
$route[modules::admin_route().'/addsch']='admin/addsch';
$route[modules::admin_route().'/addclass'] = 'admin/addclass';
$route[modules::admin_route().'/viewcat'] = 'welcome/viewcat/$1';
$route[modules::admin_route().'/previewAds'] ='admin/previewAds';
$route[modules::admin_route().'/advert_add'] ='admin/advert_add';
$route[modules::admin_route().'/activatetheme'] = 'admin/activatetheme';
$route[modules::admin_route().'/Uninstall'] = 'admin/Uninstall';
$route[modules::admin_route().'/backupdb'] = 'admin/backupdb';
$route[modules::admin_route().'/advertadd'] = 'admin/advertadd';
$route[modules::admin_route().'/installmodule'] = 'admin/installmodule';
$route[modules::admin_route().'/installtheme'] = 'admin/installtheme';
$route[modules::admin_route().'/installmodules/(:any)'] = 'admin/installmodules/$1';
$route[modules::admin_route().'/uninstallmodule/(:any)'] = 'admin/uninstallmodule/$1';
$route[modules::admin_route().'/setactivecontroller/(:any)'] = "admin/setactivecontroller/$1";
$route['maintain'] = 'admin/maintainance';
$route[modules::admin_route()] = 'admin/home';
$route[modules::admin_route().'/(:any)'] = 'admin/view/$1';
}
$route['test'] = 'welcome/test';
$route['list'] = 'welcome/lists';

$route['sendmail'] = "welcome/sendmail";

$route['install'] = 'install';
if(System::Installed()){
$route['default_controller'] = modules::default_controller();
$route[modules::default_controller()] = modules::default_controller();
}else{
    $route['default_controller'] = "welcome";
}
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */