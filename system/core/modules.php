<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modules
 *
 * @author Mobolaji Iyanu
 */
class modules {
    //put your code here
    private static function Init(){
        $CI= &get_instance();
        $CI->load->helper('file');
        $CI->load->helper('directory');
        $CI->load->helper('path');
        return $CI;
    }
      public static function AvailModules(){
        self::Init();
        $langs =array();
        $langfold= directory_map(self::modulefolder());
        foreach ($langfold as $key => $value) {
            if($key != "_zip")
            array_push($langs, array('name'=>$key));
        }
        return $langs;
    }
    
        public static function RUNDB($module){
            self::Init();
        $file_list_dr = directory_map(self::modulefolder().$module);
        $path = set_realpath(self::modulefolder().$module);
        if(file_exists($path."db.php")){
            include $path."db.php";
            
             $db= new db();
             $db->run();
        }
                }
                
         public static function DROPDB($module){
             self::Init();
             $file_list_dr = directory_map(self::modelFolder().$module);
             $path = set_realpath(self::modelFolder().$module);
             if(file_exists($path."db.php")){
                 
                 include $path."db.php";
                 $db = new db();
                 $db->drop();
             }
         }

         public static function modulefolder(){
        return 'modules/';
    }
    public static function listfiles($modules){
        $controller_folder = directory_map(self::modulefolder().$modules."/files/controllers/");
        foreach ($controller_folder as $file){
             print $file."<br>";
        }
    }

   public static function movefiles($modules){
        ###Copy Controller##
       $controller_folder = directory_map(self::modulefolder().$modules."/"."files/"."controllers/");
       if(is_array($controller_folder)){
       foreach ($controller_folder as $file){
        copy('./modules/'.$modules."/files/controllers/".$file, self::controllerFolder()."$file");
       }
       }
        ###Copy Model##
       
        $model_folder = directory_map(self::modulefolder().$modules."/files/models/");
        if(is_array($model_folder)){
        foreach ($model_folder as $model){
        copy('./modules/'.$modules."/files/models/$model", self::modelFolder().$model);
        
       }
        }
        
    }
    public static function getAdminSideBar($module){
        if(file_exists('./modules/'.$module."/$module"."_side.php")){
        include './modules/'.$module."/$module"."_side.php";
        return $side_bar;
        }else{
            return array();
        }
    }
    
    public static function isActive(){
              $CI = &get_instance();
     
             $db =DBA::operation('get_where', 'modules',['activated'=>1]);
             return $db->result();
     
    }
    public static function isActivated($id){
              $CI = &get_instance();
     
             $db =DBA::operation('get_where', 'modules',['name'=>$id,'activated'=>1]);
             return $db->num_rows();
     
    }
    public static function getModuleData($module){
        if(file_exists('./modules/'.$module."/data".".php")){
        include './modules/'.$module."/data".".php";
        return $data;
        }else{
            return array();
        }
    }
    public static function isFullModule($module){
        include './modules/'.$module."/about".".php";
        return @$detail["type"] == "full";
        
    }
       public static function hasManage($module){
        include './modules/'.$module."/about".".php";
        return @$detail["has_manage"];
    }
       public static function manage_url($module){
       include './modules/'.$module."/about".".php"; 
       return @$detail["manage_url"];
    }

        public static function getRoutes(){
       $CI = &get_instance();
     $msq = new mysqli(System::Get('host'), System::Get('user'), System::Get('pass'), System::Get('db'));
     $row=$msq->query("select name from modules where activated=1");
     $tot = $row->num_rows;
     if($tot >0 ){
    $theme =$row->fetch_assoc();
      return $theme;
     }  else {
     return array();    
     }
    
    }
    
    private static function modelFolder(){
        
        return './application/models/';
    }
     private static function controllerFolder(){
        
        return './application/controllers/';
    }
    
    
    public static function setDefault_controller($module){
        App::setConfig(['active_module'=>$module]);
    }
    
      public static function default_controller(){
        $CI = &get_instance();
     $msq = new mysqli(System::Get('host'), System::Get('user'), System::Get('pass'), System::Get('db'));
     $row=$msq->query("select active_module from configuration");
    $theme =$row->fetch_row()[0];
      return $theme;
    }
    
    public static function admin_route(){
         $CI = &get_instance();
     $msq = new mysqli(System::Get('host'), System::Get('user'), System::Get('pass'), System::Get('db'));
     $row=$msq->query("select admin_route from configuration");
    $theme =$row->fetch_row()[0];
      return $theme;
    }
    
    
    
    public static function readSetting($module){
        include './modules/'.$module."/about".".php";
        return $detail;
        
    }
    
    public static function getModulePath($module){
        
        return 'modules/'.$module."/";
    }
    public static function readPages($module){
        include './modules/'.$module."/about".".php";
        return $pages;
        
    }
    public static function pageExists($module,$page){
         include './modules/'.$module."/about".".php";
       return  in_array($page, self::readPages($module));
           
    }
    public static function admin_json_builder(){
        return "admin/custom_page";
    }
    
    public static function displayModule($module,$data=[]){
        if(modules::isActivated($module)){
        model($module);
        $CI = &get_instance();
        $CI->$module->read($data);
        }
    }
}
