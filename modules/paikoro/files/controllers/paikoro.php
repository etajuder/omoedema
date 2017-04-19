<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of paiko
 *
 * @author JUDE
 */
class paikoro extends Base{
    //put your code here
    var $data = [];
    public $lang = "en";
    
    
    public function __construct() {
     parent::__construct();
     model("paikoro_model","pkm");
     
     corelang::setLanguage("en");
  
    
    if(Auth::user()){
        $this->data["is_logged_in"] = TRUE;
        $this->data["user"] = $this->pkm->get_user();
        $this->data["user"]["messages"] = $this->pkm->get_message($this->data["user"]["id"]);
        $this->data["user"]["unread_messages"] = $this->pkm->get_unread_message($this->data["user"]["id"]);
        $this->data["user"]["count_order_messages"] = $this->pkm->get_unread_order_message($this->data["user"]["id"]);
        $this->data["user"]["invoices"] = $this->pkm->get_invoice_numbers($this->data["user"]["id"]);
        $this->data["user"]["orders_with_messages"] = $this->pkm->get_order_with_message($this->data["user"]["id"]);
        $this->data["carts"] = $this->pkm->get_carts($this->data["user"]["id"]);
        $this->data["total_cart"] = $this->pkm->get_carts_in_total($this->data["user"]["id"]);
        $this->data["monthly_sales"] = $this->pkm->get_monthly_sales();
        if($this->data["user"]["has_order"]){
            $this->data["product_order"] = $this->pkm->get_product_orders($this->data["user"]["id"]);
        } if ($this->data["user"]["is_official"]) {
             $this->data["count"]["total_user"] = $this->pkm->counter("users"); 
                    $this->data["count"]["total_department"] = $this->pkm->counter("departments");
                    $this->data["count"]["total_director"] = $this->pkm->counter("officials");
                    $this->data["count"]["potential_earnings"] = $this->pkm->get_potential_earning();
                    $this->data["count"]["total_sales"] = $this->pkm->get_total_sales();
                    $this->data["orders"]["order_awaiting_response"] = $this->pkm->get_order_awaiting_response();
                    $this->data["orders"]["order_awaiting_payment"] = $this->pkm->get_order_awaiting_payments();
                    $this->data["orders"]["order_awaiting_deliveries"] = $this->pkm->get_order_awaiting_deliveries();
                    $this->data["count"]["order_awaiting_deliveries"] = count($this->data["orders"]["order_awaiting_deliveries"]);
                    $this->data["count"]["order_awaiting_response"] = count($this->data["orders"]["order_awaiting_response"]);
                    $this->data["count"]["total_response"] = $this->pkm->get_total_amount(0);
                    $this->data["count"]["total_payments"] = $this->pkm->get_total_amount(1);
                    $this->data["count"]["total_shipping"] = $this->pkm->get_total_amount(2);
                    $this->data["count"]["total_shipped"] = $this->pkm->get_total_amount(3);
                    $this->data["count"]["total_cancel"] = $this->pkm->get_total_amount(5);
                    $this->data["count"]["total_completed"] = $this->pkm->get_total_amount(4);
                    $this->data["orders"]["order_awaiting_shipping"] = $this->pkm->get_order_awaiting_shipping();
                    $this->data["orders"]["order_shipped"] = $this->pkm->get_order_shipped();
                    $this->data["orders"]["order_completed"] = $this->pkm->get_order_completed();
                    $this->data["orders"]["order_canceled"] = $this->pkm->get_order_canceled();
                   
              $this->data["user"]["unread_messages"] = $this->pkm->get_unread_message($this->data["user"]["id"],$this->data["user"]["official"]["department"]);
        }
            
    }else{
        $this->data["is_logged_in"] = FALSE;
        
    }
    $this->data["site"] = [];
    $this->data["site"]["departments"] = $this->pkm->listdepartments();
    $this->data["site"]["videos"] = $this->pkm->get_videos();
    $this->data["site"]["wards"] = $this->pkm->get_wards();
    $this->data["site"]["news_categories"] = $this->pkm->get_news_categories();
    $this->data["site"]["produces"] = $this->pkm->get_produce(12);
    $this->data["site"]["abouts"] = $this->pkm->get_abouts();
    $this->data["site"]["banks"] = $this->pkm->list_account();
    $this->data["site"]["officials"] = $this->pkm->get_officials();
    $this->data["news_niger"] = $this->pkm->get_news(null,["category"=>1]);
    $this->data["news_paiko"] = $this->pkm->get_news(null,["category"=>2]);
    $this->data["news"] = $this->pkm->get_news();
    $this->data["archive"] = $this->pkm->archive_builder();
    $this->data["states"] = $this->pkm->get_state();
    $this->data["countries"] = $this->pkm->get_countries();
    }
    
    public function index($lang="en")
	{
        corelang::setLanguage($lang);
        
		$this->load->view('index',  $this->data);
	}
        public function Login(){
           if(@post("username") != null){
                $this->data["message"] = $this->pkm->login();
            }else{
                $this->data["message"] = "";
            }
            $this->load->view('login',  $this->data);
            
        }
        public function signup(){
           
            if(@post("username")!= NULL){
                $this->data["message"] = $this->pkm->sign_up();     
            }else{
                $this->data["message"] = "";
            }
            
            $this->data["post"] = $_POST;
            $this->load->view('signup',  $this->data);
            
        }
        
        public function forget_password($view=""){
            $this->data["view"] = $view;
            if($view == ""){
            if(post("email") != null){
                if(!$this->pkm->email_exists(post("email"))){
                    $a = anchor(App::route("signup", "", FALSE, TRUE), "Register Here");
                    $this->data["message"] = App::message("error", "Email does not exists $a");
                }else{
                    $this->data["message"] = $this->pkm->send_token();
                    $this->data["view"] = "dontshow";
                }
                
            }
            }else if($view == "token"){
                $token = Usegment(3);
                if(!$this->pkm->valid_token($token)){
                    $this->data["message"]  = App::message("error", "Invalid token");
                    $this->data["view"] = "dontshow";
                }  else {
                    if(post("password") != null){
                        if(post("password") != post("password_again")){
                            $this->data["message"] = "Password not the same";
                        }else{
                            $this->data["message"] =  $this->pkm->change_password($token);
                            $this->data["view"] = "dontshow";
                        }
                    }
                }
                
            }
            
              $this->load->view('forget_pass',  $this->data);
        }
        
            public function blog(){
                $this->data["title_page"] = "Paikoro's Blog";
                $this->load->view('blog',  $this->data);
            }
            public function contact(){
                if(post("message") != ""){
                    $this->data["message"] = $this->pkm->submit_contact();
                    $this->data["has_message"] = true;
                }
                $this->load->view('contact',$this->data);
            }
        public function produce(){
                $this->load->view('produce', $this->data);
            }
            public function about(){
                $this->load->view('about',$this->data);
            }
            public function adminfc($action){
                if($this->valid_views($action, ["addnews","addcategory","newposition","createdepartment","createofficial","addproduce","addward","add_sales_manager","addabout","addvideo"])){
                    switch ($action){
                    case "addnews":
                        set_flashdata('item', $this->pkm->add_news());
                    redirect(App::route(modules::admin_route()."/paikoro/addnews"));
                    
                        break;
                        case "addcategory":
                            set_flashdata('item', $this->pkm->addcategory());
                    redirect(App::route(modules::admin_route()."/paikoro/addcategory"));
                    
                            break;
                            case "newposition":
                                
                                set_flashdata("item", $this->pkm->create_position());
                                redirect(App::route(modules::admin_route()."/paikoro/newposition"));
                                
                                break;
                              case "createdepartment":
                                
                                set_flashdata("item", $this->pkm->create_department());
                                redirect(App::route(modules::admin_route()."/paikoro/createdepartment"));
                                
                                break;
                             case "createofficial":
                                  set_flashdata("item", $this->pkm->create_official());
                                redirect(App::route(modules::admin_route()."/paikoro/createofficial"));
                              
                                 break;
                                 case "addproduce":
                                     set_flashdata("item", $this->pkm->add_produce());
                                redirect(App::route(modules::admin_route()."/paikoro/addproduce"));
                              
                    
                                     break;
                                     case "addward":
                                         set_flashdata("item", $this->pkm->add_wards());
                                        redirect(App::route(modules::admin_route()."/paikoro/addward"));
                              
                                         break;
                                         case "add_sales_manager":
                                              set_flashdata("item", $this->pkm->add_sales_manager());
                                               redirect(App::route(modules::admin_route()."/paikoro/sales_manager"));
                                             break;
                                             case "addabout":
                                               set_flashdata("item", $this->pkm->add_about());
                                               redirect(App::route(modules::admin_route()."/paikoro/addabout"));
                                            
                                           break;
                                          
                    }
                    
                }else{
                    show_404();
                }
            }
            public function request($action){
                if($this->valid_views($action, ["deletecategory","deletedepartment","deletenews","deleteposition","deleteproduce","deleteward","updateward","updatedepartment","updateabout","deleteabout","addaccount","deleteaccount","addvideo","deleteofficial","updateproduce"])){
                    switch ($action){
                    case "deletecategory":
                        set_flashdata('item', $this->pkm->deletecategory());
                        redirect(App::route(modules::admin_route()."/paikoro/listcategory"));
                        break;
                    case "deletedepartment":
                        set_flashdata('item', $this->pkm->delete_record_by_id("departments",  get("action")));
                        redirect(App::route(modules::admin_route()."/paikoro/listdepartment"));
                        break;
                     case "deletenews":
                        set_flashdata('item', $this->pkm->delete_record_by_id("news",  get("action")));
                        redirect(App::route(modules::admin_route()."/paikoro/listnews"));
                        break;
                     case "deleteposition":
                        set_flashdata('item', $this->pkm->delete_record_by_id("positions",  get("action")));
                        redirect(App::route(modules::admin_route()."/paikoro/listpositions"));
                        break;
                     case "deleteproduce":
                        set_flashdata('item', $this->pkm->delete_record_by_id("product",  get("action")));
                        redirect(App::route(modules::admin_route()."/paikoro/listproduce"));
                         
                         break;
                    case "deleteward":
                           set_flashdata('item', $this->pkm->delete_record_by_id("wards",  get("action")));
                          redirect(App::route(modules::admin_route()."/paikoro/listwards"));
                     
                    
                        break;
                    case "updateward":
                           set_flashdata('item', $this->pkm->edit_ward());
                          redirect(App::route(modules::admin_route()."/paikoro/listwards"));
                     
                    
                        break;
                    case "updatedepartment":
                           set_flashdata('item', $this->pkm->edit_department());
                          redirect(App::route(modules::admin_route()."/paikoro/listdepartment"));
                     
                    
                        break;
                        case "updateabout":
                           set_flashdata('item', $this->pkm->modify_about());
                          redirect(App::route(modules::admin_route()."/paikoro/listabout"));
                      
                            break;
                            case "deleteabout":
                                set_flashdata('item', $this->pkm->delete_record_by_id("about",  get("action")));
                          redirect(App::route(modules::admin_route()."/paikoro/listabout"));
                     
                    
                                break;
                    case "addaccount":
                         set_flashdata('item', $this->pkm->add_account());
                          redirect(App::route(modules::admin_route()."/paikoro/addaccount"));
                     
                        break;
                    case "deleteaccount":
                          set_flashdata('item', $this->pkm->delete_record_by_id("banks",  get("action")));
                          redirect(App::route(modules::admin_route()."/paikoro/listaccount"));
                     
                        break;
                     case "addvideo":
                                               set_flashdata("item", $this->pkm->add_video());
                                               redirect(App::route(modules::admin_route()."/paikoro/addvideo"));
                                             
                                               break;
                    case "deleteofficial":
                        set_flashdata('item', $this->pkm->delete_record_by_id("users",  get("action")));
                        set_flashdata('item', $this->pkm->delete_record_by_id("officials",  get("action"), "user_id = ".  get("action")));
                          redirect(App::route(modules::admin_route()."/paikoro/listaccount"));
                     
                        break;
                    case "updateproduce":
                           set_flashdata('item', $this->pkm->edit_produce());
                          redirect(App::route(modules::admin_route()."/paikoro/listproduce"));
                          break;
                      
                        
                        
                    }
                }else{
                    show_404();
                }
            }

           public function read($slug){
               $this->data["news_title"] = str_replace("-", " ", $slug);
               if($this->pkm->news_exists($this->data["news_title"])){
                   $news = $this->pkm->get_news_by_title($this->data["news_title"]);
                   $this->data["news"] = $this->pkm->get_news($news->id);
                   Theme::Section("read", $this->data);
                   
               }else{
                   print $this->data["news_title"];
                   show_404();
               }
           }
            private function valid_views($value,$array){
           return in_array($value, $array);
        }
        
        public function archives($year,$month){
            $monthd = (int)$month > 9? $month : "0$month";
            $this->data["news"] = $this->pkm->get_news_archive($year,$month);
            $this->data["title_page"] = $this->pkm->parse_month($monthd)." Archives";
            Theme::Section("blog",  $this->data);
            
        }
        public function logout(){
            $this->session_manager->KillSessions();
            redirect(base_url());
        }
        
        public function department($name){
            $this->data["department_name"] = str_replace("-", " ", $name);
            $this->data["department"] = $this->pkm->get_department(["slug"=> url_title($this->data["department_name"])]);
            Theme::Section("departments",  $this->data);
        }
        
        public function official(){
            paikoro::MiddleWare();
            if(Auth::user()){
                if($this->data["user"]["is_chairman"]){
                   
                    }else{
                    $this->data["user"]["unread_messages"] = $this->pkm->get_unread_message($this->data["user"]["id"],$this->data["user"]["official"]["department"]);
                }
            }else{
                redirect(base_url());
            }
            Theme::Section("officials/index", $this->data);
        }

           public function official_request($type){
               paikoro::MiddleWare();
               if($this->valid_views($type, ["messages","dept","read_message","addnews","mytask","read_contact","sales","sales_history"])){
                   $this->data["views"] = $type;
                   View::$base = "officials/";
                   View::$title = "Paikoro Admin Page";
                  View::BAKEHEADER();
                  View::BAKESIDEBAR();
                  View::BAKECONTENT($type);
                  switch ($type){
                  case "dept":
                      $this->data["department_name"] = str_replace("-", " ", Usegment(4));
                      $this->data["department"] = $this->pkm->get_department(["name"=>  $this->data["department_name"]]);
                      
                             if(@post("message") != ""){
                       
                       $this->data["status"] =  $this->pkm->send_message();   
               
                             }  
                      break;
                   case "read_message":
                             
                             $this->data["message"] = $this->pkm->get_message_by_id(Usegment(4));
                             
                             break;
                  case "read_contact":
                      if(post("through") != ""){
                          $this->data["reply_info"] = $this->pkm->send_reply_contact();
                      }
                      $this->data["message"] = $this->pkm->read_contact_message(Usegment(4));
                      break;
                  
                  case "addnews":
                     
                       if(@post("body") != "" || post("body") != null){
                       
                   $this->data["status"] =  $this->pkm->add_news();   
                      }
                      break;
                  case "messages":
                      
                      $this->data["department"]["contact_messages"] = $this->pkm->get_contact_message($this->data["user"]["official"]["department"]);
                      $this->data["sub_view"] = Usegment(4);
                      
                      break;
                      case "sales_history":
                          
                          break;
                }
                 
                  
                 
            
               $path ='js/ckfinder';
           $width = '100%';
           editor($path, $width);
           $this->load->helper('url');
                View::FIRE($this->data);
               }else{
                   show_404();
               }
           }
           
           public function upload(){
               $this->pkm->picture_upload();
           }
              
        
        public function download($file_name){
            $path ="./uploads/$file_name";
            helper("download");
            
           $data = file_get_contents($path);
$name = 'attachment.png';
force_download($name, $data);
        
           
        }
        
        public function product_details($name,$id){
            $this->data["views"] = "product";
            $this->data["product"] = $this->pkm->get_product($id);
            $this->data["rand_produce"] = $this->pkm->get_produce(4);
            Theme::Section("product_details", $this->data);
            
        }
        
        public function product_order(){
            if(post("product_id") == null){
                redirect(App::route("produce", "", false, true));
            }
            $this->data["views"] = "order";
            $this->data["product"] = $this->pkm->get_product(post("product_id"));
            $this->data["product"]["total_price"] =$this->pkm->get_price_by_type($this->data["product"]["measurement_type"], $this->data["product"]["product_price"],  post("measurement"));
            $this->data["product"]["formated_price"] = $this->pkm->money_builder((int)  post("quantity") * (int)$this->data["product"]["total_price"]);
            Theme::Section("product_details", $this->data);
            
        }
        
        public function product_login(){
            $this->pkm->save_detail();
            redirect(App::route("login", "", false,TRUE)."?ref_id=".  uniqid());
       
        }
        public function continue_shopping(){
            
            $this->data["views"] = "continue_shopping";
            $this->data["saved_details"] = $this->session_manager->getSession("save_next");
            $this->data["product"] = $this->pkm->get_product($this->data["saved_details"]["product_id"]);
             $this->data["product"]["total_price"] =$this->pkm->get_price_by_type($this->data["product"]["measurement_type"], $this->data["product"]["product_price"], $this->data["saved_details"]["measurement_type"]);
            $this->data["product"]["formated_price"] = $this->pkm->money_builder((int) $this->data["saved_details"]["quantity"] * (int)$this->data["product"]["total_price"]);
             Theme::Section("product_details", $this->data);
            
        }
        public function save_product(){
              if($this->data["is_logged_in"]){
            //save in the database
                if(post("product_name") != null){
            $this->pkm->add_cart();
            redirect(App::route("product", "product_checkout", FALSE, TRUE));
            }
            }else{
                redirect(App::route("login", "", false, TRUE));
            }
        }

        public function product_checkout(){
            if(count($this->data["carts"]) < 1){
                redirect(App::route("produce"));
            }
            Theme::Section("check_out", $this->data);
            
        }
        
        public function remove_cart($id){
            paikoro::MiddleWare();
            $this->pkm->remove_cart($id);
            redirect(App::route("product", "product_checkout", FALSE, true));
        }
        
        public function submit_orders(){
            paikoro::MiddleWare();
             if(count($this->data["carts"]) < 1){
                redirect(App::route("produce"));
            }
            if($this->data["is_logged_in"]){
              $this->data["total_cart"] = $this->pkm->get_carts_in_total($this->data["user"]["id"]);
            Theme::Section("final_order", $this->data);
              
            }else{
                redirect(App::route("produce", "", FALSE, TRUE));
            }
        }
        
        public function order_update(){
            paikoro::MiddleWare();
            if(post("phone") != null){
            $this->pkm->order_update();
            }
            redirect(App::route("product", "order_invoice", false, true));
        }
        
        public function order_invoice(){
            //save as order
            paikoro::MiddleWare();
            $this->data["invoice_number"]=   $this->pkm->generate_invoice_number();
            $this->pkm->register_order($this->data["user"]["id"],$this->data["invoice_number"]);
            redirect(App::route("invoice",  $this->data["invoice_number"]));
            
           
        }
        
        public function get_local(){
            $this->pkm->get_local_government_by_state(post("id"));
        }
        
        public function get_state_feeds(){
           $data["state"] = $this->load->view("feeds_state",  $this->data, TRUE);
           print json_encode($data);
            
        }
        public function my_orders ($invoice=null){
            if($invoice==null){
                $this->data["page_view"] = "";
            }
            
            Theme::Section("my_orders", $this->data);
        }
        public function invoice($invoice){
            $this->data["page_view"] = "invoice";
                $this->data["product_order"] = $this->pkm->get_product_order_by_invoice($invoice);
                Theme::Section("order_invoice",  $this->data);
        }
        public function ward($ward_name){
            $this->data["ward_name"] = str_replace("-", " ", $ward_name);
            $this->data["ward"] = $this->pkm->get_ward_by_name(url_title($this->data["ward_name"]));
            Theme::Section("wards", $this->data);
        }
        
        public function sales_response($invoice_number){
            paikoro::MiddleWare();
            $this->data["form_message"] = "";
            $this->data["invoice_number"] = $invoice_number;
            $this->data["product_order"] = $this->pkm->get_product_order_by_invoice($this->data["invoice_number"]);
            $this->data["order_messages"] = $this->pkm->get_order_messages($invoice_number);
            View::$base = "officials/";
            View::$title = "Admin Responds to order ";
            View::BAKEHEADER();
            View::BAKEFOOTER();
            View::BAKESIDEBAR();
            View::BAKECONTENT("product_response");
            
            
            if(post("shipping_price") != "" || post("invoice_number") != null){
                $this->data["form_message"] = $this->pkm->update_order();
            }
            
            if(post("order_message") != null){
                $this->data["form_message"] = $this->pkm->insert_order_message();
            }
            
            View::FIRE($this->data);
            
        }
        
        public function admin_account(){
            paikoro::MiddleWare();
            View::$base = "officials/";
            View::$title = "Update your account";
            View::BAKEHEADER();
            View::BAKESIDEBAR();
            View::BAKEFOOTER();
            View::BAKECONTENT("account");
            if(post("username") != null){
                 
                $this->data["message"] = $this->pkm->update_account();
                $this->data["user"] = $this->pkm->get_user();
                //redirect(App::route("account/official", "update_account"));
            }
            
            
            View::FIRE($this->data);
        }
        public function sendsms(){
            paikoro::MiddleWare();
                     View::$base = "officials/";
            View::$title = "Send Sms";
            View::BAKEHEADER();
            View::BAKESIDEBAR();
            View::BAKEFOOTER();
            View::BAKECONTENT("sendsms");
            if(post("numbers") != null){
                 
                $this->data["message"] = $this->pkm->send_sms_message();
                
                //redirect(App::route("account/official", "update_account"));
            }
            
            
            View::FIRE($this->data);
            
        }
        
        public function sendmail(){
            paikoro::MiddleWare();
            View::$base = "officials/";
            View::$title = "Send Mail";
            View::BAKEHEADER();
            View::BAKESIDEBAR();
            View::BAKEFOOTER();
            View::BAKECONTENT("sendemail");
            if(post("numbers") != null){
                 
                $this->data["message"] = $this->pkm->send_sms_message();
                
                //redirect(App::route("account/official", "update_account"));
            }
            
            
            View::FIRE($this->data);
            
        }
     
        public function get_numbers(){
            
            $this->pkm->get_numbers();
        }
        
        public function send_sms_message(){
            $this->pkm->send_sms_message();
        }
        
        public function util($type){
            switch ($type){
                case "delete_all_message":
                    $this->pkm->delete_all_message($this->data["user"]["id"],  $this->data["user"]["official"]["department"]);
                    
                    break;
                case "get_more_news":
                    $last_request_id = post("last_request_id");
                    $data = [];
                    $news = $this->pkm->get_news(null,null,0,$last_request_id);
                    $data["news"] = $this->load->view("js_news_feed",["news"=>$news],TRUE);
                    $data["hasMore"] = count($news) > 0 ? 1: 0;
                    print json_encode($data);
                    break;
                case "get_more_produce":
                    $data = [];
                    $offset = post("offset");
                    $produces = $this->pkm->get_produce(6,null,$offset);
                    $data["hasMore"] = count($this->pkm->get_produce(6,null,$offset + 1)) > 0;
                    $data["nextOffset"] = $offset + 1;
                    $data["produce"] = $this->load->view("js_produce_feed",["produces"=>$produces],TRUE);
                    print json_encode($data);
                    break;
                case "get_more_history":
                    $data = [];
                    $history = $this->pkm->get_order_completed(12,  post("offset"));
                    $data["hasMore"] = count($this->pkm->get_order_completed(12,  post("offset") + 1)) > 0;
                    $data["offset"] = post("offset") + 1;
                    $data["history"] = $this->load->view("officials/js_history_feed",["orders"=> $history]);
                    print json_encode($data);
                    break;
                case "delete_order":
                   
                   $this->pkm->delete_product_order(Usegment(3));
                   redirect(App::route("my_orders"));
                    break;;
            }
        }
        
        public function search_result(){
            $where = get("query");
            
            $this->data["site"]["produces"] = $this->pkm->get_produce(null,$where);
            Theme::Section("search_result", $this->data);   
       }
       
       public static function MiddleWare($type=null){
           if(!Auth::user()){
               redirect(base_url());
           }
       }
       
       public function my_order_message($invoice_id = null){
           self::MiddleWare();
           if($invoice_id == NULL){
               $this->data["view"] = "";
           }else{
               if(!in_array($invoice_id, $this->data["user"]["invoices"])){
                   redirect(App::route("my_orders"));
               }
               $this->data["order_number"] = $invoice_id;
               $this->data["invoice_messages"] = $this->pkm->get_order_messages($invoice_id);
               $this->data["view"] = "read";
               if(post("order_message") != null){
                   $this->pkm->insert_order_message();
               }
           }
           Theme::Section("order_messages", $this->data);
           
       }
}
