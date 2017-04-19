<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of decor
 *
 * @author JUDE
 */
class decor  extends Base{
    //put your code here
    public function __construct() {
        parent::__construct();
        model("decor_model", "decor");
        model("superuser_model", "superuser");
        $this->data["is_logged_in"] = Auth::user();
        $this->data["view"] = "";
        if($this->data["is_logged_in"]){
            $this->data["user"] = $this->decor->get_user();
             
        }
         $this->data["child_view"] = "";
         $this->data["accept"] = $this->session_manager->getSession("accept") == null;
        $this->data["site"]["categories"] = $this->decor->get_categories();
        $this->data["site"]["scenes"] = [];
        $this->data["site"]["bonus_sites"] = [];
        $this->data["site"]["bonus_videos"] = [];
        $this->data["site"]["sliders"] = $this->superuser->get_sliders();
        $this->data["site"]["photos"] = $this->superuser->get_albums();
        $this->data["site"]["videos"] = $this->superuser->get_videos();
        $this->data["site"]["subscriptions"] = $this->superuser->get_plans();
        $this->data["site"]["misc"] = $this->superuser->get_misc();
    }
    
    public function index(){
        if(Auth::user()){
            
            $this->decor->payment_status($this->data["user"]["email"]);
        }
        $this->template->inject_view("index",  $this->data);
    }
    
    public function videos($category= null,$page=1){
        if(Auth::user()){
            $this->decor->payment_status($this->data["user"]["email"]);
        }
        if($category == null){
            $this->data["view"] = "videos";
           
            $this->template->inject_view("videos",  $this->data);
        }
    }
      public function photos($category= null,$page=1){
          if(Auth::user()){
            $this->decor->payment_status($this->data["user"]["email"]);
        }
        if($category == null){
            $this->data["view"] = "photos";
            $this->template->inject_view("photos",  $this->data);
        }
    }
    
        public function about(){
            $this->data["view"] = "about";
            $this->template->inject_view("about", $this->data);
        }
        
        public function misc($misc){
            $this->data["content"] = "";
            $this->data["view"] = "misc";
            switch ($misc){
            case "terms":
                $this->data["content"] = $this->data["site"]["misc"]["terms"];
                $this->data["child_view"] = "User Terms And Condition";
                break;
            case "privacy":
                $this->data["content"] = $this->data["site"]["misc"]["privacy"];
                $this->data["child_view"] = "User Privacy";
                break;
            case "business_inc":
                $this->data["content"] = $this->data["site"]["misc"]["business_inc"];
                $this->data["child_view"] = "Business Inquiries";
                break;
            
            }
            
            $this->template->inject_view("misc", $this->data);
        }
        
        public function bonus_site(){
            $this->data["view"] = "bonus_site";
            $this->template->inject_view("bonus_site",  $this->data);
        }
         public function bonus_videos(){
            $this->data["view"] = "bonus_videos";
            $this->template->inject_view("bonus_videos",  $this->data);
        }


        public function login(){
        if(Auth::user()){
            redirect(base_url());
        }
        $this->data["form"]["message"] = "";
         if(isset($_POST["username"]) && post("password") != null){
           $this->data["form"]["message"] =  $this->decor->login();
        }
        $this->data["view"] = "login";
        $this->template->inject_view("login",  $this->data);
    }
    
    public function signup(){
        if(Auth::user()){
            //redirect(base_url());
        }
        $this->data["form"]["message"] = "";
        if(isset($_POST["username"]) && post("email") != null){
           $$this->data["form"]["message"] = $this->decor->save_user_temp();
           
        }
         Theme::Section("sign",  $this->data);
    }
    
    public function user_reg(){
        if(post("username") != null){
            $this->data["form"] = $_POST;
            print "not null";
            print_r($_POST);
            $this->data["form"]["message"] = $this->decor->save_user_temp();
            
        }else{
         
        }
  
    }
    
    public function payment_confirmation(){
        $request_id = get("payment_request_id");
        $payment_id = get("payment_id");
        $this->decor->payment_confirmation($request_id,$payment_id);
    }
    
    public function memberjoin($slug,$id){
        if(Auth::user()){
            //redirect("");
        }
        $this->data["view"] = "memberjoin";
        $this->data["video"] = $this->superuser->get_videos($id);
        $this->template->inject_view("memberjoin",  $this->data);
    }
      public function video($slug,$id){
          if(Auth::user()){
            $this->decor->payment_status($this->data["user"]["email"]);
        }
        if(Auth::user()){
            //redirect("");
        }
        $this->data["view"] = "memberjoin";
        $this->data["video"] = $this->superuser->get_videos($id);
        $this->template->inject_view("video",  $this->data);
    }

    public function request($action){
        switch ($action){
            case "login":
                $this->decor->login();
                break;
            case "register":
                $this->decor->register();
                break;
            case "logout":
                $this->decor->logout();
                break;
            case "change_picture":
                $this->decor->change_picture();
                redirect(App::route($this->data["user"]["username"], "account"));
                break;
            case "accept":
                $this->session_manager->setSession("accept","yes");
                break;
        }
    }
    

    public function photo_album($slug,$id){
        $this->data["view"] = "photo";
        $this->data["photo"] = $this->superuser->get_albums($id);
        $this->template->inject_view("photo_album",  $this->data);
        
    }
    
    public function category($name){
        $cate = $this->superuser->get_category_by_name(str_replace("-", " ", $name));
        if(!$cate){
            show_404(); 
        }
        $this->data["child_view"] = "categories";
        $this->data["category"] = $cate;
        $this->data["site"]["videos"] = $this->superuser->get_videos(null,$cate["id"]);
        $this->data["site"]["photos"] = $this->superuser->get_albums(null,$cate["id"]);
        $this->videos();
    }
    public function search(){
        $this->data["child_view"] = "Search";
        $this->data["site"]["videos"] = $this->superuser->get_videos(null,null,  get("q"));
        $this->data["site"]["photos"] = $this->superuser->get_albums(null,null,  get("q"));
        $this->videos();
    }
    
    public function recover_password(){
        $this->data["view"] = "login";
        $this->data["form"]["message"] = "";
        
        if(post("email") != null){
            $this->data["form"]["message"] = $this->decor->send_recovery();
        }
        $this->template->inject_view("forget",  $this->data);
    }

    public function new_design(){
        if(!Auth::user()){
            redirect(base_url("login"));
        }
        Theme::Section("new_design",  $this->data);
    }

    public function test(){
        print "";
    }
    
}
