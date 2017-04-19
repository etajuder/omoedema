<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewRenderer
 *
 * @author JUDE
 */
class View {
    //put your code here
    private $view;
    private $path;
    private $config;
     static $header = false;
    static $footer = false;
    static $sidebar = false;
    static $content = false;
    static $base = "";
    static $title = "";


    static $CI;
    
    public function __construct() {
        
    
    }
    
    public static function fromTheme($view,$data=[]){
        Theme::PickFromThemeFolder($view,$data);
    }
    public static function fromAdmin($view,$data=[]){
        Theme::PickFromAdminFolder($view,$data);
    }
    
    public function MakeTemp(callable $call){
        
    }
    
    public function Runnable(callable $call,$millseconds){
        $start = time();
        
        $stop = $start + $millseconds;
        
       
        
        
    }
     

    public static function BAKEHEADER(){
        self::$header = TRUE;
    }
    
    public static function BAKEFOOTER(){
        self::$footer = true;
    }
    
    public static function BAKESIDEBAR(){
        self::$sidebar = true;
    }
    
    public static function BAKECONTENT($content){
        self::$content = $content;
    }
    
    public static function BAKE(callable $call){
        if(is_callable($call)){
            call_user_func($call);
        }else{
            throw new Exception("invalid argument passed \n must be of type View ", 601, 778);
        }
    }
    
    public static function FIRE($data=null){
        self::$CI = &get_instance();
        Theme::Section(self::$base."raw",$data);
    }
    
    
}

class Route{
    private $route;
    public function __construct($from) {
        
    }
}
