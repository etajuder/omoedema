<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author JUDE
 */
class dashboard extends CI_Model {
    //put your code here
    var $data = [];
    public function __construct() {
        parent::__construct();
        ORMconnect();
    }
    
     public function read(){
        
         $this->data["total_users"] = $this->count("users");
         $this->data["female_users"] = $this->count("users",["gender"=>"female"]);
         $this->data["male_users"] = $this->count("users",["gender"=>"male"]);
         $this->data["total_projects"] = $this->count("projects");
         $this->data["total_live_projects"] = $this->count("projects",["status"=>2]);
         $this->data["total_pending_projects"] = $this->count("projects",["status"=>1]);
         $this->data["total_ongoing_projects"] = $this->count("projects",["status"=>0]);
         $this->data["total_expired_projects"] = $this->count("projects",["status"=>3]);
         $this->data["total_denied_projects"] = $this->count("projects",["status"=>4]);
         if(modules::isActivated("staffpick")){
             $this->data["staffpicks"] = $this->count("staff_pick");
         }
         $this->data["total_categories"] = $this->count("project_category");
         $this->data["total_project_pledges"] = $this->count("project_pledged");
         $this->data["total_amount_pledges"] = $this->sum("project_pledged", "amount_pledged");
         $this->load->moduleview("dashboard","dashboard",  $this->data);
        
    }
    
    public function count($table,$where=null){
        $operation = ORM::for_table($table)
                ->find_array();
        if($where != null){
        $operation = ORM::for_table($table)
                ->where($where)
                ->find_array();
        }
        if($operation){
            return count($operation);
        }else{
            return 0;
        }
    }
    public function sum($table,$column,$where=null){
        
        $get = ORM::for_table($table)
                ->select_expr("sum($column)", "total")
                ->find_one();
        if($where != null){
            $get = ORM::for_table($table)
                    ->select_expr("sum($column)", "total")
                    ->where($where)
                    ->find_one();
            
        }
        return $get->total;
    }
}
