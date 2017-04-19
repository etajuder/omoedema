<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of System
 *
 * @author ETANUWOMA
 */
class System {
    //put your code here
  private static  $sql; 
    

    public static function Installed(){
      self::$sql = new SQLite3('system/predb.sqlite');
       self::Create();
       self::Populate();
       self::Config();
       if(self::Select()=="yes"){
           return TRUE;
       }else{
           return FALSE;
       }
    }
    
    private static  function Create(){
        self::$sql = new SQLite3('system/predb.sqlite');
      
    }
    
    private static function Populate(){
        self::$sql->query("Create table if not exists Jude( id int(10),install varchar(4))");
    }
    
    public static function Install($yes){
        self::$sql->query("insert into Jude values(1,'$yes')");
    }
    
    private static function Config(){
        self::$sql->query("create table if not exists Config("
                . " id int(10),"
                . "host varchar(20),"
                . "user varchar(20),"
                . "pass varchar(50),"
                . "db varchar(50)"
                . ")");
    }
    
    public static function insert($host,$user, $pass,$db){
        self::$sql->query("insert into Config values(1,'$host','$user','$pass','$db')");
    }
    
   public static function Get($val){
       self::$sql = new SQLite3('system/predb.sqlite');
       $db= self::$sql->query("select $val from Config");
        return $db->fetchArray()[0]; 
   }
    private static function Select(){
       $res= self::$sql->query("select * from jude where install='yes'");
       return $d = $res->fetchArray()[1];
    }
         public static function getSes($ses){
             $CI = &get_instance();
             $CI->load->model('install_md','md');
            return $CI->md->getSes($ses);
         }
   public static function Maintain(){
       $CI = &get_instance();
       $CI->load->database();
      $sd= $CI->db->get('configuration');
     return $sd->row_array()['maintainance_mode'];
   }
   public static function UNINSTALL(){
       self::Create();
       self::$sql->query("drop table jude");
       self::$sql->query('drop table Config');
   }
   
}
