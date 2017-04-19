<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Base
 *
 * @author Faith
 */
class Base extends CI_Controller {
    //put your code here
    var $data;
     var $template;
     
    public function __construct() {
        parent::__construct();
        if(!System::Installed()){
           redirect(base_url('install'));
       }
       ORMconnect();
       $this->load->helper('form');
          $this->load->library('form_validation');
          $path ='js/ckfinder';
           $width = '100%';
           $this->editor($path, $width);
           $this->load->helper('url');
         $this->template = new Skeleton();
       $this->template->Set_Skeleton("template-skeleton");
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
    
}
 class Skeleton {
     var $parent_view = "";
     public $data =[];
     public function __construct() {
          
     }

     public function Set_Skeleton($view){
         $this->parent_view = $view;
        
     }
     
     public function inject_view($view,$data=null){
     
         $this->data = $data;
          $this->data["theme"]["inject"] = $view;
          $this->data["theme"]["display_header"] = TRUE;
          $this->data["theme"]["display_footer"] = TRUE;
         //var_dump($this->data);
         Theme::Section($this->parent_view, $this->data);
     }
     public function disable_header(){
         $this->data["theme"]["display_header"] =FALSE;
     }
     public function disable_footer(){
         $this->data["theme"]["display_footer"] = FALSE;
     }
     
 }
