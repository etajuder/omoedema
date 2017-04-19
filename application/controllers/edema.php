<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of edema
 *
 * @author JUDE
 */
class edema extends Base {
    //put your code here
    public function __construct() {
        parent::__construct();
        model("superuser_model", "superuser");
        model("edema_model","edema");
        model("ads_model","ads");
        $this->data["is_logged_in"] = Auth::user();
        if($this->data["is_logged_in"]){
            $this->data["user"] = $this->edema->get_user();
        }
        $this->data["form"]["message"] = "";
        $this->data["site"]["title"] = App::getConfig("site_name");
        $this->data["site"]["logo"] = App::Assets()->getImage("logo.png");
        $this->data["site"]["desc"] = "A Nigerian news providing Website, a daily publication in Nigeria covering Niger delta, general national news, politics, business, energy, sports, entertainment, fashion,lifestyle human interest stories, etc";
        $this->data["site"]["news"]["audios"] = [];
        $this->data["site"]["news"]["videos"] = [];
        $this->data["site"]["categories"] = $this->superuser->get_categories();
        $this->data["site"]["news"]["front_row"] = $this->superuser->get_news(null,null,3,0,true);
        $this->data["site"]["news"]["recent_news"] = $this->superuser->get_news(null,null,4); 
        $this->data["site"]["news"]["all_news"] = $this->superuser->get_news();
        $this->data["site"]["news"]["hot_news"] = $this->superuser->get_news(null,"hotnews=1",4); 
        $this->data["site"]["news"]["video_news"] = $this->superuser->get_video_news();
        $this->data["site"]["news"]["popular"] = $this->superuser->get_popular_news();
        $this->data["site"]["news"]["most_viewed"] = $this->superuser->get_most_viewed_news();
         $this->data["site"]["misc"] = $this->superuser->get_misc();
         $this->data["site"]["boxad"] = $this->ads->get_ads(); 
        $this->data["count"] = 0;
         if(post("username") != "" && post("password")){
            $this->data["form"]["message"] =$this->edema->login();
        }
     }
    
     
    public function index(){
        $this->template->inject_view("index",  $this->data);
    }
    
    public function category($name){
        if(!$this->superuser->check_cate(str_replace("-", " ", $name))){
            $this->for04();
        }
        
        $this->data["category_name"] = str_replace("-", " ", $name);
        $this->data["site"]["title"] = $this->data["category_name"];
        $this->data["category"] = $this->superuser->check_cate($this->data["category_name"]);
       $this->data["total_news"] = $this->superuser->get_news(null,"category = ".$this->data["category"]["id"],100);
        
        if(get("page")){
         
         $this->data["category_news"] = $this->superuser->get_news(null,"category = ".$this->data["category"]["id"],6,  get("page")-1);
           
        }else{
         
         $this->data["category_news"] = $this->superuser->get_news(null,"category = ".$this->data["category"]["id"],6);
           
        }$total = count($this->data["total_news"]);
        $row = $total/6;
        $this->data["pagin_value"] = ceil($row);
        $this->data["page"] = get("page") == null? 1: get("page"); 
        $this->template->inject_view("categories",  $this->data);
        
    }
    
    public function download($id_enc,$access=false){
        $id = ENCRYPT::Decrypt($id_enc);
        $news = $this->superuser->get_news($id);
        if(!$access){
    if(!$news["file_access"]){
        //free
         helper('download');
         $ex = explode("/", $news["audio"]);
         $name = $ex[count($ex)-1];
         $path = "./uploads/".$name;
         $data = file_get_contents($path);
         $name = url_title($news["title"]).".mp3";
        force_download($name,$data);
    }
    }else{
         helper('download');
         $ex = explode("/", $news["audio"]);
         $name = $ex[count($ex)-1];
         $path = "./uploads/".$name;
         $data = file_get_contents($path);
         $name = url_title($news["title"]).".mp3";
        force_download($name,$data);
    }
    }
    
    public function news($id,$slug){
        $this->data["news"] = $this->superuser->get_news($id);
        if(url_title($this->data["news"]["title"]) != $slug){
            redirect(base_url());
        }
        $this->data["site"]["title"] = $this->data["news"]["title"];
        $this->data["site"]["logo"] = $this->data["news"]["picture"];
        $this->data["site"]["desc"] = $this->data["news"]["body_short_desc"]; 
        $this->data["related_news"] = $this->superuser->get_news(null,"category = ".$this->data["news"]["category_id"]);
        $this->template->inject_view("read",  $this->data);
    }
    
    public function search(){
        $terms = get("q");
        $this->data["total_news"] = $this->superuser->get_news(null,"news.title like '%$terms%'",100);
        
        if(get("page")){
         
         $this->data["category_news"] = $this->superuser->get_news(null,"news.title like '%$terms%' ",6,  get("page")-1);
           
        }else{
         
         $this->data["category_news"] = $this->superuser->get_news(null,"news.title like '%$terms%' ",6);
           
        }$total = count($this->data["total_news"]);
        $row = $total/6;
        $this->data["pagin_value"] = ceil($row);
        $this->data["page"] = get("page") == null? 1: get("page"); 
        $this->template->inject_view("search",  $this->data);
    }
    public function register(){
        
        if(post("username") != null && post("pass") !=null ){
            $this->data["form"]["message"] = $this->edema->register();
        }
        $this->template->inject_view("auth",  $this->data);
        
    }
    
    public function downloads(){
        $this->data["total_news"] = $this->superuser->get_news(null,"audio != '' ",100);
        
        if(get("page")){
         
         $this->data["category_news"] = $this->superuser->get_news(null,"audio != '' ",6,  get("page")-1);
           
        }else{
         
         $this->data["category_news"] = $this->superuser->get_news(null,"audio != '' ",6);
           
        }$total = count($this->data["total_news"]);
        $row = $total/6;
        $this->data["pagin_value"] = ceil($row);
        $this->data["page"] = get("page") == null? 1: get("page"); 
        $this->template->inject_view("downloads",  $this->data);
    }

        public function payment($status){
        if($status == "success"){
            $link = "https://voguepay.com/?type=json&demo=true&v_transaction_id=".  post("transaction_id");
            $request = new cURL();
            $response = $request->get($link);
            $arr = json_decode($response);
            if($arr->status == "Approved"){
                $this->data["response"] = App::message("success","<h1>Your Payment was recieved please wait for you download</h1>");
                //sleep($seconds)
                $this->download($arr->merchant_ref,true);
            }else{
                $this->data["response"] = App::message("error", "<h1>Your payment could not be completed please try again</h1>");
            }
        }else{
            $this->data["response"] = App::message("error", "<h1>Your payment could not be completed please try again</h1>");
        }
        
        $this->template->inject_view("payment",  $this->data);
    }
    
    public function request($action){
        switch ($action){
            case "logout":
                $this->session_manager->killSessions();
                Auth::DisAuthenticate();
                redirect(base_url());
                break;
            case "register":
                $this->edema->register();
                break;
            
        }
    }
            
     public function contact(){
         $this->template->inject_view("contact",  $this->data);
     }
     
     
     public function about(){
         $this->template->inject_view("about",  $this->data);
     }
        public function for04($message=""){
       print  "error";
        show_404();
    }
            
}
