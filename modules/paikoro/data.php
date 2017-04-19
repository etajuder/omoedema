<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * this file contains all the data you want to use in the admin page
 * set it like this  data["data"] = model_request("modelname","functionname","parameters")
 */


$data["listbatch"] = "";
$data["total_user"] = model_request("paikoro_model", "counter", "users");
$data["total_director"] = model_request("paikoro_model", "counter", "officials");
$data["monthly_sales"] = model_request("paikoro_model", "get_monthly_sales");