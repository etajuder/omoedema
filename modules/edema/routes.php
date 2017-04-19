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


$route["superuser"] = "superuser/index";
$route["superuser/login"] = "superuser/login";
$route["superuser"] = "superuser/index";
$route["superuser/login"] = "superuser/login";
$route["superuser/categories"] = "superuser/categories";
$route["requests/(:any)"] = "superuser/requests/$1";
$route["superuser/add_news"] = "superuser/add_news";
$route["superuser/news"] = "superuser/news";
$route["superuser/news/(:num)"] = "superuser/edit_news/$1";
$route["superuser/users"] = "superuser/users";
$route["superuser/design"] = "superuser/design";
$route["superuser/settings"] = "superuser/settings";
$route["superuser/ads"] = "superuser/ads";
$route["download/(:any)"] = "edema/download/$1";
$route["register"] = "edema/register";
$route["search"] = "edema/search";
$route["contact-us"] = "edema/contact";
$route["about-us"] = "edema/about";
$route["downloads"] = "edema/downloads";
$route["payment/(:any)"] = "edema/payment/$1";
$route["request/(:any)"] = "edema/request/$1";
$route["(:num)/(:any)"] = "edema/news/$1/$2";
$route["(:any)"] = "edema/category/$1";
