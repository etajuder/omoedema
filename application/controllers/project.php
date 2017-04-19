<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of project
 *
 * @author JUDE
 */
use Jenssegers\Date\Date;
class project extends Base{
    //put your code here
    public function __construct(){
        parent::__construct();
        model("project_model", "project");
        model("kick_model","kick");
        model("post_repo", "post");
       $this->data["_is_logged_in"] = Auth::user();
       if(Auth::user()){
          $this->data["user"] = $this->kick->get_user(Auth::Username());
       }
    }
    
    public function changeprojectimg(){
        $this->project->upload();
    }
    public function changeprojectvid(){
        $this->project->uploadvid();
    }
    public function basicsetup(){
        
        $this->project->basic();
        
    }
    
    public function storysetup(){
        
        $this->project->story();
    }
    
    public function preview(){
        if(get("id") == null){
            redirect(base_url("account"));
        }else{
           $project = $this->project->get_projects(1,["project_id"=>  get("id")],true);
           if($project){
              $this->data["project"] = $project;
              $this->data["user"] =  $this->kick->get_user(Auth::Username());
              $this->data["title"] = App::getConfig("site_name")."| ".$project["title"];
              Theme::Section("account-preview", $this->data);
           }
        }
    }
    
    public function completesetup(){
        
        $this->project->completesetup();
    }
    
    public function addcategory(){
        $this->session->set_flashdata('item',$this->project->addcategory());
       header("location:".App::route(modules::admin_route(), '/kick/addcategory'));
        
    }
    
    public function projects($user,$title,$action=null){
       
        if($this->kick->userExists($user)){
             $this->data["user_profile"] = $this->kick->get_user($user,["username"=>$user]); 
             
             $project = $this->project->get_projects(1,["user_id"=> $this->data["user_profile"]["id"],"title"=>  str_replace("-", " ", $title)],true);
            if($project){
                $this->data["title"] = $project["title"];
                $this->data["project"] = $project;
                
                $this->data["proj_title"] = url_title($title);
                $this->data["user_url"] = $user;
                $this->data["project_posts"] = $this->post->read_post(["project_id"=>$project["id"]]);
                $this->data["project_post_count"] = count($this->data["project_posts"]);
               if($action == null){
                Theme::Section("project-projects", $this->data);
               }else if($action == "pledge"){
                   if(Auth::user()){
                   Theme::Section("project-pledge-index", $this->data);
                   }else{
                       redirect(base_url());
                   }
               }
            }else{
                show_404();
            }
        }else{
            show_404();
        }
        
    }
    
    public function pledge(){
        $user_id = $this->data["user"]["id"];
        $this->project->pledge($user_id);
    }
    
    public function postcomment(){
        $this->post->insert();
    }
    public function insertcomment(){
        $this->post->insertcomment();
    }
    
    
}
