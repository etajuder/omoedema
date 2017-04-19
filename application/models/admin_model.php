<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author ETANUWOMA
 */
use Imagine\Image\Box;
use Imagine\Image\Point;
class Admin_model extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('form');
        
    }
    public function login(){
       $user = $this->input->post('user');
       $pass = $this->input->post('pass');
      $result= $this->db->get_where('admin',array('username'=>$user,'password'=>$pass));
       return $result->num_rows();
      
    }
    
    public function getConfig(){
        $df = $this->db->get('configuration');
        return $df->row_array();
    }
    
    public function updateConfig(){
        $data = array(
            'site_name' => $this->input->post('stname'),
             'site_description' => $this->input->post('desc'),
             'site_keywords' => $this->input->post('keyw'),
             'facebk_page' => $this->input->post('fbp'),
             'tweet_page' => $this->input->post('twp'),
             'maintainance_mode' => $this->input->post('maintain'),
            'enable_breaking_news' =>  $this->input->post('bkn'),
            'Sykup_page' =>  $this->input->post('syk'),
            'word_limit' => $this->input->post('limit'),
            'admin_route'=> $this->input->post('admin_route')
        );
        $this->db->update('configuration',$data);
        return App::message('success', 'Inserted');
    }
    
    public function adddept(){
        $nm = post('fullname');
        if(!$this->exists('departments', 'fullname', $nm)){
            $data = [
                'fullname'=>$nm,
                'short_name'=>  post('short_name'),
                'school'=>  post('school')
            ];
        if(DBA::operation(INSERT, 'departments', $data)){
            return App::message('success', 'Inserted');
        }else{
            return App::message('error', 'Error Occurred');
        }
        }else{
            return App::message('error', 'Error Occurred',10111);
        }
    }
    public function addsch(){
        $nm = post('fullname');
        if(!$this->exists('schools', 'full_name', $nm)){
            $data = [
                'full_name'=>$nm,
                'short_name'=>  post('short_name')
            ];
        if(DBA::operation(INSERT, 'schools', $data)){
            return App::message('success', 'Inserted');
        }else{
            return App::message('error', 'Error Occurred');
        }
        }else{
            return App::message('error', 'Error Occurred',10111);
        }
    }
 public function addclass(){
        $nm = post('name');
        if(!$this->exists('class', 'name', $nm)){
            $data = [
                'name'=>$nm,
                'slug'=>  post('slug')
            ];
        if(DBA::operation(INSERT, 'class', $data)){
            return App::message('success', 'Inserted');
        }else{
            return App::message('error', 'Error Occurred');
        }
        }else{
            return App::message('error', 'Error Occurred',10111);
        }
    }
 
    public function erase(){
        $this->db->where('id',  $this->input->get('id'));
        $db = $this->db->update('categories',array('page_display'=>0));
    }
    

    public function exists($db,$col,$vl){
        $rs = $this->db->get_where($db,array($col=>$vl));
        return $rs->num_rows();
    }
   
     
    public function insertstudent(){
        $pic = "";
          if(isset($_FILES['userfile'])){
            $result=$this->do_upload();
            foreach($result as $res){
               $pic = $res['file_name'];
               $imagine = new Imagine\Gd\Imagine();
               $image = $imagine->open("./uploads/$pic");
               $image->resize(new Box(214, 172))
                       ->save("./uploads/$pic");
            }
        }
        
        $data = [
            'name'=>post('name'),
            'nick'=>post('nick'),
            'phone'=>post('phone'),
            'dob'=>post('dob'),
            'activities'=>post('activities'),
            'skills'=>post('skills'),
            'email'=>post('email'),
            'facebook_account'=>post('facebook_account'),
            'company'=>post('company'),
            'project_topic'=>post('project_topic'),
            'hobbies'=>post('hobbies'),
            'reviews'=>post('review'),
            'school'=>post('school'),
            'class'=>post('class'),
            'department'=>post('department'),
            'image'=>$pic,
            'nationality'=>post('nation'),
            'state'=>  post('state'),
            'itfirm'=>  post('itfirm')
        ];
       if( $this->db->insert("students",$data)){
           $db = DBA::operation(GETW, 'students', $data);
           $id = $db->row_array()['id'];
           $this->uploads($id);
           return App::message('success', 'Inserted successfully');
           
       }else{
           return App::message('error', 'Error Occured');
       }
    }
    
 
    public function random(){
        return rand().rand().rand();
    }
     private function uploads($id){
       if(isset($_FILES['files'])){
    $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = md5(uniqid()).time().'.png';
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
        if($file_size > 2097152){
			$errors[]='File size must be less than 2 MB';
        }		
        $desired_dir="./uploads";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
                $db = DBA::operation('insert', 'gallery',['image'=>$file_name,'user_id'=>$id]);
            }else{									// rename the file if another one exist
                $new_dir="$desired_dir/".$file_name.time();
                 rename($file_tmp,$new_dir) ;				
            }
					
        }else{
                print_r($errors);
        }
    }
	
}

        }
    function do_upload()
	{
            
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|zip';
		$config['max_size']	= '1024';
		$config['max_width']  = '1924';
		$config['max_height']  = '968';
                $config['file_name'] = md5($this->input->post('id')).time().'.png';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			return $data['file_name'] = $this->input->post('picture');

		}
		else
		{
                       
			return $data = array('upload_data' => $this->upload->data());
                        
                        
		}
	}
         function do_uploads()
	{
        
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1024';
		$config['max_width']  = '1924';
		$config['max_height']  = '968';
                $config['file_name'] = md5($this->input->post('id')).time().'.png';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			return $data['file_name'] = "";

		}
		else
		{
			return $data = array('upload_data' => $this->upload->data());
                        
		}
	}
       
        
        function upload_module(){
            @mkdir("./modules/_zip/", 0777, true);
            $tempFile = $_FILES['file']['tmp_name'];
  $targetPath =  './modules/_zip/';
   $targetFile = $targetPath."file.zip";
  if(move_uploaded_file($tempFile, $targetFile)){
      return true;
  }else{
      return false;
  }
		
        }
         function upload_theme(){
            @mkdir("./modules/_zip/", 0777, true);
            $tempFile = $_FILES['file']['tmp_name'];
  $targetPath =  './modules/_zip/';
   $targetFile = $targetPath."file.zip";
  if(move_uploaded_file($tempFile, $targetFile)){
      return true;
  }else{
      return false;
  }
		
        }
        
        
    
    public function describe(){
        $table = $this->input->get('action');
         $sd= $this->db->query("describe $table");
   return  $d= $sd->result_array();
     
    }
    public function getAdverts(){
        $db = $this->db->get('advert');
        return $db->result_array();
    }
     public function getCusAdverts(){
        $db = $this->db->get('customadvert');
        return $db->result_array();
    }
    public function add_advert(){
        $data = array(
            'website'=>  $this->input->post('website')
        );
        $this->db->insert('advert',$data);
        
    }
    
    public function advertadd(){
        $pic = "";
          if(isset($_FILES['userfile'])){
            $result=$this->do_upload();
            foreach($result as $res){
               $pic = $res['file_name'];
            }
        }
        $data = [
            'type'=>  $this->input->post('type'),
            'script'=> $this->input->post('script'),
            'image' =>$pic,
            'imagelink' => $this->input->post('imglink')
        ];
        
        if($this->db->insert('customadvert',$data)){
           return App::message('success', 'Advert Added successfully');
       }else{
           return App::message('error', 'Error Occured');
       }
    }
    
    
    
     public function installModule(){
           if($this->upload_module()){
               $this->unzip("./modules/_zip", "./modules/");
               delete_files("./modules/_zip",true);
               
               
              return App::message('success', 'Module Installed successfully');
           }else{
              return App::message('error', 'Error Occurred');
           }
            
        }
        
        
     public function activatemodule($module){
         if(!$this->moduleactivated($module) && !$this->nameExists($module)){
         
         modules::RUNDB($module);
         modules::movefiles($module);
         $this->db->insert('modules',['name'=>$module,'activated'=>1]);
         }else if($this->nameExists($module)){
          modules::RUNDB($module);
         modules::movefiles($module);
         $this->db->where(['name'=>$module,'activated'=>0]);
         $this->db->update('modules',['activated'=>1]);
             
         }
         
     }
     
      public function deactivatemodule($module){
          modules::DROPDB($module);
         $this->db->where(['name'=>$module,'activated'=>1]);
         $this->db->update('modules',['activated'=>0]);
     }
     
     public function nameExists($module){
         $db = $this->db->get_where('modules',['name'=>$module]);
         return $db->num_rows();
     }
     public function moduleactivated($module){
         
         $db = $this->db->get_where('modules',['name'=>$module,'activated'=>1]);
         return $db->num_rows();
         
     }
           public function installTheme(){
           if($this->upload_module()){
               $this->unzip("./modules/_zip", "./themes/");
               delete_files("./modules/_zip",true);
               
               
              return App::message('success', 'Themes Installed successfully');
           }else{
              return App::message('error', 'Error Occurred');
           }
            
        }
    
 
    public function unzip($source, $destination) {
        @mkdir($destination, 0777, true);
   
        foreach ((array) glob($source . "/*.zip") as $key => $value) {
            $zip = new ZipArchive;
            if ($zip->open(str_replace("//", "/", $value)) === true) {
                $zip->extractTo($destination);
                $zip->close();
            }else{
                print 'error';
            }
        }
    }
    
    public function gettotal($table, $name){
       $db = DBA::operation(GETW, 'students',[$table=>$name]);
       return num_rows($db);
    }
   
}

class CategoryHelper extends CI_Model{
    private $category;
    public $total;
    public $news;
    public function __construct($cat) {
        parent::__construct();
        $this->category = $cat;
        $this->total = $this->getDetails()->num_rows();
        $this->news = $this->getDetails()->result_array();
    }
    
    private function getDetails(){
       $dbact= $this->db->get_where('news',array('category'=>  $this->category));
       return $dbact;
    }
    
}
