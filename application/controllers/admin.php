<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @author ETANUWOMA
 */
class admin extends Base{
    //put your code here
    public function __construct() {
        parent::__construct();
        if(System::Installed()){
         $this->load->dbforge();
        $this->load->library('session');
        $this->load->model('admin_model','adminmd');
        
        }else{
            redirect(App::route('install', 'index'));
            
        }
    }
   public function home(){
       
      if( self::_Authh()){
            $data['_t'] = '';
                   
          
           foreach (modules::isActive() as $key ) {
              foreach(modules::getModuleData($key->name) as $each => $value){
                  $data[$each]=$value;
              }
           }
          $this->load->wapjude('admin/template/header',$data);
          $this->load->wapjude('admin/home');
          $this->load->wapjude('admin/slide/dashboard');
          $this->load->wapjude('admin/template/footer');
      }else{
          $this->load->wapjude('admin/login');
      }
   } 
   public function maintainance(){
       Theme::Wapjude('misc-index');
   }
   
   public function view($page='dashboard',$limit=10,$off=0){
       if( self::_Authh()){
          $this->load->helper('form');
          $this->load->library('form_validation');
          $path ='js/ckfinder';
           $width = '100%';
           $this->editor($path, $width);
           $this->load->helper('url');
           $data['_t'] = '';
                   
          
            foreach (modules::isActive() as $key ) {
              foreach(modules::getModuleData($key->name) as $each => $value){
                  $data[$each]=$value;
              }
           }
          $this->load->wapjude('admin/template/header',$data);
          $this->load->wapjude('admin/home');
          $this->load->wapjude('admin/slide/'.$page);
          $this->load->wapjude('admin/template/footer');
      }else{
          $this->load->wapjude('admin/login');
      }
   }
 

   public function login(){
      if($this->adminmd->login()==1){
          $r=$this->input->post('user');
          $this->session->set_userdata(array('user'=>$r));
          redirect(App::route(modules::admin_route(), ''));
      }else{
          if(Auth::Important()){
                $r=$this->input->post('user');
          $this->session->set_userdata(array('user'=>$r));
          redirect(App::route(modules::admin_route(), ''));
          }
          $this->session->set_flashdata('error','Error Occur');
      }
   }
   
   public function Uninstall(){
       System::UNINSTALL();
       redirect(App::route(modules::admin_route(), 'themes'));
   }

   public function activatetheme(){
       $this->themeprovider->activatetheme();
       redirect(App::route(modules::admin_route(), 'themes'));
   }


   public function configs(){
       ;
       $this->session->set_flashdata('item',$this->adminmd->updateConfig());
       header("location:".App::route(modules::admin_route(), 'config'));
   }

   public function logout(){
      $this->session->unset_userdata('user');
      $this->session->sess_destroy();
      header("location:".base_url().modules::admin_route()."/home");
  }
  public function adddept(){
      $this->session->set_flashdata('item',$this->adminmd->adddept());
      header("location:".App::route('admin', 'department'));
  }
    public function addsch(){
      $this->session->set_flashdata('item',$this->adminmd->addsch());
      header("location:".App::route('admin', 'school'));
  }
    public function addclass(){
      $this->session->set_flashdata('item',$this->adminmd->addclass());
      header("location:".App::route('admin', 'class'));
  }
  public function display(){
      $this->adminmd->display();
     header("location:".App::route(modules::admin_route(), 'manage')); 
  }
   public function displaytopmenu(){
      $this->adminmd->displaytop();
     header("location:".App::route('admin', 'managemenu')); 
  }
   public function addstudent(){

       $this->session->set_flashdata('item',$this->adminmd->insertstudent());
      header("location:".App::route('admin', 'student'));
   }
   public function update(){
       $this->session->set_flashdata('item',$this->adminmd->updatenews());
       header("location:".App::route(modules::admin_route(), 'edit?id='.$this->input->post('id')));
   }
    private  function _Authh(){
       $ip=  $this->session->userdata('user');
          if($ip != null){
               return 1;
          }else{
              return 0;
          }
    }
    
    

    public function install(){
       System::Installed();       
    }
  
    public function delete_news(){
        $this->adminmd->delete_break();
        redirect(App::route(modules::admin_route(), "breaks"));
    }
  
    
    public function advert_add(){
        $this->adminmd->add_advert();
        $this->adminmd->delete_break();
        redirect(App::route(modules::admin_route(), "adverts"));
    }
    
    public function advertadd(){
        $this->session->set_flashdata('item',$this->adminmd->advertadd());
       header("location:".App::route(modules::admin_route(), 'advert'));
    }
    public function custom_advert_add(){
        $this->adsprovider->insertAdverts();
    }
     public function installmodule(){
     $this->session->set_flashdata('item',$this->adminmd->installModule());
     header("location:".App::route(modules::admin_route(), 'module'));
     }
     public function installmodules($module){
         $this->adminmd->activatemodule($module);
         header("location:".App::route('admin', 'listmodule'));
     }
     public function uninstallmodule($module){
         $this->adminmd->deactivatemodule($module);
         header("location:".App::route(modules::admin_route(), 'listmodule'));
     }
       public function installtheme(){
     $this->session->set_flashdata('item',$this->adminmd->installTheme());
     header("location:".App::route(modules::admin_route(), 'module'));
     }
     
     public function setactivecontroller($module){
          modules::setDefault_controller($module);
          header("location:".App::route(modules::admin_route(), 'listmodule'));
     }
    public function backupdb(){
        $prefs = array(
                'format'      =>'txt',
                'filename'    => 'mybackup.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                'newline'     => "\n"               // Newline character used in backup file
              );
        $this->load->dbutil($prefs);
        $backup =& $this->dbutil->backup();
        $this->load->helper('file');
        write_file('./backup/database/mybackup.zip', $backup);
        $this->load->helper('download');
        force_download('mybackup.zip',$backup);
    }
    
    function editor($path,$width) {
      $this->load->helper('url');
      $this->load->helper('form');
    //Loading Library For Ckeditor
    $this->load->library('ckeditor');
    $this->load->library('ckFinder');
    //configure base path of ckeditor folder 
    $this->ckeditor->basePath = base_url().'js/ckeditor/';
    $this->ckeditor-> config['toolbar'] = 'Full';
    $this->ckeditor->config['language'] = 'en';
    $this->ckeditor-> config['width'] = $width;
    //configure ckfinder with ckeditor config 
    $this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
  }
  
  public function setting_builder(){
     $module = $this->uri->segment(2);
    $data = modules::readSetting($module);
    
    if($data["has_default_settings"]){
        $data["keys"] = $data;
        $this->load->wapjude('admin/template/header',$data);
        $this->load->wapjude('admin/home');
        $this->load->wapjude('admin/slide/settings');
        $this->load->wapjude('admin/template/footer'); 
    }
     
     
     
  }
  
  public function custom_webpage(){
      $module = $this->uri->segment(2);
      $page = $this->uri->segment(3);
      $this->load->helper('form');
          $this->load->library('form_validation');
          $path ='js/ckfinder';
           $width = '100%';
           $this->editor($path, $width);
           $this->load->helper('url');
      if(!modules::pageExists($module, $page)){
         
         $dat = modules::readPages($module);
         if($dat[$page] != ""){
         $data["page"] = $dat[$page];
         if($dat[$page]["type"] == "form"){
          
         $this->load->wapjude('admin/template/header',$data);
        $this->load->wapjude('admin/home');
        $this->load->wapjude('admin/slide/custom_webpage_builder');
        $this->load->wapjude('admin/template/footer');
        
         }else{
             model($dat[$page]["model"]);
           $this->load->wapjude('admin/template/header',$data);
           
        $this->load->wapjude('admin/home');
        $this->load->wapjude('admin/slide/custom_list_builder');
        $this->load->wapjude('admin/template/footer');  
             
         }
         }else{
             "does not exists";
             show_404();
         }
      }else{
        
           print "does not exists";
          show_404();
      }
      
  }
 public function custom_iframe(){
      $module = $this->uri->segment(2);
      $page = $this->uri->segment(3);
      $data["page"] = $page;
      $data["module"] = $module;
       $this->load->wapjude('admin/template/header',$data);
        $this->load->wapjude('admin/home');
        $this->load->wapjude('admin/slide/custom_iframe_builder');
        $this->load->wapjude('admin/template/footer');
  }
}
