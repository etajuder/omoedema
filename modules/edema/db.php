<?php

class db {
    //put your code here
    public function run(){
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
            ],
            "price"=>[
                "type"=>"int",
                "constraint"=>11,
                "default"=>0
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
