<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Details about your modules must be specified here example
$detail=[
    'name'=>'p2p',
    'Created By'=>'Jude Etanuwoma',
    'Version'=>'1.0.0',
    'type'=>'full'
];

//custom creation for admin can also be done here
//example
$pages = [
    "addnews"=>[
        "type"=>"form",
        "title"=>"Add News",
        "title_description"=>"Fill all form",
        "form"=>[
            "method"=>"post",
            "action"=>  App::route("adminfc/addnews"),
            "submit"=>"Add News",
            "elements"=>[
              "title"=>[
                  "type"=>"text",
                  "placeholder"=>"News Title",
                  "required"=>"required",
                  "label"=>"News Title"
              ],
              "body"=>[
                  "type"=>"cke"
              ],
              "category"=>[
                  "type"=>"dropdown",
                  "description"=>"Choose category",
                  "showcase"=>[
                      "id"=>"name"
                  ],
                  "model"=>"paikoro_model",
                  "source"=>"get_category"
              ],
              "file"=>[
                  "type"=>"file",
                  "label"=>"Picture",
                 
              ],
               "user_id"=>[
                   "type"=>"hidden",
                   "value"=>"0"
               ],
                
                
            ]
        ]
    ],
    "addcategory"=>[
        "type"=>"form",
        "title"=>"Add Category",
        "title_description"=>"Fill all form",
        "form"=>[
            "method"=>"post",
            "action"=>App::route("adminfc/addcategory"),
            "submit"=>"Add Category",
            "elements"=>[
                "name"=>[
                    "type"=>"text",
                    "label"=>"Name",
                    "placeholder"=>"Category Name",
                    "required"=>"required"
                ]
            ]
        ]
    ],
    "listcategory"=>[
        "type"=>"list",
        "title"=>"List of Categories",
        "model"=>"paikoro_model",
        "adapter"=>"get_category",
        "showcase"=>["id"=>"id","Name"=>"name","Action"=>["Delete"=>["type"=>"get","base_url"=>"request/deletecategory","value"=>"id"]]]
    ],
    "listnews"=>[
        "type"=>"list",
        "title"=>"List of All News",
        "model"=>"paikoro_model",
        "adapter"=>"get_n",
        "showcase"=>[
            "id"=>"id",
            "Title"=>"title",
            "Category"=>"name",
            "Action"=>["Delete"=>["type"=>"get","base_url"=>"request/deletenews","value"=>"id"]]
            
        ]
    ],
    "listusers"=>[
        "type"=>"list",
        "title"=>"List Of Registered Users",
        "model"=>"paikoro_model",
        "adapter" => "get_users",
        "showcase"=>[
            "S/N"=>"id",
            "Fullname"=>"fullname",
            "Email"=>"email",
            "Country"=>"country",
            "State"=>"state",
            "Town"=>"town",
            "Gender"=>"gender",
            "Action"=>["Delete"=>["type"=>"get","base_url"=>"request/deleteuser","value"=>"username"]]
        ]
    ],
    
    
    "newposition"=>[
        "type"=>"form",
        "title"=>"Create Position",
        "title_description"=>"Fill all form",
        "form"=>[
            "action"=>App::route("adminfc", "newposition"),
            "method"=>"post",
            "submit"=>"Create",
            "elements"=>[
                "name"=>[
                    "type"=>"text",
                    "label"=>"Position Name",
                    "placeholder"=>"Name",
                    "required"=>"required",
                    
                ]
            ]
        ]
    ],
    "listpositions"=>[
        "type"=>"list",
        "title"=>"List of positions in the local government",
        "model"=>"paikoro_model",
        "adapter"=>"listpositions",
        "showcase"=>[
            "S/N"=>"id",
            "Name"=>"name",
            "Action"=>["Delete"=>[
                "type"=>"get",
                "base_url"=>"request/deleteposition",
                "value"=>"id"
                ]
            ]
        ]
    ],
    
    
    "createofficial"=>[
        "type"=> "form",
        "title"=>"Create An Official",
        "title_description"=>"Fill All Form",
        "form"=>[
            "method"=>"post",
            "action"=>  App::route("adminfc/createofficial"),
            "submit"=>"Create An Official",
            "elements"=>[
                "fullname"=>[
                    "type"=>"text",
                    "placeholder"=>"Enter Admin Fullname",
                    "label"=>"Fullname",
                    "required"=>"required"
                    
                    
                ],
               
                "email"=>[
                    "type"=>"text",
                    "placeholder"=>"Enter Admin Email",
                    "label"=>"Email",
                    "required"=>"required"
            ],
                "mobile"=>[
                   "type"=>"text",
                   "placeholder"=>"Enter Mobile Number",
                    "label"=>"Phone Number",
                    "required"=>""
                ],
                
                "username"=>[
                    "type"=>"text",
                    "placeholder"=>"Enter Admin Username",
                    "label"=>"Username",
                    "required"=>"required"
                    ],
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Enter Admin Password",
                    "label"=>"Password",
                    "required"=>"required"
                ],
                "gender"=>[
                    "type"=>"dropdown",
                    "description"=>"Gender",
                    "options"=>[
                        "male"=>"Male",
                        "female"=>"Female"
                    ]
                ],
                "file"=>[
                    "type"=>"file",
                    "label"=>"Profile Pics"
                ],
               
                "department"=>[
                    "type"=>"dropdown",
                    "description"=>"Department",
                    "model"=>"paikoro_model",
                    "source"=>"listdepartments",
                    "showcase"=>[
                        "id"=>"name"
                    ]
                ],
                "about"=>[
                     "type"=>"textarea",
                    "placeholder"=>"About Admin",
                    "label"=>"About Admin",
                    "required"=>"required"
                ]
          
                
              
        ]
    ]
],
    "createdepartment"=>[
        "type"=>"form",
        "title"=>"Add Department",
        "title_description"=>"fill all inputs",
        "form"=>[
            "method"=>"post",
            "action"=>App::route("adminfc/createdepartment"),
            "submit"=>"Create Department",
            "elements"=>[
                "name"=>[
                    "type"=>"text",
                    "label"=>"Name",
                    "placeholder"=>"Department Name",
                    "required"=>""
                ],
                "about"=>[
                    "type"=>"textarea",
                    "label"=>"About",
                    "required"=>"",
                    "placeholder"=>"About Department"
                ]
            ]
        ]
    ],
    "listdepartment"=>[
        "type"=>"list",
        "title"=>"List of all departments",
        "model"=>"paikoro_model",
        "adapter"=>"listdepartments",
        "showcase"=>[
            "S/N"=>"id",
            "Name"=>"name",
            "Action"=>[
                "Delete"=>[
                    "type"=>"get",
                    "base_url"=>"request/deletedepartment",
                    "value"=>"id"
                ],
                "Edit"=>[
                    "type"=>"get",
                    "base_url"=>  modules::admin_route()."/paikoro/editdepartment",
                    "value"=>"id"
                ]
            ]
        ]
    ],
    "editdepartment"=>[
        "type"=>"form",
        "title"=>"Edit department",
        "title_description"=>"fill all form",
        "edit"=>true,
        "model"=>"paikoro_model",
        "adapter"=>"get_department_by_id",
        "form"=>[
            "method"=>"post",
            "action"=>App::route("request", "updatedepartment"),
            "submit"=>"Update",
            "elements"=>[
                "name"=>[
                    "type"=>"text",
                    "label"=>"Name",
                    "required"=>"",
                    "read"=>"name"
                ],
                 "about"=>[
                    "type"=>"cke",
                    "label"=>"Description",
                    "required"=>"",
                    "read"=>"about"
                ]
            ]
        ]
    ],
    "addproduce"=>[
        "type"=>"form",
        "title"=>"Add Produce",
        "title_description"=>"fill all form",
        "form"=>[
            "method"=>"post",
            "action"=>App::route("adminfc/addproduce"),
            "submit"=>"Add Produce",
            "elements"=>[
                "name"=>[
                    "type"=>"text",
                    "label"=>"Product Name",
                    "placeholder"=>"e.g Melon",
                   "required"=>"required"
                ],
                "measurement_type"=>[
                    "type"=>"text",
                    "label"=>"Measured By",
                    "placeholder"=>"e.g Bag, Rubber, Plot",
                    "required"=>""
                ],
                "price"=>[
                    "type"=>"text",
                    "label"=>"Product Price",
                    "placeholder"=>"e.g 25000,5000, 50000",
                    "required"=>""
                ],
                "description"=>[
                    "type"=>"cke",
                    "label"=>"Product Description"
                ],
                "file"=>[
                    "type"=>"file",
                    "label"=>"Product Image",
                    "required"=>""
                ]
            ]
        ]
    ],
    "listproduce"=>[
        "type"=>"list",
        "title"=>"List of our produce",
        "model"=>"paikoro_model",
        "adapter"=>"get_produce",
        "showcase"=>[
            "S/N"=>"id",
            "Name"=>"product_name",
            "Measurement Type"=>"measurement_type",
            "Price"=>"product_price",
            "Action"=>[
                "Delete"=>["base_url"=>"request/deleteproduce","type"=>"get","value"=>"id"],
                "Edit"=>[
                    "type"=>"get",
                    "base_url"=>  modules::admin_route()."/paikoro/editproduce",
                    "value"=>"id"
                ]
                ]
        ]
    ],
    "addward"=>[
        "type"=>"form",
        "title"=>"Add Wards",
        "title_description"=>"Fill all form",
        "form"=>[
            "method"=>"post",
            "action"=>App::route("adminfc", "addward"),
            "submit"=>"Add Ward",
            "elements"=>[
                "name"=>[
                    "type"=>"text",
                    "label"=>"Ward Name",
                    "placeholder"=>"ward name",
                    "required"=>""
                ],
                "description"=>[
                    "type"=>"cke"
                ]
            ]
        ]
    ],
    "editward"=>[
        "type"=>"form",
        "title"=>"Edit ward",
        "title_description"=>"fill all form",
        "edit"=>true,
        "model"=>"paikoro_model",
        "adapter"=>"get_ward_by_id",
        "form"=>[
            "method"=>"post",
            "action"=>App::route("request/updateward"),
            "submit"=>"Update",
            "elements"=>[
                "name"=>[
                    "type"=>"text",
                    "label"=>"Name",
                    "required"=>"",
                    "read"=>"name"
                ],
                 "description"=>[
                    "type"=>"cke",
                    "label"=>"Description",
                    "required"=>"",
                    "read"=>"description"
                ]
            ]
        ]
    ],
    "listwards"=>[
        "type"=>"list",
        "title"=>"List of Local Government wards",
        "model"=>"paikoro_model",
        "adapter"=>"get_wards",
        "showcase"=>[
            "S/N"=>"id",
            "Name"=>"name",
            "Action"=>["Delete"=>["base_url"=>"request/deleteward","type"=>"get","value"=>"id"],"Edit"=>["base_url"=>modules::admin_route()."/paikoro/editward","type"=>"get","value"=>"id"]]
        ]
    ],
    "sales_manager"=>[
        "type"=>"form",
        "title"=>"Select department to manage sales",
        "title_description"=>"",
        "form"=>[
            "method"=>"post",
            "action"=>App::route("adminfc", "add_sales_manager"),
            "submit"=>"Update",
            "elements"=>[
                "department_id"=>[
                    "type"=>"dropdown",
                    "description"=>"Department",
                    "model"=>"paikoro_model",
                    "source"=>"listdepartments",
                    "showcase"=>[
                        "id"=>"name"
                    ]
                ],
            ]
        ]
    ],
    "addabout"=>[
        "type"=>"form",
        "title"=>"Add Admin Section",
        "title_description"=>"Fill all forms",
        "form"=>[
            "action"=>App::route("adminfc", "addabout"),
            "method"=>"post",
            "submit"=>"Add Section",
            "elements"=>[
                "title"=>[
                    "type"=>"text",
                    "label"=>"About Section Title",
                    "required"=>"true"
                ],
                "body"=>[
                    "type"=>"cke"
                ]
            ]
        ]
    ],
     "listabout"=>[
        "type"=>"list",
        "title"=>"List of About Section in Local Government",
        "model"=>"paikoro_model",
        "adapter"=>"get_abouts",
        "showcase"=>[
            "S/N"=>"id",
            "Title"=>"title",
            "Action"=>["Delete"=>["base_url"=>"request/deleteabout","type"=>"get","value"=>"id"],"Edit"=>["base_url"=>modules::admin_route()."/paikoro/editabout","type"=>"get","value"=>"id"]]
        ]
    ],
     "editabout"=>[
        "type"=>"form",
        "title"=>"Edit Section",
        "title_description"=>"fill all form",
        "edit"=>true,
        "model"=>"paikoro_model",
        "adapter"=>"get_about_by_id",
        "form"=>[
            "method"=>"post",
            "action"=>App::route("request/updateabout"),
            "submit"=>"Update",
            "elements"=>[
                "title"=>[
                    "type"=>"text",
                    "label"=>"Title",
                    "required"=>"",
                    "read"=>"title"
                ],
                 "body"=>[
                    "type"=>"cke",
                    "label"=>"Description",
                    "required"=>"",
                    "read"=>"body"
                ]
            ]
        ]
    ],
     "editproduce"=>[
        "type"=>"form",
        "title"=>"Edit Produce",
        "title_description"=>"fill all form",
        "edit"=>true,
        "model"=>"paikoro_model",
        "adapter"=>"get_produce_by_id",
        "form"=>[
            "method"=>"post",
            "action"=>App::route("request/updateproduce"),
            "submit"=>"Update",
            "elements"=>[
                "name"=>[
                    "type"=>"text",
                    "label"=>"Product Name",
                    "required"=>"",
                    "read"=>"product_name"
                ],
                 "measurement"=>[
                    "type"=>"text",
                    "label"=>"Measurement Type",
                    "required"=>"",
                    "read"=>"measurement_type"
                ],
                 "price"=>[
                    "type"=>"text",
                    "label"=>"Prices",
                    "required"=>"",
                    "read"=>"product_price"
                ],
                 "description"=>[
                    "type"=>"cke",
                    "label"=>"Description",
                    "required"=>"",
                    "read"=>"product_description"
                ]
            ]
        ]
    ],
    
    "addaccount"=>[
        "type"=>"form",
        "title"=>"Add Bank Details",
        "title_description"=>"Fill all details",
        "form"=>[
            "method"=>"post",
            "action"=>App::route("request","addaccount"),
            "submit"=>"Add Account",
            "elements"=>[
                "bank"=>[
                    "type"=>"text",
                    "label"=>"Bank Name",
                    "placeholder"=>"Enter Bank Name",
                    "required"=>""
                ],
                "name"=>[
                    "type"=>"text",
                    "label"=>"Account Name",
                    "placeholder"=>"Enter account name",
                    "required"=>""
                ],
                "number"=>[
                    "type"=>"text",
                    "label"=>"Bank Account Number",
                    "placeholder"=>"Enter account number",
                    "required"=>""
                ]
            ]
        ]
    ],
     "listaccount"=>[
        "type"=>"list",
        "title"=>"List of Added Bank Accounts",
        "model"=>"paikoro_model",
        "adapter"=>"list_account",
        "showcase"=>[
            "S/N"=>"id",
            "Bank Name"=>"bank",
            "Account Name"=>"name",
            "Account Number"=>"number",
            "Action"=>["Delete"=>["base_url"=>"request/deleteaccount","type"=>"get","value"=>"id"]]
        ]
    ],
    "addvideo"=>[
        "type"=>"form",
        "title"=>"Add Video",
        "title_description"=>"Fill all details",
        "form"=>[
             "method"=>"post",
            "action"=>App::route("request","addvideo"),
            "submit"=>"Add Video",
            "elements"=>[
                "title"=>[
                    "type"=>"text",
                    "label"=>"Video Title",
                    "placeholder"=>"add video title",
                    "required"=>""
                ],
                "video"=>[
                    "type"=>"file",
                    "label"=>"Select Video",
                    "required"=>""
                ]
            ]
        ]
    ],
     "listofficials"=>[
        "type"=>"list",
        "title"=>"List of Paikoro Officials",
        "model"=>"paikoro_model",
        "adapter"=>"get_officials",
        "showcase"=>[
            "S/N"=>"id",
            "Fullname"=>"fullname",
            "Gender"=>"gender",
            "Department"=>"name",
            "Action"=>["Delete"=>["base_url"=>"request/deleteofficial","type"=>"get","value"=>"id"]]
        ]
    ],
    ];
/*
 * The above example contains 3 pages for the admin (crimetype, crimetypelist, crimelists) access to this page can be provided through routing
 * set you route from the route file to $route["crimetype"] = "admin/custom_webpage";
 * 
 */