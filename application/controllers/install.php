<?php
@session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of install
 *
 * @author ETANUWOMA
 */
class install extends CI_Controller {
    //put your code here
    
    public function __construct() {
        parent::__construct();
        if(System::Installed()){
            redirect(base_url());
            
        }
    }
    public function index(){
        Theme::Wapjude('install-index');
        $this->session->sess_destroy();
    }
    
    public function installdb(){
        
        
        $host = $this->input->post('host');
        $user = $this->input->post('user');
        $password = $this->input->post('pass');
        $database = $this->input->post('db');
       $this->__Check($host, $user, $password, $database);
        
    }
    
    private function __Check($host,$username,$password,$database){
        
         if(@mysql_connect($host, $username, $password)){
             
              if(mysql_select_db($database)){
                  $this->session->set_flashdata('item',  App::message('success', 'Connected <strong>Happy Coding</strong>'));
                  $this->session->set_userdata(array(
                      'host'=>$this->input->post('host'),
                      'user'=>$this->input->post('user'),
                      'pass'=>$this->input->post('pass'),
                      'db'=>$this->input->post('db')
                  ));
                  $_SESSION["host"] = $this->input->post('host');
                  $_SESSION["user"] = $this->input->post('user');
                  $_SESSION["pass"] = $this->input->post('pass');
                  $_SESSION["db"] = $this->input->post('db');
                  header("location:".App::route('install', 'site'));
              }else{
                  $this->session->set_flashdata('item',  App::message('error', '<strong>Database does not exists</strong>'));
                 header("location:".App::route('install', 'index'));
              }
         }  else {
           $this->session->set_flashdata('item',  App::message('error', 'Could not connect with the provided values'));
           header("location:".App::route('install', 'index'));
         }
         
       
    }
    public function Site() {
        $this->load->model('install_md','md');
        $this->md->load();
        Theme::Wapjude('install-site');
    }
    
    public function finalize(){
        $this->load->model('install_md','md');
         $this->md->addAdmin();
         $this->md->insertConfig();
         Theme::Wapjude('install-final');
         System::insert($_SESSION["host"], $_SESSION["user"], $_SESSION["pass"], $_SESSION["db"]);
         System::Install("yes");
         
         $this->load->database('default');
         $this->session->sess_destroy();
         session_destroy();
    }
    
}
