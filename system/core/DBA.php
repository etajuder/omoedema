<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBA
 *
 * @author Faith
 */
class DBA {
     
    public static function operation($operation,$table,$data=null){
       $CI = &get_instance();
       $CI->load->database();
       return $CI->db->$operation($table,$data);
    }
    public static function where($array){
       $CI = &get_instance();
       $CI->load->database();
       return $CI->db->where($array);
        
    }
}
