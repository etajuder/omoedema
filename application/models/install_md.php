<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of install
 *
 * @author OLODUSAMUEL
 */
class install_md extends CI_Model{
 
    public function __construct() {
        parent::__construct();
        
    }
    
    
    public function load(){
         $this->load->database('test');
        $this->load->dbforge();
        $this->dbforge->drop_table('news',TRUE);
         $field = array(
            'id' => array(
                'type' =>'INT',
                'auto_increment' =>TRUE,
            ),
            'title' =>array(
                'type'=>'varchar',
                'constraint' =>100,
            ),
		
            'body' =>array(
                'type' => 'longtext'
            ),
            'category'=>array(
                'type' => 'varchar',
                'constraint' =>70,
            ),
            'picture'=>array(
                'type' => 'varchar',
                'constraint' =>70,
            ),
            'video'=>array(
                'type' => 'varchar',
                'constraint' =>70,
            ),
             'audio'=>array(
                'type' => 'varchar',
                'constraint' =>70,
            ),
            'viewed'=>array(
                'type' => 'int',
                'constraint' =>70,
            ),
            'popular'=>array(
                'type' => 'int',
                'constraint' =>11,
            ),
            'hotnews'=>array(
                'type' => 'varchar',
                'constraint' =>11,
            ),
             'slug' =>array(
                 'type' => 'varchar',
                 'constraint'=> 70,
             ),
            'created_at'=>array(
                'type' => 'varchar',
                'constraint' =>70
                
            ),
            
        );
        $this->dbforge->add_field($field);
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('news',TRUE);
        $this->dbforge->drop_table('categories',TRUE);
        $fields= array(
            'id' => array(
                'type' => 'int',
                'auto_increment' => TRUE
            ),
            'name' =>array(
                'type' =>'varchar',
                'constraint' =>50
            ),
            'created_at' =>array(
                'type' =>'varchar',
                'constraint' =>50
            ),
            'top_menu' =>array(
                'type' =>'int',
                'constraint' =>11,
                'default' =>0
            ),
            'page_display' =>array(
                'type' =>'int',
                'constraint' =>11,
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('categories',TRUE);
        $this->dbforge->drop_table('admin',TRUE);
         $fiel= array(
            'id' => array(
                'type' => 'int',
                'auto_increment' => TRUE
            ),
            'fullname' =>array(
                'type' =>'varchar',
                'constraint' =>50
            ),
            'username' =>array(
                'type' =>'varchar',
                'constraint' =>50
            ),
            'password' =>array(
                'type' =>'varchar',
                'constraint' =>50,
            )
             );
         $this->dbforge->add_field($fiel);
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('admin',TRUE);
        $this->dbforge->drop_table('configuration',TRUE);
        $config= array(
            'id' => array(
                'type' => 'int',
                'auto_increment' => TRUE
            ),
            'site_name' =>array(
                'type' =>'varchar',
                'constraint' =>70
            ),
            'site_description' =>array(
                'type' =>'longtext',  
            ),
            'facebk_page' =>array(
                'type' =>'varchar',
                'constraint' =>50,
                'null' =>TRUE
            ),
            'tweet_page' =>array(
                'type' =>'varchar',
                'constraint' =>50,
                'null' =>TRUE
            ),
            'site_keywords' =>array(
                'type' =>'varchar',
                'constraint' =>80,
                'null' =>TRUE
            ),
            'facebk_id' =>array(
                'type' =>'varchar',
                'constraint' =>50,
                'null' =>TRUE
            ),
            'tweet_id' =>array(
                'type' =>'varchar',
                'constraint' =>50,
                'null' =>TRUE
            ),
            'Sykup_page' =>array(
                'type'=>'varchar',
                'constraint'=>70
            ),
            'maintainance_mode' =>array(
                'type' =>'int',
                'constraint' =>2,
                'default' =>1
            ),
            'enable_breaking_news' =>array(
                'type'=>'varchar',
                'constraint'=>100,
                
            ),
			'word_limit'=>[
			'type'=>'int',
			'constraint'=>10,
			'default'=>20
			],
            'theme'=>array(
                'type'=>'varchar',
                'constraint'=>70,
                'default'=>'default'
            ),
            'active_module'=>[
                'type'=>'varchar',
                'constraint'=>70,
                'default'=>'welcome',
            ],
            'admin_route'=>[
                'type'=>'varchar',
                'constraint'=>70,
                'default'=>'admin'
            ]
        );
        
        $this->dbforge->add_field($config);
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('configuration',TRUE);
        $this->dbforge->drop_table('breaking_news',TRUE);
        $break = array(
            
            'id' => array(
                'type'=>'int',
                'auto_increment'=>TRUE
            ),
            'title'=>array(
                'type'=>'varchar',
                'constraint' =>100,
            ),
            'time'=>array(
                'type'=>'varchar',
                'constraint'=>30
            )
            
        );
        
        $this->dbforge->add_field($break);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('breaking_news',TRUE);
        $this->dbforge->drop_table('advert',TRUE);
        $advert = array(
          'id' =>array(
              'type'=>'int',
              'auto_increment'=>TRUE
          ),
            'website' => array(
                'type'=>'varchar',
                'constraint'=>70
            ),
            'show_picture'=>array(
                'type'=>'int',
                'constraint'=>2
            )
        );
        $this->dbforge->add_field($advert);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('advert',TRUE);
        $this->dbforge->drop_table('modules',TRUE);
        $module = array(
          'id' =>array(
              'type'=>'int',
              'auto_increment'=>TRUE
          ),
            'name' => array(
                'type'=>'varchar',
                'constraint'=>70
            ),
            'activated'=>array(
                'type'=>'int',
                'constraint'=>2,
                'default'=>0
            )
        );
        $this->dbforge->add_field($module);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('modules',TRUE);
        
        $this->dbforge->drop_table('custompage',TRUE);
        $custom = array(
            'id'=> array(
                'type' =>'int',
                'auto_inc'=>TRUE
            ),
            'page_name' => array(
                'type' => 'varchar',
                'constraint' => 50
            ),
            'page_title' => array(
                'type' => 'varchar',
                'constraint' =>  100,
                
            ),
            'page_description' => array(
                'type' => 'varchar',
                'constraint'=> 500
            ),
            'page_route' => array(
                'type' => 'varchar',
                'constraint' => 20
            ),
            'page_theme' => array(
                'type' => 'varchar',
               'constraint' =>20
            ),
            'page_admin_username' => array(
                'type'=>'varchar',
                'constraint' => 30
            ),
            'page_admin_password' => array(
                'type' =>'varchar',
                'constraint' =>100
            ),
            'page_admin_fullname' => array(
                'type' =>'varchar',
                'constraint' =>50
            )
            
        );
        $this->dbforge->add_field($custom);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('custompage',TRUE);
        
    }
    
    
    
    public function getSes($data){
        return $_SESSION[$data];
    }
    
    public function addAdmin(){
        $this->load->database('test');
        $user = $this->input->post('user');
        $pass = $this->input->post('pass');
        $fuln = $this->input->post('name');
        $data = array(
            'fullname' =>$fuln,
            'username' => $user,
            'password' => $pass,
        );
        $this->db->insert('admin',$data);
    }
    public function updateConfig($type,$val){
        $this->load->database('test');
        $this->db->update('configuration',array($type=>$val));
    }
    public function insertConfig(){
        $this->load->database('test');
        $data = array(
            'site_name' =>  $this->input->post('stname'),
            'site_description'  =>  $this->input->post('desc'),
        );
        $this->db->insert('configuration',$data);
    }
    
}
