<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of p2p_model
 *
 * @author JUDE
 */
class p2p_model  extends CI_Model{
    //put your code here
    var $user;
    public function __construct() {
        parent::__construct();
        
        $this->user = $this->get_user();
    }
    
    
    public function get_user(){
        $get_user = $this->for_table("users")
                ->where_raw("username = ?", [Auth::Username()])
                ->find_one();
        return $get_user;
    }
    
    public function  match_maker(){
        
    }
    
    
}
