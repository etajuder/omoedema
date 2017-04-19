<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$side_bar = [
    "About LGA"=>[
        "Add Section"=>  modules::admin_route()."/paikoro/addabout",
        "List Section"=> modules::admin_route()."/paikoro/listabout",
        "Add Bank Account"=> modules::admin_route()."/paikoro/addaccount",
        "List Bank Accounts"=>  modules::admin_route()."/paikoro/listaccount",
        "LGA info"=>  modules::admin_route()."/paikoro/addinfo"
    ],
 "News"=> [ 
     "Add News"=>modules::admin_route()."/paikoro/addnews",
     "Add Video"=>modules::admin_route()."/paikoro/addvideo",
     "List News"=>  modules::admin_route()."/paikoro/listnews"
     ],
 "News Category"=>[
     "Add Category"=>  modules::admin_route()."/paikoro/addcategory",
     "List Category"=> modules::admin_route()."/paikoro/listcategory"
 ],
    "User Management"=>[
      "List User"=> modules::admin_route()."/paikoro/listusers",
      "Create Official"=>  modules::admin_route()."/paikoro/createofficial",
       "Lists Officials"=>  modules::admin_route()."/paikoro/listofficials",
        "Sales Manager"=>  modules::admin_route()."/paikoro/sales_manager"
    ],
    
    "Position"=>[
        "Create position"=>  modules::admin_route()."/paikoro/newposition",
        "List Positions"=>  modules::admin_route()."/paikoro/listpositions"
    ],
    "Department Management"=>[
        "Create Department"=>  modules::admin_route().'/paikoro/createdepartment',
        "List Department"=>  modules::admin_route().'/paikoro/listdepartment',
    ],
    "Produce"=>[
        "Add Produce"=> modules::admin_route()."/paikoro/addproduce",
        "List Produce"=> modules::admin_route()."/paikoro/listproduce"
    ],
    "Wards"=>[
        "Add Ward"=>  modules::admin_route()."/paikoro/addward",
        "List Ward"=> modules::admin_route()."/paikoro/listwards"
    ],
    "Conversations"=>[
        "View Active Conversations"=>  modules::admin_route()."/conversation"
    ]
];



