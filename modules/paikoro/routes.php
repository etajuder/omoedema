<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * All your custom route must be set here note see https://ellislab.com/codeigniter/user-guide/general/routing.html
 * example 
 * $route["login"] = "mycontroller/myfunction/$1";
 */
$route["login"] = "paikoro/login";
$route["signup"] = "paikoro/signup";
$route["forget_password"] = "paikoro/forget_password";
$route["forget_password/token/(:any)"] = "paikoro/forget_password/token";
$route['about']="paikoro/about";
$route['blog']="paikoro/blog";
$route['contact']="paikoro/contact";
$route['produce']="paikoro/produce";
$route["logout"] = "paikoro/logout";
$route["utils/get_numbers"] = "paikoro/get_numbers";
$route["utils/send_sms_message"] = "paikoro/send_sms_message";
$route["utils/(:any)"] = "paikoro/util/$1";
$route["department/(:any)"] = "paikoro/department/$1";
$route["account/official"] = "paikoro/official";
$route["account/official/update_account"] = "paikoro/admin_account";
$route["account/official/sendsms"] = "paikoro/sendsms";
$route["account/official/sendmail"] = "paikoro/sendmail";
//$route["account/official/sales"] = "paikoro/sales_management";
$route["account/official/response/(:any)"] = "paikoro/sales_response/$1";
$route["picture/upload"] = "paikoro/upload";
$route["account/official/(:any)"] = "paikoro/official_request/$1";
$route["download/(:any)"] = "paikoro/download/$1";
$route["product_login"] = "paikoro/product_login";
$route["product/continue_shopping"] = "paikoro/continue_shopping";
$route["product/product_checkout"] = "paikoro/product_checkout";
$route["product/remove_cart/(:num)"] = "paikoro/remove_cart/$1";
$route["product/submit_orders"] = "paikoro/submit_orders";
$route["product/order_update"] = "paikoro/order_update";
$route[modules::admin_route()."/paikoro/addproduce"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/listproduce"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/editproduce"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/addnews"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/addcategory"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/listcategory"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/listnews"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/listusers"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/newposition"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/listpositions"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/createofficial"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/createdepartment"]="admin/custom_webpage";
$route[modules::admin_route()."/paikoro/editdepartment"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/listdepartment"]="admin/custom_webpage";
$route[modules::admin_route()."/paikoro/addward"]="admin/custom_webpage";
$route[modules::admin_route()."/paikoro/listwards"]="admin/custom_webpage";
$route[modules::admin_route()."/paikoro/editward"]="admin/custom_webpage";
$route[modules::admin_route()."/paikoro/addabout"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/listabout"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/editabout"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/addaccount"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/listaccount"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/addvideo"] = "admin/custom_webpage";
$route[modules::admin_route()."/paikoro/listofficials"] = "admin/custom_webpage";
$route["product/details/(:any)/(:num)"] = "paikoro/product_details/$1/$2";
$route[modules::admin_route()."/paikoro/sales_manager"]="admin/custom_webpage";
$route["archive/(:any)/(:any)"] = "paikoro/archives/$1/$2";
$route["ward/(:any)"] = "paikoro/ward/$1";
$route["product/order"] = "paikoro/product_order";
$route["product/save_product"] = "paikoro/save_product";
$route["request/(:any)"] = "paikoro/request/$1";
$route["adminfc/(:any)"]  = "paikoro/adminfc/$1";
$route["utility/get_local"] = "paikoro/get_local";
$route["utility/get_state_feeds"] = "paikoro/get_state_feeds";
$route["product/order_invoice"] = "paikoro/order_invoice";
$route["my_orders"] ="paikoro/my_orders";
$route["my_orders/messages"] = "paikoro/my_order_message";
$route["my_orders/messages/(:any)"] = "paikoro/my_order_message/$1";
$route["invoice/(:any)"] = "paikoro/invoice/$1";
$route["my_orders/invoice/(:any)"] = "paikoro/my_orders/$1";
$route["read/(:any)"] = "paikoro/read/$1";
$route["(:any)"] ="paikoro/index/$1";
$route["tests"] = "paikoro/tests";
$route["search_result"] = "paikoro/search_result";
//modules

//Category List
$route[modules::admin_route()."/categorylist/manage"] = "admin/custom_iframe";
$route["categorylist/manage"] = "categoryls/manage";
$route["categorylist/savedesign"] = "categoryls/savedesign";

