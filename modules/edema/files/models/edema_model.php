<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of edema_model
 *
 * @author JUDE
 */
class edema_model extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function get_news($id= null,$where=NULL,$limit = 6,$offset = 0){
        
    }
    public function get_user(){
        return $this->for_table("users")
                ->where_raw("username = ?", [Auth::Username()])
                ->find_one();
    }
    public function register(){
        $new_user = $this->for_table("users")
                ->create();
        $new_user->fullname = post("fullname");
        $new_user->username = post("username");
        $new_user->password = post("pass");
        $new_user->email = post("email");
        $new_user->set_expr("created_at", "NOW()");
       if(!$this->details_exist("users", "username", post("username"))){
           if (!$this->details_exist("users", "email", post("email"))){
               $this->session_manager->setSession("user",  post("username"));
               redirect(App::route(""));
           }else{
               return App::message("error", "Email Already Registered!!");
           }
       }else{
           return App::message("error", "Username Already taken");
       }   
    }
    
    public function details_exist($tbl,$key,$value){
        return $this->for_table($tbl)
                ->where_raw("$key = ?", [$value])
                ->find_one();
    }
    
    public function login(){
        $get_user = $this->for_table("users")
                ->where_raw("username = ?", [post("username")])
              ->find_one();
        if($get_user){
            $password_hash = $get_user->password;
            if(password_verify(post("password"), $password_hash)){
                $this->session_manager->setSession("user",  post("username"));
                return App::message("success", "successfully login");
            }else{
                return App::message("error", "Incorrect user login info");
            }
    }else{
        return App::message("error", "Email does not exist please try again");
    }
    }

        public function add_news(){
        
    }
    
    
}
