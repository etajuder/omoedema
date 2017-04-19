<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of p2p
 *
 * @author JUDE
 */
class p2p extends Base {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->data["is_logged_in"] = Auth::user();
        if($this->data["is_logged_in"]){
            $this->data["user"] = $this->p2p->get_user();
        }
    }
    
    public function index(){
      
    }
}
