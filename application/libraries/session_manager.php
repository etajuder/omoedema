<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of session_manager
 *
 * @author JUDE
 */
class session_manager {
    //put your code here
    public function setSession($key,$value){
        $_SESSION[$key] = $value;
    }
    public function getSession($key){
        if(!empty($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return null;
    }
    
    public function unsetSession($key){
        unset($_SESSION[$key]);
    }
    public function killSessions(){
        session_destroy();
    }
}
