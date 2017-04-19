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
$route["request/(:any)"] = "decor/request/$1";
$route["logout"] = "decor/request/logout";
$route["login"] = "decor/login";
$route["register"] = "decor/signup";
$route["videos"] = "decor/videos";
$route["videos/(:any)"] = "decor/videos/$1";
$route["videos/(:any)/(:any)"] = "decor/videos/$1/$2";
$route["photos"] = "decor/photos";
$route["photos/(:any)"] = "decor/photos/$1";
$route["photos/(:any)/(:any)"] = "decor/photos/$1/$2";
$route["about-us"] = "decor/about";
$route["recover_password"] = "decor/recover_password";
$route["forget_password/token/(:any)"] = "decor/forget_password/token";
$route["bonus_site"] = "decor/bonus_site";
$route["search"] = "decor/search";
$route["bonus_videos"] = "decor/bonus_videos";
$route["superuser"] = "superuser/index";
$route["superuser/login"] = "superuser/login";
$route["superuser/categories"] = "superuser/categories";
$route["requests/(:any)"] = "superuser/requests/$1";
$route["superuser/photos"] = "superuser/photos";
$route["superuser/photo/album/(:any)"] = "superuser/photo_album/$1";
$route["superuser/videos"] = "superuser/videos";
$route["superuser/video/(:any)"] = "superuser/video/$1";
$route["superuser/sliders"] = "superuser/sliders";
$route["superuser/sliders/(:any)"] = "superuser/sliders/$1";
$route["superuser/users"] = "superuser/users";
$route["superuser/plans"] = "superuser/plans";
$route["superuser/settings"] = "superuser/settings";
$route["register/user_reg"] = "decor/user_reg";
$route["payment/confirmation"] = "decor/payment_confirmation";
$route["memberjoin/(:any)/(:any)"] = "decor/memberjoin/$1/$2";
$route["video/(:any)/(:any)"] = "decor/video/$1/$2";
$route["photo_album/(:any)/(:any)"] = "decor/photo_album/$1/$2";
// Category Setup
$route["(:any)"] = "decor/category/$1";
//Misc page

$route["terms"] = "decor/misc/terms";
$route["privacy"] = "decor/misc/privacy";
$route["business_inc"] = "decor/misc/business";
$route["superuser/design"] = "superuser/design";