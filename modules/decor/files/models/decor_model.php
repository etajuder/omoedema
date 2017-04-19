<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of decor_model
 *
 * @author JUDE
 */
class decor_model extends CI_Model{
    //put your code here
    var $user;
    var $pay_api;
    public function __construct() {
        parent::__construct();
        $this->user = $this->get_user();
        $this->pay_api = new \Instamojo\Instamojo("6d3374ed4d578c53961e7035d1b652ea", "59071e12267279b891da03b2dbbead0c",'https://test.instamojo.com/api/1.1/');
        if(Auth::user()){
            $this->user = $this->get_user();
        }
        
    }
    
    public function get_user(){
        $get_user = ORM::for_table("users")
                ->where_raw("username = ?", [Auth::Username()])
                ->find_one();
        
         return $get_user;
    }
    public function payment_status($email){
        
        $get_payment = $this->for_table("payments")
                ->where_raw("user_email = ?", [$email])
                ->find_one();
        if($get_payment){
            if($get_payment->status == 0 ){
                redirect($get_payment->longurl);
            }elseif($get_payment->status == 1){
                $get_sub_plan = $this->for_table("sub_plans")
                        ->find_one($get_payment->sub_id);
                $time = $get_payment->time_start;
                
                $expiring_date = $get_sub_plan->duration;
                $total_time = time() + 24 * 60 * 60 * $expiring_date;
                if(time() > $total_time){
                    //expired
                     $get_user = $this->for_table("users")
                    ->where_raw("email = ?", [$email])
                    ->find_one();
                    
            $get_user->delete();
               $this->session_managet->killSessions();
                    Auth::DisAuthenticate();
                    redirect(App::route("register?q=ragain"));
                }else{
                    
                }
            }
        }else{
            $this->session_managet->killSessions();
            Auth::DisAuthenticate();
            $get_user = $this->for_table("users")
                    ->where_raw("email = ?", [$email])
                    ->find_one();
            $get_user->delete();
            redirect(App::route("register?q=ragain"));
        }
    }
public function get_categories(){
    return $this->for_table("categories")
            ->find_many();
}
    public function save_user_temp(){
        
        $new_user = $this->for_table("users")
                ->create();
        $new_user->username = post("username");
        $new_user->password = password_hash(post("password"),PASSWORD_BCRYPT);
        $new_user->email = post("email");
        $new_user->fullname = post("fullname");
        $new_user->set_expr("date", "NOW()");
        if(!$this->record_exists("users", "username", post("username"))){
            if(!$this->record_exists("users", "email", post("email"))){
             try {
         $get_service = $this->for_table("sub_plans")
                 ->where_raw("id = ?", [post("product_id")])
                 ->find_one();
         
    $response = $this->pay_api->paymentRequestCreate(array(
        "purpose" => "Website Activation Payment",
        "amount" => $get_service->price,
        "send_email" => true,
        "currency"=>"USD",
        "email" => post("email"),
        "redirect_url" => App::route("payment", "confirmation")
        ));
    $new_request = $this->for_table("payments")
                    ->create();
            $new_request->user_email = post("email");
            $new_request->sub_id = post("product_id");
            $new_request->payment_id = $response["id"];
            $new_request->time_start = time();
            $new_request->longurl = $response["longurl"];
            $new_request->set("created_at", "NOW()");
            $new_request->save();
             if($new_user->save()){
                $this->session_manager->setSession("user",  post("username"));
               redirect($response["longurl"]);
            }
            return App::message("success", "User registered Successfully");
}
catch (Exception $e) {
    
    return App::message("error", "Error Occurred");
}
            }else{
            return App::message("error", "Email Already registerred");
            }
        }else{
            
        }
            return App::message("error", "username has been registered");
        }
    
     
        
        

                public function record_exists($table,$key,$value){
        return $this->for_table($table)
                ->where_raw("$key = ?", $value)
                ->find_one();
    }
    
    public function payment_confirmation($req_id,$pay_id){
        $response =$this->pay_api->paymentRequestPaymentStatus($req_id,$pay_id);
        if($response["status"] == "Completed"){
            $get_payment = $this->for_table("payments")
                    ->where_raw("payment_id = ?", [$req_id])
                    ->find_one();
            $get_payment->status = 1;
            $get_payment->time_start = time();
            $get_payment->save();
            $get_user = $this->for_table("users")
                    ->where_raw("email = ?", [$get_payment->user_email])
                    ->find_one();
            $this->session_manager->setSession("user",$get_user->username);
            mail($get_user->email,App::getConfig("site_name")." Registration and Membership Completion" , "Completed");
            redirect(App::route(""));
        }else{
            Auth::DisAuthenticate();
           redirect(App::route(""));
            
        }
    }
    public function send_recovery(){
            $token = $this->generate_token();
           $get_user = ORM::for_table("users")
                   ->where_raw("email = ?", [post("email")])
                   ->find_one();
           
           $new_remember = ORM::for_table("forget_password")
                   ->create();
           $new_remember->token = $token;
           $new_remember->user_id = $get_user->id();
           $new_remember->set_expr("created_at", "now()");
           
           library("email");
           $link = APP::route("forget_password", "token/".$token, FALSE, TRUE);
           $message = "<h1>Hi $get_user->fullname</h1>"
                   . "<p>Click below link to recover your password .</p>"
                   . "$link<br>"
                   . "".  img(App::Assets()->getImage("paikoroo.jpg"))."";
           
        $swift = Swift_Message::newInstance()
             ->setSubject(App::getConfig("site_name")." Password Recovery Request")
               ->setFrom(["info@gmail.com"=>App::getConfig("site_name")])
               ->setTo([post("email")=>$get_user->fullname])
                ->setBody($message,"text/html")
                ;
        
        $transport = Swift_SmtpTransport::newInstance("mail.vdocamgirls.com",587)
                ->setUsername("admin@vdocamgirls.com")
                ->setPassword("vodcamgirls*1#?./");
        
       $mailer = Swift_Mailer::newInstance($transport);
       
        
       if($mailer->send($swift)) {
           $new_remember->save();
           
           return App::message("success", "Check your email,recovery link has been sent to your email");
       }else{
           return App::message("error", "Error recovering your password, try again");
       }
        
    }
    
     public function generate_token(){
           $token = md5(time()*rand(1, 9999)).md5(time()*rand(1, 9999)).md5(time()*rand(1, 9999));
           $get_token = ORM::for_table("forget_password")
                   ->where_raw("token = ?", [$token])
                   ->find_one();
           if($get_token){
               return $this->generate_token();
           }  else {
               return $token;    
           }
       }
  public function valid_token($token){
           $get_token = ORM::for_table("forget_password")
                   ->where_raw("token = ?", [$token])
                   ->find_one();
           return $get_token;
       }
       public function change_password($token){
          $get_token_holder = ORM::for_table("forget_password")
                  ->where_raw("token = ?", [$token])
                  ->find_one();
          $get_affected_user = ORM::for_table("users")
                  ->find_one($get_token_holder->user_id);
          $get_affected_user->password = password_hash(post("password"), PASSWORD_BCRYPT);
          if($get_affected_user->save()){
              $get_token_holder->delete();
              $a = anchor(App::route("login", "", FALSE, TRUE), "Login Here");
              return App::message("success", "Password changed successfully $a.");
          }else{
              return App::message("error", "Error occurred, try again.");
          }
           
           
       }
     
    public function login(){
        $data = [];
        $data["code"] = 0;
        $data["url"] =  "";
        $data["message"] = "";
        $get_user = ORM::for_table("users")
                ->where_raw("username = ?", [post("username")])
                ->find_one();
        if($get_user){
            $hash_password = $get_user->password;
            if(password_verify(post("password"), $hash_password)){
                //if user have paid;
                
                $data["code"] = 1;
                $data["url"] = base_url();
                $this->session_manager->setSession("user",  post("username"));
               
                $this->payment_status($get_user->email);
                redirect(base_url());
            }else{
                return App::message("error",  "Invalid password suppied");
            }
        }else{
             return App::message("error","Invalid Username supplied");
        }
       
    }
  
    
    public function register(){
        $data = [];
        $data["message"] = "";
        $data["code"] = 0;
        $data["url"] = "";
        $new_account = ORM::for_table("users")
                ->create();
        $new_account->username = post("username");
        $new_account->password = password_hash(post("password"),PASSWORD_BCRYPT);
        $new_account->fullname = post("fullname");
        $new_account->email = post("email");
        if(!$this->details_exists("users", "username", post("username"))){
            if(!$this->details_exists("users", "email", post("email"))){
                if(post("password") == post("password_again")){
                    if($new_account->save()){
                        $data["code"] = 1;
                        $data["message"] = "Registered Successfully";
                        $data["url"] = base_url();
                        $this->session_manager->setSession("user",  post("username"));
                        redirect(base_url());       
                    }else{
                       return "Error occurred please try again";
                    }
            }else{
                return  App::message("error", "Password not matched");
            }
            }  else {
                return App::message("error", "Email exists please choose a new one") ;    
            }
        }else{
            return App::message("error", "Username exists please choose a new one");
        }
        
        
    }
    
    public function logout(){
        $this->session_manager->killSessions();
        redirect(base_url());
    }
    
    public function details_exists($table,$key, $value){
        
        return ORM::for_table($table)
                ->where_raw("$key = ? ", [$value])
                ->find_one();
    }
    public function upload($name,$ext=".png"){
        
        $storage = new \Upload\Storage\FileSystem("./uploads/");
        $file = new Upload\File($name, $storage);
        $new_name = uniqid().md5(time());
        if($ext == ".mp4"){
            $file->addValidations([
            new Upload\Validation\Extension(["mp4","webm","avi","flv","aac"]),
            new Upload\Validation\Size("100M")
        ]);
        }else{
        $file->addValidations([
            new Upload\Validation\Extension(["png","jpg","jpeg","gif","mp4","webm"]),
            new Upload\Validation\Size("100M")
        ]);
        }
        try {
            if($file->upload($new_name)){
                return $file->getNameWithExtension();
            }
        } catch (Exception $exc) {
            return "";
        }
        }
        
        public function update_account(){
            $this->user->fullname = post("fullname");
            $this->user->gender = post("gender");
            $this->user->address = post("address");
            $this->user->save();
            return App::message("success", "Record Updated successfully");
        }
        public function update_password(){
            if(password_verify(post("old_password"), $this->user->password)){
                if(post("new_password") == post("confirm_password")){
                    $this->user->password = password_hash(post("new_password"), PASSWORD_BCRYPT);
                    $this->user->save();
                }else{
                    return App::message("error", "New Password Not Matched");
                }
            }else{
                return App::message("error", "Invalid Old Password Supplied");
            }
        }
        
        public function change_picture(){
           $name = $this->upload("file");
           $this->user->image = $name;
           $this->user->save();
            
        }
}
