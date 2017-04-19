<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Theme
 *
 * @author Faith
 */
class Theme {
    //put your code here
    public static function Section($sec,$data=NULL){
        $CI = &get_instance();
        $CI->load->view(str_replace('-', '/', $sec),$data);
    }
    
    public static function Wapjude($sec,$data=NULL){
        $CI = &get_instance();
        $CI->load->wapjude(str_replace('-', '/', $sec),$data);
    }
    public static function PickFromThemeFolder($sec,$data=NULL){
        $CI = &get_instance();
        $CI->load->view(str_replace('-', '/', $sec),$data);
    }
    public static function PickFromAdminFolder($sec,$data=NULL){
        $CI = &get_instance();
        $CI->load->wapjude(str_replace('-', '/', $sec));
    }


    public static function CategoryBlade($sec,$data=NULL){
         $CI = &get_instance();
        $daba['title'] = $sec;
        $daba['listed'] = $CI->NewsProvider->getnewsbycat($sec,10);
        $CI->load->view('blade/index',$daba);
    }
    public static function CurrentPage($title,$cat){
        if($title==$cat){
            return 'current-menu-item';
        }
    }
   
  public static function getCurrentTheme(){
        $CI = &get_instance();
     $msq = new mysqli(System::Get('host'), System::Get('user'), System::Get('pass'), System::Get('db'));
     $row=$msq->query("select theme from configuration");
    $theme =$row->fetch_row()[0];
      return $theme;
    }
    
 public static function Make($view,$args=null){
     if(is_callable($view)){
         call_user_func($view,$args);
     }elseif (is_array($view)) {
         foreach ($view as $v){
             if(is_callable($v)){
                 call_user_func($v);
             }else if(is_a($v, "View")){
               
             }
             
         }
            
        }
     
 }
    
}
