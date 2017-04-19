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
            "password"=>[
            "type" =>"varchar",
            "constraint"=>225
            ],
            
            "address"=>[
            "type" =>"varchar",
            "constraint"=>225
            ],
             "image"=>[
            "type" =>"varchar",
            "constraint"=>225
            ],
            "date"=>[
                "type"=>"datetime"
            ]
        ];        
       
        $CI->dbforge->add_field($fields);
        $CI->dbforge->add_key('id', TRUE);
        $CI->dbforge->create_table('users', TRUE);
        
        
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
            "profile_img"=>[
                "type"=>"varchar",
                "constraint"=>100
            ],
            "created_at"=>[
                "type"=>"datetime"
            ]
        ];
        $CI->dbforge->add_field($forget_password_table);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("forget_password",TRUE);
        $photo_album = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "name"=>[
                "type"=>"varchar",
                "constraint"=>250
            ],
            "category_id"=>[
                "type"=>"int",
                "constraint"=>11
            ],
            "can_view"=>[
                "type"=>"int",
                "constraint"=>11,
                "default"=>0
            ],
            "cover_photo"=>[
                "type"=>"varchar",
                "constraint"=>250
            ],
            "albums"=>[
                "type"=>"longtext",
               
            ],
            "created_at"=>[
                "type"=>"datetime"
            ]
        ];
        
         $CI->dbforge->add_field($photo_album);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("photo_album",TRUE);
        $videos = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "title"=>[
                "type"=>"varchar",
                "constraint"=>250
            ],
            "category_id"=>[
                "type"=>"int",
                "constraint"=>11
            ],
            "can_view"=>[
                "type"=>"int",
                "constraint"=>11,
                "default"=>0
            ],
            "cover_photo"=>[
                "type"=>"varchar",
                "constraint"=>250
            ],
            "video"=>[
                "type"=>"longtext",
               
            ],
            "lenght"=>[
                "type"=>"varchar",
                "constraint"=>11
            ],
            "created_at"=>[
                "type"=>"datetime"
            ]
        ];
        
         $CI->dbforge->add_field($videos);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("videos",TRUE);
        $sliders = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "title"=>[
                "type"=>"varchar",
                "constraint"=>250
            ],
            "category_id"=>[
                "type"=>"int",
                "constraint"=>11
            ],
            
            "cover_photo"=>[
                "type"=>"varchar",
                "constraint"=>250
            ],
            "video"=>[
                "type"=>"longtext",
               
            ],
            "lenght"=>[
                "type"=>"varchar",
                "constraint"=>11
            ],
            "created_at"=>[
                "type"=>"datetime"
            ]
        ];
        
         $CI->dbforge->add_field($sliders);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("sliders",TRUE);
       $sub_plans = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "name"=>[
                "type"=>"varchar",
                "constraint"=>150
            ],
            "price"=>[
                "type"=>"varchar",
                "constraint"=>11
            ],
            "duration"=>[
                "type"=>"int",
                "constraint"=>11
            ],
            "description"=>[
                "type"=>"varchar",
                "constraint"=>250
            ],
            "created_at"=>[
                "type"=>"datetime"
            ]
        ];
        
        $CI->dbforge->add_field($sub_plans);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("sub_plans",TRUE);
        $payments = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "user_email"=>[
                "type"=>"varchar",
                "constraint"=>150
            ],
            "sub_id"=>[
                "type"=>"int",
                "constraint"=>11
            ],
            
            "payment_id"=>[
                "type"=>"varchar",
                "constraint"=>250
            ],
            "created_at"=>[
                "type"=>"datetime"
            ],
            "time_start" =>[
                "type"=>"varchar",
                "constraint"=>50
            ],
            "longurl" =>[
                "type"=>"varchar",
                "constraint"=>400
            ],
            "status"=>[
                "type"=>"int",
                "constraint"=>11,
                "default"=>0
            ],
            
            
        ];
        
        $CI->dbforge->add_field($payments);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("payments",TRUE);
        
        $misc = [
            "id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "terms"=>[
                "type"=>"longtext"
            ],
            "privacy"=>[
                "type"=>"longtext"
            ],
            "business_inc"=>[
                "type"=>"longtext"
            ],
            "about"=>[
                "type"=>"longtext"
            ]
            
            
        ];
          $CI->dbforge->add_field($misc);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table("misc",TRUE);
       
          }
    
    public function drop(){
        
        $CI = &get_instance();
        $CI->dbforge->drop_table('users');
        $CI->dbforge->drop_table('forget_password');
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
