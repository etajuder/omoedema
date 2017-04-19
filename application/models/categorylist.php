<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of catlist
 *
 * @author JUDE
 */
class categorylist extends CI_Model {
    //put your code here
    
    public function __construct(){
        parent::__construct();
        model("project_model");
    }
    
    public function read(){
        $data["category"] = $this->readcategory();
        $data["cat_title"] = $this->getSettings("title");
        $data["cat_description"] = $this->getSettings("description");
        $data["cat_background"] = $this->getSettings("background");
        $data["cat_border"] = $this->getSettings("border");
        $data["title_color"] = $this->getSettings("title_color");
        $data["title_size"] = $this->getSettings("title_size");
        $data["description_color"] = $this->getSettings("description_color");
        $data["description_size"] = $this->getSettings("description_size");
        $data["category_name_color"] = $this->getSettings("category_name_color");
        $data["category_name_size"] = $this->getSettings("category_name_size");
        $data["category_plus_color"] = $this->getSettings("category_plus_color");
        $data["category_plus_size"] = $this->getSettings("category_plus_size");
        $data["category_count_color"] = $this->getSettings("category_count_color");
        $data["view_all_category"] = $this->getSettings("view_all_category");
        $data["view_all_color"] = $this->getSettings("view_all_color");
        $data["view_all_size"] = $this->getSettings("view_all_size");
        $this->load->moduleview("categorylist","list",$data);
    }
    
    public function readcategory(){
        $categories = [];
        
        $get_categories = ORM::for_table("project_category")
                ->find_array();
        foreach ($get_categories as $category){
            $category["project_count"] = $this->project_model->count_project_by_category($category["id"]);
            $categories[] = $category;
        }
        
        return $categories;
    }
    
    public function countcategory(){
        
        return ORM::for_table("category")
                ->find_many()
                ->count();
    }
    
    public function getSettings($key){
        
        $json = file_get_contents(modules::getModulePath("categorylist")."settings.json");
        $array = json_decode($json, TRUE);
        return $array[$key];
    }
    
    public function savedesign(){
        
            $file_name = modules::getModulePath("categorylist")."settings.json";
       $settings = file_get_contents($file_name);
       $arrays = json_decode($settings,TRUE);
   foreach ($_POST as $key=> $value){
       $arrays[$key] = $value;
   }
   
   if(file_put_contents($file_name, json_encode($arrays))){
       redirect(base_url("categorylist/manage"));
   }else{
       print_r($arrays);
   }
      
    }
    
}
