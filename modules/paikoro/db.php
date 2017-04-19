<?php

class db {
    //put your code here
    public function run(){
        //create  all your database tables here using codeigniter dbforge https://ellislab.com/codeigniter/user-guide/database/forge.html
        $CI = &get_instance();
        $CI->load->dbforge();
            
        $fields = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "fullname"=>[
                "type"=>"varchar",
                "constraint"=>225
            ],
            "email"=>[
                "type"=>"varchar",
                "constraint"=>255
            ],
            "username"=>[
                "type"=>"varchar",
                "constraint"=>255
            ],
            "gender"=>[
                "type"=>"varchar",
                "constraint"=>10
            ],
            "country"=>[
                "type"=>"varchar",
                "constraint"=>100
            ],
            "state"=>[
                "type"=>"varchar",
                "constraint"=>100
            ],
            "town"=>[
                "type"=>"varchar",
                "constraint"=>100
            ],
            "address"=>[
                "type"=>"longtext"
                
            ],
            "password"=>[
            "type" =>"varchar",
            "constraint"=>225
            ],
            "position"=>[
                "type"=>"int",
                "constraint"=>11,
                "default"=>0
            ],
            "phone_number"=>[
                "type"=>"varchar",
                "constraint"=>225
            ],
            "profile_pics"=>[
                "type"=>"varchar",
                "constraint"=>225
            ],
            "date"=>[
                "type"=>"datetime"
            ]
        ];        
       
        $CI->dbforge->add_field($fields);
        $CI->dbforge->add_key('id', TRUE);
        $CI->dbforge->create_table('users', TRUE);
        
        $fields=[
            "id"=>[
            "type"=>"int",
                "auto_increment"=>true
            ],
            "user_id"=>[
                    "type"=>"int", 
                "constraint"=>11
                
            ],
            "about"=>[
                "type"=>"longtext"

            ],
            
        "official_position"=>[
            "type"=>"int",
            "constraint"=>11
        ],
            "department"=>[
                "type"=>"varchar",
                "constraint"=>100,
                "null"=>true
            ]
            
            
            
        ];
        $CI->dbforge->add_field($fields);
        $CI->dbforge->add_key('id', TRUE);
        $CI->dbforge->create_table('officials', TRUE);
        
        $fieldss=[
             "id"=>[
            "type"=>"int",
                "auto_increment"=>true
            ],
             "user_id"=>[
                    "type"=>"int", 
                "constraint"=>11
                
            ],
      "product_name"=>[
          "type"=>"varchar",
          "constraint"=>225
      ],
            "product_price"=>[
                "type"=>"varchar",
          "constraint"=>225
                
            ],
            "measurement_type"=>[
                "type"=>"varchar",
                "constraint"=>225
            ],
            "product_description"=>[
                "type"=>"longtext",
              
                
            ],
            "product_category_id"=>[
                "type"=>"int",
                "constraint"=>11
            ],
            "image"=>[
              "type"=>"varchar",
                "constraint"=>255
            ],
            "created_at"=>[
                "type"=>"datetime"
            ]
        ];
        $CI->dbforge->add_field($fieldss);
        $CI->dbforge->add_key('id', TRUE);
        $CI->dbforge->create_table('product', TRUE);
        
        $product_category=[
            "id"=>[
                "type"=>"int",
                "constraint"=>TRUE
            ],
            "category_name"=>[
                "type"=>"varchar",
                "constraint"=>225
            ],
             "date"=>[
                "type"=>"datetime"
            ]
        ];
        $CI->dbforge->add_field($product_category);
        $CI->dbforge->add_key('id', TRUE);
        $CI->dbforge->create_table('product_category',TRUE);
        
        
        $product_message=[
             "id"=>[
            "type"=>"int",
                "auto_increment"=>true
            ],
             "user_id"=>[
                    "type"=>"int", 
                "constraint"=>11
                
            ],
            "invoice_number"=>[
                    "type"=>"varchar", 
                "constraint"=>255
                
            ],
            "message"=>[
                 "type"=>"longtext"  
            ],
            "images"=>[
                "type"=>"varchar",
                "constraint"=>255
            ],
            "status"=>[
                "type"=>"int",
                "constraint"=>11,
                "default"=>0
            ],
            "created_at"=>[
                "type"=>"datetime"
            ],
            "updated_at"=>[
               "type"=> "datetime"
            ]
                     
        ];
        
         $CI->dbforge->add_field($product_message);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table('product_message', TRUE);
        
        $product_image=[
                         "id"=>[
            "type"=>"int",
                "auto_increment"=>true
            ],
            "invoice_number"=>[
                "type"=>"varchar",
                "constraint"=>255
            ],
            "image"=>[
                "type"=>"varchar",
                "constraint"=>225
            ]
            
        ];
        
         $CI->dbforge->add_field($product_image);
         $CI->dbforge->add_key('id', true);
        $CI->dbforge->create_table('product_image', TRUE);
        
        $gallery=[
            "id"=>[
                "type"=>"int",
                "auto_increment"=>TRUE
            ],
        "image"=>[
            "type"=>"varchar",
            "constraint"=>225
        ],    
              "date"=>[
                "type"=>"datetime"
            ]
            
        ];
        $CI->dbforge->add_field($gallery);
        $CI->dbforge->add_key('id', TRUE);
        $CI->dbforge->create_table('gallery', TRUE);
        
        $news=[
            "id"=>[
            "type"=>"int",
                "auto_increment"=>TRUE
            ],
            
            "message"=>[
                "type"=>"longtext"          
            ],
             
             "user_id"=>[
                    "type"=>"int", 
                "constraint"=>11
                
            ],
            "to_user_id"=>[
              "type"=>"int",
                "constraint"=>11
            ],
            "seen"=>[
                "type"=>"int",
                "constraint"=>11,
                "default"=>0
            ],
          "image"=>[
              "type"=>"longtext",
              
          ],
            "news_category_id"=>[
                "type"=>"int",
                "constraint"=>11
            ],
            "created_at"=>[
                "type"=>"datetime"
            ]
            
            
        ];
        $CI->dbforge->add_field($news);
        $CI->dbforge->add_key('id', TRUE);
        $CI->dbforge->create_table('message', TRUE);
        
        $news_category=[
            "id"=>[
                "type"=>"int",
                "auto_increment"=>TRUE
            ],
            "name"=>[
                "type"=>"varchar",
                "constraint"=>11
            ],
            "date"=>[
                "type"=>"datetime"
            ]
        ];
        
        $CI->dbforge->add_field($news_category);
        $CI->dbforge->add_key('id', TRUE);
        $CI->dbforge->create_table('news_category', TRUE);
        
        $message=[
            "id"=>[
                "type"=>"int",
                "auto_increment"=>TRUE               
            ],
            "from_user_id"=>[
                "type"=>"int",
                "constraint"=>11
            ],
            "to_user_id"=>[
                "type"=>"int",
                "constraint"=>11
            ],
            "message"=>[
                "type"=>"longtext"
            ],
            "image"=>[
                "type"=>"varchar",
                "constraint"=>225
            ],
            "date"=>[
                "type"=>"datetime"
            ]
            
        ];
        $CI->dbforge->add_field($message);
        $CI->dbforge->add_key('id', TRUE);
        $CI->dbforge->create_table('message', TRUE);
        $field = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "name"=>[
                "type"=>"varchar",
                "constraint"=>255,
                
            ],
            "created_at"=>[
                "type"=>"datetime"
            ]
        ];
        $CI->dbforge->add_field($field);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("positions",TRUE);
        
        
        $dapartmenr=[
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "name"=>[
                "type"=>"varchar",
                "constraint"=>225
            ],
             "slug"=>[
                "type"=>"varchar",
                "constraint"=>225
            ],
            "about"=>[
                "type"=>"longtext",
          
                
            ],
            "created_at"=>[
                "type"=>"datetime"
            ]
            
        ];
         $CI->dbforge->add_field($dapartmenr);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("departments",TRUE);
        
        $orders = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "product_id"=>[
                "type"=>"int",
                "constraint"=>11
            ],
            "invoice_number"=>[
               "type"=>"varchar",
               "constraint"=>20
           ],
           
            "product_name"=>[
                "type"=>"varchar",
                "constraint"=>255
            ],
            "price"=>[
                "type"=>"varchar",
                "constraint"=>15
            ],
            "quantity"=>[
                "type"=>"int",
                "constraint"=>11
            ],
            "formated_price"=>[
                "type"=>"varchar",
                "constraint"=>50
            ],
            "measurement_type"=>[
                "type"=>"varchar",
                "constraint"=>100
            ],
            "user_id"=>[
                "type"=>"int",
                "constraint"=>11
            ],
            "status"=>[
                "type"=>"int",
                "constraint"=>11,
                "default"=>0
                
            ],
            "created_at"=>[
                "type"=>"datetime"
            ]
        ];
          $CI->dbforge->add_field($orders);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("orders",TRUE);
        
       $carts = [
         "id"=>[
             "type"=>"int",
             "auto_increment"=>true
         ],
           
           "product_id"=>[
               "type"=>"int",
               "constraint"=>11
           ],
           "product_name"=>[
               "type"=>"varchar",
               "constraint"=>255
           ],
           "price"=>[
               "type"=>"varchar",
               "constraint"=>15
           ],
           "quantity"=>[
               "type"=>"int",
               "constraint"=>11
           ],
           "formated_price"=>[
               "type"=>"varchar",
               "constraint"=>50
           ],
           "measurement_type"=>[
               "type"=>"varchar",
               "constraint"=>50
           ],
           "user_id"=>[
               "type"=>"int",
               "constraint"=>11
           ],
           "created_at"=>[
               "type"=>"datetime"
           ]
       ];
       
         $CI->dbforge->add_field($carts);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("carts",TRUE);
        $product_orders = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "user_id"=>[
                "type"=>"int",
                "constraint"=>11
            ],
            "invoice_number"=>[
                "type"=>"varchar",
                "constraint"=>100
            ],
            "status"=>[
                "type"=>"int",
                "constraint"=>11,
                "default"=>0
            ],
            "shipping_price"=>[
              "type"=>"int",
               "constraint"=>11,
               "default"=>0
            ],
            "shipping_days"=>[
              "type"=>"int",
               "constraint"=>11,
               "default"=>0
            ],
            "shipping_mode"=>[
              "type"=>"int",
               "constraint"=>11
               
            ],
             "view"=>[
              "type"=>"int",
               "constraint"=>11,
               "default"=>0
            ],
            "created_at"=>[
                "type"=>"datetime"
            ],
            "updated_at"=>[
                "type"=>"datetime"
            ]
        ];
         $CI->dbforge->add_field($product_orders);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("product_orders",TRUE);
        
        $ward = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "name"=>[
                "type"=>"varchar",
                "constraint"=>300
            ],
            "description"=>[
                "type"=>"longtext"
            ],
            "slug"=>[
                "type"=>"varchar",
                "constraint"=>250
            ],
            "created_at"=>[
                "type"=>"datetime"
            ],
            "updated_at"=>[
                "type"=>"datetime"
            ]
        ];
         $CI->dbforge->add_field($ward);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("wards",TRUE);
        
        $sales_manager = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>TRUE
            ],
            "department_id"=>[
                "type"=>"int",
                "constraint"=>11
            ]
        ];
        
         $CI->dbforge->add_field($sales_manager);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("sales_management",TRUE);
        $about_table = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "title"=>[
                "type"=>"varchar",
                "constraint"=>300
            ],
            "body"=>[
                "type"=>"longtext"
            ]
           
        ];
        $CI->dbforge->add_field($about_table);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("about",TRUE);
        $contact_table = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "fullname"=>[
                "type"=>"varchar",
                "constraint"=>255
            ],
            "email"=>[
                "type"=>"varchar",
                "constraint"=>255
            ],
            "phone_number"=>[
                "type"=>"varchar",
                "constraint"=>255,
            ],
            "department_id"=>[
                "type"=>"int",
                "constraint"=>11
            ],
            "message"=>[
                "type"=>"longtext"
            ],
            "created_at"=>[
                "type"=>"datetime"
            ],
            "seen"=>[
                "type"=>"int",
                "constraint"=>11,
                "default"=>0            ]
        ];
        $CI->dbforge->add_field($contact_table);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("contact",TRUE);
        
        $bank_account = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "bank"=>[
                "type"=>"varchar",
                "constraint"=>255
            ],
            "name"=>[
                "type"=>"varchar",
                "constraint"=>255
            ],
            "number"=>[
                "type"=>"varchar",
                "constraint"=>255
            ]
            
        ];
        
        
        $CI->dbforge->add_field($bank_account);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("banks",TRUE);
        $video = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "title"=>[
                "type"=>"varchar",
                "constraint"=>255
            ],
            "video"=>[
                "type"=>"varchar",
                "constraint"=>255
            ]
            
        ];
        $CI->dbforge->add_field($video);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("video",TRUE);
        
        $forget_password_table = [
             "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "user_id"=>[
                "type"=>"varchar",
                "constraint"=>255
            ],
            "token"=>[
                "type"=>"varchar",
                "constraint"=>255
            ],
            "created_at"=>[
                "type"=>"datetime"
            ]
        ];
        $CI->dbforge->add_field($forget_password_table);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("forget_password",TRUE);
        
        
          }
    
    public function drop(){
        $CI = &get_instance();
        $CI->dbforge->drop_table('officials');
        $CI->dbforge->drop_table('product');
        $CI->dbforge->drop_table('product_category');
        $CI->dbforge->drop_table('product_message');
        $CI->dbforge->drop_table('product_image');
        $CI->dbforge->drop_table('message');
        $CI->dbforge->drop_table('gallery');
        $CI->dbforge->drop_table('positions');
        $CI->dbforge->drop_table('departments');
        $CI->dbforge->drop_table('orders');
        $CI->dbforge->drop_table('carts');
        $CI->dbforge->drop_table('product_orders');
        
        
        
        
        
        
        //list of all database tables to drop while uninstalling use dbforge helper class to do this see https://ellislab.com/codeigniter/user-guide/database/forge.html
    }
    
    public function rerun(){
        /*
         * you can just do this
         */
        //$this->run(); // or 
        //declare you added tables
        
        
    }
}
