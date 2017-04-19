<?php

class db{
    public function run(){
        $CI = &get_instance();
        $CI->load->dbforge();
        
        $field = [
            'id'=>[
                'type'=>'int',
                'auto_increment'=>TRUE
            ],
            'type'=>[
                'type'=>'varchar',
                'constraint'=>5
            ],
            'script'=>[
                'type'=>'longtext'
                
            ],
            'image'=>[
                'type'=>'varchar',
                'constraint'=>70
            ],
            'imagelink'=>[
                'type'=>'varchar',
                'constraint'=>50
            ]
            
        ];
        #######
        $CI->dbforge->add_field($field);
        $CI->dbforge->add_key('id',TRUE);
        $CI->dbforge->create_table('customadvert',TRUE);
    }
    public function drop(){
        $CI = &get_instance();
        $CI->load->dbforge();
        $CI->dbforge->drop_table('customadvert', true);
    }
}