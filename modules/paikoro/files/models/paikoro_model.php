<?php

class paikoro_model extends CI_Model{
    var $data =[];
    public function __construct() {
        parent::__construct();
        $this->data["limit"] = 12;
        library("session_manager");
    }
    
    public function get_news($id=null, $where=null,$offset=0,$last_request_id=null){
        $news = [];
        if($id != NULL){
            
            $get_news = ORM::for_table("news")
                    ->find_one($id);
        if($get_news["picture"] != null || $get_news["picture"] != "" ){
                $get_news["picture"] = $this->get_news_image($get_news["picture"]);
                $get_news["has_picture"] = TRUE;
            }else{
                $get_news["has_picture"] = FALSE;
            }
            if($get_news["user_id"] != 0){
                $get_news["user"] = $this->get_user($get_news["user_id"]);
            }else{
                $get_news["user"] = ["fullname"=>"Admin"];
            }
            
            return $get_news;
        }else{
            if($where != NULL){
                
                $get_news = ORM::for_table("news")
                        ->limit($this->data["limit"])
                        ->offset($offset*=$this->data["limit"])
                         ->order_by_desc("id")
                        ->where($where)
                        ->find_array();
                
            }else{
                if($last_request_id != null){
                    $get_news = ORM::for_table("news")
                            ->limit($this->data["limit"])
                            ->order_by_desc("id")
                            ->where_lt("id", $last_request_id)
                            ->find_array();
                }else{
                
                $get_news = ORM::for_table("news")
                        ->limit($this->data["limit"])
                        ->offset($offset*=$this->data["limit"])
                        ->order_by_desc("id")
                        ->find_array();
                
            }
                
            }
            foreach ($get_news as $news_item){
                    if($news_item["picture"] != null || $news_item["picture"] != "" ){
                        $news_item["picture"] = $this->get_news_image($news_item["picture"]);
                        $news_item["has_picture"] = TRUE;
                    }else{
                       $news_item["has_picture"] = FALSE; 
                    }
                    
                    if($news_item["user_id"] != 0){
                        $news_item["user"] = $this->get_user($news_item["user_id"]);
                    }else{
                        $news_item["user"] = ["fullname"=>"Admin"];
                    }
                    $news[] = $news_item;
                    
                }
                return $news;
            
        }
    }
    public function get_news_archive($year,$month){
        $news = [];
        $month = (int)$month > 9? $month: "0$month";
        $get_news = ORM::for_table("news")
                ->where_like("created_at", "%$year-$month%")
                ->find_array();
        
         foreach ($get_news as $news_item){
                if($news_item['picture'] != NULL){
                    $news_item['has_picture'] = true;
                }else{
                    $news_item['has_picture'] = false;
                }
                    $news_item["picture"] = $this->get_news_image($news_item["picture"]);
                    if($news_item["user_id"] != 0){
                        $news_item["user"] = $this->get_user($news_item["user_id"]);
                    }else{
                        $news_item["user"] = ["fullname"=>"Admin"];
                    }
                    $news[] = $news_item;
                    
                }
                return $news;
    }
    public function add_news(){
        
        $new_news = ORM::for_table("news")
                ->create();
        $new_news->title = post("title");
        $new_news->body = post("body");
        $new_news->user_id = post("user_id");
        $new_news->picture = $this->upload("file");
        $new_news->category = post("category");
        $new_news->slug = url_title(post("title"));
        $new_news->set_expr("created_at", "NOW()");
        if($new_news->save()){
            return App::message("success", "News inserted successfully");
        }  else {
            return App::message("error", "Server error try again");    
        }
    }
    


    /**
     *  To get a specific user from the database
     * @param type id
     * @return type int
     */
    
    public function get_user($id=null){
        if($id != null){
        $users = ORM::for_table("users")
                ->find_one($id);
         $find_if = ORM::for_table("officials")
                    ->where_raw("user_id = ?", [$users["id"]])
                    ->find_one();
            if($find_if){
                $users["is_official"] = true;
                $users["is_chairman"] = $users["position"] > 0 ?true:FALSE;
                $users["official"] = $find_if->as_array();
               $users["office_department"] = $this->get_department(null, $users["official"]["department"]);
               $users["has_order"] = $this->has_order($users["id"]);
               $users["is_sales_manager"] = $this->is_managing_sales($users["official"]["department"]);
            }else{
                $users["is_official"] = FALSE;
            }
        return $users;
        }else{
            $user = ORM::for_table("users")
                    ->where_raw("username = ?", [$this->session_manager->getSession("user")])
                    ->find_one();
            $user["has_picture"] = ($user["profile_pics"] != "" || $user["profile_pics"] != null );
            $user["user_picture"] = $this->getAvatar($user["profile_pics"],$user["fullname"]);
            $user["has_order"] = $this->has_order($user["id"]);
            //get if official
            $find_if = ORM::for_table("officials")
                    ->where_raw("user_id = ?", [$user["id"]])
                    ->find_one();
            $user["is_chairman"] = $user["position"] > 0 ?true:FALSE;
            if($find_if){
                $user["is_official"] = true;
                $user["official"] = $find_if->as_array();
                $user["office_department"] = $this->get_department(null, $user["official"]["department"]);
                $user["is_sales_manager"] = $this->is_managing_sales($user["official"]["department"]);
            }else{
                $user["is_official"] = FALSE;
            }
            return $user;
        }
    }
    
    public function getAvatar($pics,$fullname){
        if($pics == null || $pics == ""){
            return '';
        }else{
            return App::Assets()->getUploads()->getImage($pics);
        }
    }
    public function get_news_image($image){
        return App::Assets()->getUploads()->getImage($image);
    }
    
    public function upload($name,$ext=".png"){
        
        $storage = new \Upload\Storage\FileSystem("./uploads/");
        $file = new Upload\File($name, $storage);
        $new_name = uniqid().md5(time()). $ext;
        if($ext == ".mp4"){
            $file->addValidations([
            new Upload\Validation\Extension(["mp4","webm"]),
            new Upload\Validation\Size("10M")
        ]);
        }else{
        $file->addValidations([
            new Upload\Validation\Extension(["png","jpg","jpeg","gif","mp4","webm"]),
            new Upload\Validation\Size("10M")
        ]);
        }
        try {
            if($file->upload($new_name)){
                return $new_name;
            }
        } catch (Exception $exc) {
            return "";
        }
        }
        
        public function get_category(){
            return ORM::for_table("categories")
                    ->find_many();
        }
        
        public function addcategory(){
            $new_category = ORM::for_table("categories")
                    ->create();
            $new_category->name = post("name");
            if($new_category->save()){
            
                return App::message("success", "Inserted Successfully");
            }else{
                return App::message("error", "Error occurred");
            }
            
        }
        public function deletecategory(){
            $id = get("action");
            //delete news under this category;
            ORM::for_table("news")
                    ->where_raw("category = ?", [$id])
                    ->delete_many();
            $get_cat = ORM::for_table("categories")
                    ->find_one($id);
            if($get_cat->delete()){
                return App::message("success", "Category Deleted Successfully");
            }else{
                return App::message("error", "Error Occurred");
            }
        }
        public function get_n(){
            return ORM::for_table("news")
                    ->select(["news.id","news.title","news.category","categories.name"])
                    ->inner_join("categories", "news.category = categories.id")
                    ->find_many();
        }
        
        public function news_exists($title){
            $get_news = ORM::for_table("news")
                    ->where_raw("title = ?",[$title])
                    ->find_one();
            if($get_news){
                return TRUE;
            }else{
                return FALSE;
            }
        }
        public function get_news_by_title($title){
            
            $get_news  = ORM::for_table("news")
                    ->where_raw("title = ?", [$title])
                    ->find_one();
            
            if($get_news){
                return $get_news;
        }else{
            return [];
        }
            
        }
       public function archive_builder(){
            $archives = [];
            $get_news = $this->get_news();
            foreach($get_news as $news){
                //print date
                $actual_date = explode(" ", $news["created_at"]);
                $actual_month = explode("-", $actual_date[0]);
                $arch= ["month"=>  $this->parse_month($actual_month[1]),"month_number"=>(int)$actual_month[1],"year"=>$actual_month[0]];
                if(!in_array($arch, $archives)){
                    $archives[] = ["month"=>  $this->parse_month($actual_month[1]),"month_number"=>(int)$actual_month[1],"year"=>$actual_month[0]];
                }
                
            }
            return $archives;
        }
        
        public function parse_month($month){
            switch ($month){
                case "01":
                    return "January";
                    break;
                case "02":
                    return "February";
                    break;
                case "03":
                    return "March";
                    break;
                case "04":
                    return "April";
                    break;
                case "05":
                    return "May";
                    break;
                case "06":
                    return "June";
                    break;
                case "07":
                    return "July";
                    break;
                case "08":
                    return "August";
                    break;
                case "09":
                    return "September";
                    break;
                case "10":
                    return "October";
                    break;
                case "11":
                    return "November";
                    break;
                case "12":
                    return "December";
                    break;
                    
            }
        }
        
        public function sign_up(){
            
            $new_user = ORM::for_table("users")
                    ->create();
            $new_user->fullname = post("first")." ".post("last");
            $new_user->email = post("email");
            $new_user->username = post("username");
            $new_user->password = password_hash(post("password"), PASSWORD_BCRYPT);
            $new_user->phone_number = post("mobile");
            $new_user->gender = post("gender");
            $new_user->set_expr("date", "NOW()");
            if(!$this->_value_exists("users", ["phone_number"=>  post("mobile")])){
            if(!$this->_value_exists("users", ["email"=>  post("email")])){
            if(!$this->_value_exists("users", ["username"=>  post("username")])){
            if($new_user->save()){
                if($this->session_manager->getSession("save_next") != null){
                    $this->session_manager->setSession("user",  post("username"));
                    redirect(App::route("product", "continue_shopping",false,true));
                }
               $a = anchor(App::route("login", "", false, true), "Login Here");
                return App::message("success", "Successfully Registered!! $a");
            }else{
                return App::message("error", "Error occurred please try again");
            }
            }else{
                return App::message("error", "That Username Have Been Registered");
            }
            }else{
                return App::message("error", "That email have been registered");
            }
            }else{
                return App::message("error", "That mobile number have been registered");
            }
            
        }
        
        private function _value_exists($table,array $value){
            
            $get_value = ORM::for_table($table)
                    ->where($value)
                    ->find_one();
            if($get_value){
                return true;
            }else{
                return FALSE;
            }
            
        }
        
        public function login(){
            
            $get_user = ORM::for_table("users")
                    ->where_raw("username = ?", [post("username")])
                    ->find_one();
            if($get_user){
                //get password
                $password_hash = $get_user->password;
                if(password_verify(post("password"), $password_hash)){
                    //user logged in continue
                    $this->session_manager->setSession("user",  post("username"));
                    //check for officials login
                    
                    $load_user = $this->get_user($get_user["id"]);
                    if($load_user["is_official"]){
                        redirect(App::route("account/official"));
                    }else{
                        if(@get("ref_id") != null){
                            redirect(App::route("product", "continue_shopping", false, TRUE));
                        }
                        redirect(App::route("", "", true));
                    }
                    
                    
                }else{
                    return App::message("error", "Wrong password");
                }
                
            }else{
                return App::message("error", "Username does not exists");
            }
        }
        
        
        public function get_users(){
            
            $users = ORM::for_table("users")
                    ->find_many();
            return $users;
        }
      public function create_position(){
          $new_position = ORM::for_table("positions")
                  ->create();
          $new_position->name = post("name");
          $new_position->set_expr("created_at", "NOW()");
          if(!$this->_value_exists("positions", ["name"=>  post("name")])){
              if($new_position->save()){
                  return App::message("success", "Successfully created a new position");
              }else{
                  return App::message("error", "Error Occurred try again");
              }
          }else{
              return App::message("error", "Position exists before please create a new one");
          }
      }
      
      public function listpositions(){
          return ORM::for_table("positions")
                  ->find_many();
      }
      
      public function create_official(){
          $new_official = ORM::for_table("users")
                  ->create();
          $new_official->fullname = post("fullname");
          $new_official->username = post("username");
          $new_official->email = post("email");
          $new_official->position = post("position");
          $new_official->gender = post("gender");
          $new_official->country = "Nigeria";
          $new_official->phone_number = post("mobile");
          $new_official->profile_pics = $this->upload("file");
          $new_official->password = password_hash(post("password"), PASSWORD_BCRYPT);
          $new_official->set_expr("date", "NOW()");
          if(!$this->_value_exists("users", ["username"=>post("username")])){
              if(!$this->_value_exists("users", ["phone_number"=>  post("mobile")])){
                  if(!$this->_value_exists("users", ["email"=>  post("email")])){
                      
                      if($new_official->save()){
                          
                   $user =  $this->get_user_by_username(post("username"));
                   $official = ORM::for_table("officials")
                           ->create();
                   $official->user_id = $user->id();
                   $official->about = post("about");
                   $official->official_position= post("position");
                   $official->department = post("department");
                   if($official->save()){
                      return App::message("success", "Official successfully Created");
                   }else{
                       return App::message("error", "Officail coild not be registered, please try again");
                   }
                      }else{
                        return  App::message("error", "An error occurred, please try again ");
                      }
                      
                  }else{
                      return App::message("error", "That email has been registered");
                  }
              }else{
                  return App::message("error", "The mobile number have been registered");
              }
          }else{
              return App::message("error", "That Username have been registered");
          }
      }
      public function get_user_by_username($username){
          $get_user=  ORM::for_table("users")
                  ->where_raw("username=?", [$username])
                  ->find_one();
              return $get_user;
                  
      }
      
      public function create_department(){
          $new_department = ORM::for_table("departments")
                  ->create();
          $new_department->set_expr("created_at", "NOW()");
          $new_department->name = str_replace("/","&frasl;",trim(post("name")));
          $new_department->about = post("about");
          $new_department->slug = url_title(post("name"));
          if(!$this->_value_exists("departments", ["name"=>  post("name")])){
              if($new_department->save()){
                  return App::message("success", "Department created Successfully");
              }else{
                  return App::message("error", "Error Occurred try again later");
              }
          }else{
              return App::message("error", "Department already registered");
          }
      }
      
      public function listdepartments($id = null){
          return ORM::for_table("departments")
                  ->find_many();
          
      }
      
       public function get_department($where=null,$id= null){
           if($where != null){
               $get_dept =  ORM::for_table("departments")
                       ->where($where)
                       ->find_one();
           }
           if($id != null){
             $get_dept =   ORM::for_table("departments")
                       ->find_one($id);
           }
           $get_official = ORM::for_table("departments")
                   
                   ->select(["departments.id","departments.name","departments.about","officials.user_id","officials.official_position","officials.department"])
                   ->select(["users.fullname","users.username","users.gender","users.profile_pics"])
                   ->where_raw("departments.id = ?", [$get_dept["id"]])
                   ->inner_join("officials", "officials.department = departments.id")
                   ->inner_join("users", "users.id = officials.user_id")
                   ->find_one();
           
           $get_official["has_official"] = $get_official;
           if($get_official["has_official"]){
           $get_official["is_chairman"] = $get_official["officials_position"] == 1 ? TRUE : FALSE;
           $get_official["user_picture"] = $this->getAvatar($get_official["profile_pics"], $get_official["fullname"]);
           return $get_official;
           }else{
               return $get_dept;
           }
       }

      public function delete_record_by_id($table,$id,$where = null){
          
          if($where==null){
              $get_record = ORM::for_table($table)
                  ->find_one($id);
          }else{
              $get_record = ORM::for_table($table)
                      ->where($where)
                  ->find_one();
          }
          if($get_record->delete()){
              return App::message("success", "Record deleted successfully");
          }else{
              return App::message("error", "Unable to delete try again");
          }
                 
      }
      
      public function get_department_by_id(){
          return $this->get_department(null, get("action"));
      }
      public function get_ward_by_id(){
          return ORM::for_table("wards")
                  ->find_one(get("action"));
      }
      public function counter($table){
            return ORM::for_table($table)
                    ->count();
        }
        
      public function get_message($user_id){
          $messages = [];
          $get_message = ORM::for_table("message")
                  ->select("message.id", "message_id")
                  ->select(["message.message","message.user_id","message.to_user_id","message.seen","message.image","message.created_at"])
                  ->select(["users.profile_pics","users.fullname","users.username"])
                  ->where_raw("message.to_user_id = ?", [$user_id])
                  ->order_by_desc("message.id")
                  ->inner_join("users", "users.id = message.user_id")
                  ->find_array();
          foreach ($get_message as $message){
              $message["user_picture"] = $this->getAvatar($message["profile_pics"], $message["fullname"]);
              $message["has_picture"] = ($message["profile_pics"] != "" || $message["profile_pics"] != null );
              $messages[] = $message;
          }
          
          return $messages;
          
      }
      public function get_unread_message($user_id, $dept_id = null){
          $messages = [];
          $get_message = ORM::for_table("message")
                  ->select("message.id", "message_id")
                  ->select(["message.message","message.user_id","message.to_user_id","message.seen","message.image","message.created_at"])
                  ->select(["users.profile_pics","users.fullname","users.username"])
                  ->where_raw("message.to_user_id = ? and seen = 0", [$user_id])
                  ->order_by_desc("messsage.id")
                  ->inner_join("users", "users.id = message.user_id")
                  ->find_array();
          foreach ($get_message as $message){
              $message["user_picture"] = $this->getAvatar($message["profile_pics"], $message["fullname"]);
              $message['is_contact'] = FALSE;
              $message["has_picture"] = ($message["profile_pics"] != "" || $message["profile_pics"] != null );
              $messages[] = $message;
          }
          if($dept_id != null){
              $get_message = ORM::for_table("contact")
                      ->where_raw("department_id = ? and seen = 0", [$dept_id])
                      ->order_by_desc("id")
                      ->find_many();
              foreach ($get_message as $message){
                  $message["has_picture"] = FALSE;
                  $message['is_contact'] = true;
                  $messages[] = $message;
              }
          }
          
          
          return $messages;
          
      }
      
      public function get_news_categories(){
          return ORM::for_table("categories")
                  ->find_array();
      }
      
      public function picture_upload(){
          $data["message"] = "";
          $data["code"] = 0;
          $data["image"] = "";
          $ext = ".png";
          $storage = new Upload\Storage\FileSystem("./uploads");
          $file = new Upload\File("file", $storage);
          $new_name = uniqid().md5(time());
          
        
        $file->addValidations([
            new Upload\Validation\Extension(["png","jpg","jpeg","gif"]),
            new Upload\Validation\Size("10M")
        ]);
        
        try {
            if($file->upload($new_name)){
                $data["image"] = App::Assets()->getUploads()->getImage($file->getNameWithExtension());
                if(post("user_id") != null){
                    $user = ORM::for_table("users")
                            ->find_one(post("user_id"));
                    $user->profile_pics = $file->getNameWithExtension();
                    $user->save();
                }
                $data["code"] = 1;
                $data["message"] = "Successfully upload the images";
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        print json_encode($data);
          }
          
          public function send_message(){
              $new_message = ORM::for_table("message")
                      ->create();
              $new_message->message = post("message");
              $new_message->user_id = post("user_id");
              $new_message->to_user_id = post("to_user_id");
              $new_message->image = post("image");
              $new_message->set_expr("created_at", "NOW()");
              if($new_message->save()){
                  return App::message("success", "Message Sent Successfully");
              }else{
                  return App::message("error", "An Error Occurred try again");
              }
          }
          
          public function get_message_by_id($id){
              $message = ORM::for_table("message")
                      ->find_one($id)
                      ;
              $message->seen = 1;
              $message->save();
              $message["sender"] = $this->get_user($message["user_id"]);
              $message["has_attachment"] = ($message["image"] != "") || ($message["image"] != null);
              if($message["has_attachment"]){
                  
                  $images = explode(" ",  trim(str_replace("-", " ", $message["image"])));
                  $message["images"] = $images;
              }
              return $message;
          }
          public function add_produce(){
                $produce = ORM::for_table("product")
                        ->create();
                $produce->product_name = post("name");
                $produce->measurement_type = post("measurement_type");
                $produce->product_price = post("price");
                $produce->image = $this->upload("file");
                $produce->user_id = 0;
                $produce->product_description = post("description");
                $produce->set_expr("created_at", "NOW()");
                if($produce->save()){
                
                    return App::message("success", "Product Added successfully");
                }else{
                    return App::message("error", "Error occurred please try again");
                }
                
              
          }
          
          public function get_produce($limit = null,$where=null,$offset=0){
              $produces = [];
              if($limit != null){
                   $get_product = ORM::for_table("product")
                      ->limit($limit)
                      ->offset($offset*= $limit)
                      
                      ->order_by_expr("rand()")
                      ->find_many();
              }elseif($where != null){
                  $get_product = ORM::for_table("product")
                          ->where_like("product_name", "%$where%")
                          ->find_many();
              }else{
              $get_product = ORM::for_table("product")
                      ->find_many();
              }
              foreach ($get_product as $produce){
                  $produce["image"] = App::Assets()->getUploads()->getImage($produce["image"]);
                  $produces[] = $produce;
              }
              return $produces;
          }
          
          public function get_product($id,$where=null){
              
              if($where != null){
              $get_product = ORM::for_table("product")
                      ->where($where)
                      ->find_one();
                  
              }else{
                  $get_product = ORM::for_table("product")
                          ->find_one($id);
              }
              if($get_product){
                  $get_product = $get_product->as_array();
                  $get_product["image"] = App::Assets()->getUploads()->getImage($get_product["image"]);
                  $get_product["measured"] = $this->get_price_type($get_product["measurement_type"], $get_product["product_price"]);
                
                  
              }
              return $get_product;
              
              
          }
          
          public function get_price_type($measurement,$price){
              $measures = explode(",", trim($measurement));
              $prices = explode(",", trim($price));
              $proccessed = [];
              if(count($prices) != count($measures)){
                  return [["measurement"=>$measurement,"price"=>$price]];
              }else{
                  for($i = 0; $i<=count($prices)-1;$i++){
                      $proccessed[] = ["measurement"=>$measures[$i],"price"=>$prices[$i]];
                  }
              }
              return $proccessed;
          }
          
          public function generate_product_id(){
              $attach = "PKLGA".uniqid();
              return $attach;
          }
          public function get_price_by_type($measurement,$prices,$type){
              $measurement_index = 1;
              $get_measurement = $this->get_price_type($measurement, $prices);
              $index = 1;
              foreach ($get_measurement as $measure){
                  if($measure["measurement"] == $type){
                      $measurement_index = $index;
                  }
                  $index++;
              }
              $get_price = explode(",",trim($prices));
              return $get_price[$measurement_index-1];
          }
          
         public function money_builder($money){
            $str = (string)$money;
            
            $index = 1;
            $list_money = "";
            for($i = strlen($str)-1; $i >= 0; $i--){
                $list_money .= $str[$i];
                if( ($index % 3) == 0){
                    $list_money.=",";
                }
                $index++;
            }
            $final_money  = "";
            
            for($j = strlen($list_money)-1; $j >= 0; $j--){
                
                $final_money .= $list_money[$j];
            }
            
            $first_word = substr($final_money, 0, 1);
            if($first_word == ","){
                return substr($final_money, 1, strlen($final_money)-1);
            }else{
                return $final_money;
            }
             
        }
          public function save_detail(){
              $details = [
                  "product_name"=>post("product_name"),
                  "quantity"=>  post("quantity"),
                  "price"=> post("price"),
                  "formated_price"=>  post("formated_price"),
                  "product_id" => post("product_id"),
                  "measurement_type"=> post("measurement_type")
              ];
             
              if($this->session_manager->getSession("save_next") != null){
                  $this->session_manager->setSession("save_next", null);
              }else{
                  $this->session_manager->setSession("save_next",$details);
              }
              
          }
          
          public function add_cart(){
          
              $new_cart = ORM::for_table("carts")
                      ->create();
              $new_cart->product_id = post("product_id");
              $new_cart->user_id = post("user_id");
              $new_cart->product_name = post("product_name");
              $new_cart->price = post("price");
              $new_cart->quantity = post("quantity");
              $new_cart->formated_price = post("formated_price");
              $new_cart->measurement_type = post("measurement_type");
              $new_cart->set_expr("created_at", "NOW()");
              
              $new_cart->save();
          }
          
          public function get_carts($user_id){
              $carts = [];
              $get_carts = ORM::for_table("carts")
                      ->select(["carts.measurement_type","carts.product_name","carts.user_id","carts.formated_price","carts.quantity","carts.price"])
                      ->select(["product.image","carts.id","carts.product_id"])
                      ->where_raw("carts.user_id = ?", [$user_id])
                      ->inner_join("product", "product.id = carts.product_id")
                      ->find_array();
              foreach ($get_carts as $cart){
                  $cart["image"] = App::Assets()->getUploads()->getImage($cart["image"]);
                  $carts[] = $cart;
              }
              return $carts;
          }
          
          public function register_order($user_id,$invoice_number){
              //Add to the product_order table
              $new_order = ORM::for_table("product_orders")
                      ->create();
              $new_order->invoice_number = $invoice_number;
              $new_order->user_id = $user_id;
              $new_order->shipping_mode = $this->session_manager->getSession("shipping_mode");
              $new_order->set_expr("created_at", "NOW()");
              $new_order->set_expr("updated_at", "NOW()");
              $new_order->save();
              
              $get_carts = $this->get_carts($user_id);
              foreach ($get_carts as $cart){
                  $new_order = ORM::for_table("orders")
                      ->create();
                  $new_order->invoice_number = $invoice_number;
                  $new_order->product_id = $cart["product_id"];
                  $new_order->price = $cart["price"];
                  $new_order->quantity = $cart["quantity"];
                  $new_order->formated_price = $cart["formated_price"];
                  $new_order->measurement_type = $cart["measurement_type"];
                  $new_order->user_id = $cart["user_id"];
                  $new_order->set_expr("created_at", "NOW()");
                  $new_order->save();
              }
              $delete_cart = ORM::for_table("carts")
                      ->where_raw("user_id = ?", [$user_id])
                      ->delete_many();
             
          }
          
          public function get_orders(){
              
              $orders = [];
              
              $get_orders = ORM::for_table("orders")
                      ->select("orders.id","order_id")
                      ->select(["orders.product_id","orders.price","orders.quantity","orders.formated_price","orders.measurement_type","orders.user_id","orders.product_name"])
                      ->select(["users.id","users.fullname","users.username","users.email","users.profile_pics","orders.created_at","orders.status"])
                      ->inner_join("users", "users.id = orders.user_id")
                      ->find_array();
          
              foreach($get_orders as $order){
                  $order["user_picture"] = $this->getAvatar($order["profile_pics"], $order["fullname"]);
                 
                 $orders[] = $order; 
              }
          }
          
          public function get_carts_in_total($user_id){
            $total_carts = [];
              $carts =  $this->get_carts($user_id);
            $total_price = 0;
            foreach ($carts as $cart){
                $total_price += ($cart["price"] * $cart["quantity"]);
                
            }
            $total_carts["total_price"] = $total_price;
            $total_carts["formatted_price"] = $this->money_builder($total_carts["total_price"]);
            $total_carts["item_counts"] = count($carts);
            
            return $total_carts;
          }
          
          public function remove_cart($id){
              $get_cart = ORM::for_table("carts")
                      ->find_one($id);
              if($get_cart->delete()){
                  
              }
          }
          
          public function order_update(){
              $get_user = ORM::for_table("users")
                      ->find_one(post("user_id"));
              $get_user->town = post("town");
              $get_user->address = post("address");
              $get_user->phone_number = post("phone");
              $get_user->state = post("state");
              $get_user->country = post("countries");
              if($get_user->save()){
                  
                  $this->session_manager->setSession("shipping_mode",  post("shipping_mode"));
                  return App::message("success", "Successfully updated records");
              }else{
                  return App::message("error", "Error updating records");
              }
              
          }
          
          public function generate_invoice_number(){
              $start = "PKLG";
              $end = "NG";
              $size = 10;$min = 0;$max = 9;
              $retval = [];
              
              for($i = $min; $i<=$max; $i++){
               $retval[$i] = $i;
                  
              }
              
              for($i = $min; $i< $size; $i++){
                $tmp = $retval[$i];
                $retval[$i] = $retval[$tmpkey = rand($min, $max)];
                $retval[$tmpkey] =$tmp;
                  
              }   
              return $start.join("",array_slice($retval, 0,$size)).$end;
          }
          
          
          public function get_local_government_by_state($state_id){
              $data["local_governments"] = "";
              $get_local = ORM::for_table("locals")
                      ->where_raw("state_id = ? ", [$state_id])
                      ->find_array();
              foreach ($get_local as $local ){
                  $data["local_governments"].= $this->build_option($local["local_id"], $local["local_name"]);
                  
              }
              $data["state"] = $this->get_shipping_price($state_id);
              print json_encode($data);
          }
          
          public function get_state(){
              $get_states = ORM::for_table("states")
                      ->find_array();
              return $get_states;
          }
          public function build_option($id, $value){
              
              return "<option value='$id'>$value</option>";
          }
          
          public function get_countries(){
              $get_countries = ORM::for_table("countries")
                      ->find_array();
              return $get_countries;
          }
          
          public function get_shipping_price($state_id){
              
              $get_state = ORM::for_table("states")
                      ->use_id_column("state_id")
                      ->find_one($state_id);
              $get_state = $get_state->as_array();
             
              $get_state["price"] = $get_state["shipping_price"];
              $get_state["formated_price"] = $this->money_builder($get_state["shipping_price"]);
              
              return $get_state;
          }
          
         public function has_order($user_id){
             $get_order = ORM::for_table("product_orders")
                     ->where_raw("user_id = ?", [$user_id])
                     ->find_many();
             if($get_order){
                 return true;
             }else{
                 return false;
             }
         }
         public function get_product_orders($user_id){
             $orders = [];
             $get_product_orders = ORM::for_table("product_orders")
                     ->where_raw("user_id = ? && view = 1 ", [$user_id])
                     ->order_by_desc("id")
                     ->find_array();
             foreach ($get_product_orders as $product_order){
                 $get_all_orders = [];
                 $get_order = ORM::for_table("orders")
                         ->where_raw("orders.invoice_number = ?", [$product_order["invoice_number"]])
                         ->inner_join("product", "product.id = orders.product_id")
                         ->find_array();
                 foreach ($get_order as $item){
                     $item["image"] = App::Assets()->getUploads()->getImage($item["image"]);
                     $get_all_orders[] = $item;
                 }
                 $product_order["orders"] = $get_all_orders;
                 $product_order["has_new_message"] = $this->order_has_message($product_order["invoice_number"]);
                  if($product_order["status"] == 0){
                     $product_order["order_status"] = "Order in progress";
                 }  elseif($product_order["status"] == 1) {
                     $product_order["order_status"] = "Order Awaiting payment";
                 }elseif($product_order["status"] == 2){
                     $product_order["order_status"] = "Your payment have been received";
                 } elseif($product_order["status"] == 3){
                     $product_order["order_status"] = "Your order have been shipped";
                 } elseif($product_order["status"] == 4){
                     $product_order["order_status"] = "Order completed";
                 } elseif($product_order["status"] == 5){
                     $product_order["order_status"] = "Order Canceled";
                 }
                 $orders[] = $product_order;
             }
             return $orders;
             
         }
         
         public function add_wards(){
             $new_ward = ORM::for_table("wards")
                     ->create();
             $new_ward->name = str_replace("/","&frasl;",trim(post("name")));
             $new_ward->description = post("description");
             $new_ward->slug = url_title(trim(post("name"))); 
             $new_ward->set_expr("created_at", "NOW()");
             if($new_ward->save()){
                 return App::message("success", "Ward added successfully");
             }else{
                 return App::message("error", "Error occurred try again");
             }
         }
         public function get_wards(){
            return $get_ward = ORM::for_table("wards")
                     ->find_many();
             
         }
         public function get_ward_by_name($name){
             $get_ward = ORM::for_table("wards")
                     ->where_raw("slug = ?", [$name])
                     ->find_one();
                return $get_ward;
             }
             
             public function get_total_sales(){
                 $amount = [];
                 $amount["total"] = 0;
                 $get_product_orders = ORM::for_table("product_orders")
                         ->where_raw("status = ?",[2])
                         ->find_array();
                 //if found
                 foreach ($get_product_orders as $get_orders){
                     //get order under invoice id
                     $get_order = ORM::for_table("orders")
                             ->where_raw("invoice_number = ?", [$get_orders["invoice_number"]])
                             ->find_array();
                     
                     foreach ($get_order as $order){
                         $amount["total"] += (int)$order["price"] * (int)$order["quantity"];
                     }
                 }
                 $amount["formatted_price"] = $this->money_builder($amount["total"]);
                 
                 return $amount;
                 
             }
             
             public function get_potential_earning(){
                 $amount = [];
                 $amount["total"] = 0;
                 $get_product_orders = ORM::for_table("product_orders")
                         ->where_raw("status != ?", [2])
                         ->find_array();
                 //if found
                 
                 foreach ($get_product_orders as $get_orders){
                     $get_order = ORM::for_table("orders")
                             ->where_raw("invoice_number = ?", [$get_orders["invoice_number"]])
                             ->find_array();
                     foreach ($get_order as $order){
                         $amount["total"] +=  (int)$order["price"] * $order["quantity"];
                     }
                     
                 }
                 
                 $amount["formatted_price"] =$this->money_builder($amount["total"]);
                 return $amount;
             }
             
             
             public function get_order_awaiting_response(){
                $orders = [];
                
                 $get_orders = ORM::for_table("product_orders")
                         ->where_raw("status = ?", [0])
                         ->find_many();
                 foreach ($get_orders as $prod_orders){
                     //get total foreach
                     $get_orders = ORM::for_table("orders")
                             ->where_raw("invoice_number = ?", [$prod_orders["invoice_number"]])
                             ->find_many();
                     foreach ($get_orders as $item_order){
                         $prod_orders["total_price"] += $item_order["price"] * $item_order["quantity"];
                     }
                     $prod_orders["total_price"] = $this->money_builder($prod_orders["total_price"]);
                     $prod_orders["has_new_message"] = $this->order_has_message($prod_orders["invoice_number"]);
                     $orders[] = $prod_orders;
                 }
                
                 return $orders;
             }
             
             public function get_order_awaiting_deliveries(){
                $orders = [];
                
                 $get_orders = ORM::for_table("product_orders")
                         ->where_raw("status = ?", [2])
                         ->find_many();
                 foreach ($get_orders as $prod_orders){
                     //get total foreach
                     $get_orders = ORM::for_table("orders")
                             ->where_raw("invoice_number = ?", [$prod_orders["invoice_number"]])
                             ->find_many();
                     foreach ($get_orders as $item_order){
                         $prod_orders["total_price"] += $item_order["price"] * $item_order["quantity"];
                     }
                     $prod_orders["total_price"] = $this->money_builder($prod_orders["total_price"]);
                     $prod_orders["has_new_message"] = $this->order_has_message($prod_orders["invoice_number"]);
                     $orders[] = $prod_orders;
                 }
                
                 return $orders;
             }
             
             public function get_order_awaiting_payments(){
                  $orders = [];
                
                 $get_orders = ORM::for_table("product_orders")
                         ->where_raw("status = ?", [1])
                         ->find_many();
                 foreach ($get_orders as $prod_orders){
                     //get total foreach
                     $get_orders = ORM::for_table("orders")
                             ->where_raw("invoice_number = ?", [$prod_orders["invoice_number"]])
                             ->find_many();
                     foreach ($get_orders as $item_order){
                         $prod_orders["total_price"] += $item_order["price"] * $item_order["quantity"];
                     }
                     $prod_orders["total_price"] = $this->money_builder($prod_orders["total_price"]);
                     $prod_orders["has_new_message"] = $this->order_has_message($prod_orders["invoice_number"]);
                     $orders[] = $prod_orders;
                 }
                
                 return $orders;
                 
             }
             public function get_order_awaiting_shipping(){
                  $orders = [];
                
                 $get_orders = ORM::for_table("product_orders")
                         ->where_raw("status = ?", [2])
                         ->find_many();
                 foreach ($get_orders as $prod_orders){
                     //get total foreach
                     $get_orders = ORM::for_table("orders")
                             ->where_raw("invoice_number = ?", [$prod_orders["invoice_number"]])
                             ->find_many();
                     foreach ($get_orders as $item_order){
                         $prod_orders["total_price"] += $item_order["price"] * $item_order["quantity"];
                     }
                     $prod_orders["total_price"] = $this->money_builder($prod_orders["total_price"]);
                     $prod_orders["has_new_message"] = $this->order_has_message($prod_orders["invoice_number"]);
                     $orders[] = $prod_orders;
                     
                 }
                
                 return $orders;
                 
             }
              public function get_order_shipped(){
                  $orders = [];
                
                 $get_orders = ORM::for_table("product_orders")
                         ->where_raw("status = ?", [3])
                         ->find_many();
                 foreach ($get_orders as $prod_orders){
                     //get total foreach
                     $get_orders = ORM::for_table("orders")
                             ->where_raw("invoice_number = ?", [$prod_orders["invoice_number"]])
                             ->find_many();
                     foreach ($get_orders as $item_order){
                         $prod_orders["total_price"] += $item_order["price"] * $item_order["quantity"];
                     }
                     $prod_orders["total_price"] = $this->money_builder($prod_orders["total_price"]);
                     
                     $orders[] = $prod_orders;
                 }
                
                 return $orders;
                 
             }
              public function get_order_completed($limit = 10, $offset = 0){
                  $orders = [];
                
                 $get_orders = ORM::for_table("product_orders")
                         ->where_raw("status = ?", [4])
                         ->limit($limit)
                         ->offset($offset *= $limit)
                         ->find_many();
                 foreach ($get_orders as $prod_orders){
                     //get total foreach
                     $get_orders = ORM::for_table("orders")
                             ->where_raw("invoice_number = ?", [$prod_orders["invoice_number"]])
                             ->find_many();
                     foreach ($get_orders as $item_order){
                         $prod_orders["total_price"] += $item_order["price"] * $item_order["quantity"];
                     }
                     $prod_orders["total_price"] = $this->money_builder($prod_orders["total_price"]);
                     $prod_orders["has_new_message"] = $this->order_has_message($prod_orders["invoice_number"]);
                     $orders[] = $prod_orders;
                 }
                
                 return $orders;
                 
             }
              public function get_order_canceled(){
                  $orders = [];
                
                 $get_orders = ORM::for_table("product_orders")
                         ->where_raw("status = ?", [5])
                         ->find_many();
                 foreach ($get_orders as $prod_orders){
                     //get total foreach
                     $get_orders = ORM::for_table("orders")
                             ->where_raw("invoice_number = ?", [$prod_orders["invoice_number"]])
                             ->find_many();
                     foreach ($get_orders as $item_order){
                         $prod_orders["total_price"] += $item_order["price"] * $item_order["quantity"];
                     }
                     $prod_orders["total_price"] = $this->money_builder($prod_orders["total_price"]);
                     $prod_orders["has_new_message"] = $this->order_has_message($prod_orders["invoice_number"]);
                     $orders[] = $prod_orders;
                 }
                
                 return $orders;
                 
             }
             
             public function get_total_amount($status){
                 $amount = 0;
                 $get_orders = ORM::for_table("product_orders")
                         ->where_raw("status = ?", [$status])
                         ->find_many();
                 foreach ($get_orders as $orders){
                     $get_order = ORM::for_table("orders")
                             ->where_raw("invoice_number = ?", [$orders["invoice_number"]])
                             ->find_many();
                     foreach ($get_order as $order_item){
                         $amount += $order_item["price"] * $order_item["quantity"];
                     }
                 }
                 return $this->money_builder($amount);
             }
             public function is_managing_sales($department_id){
                 $get_manager = ORM::for_table("sales_management")
                         ->find_one();
             if($get_manager){
                 if($get_manager->department_id == $department_id){
                     return true;
                 }else{
                     return FALSE;
                 }
             }else{
                 return FALSE;
             }
             }
             
             public function add_sales_manager(){
                 //if exists changed
                 $get_sales_manager = ORM::for_table("sales_management")
                         ->find_one();
                 if($get_sales_manager){
                     //meaning manager exists just changed it
                     
                    $get_sales_manager->department_id = post("department_id");
                    if($get_sales_manager->save()){
                        return App::message("success", "Sales management have been asigned");
                    }else{
                        return App::message("error", "Error occurred try again");
                    }
                 }else{
                     //create a new manager
                     
                     $new_manager = ORM::for_table("sales_management")
                             ->create();
                     $new_manager->department_id = post("department_id");
                     if($new_manager->save()){
                         return App::message("success", "Sales management have been asigned");
                     }else{
                         return App::message("error", "Error occurred try again");
                     }
                 }
             }
             
             public function get_product_order_by_invoice($invoice_number){
                 
                 $get_product_order = ORM::for_table("product_orders")
                         ->where_raw("invoice_number = ?", [$invoice_number])
                         ->inner_join("users", "users.id = product_orders.user_id")
                         ->find_one();
                $orders = [];
                 $get_orders = ORM::for_table("orders")
                         ->select(["orders.price","orders.formated_price","orders.quantity","orders.measurement_type","product.product_name"])
                         ->where_raw("invoice_number = ?", [$invoice_number])
                         ->inner_join("product", "product.id = orders.product_id")
                         ->find_many();
                 foreach ($get_orders as $order){
                     $order["unit_price"] = $this->money_builder($order["price"]);
                     $get_product_order["total_price"] += $order["price"] * $order["quantity"];
                     
                     $orders[] = $order;
                 }
                 $get_product_order["total_price_unmodified"] = $get_product_order["total_price"];
                 $get_product_order["total_price"] = $this->money_builder($get_product_order["total_price"] + $get_product_order["shipping_price"]);
                 $get_product_order["shipping_price"] = $this->money_builder($get_product_order["shipping_price"]);
                 if($get_product_order["status"] == 0){
                     $get_product_order["order_status"] = "Order in progress";
                 }  elseif($get_product_order["status"] == 1) {
                     $get_product_order["order_status"] = "Order Awaiting payment";
                 }elseif($get_product_order["status"] == 2){
                     $get_product_order["order_status"] = "Your payment have been received";
                 } elseif($get_product_order["status"] == 3){
                     $get_product_order["order_status"] = "Your order have been shipped";
                 } elseif($get_product_order["status"] == 4){
                     $get_product_order["order_status"] = "Order completed";
                 } elseif($get_product_order["status"] == 5){
                     $get_product_order["order_status"] = "Order Canceled";
                 }
                 $get_product_order["orders"] = $orders;
                 $get_product_order["country"] = $this->get_country_by_id($get_product_order["country"]);
                 
                 return $get_product_order;
             }
             public function get_country_by_id($id){
                 $get_region = ORM::for_table("countries")
                         ->find_one($id);
                 return $get_region->name;
             }
             
             public function update_order(){
                 
                 $get_order = ORM::for_table("product_orders")
                         ->where_raw("invoice_number = ?", [post("invoice_number")])
                         ->find_one();
                 if(post("status") == null){
                 $get_order->shipping_price = post("shipping_price");
                 $get_order->shipping_days = post("shipping_days");
                 $get_order->status = 1;
                 $get_order->set_expr("updated_at", "NOW()");
                }else{
                    $get_order->status = post("status");
                    $get_order->set_expr("updated_at", "NOW()");
                }
                if($get_order->save()){
                    return App::message("success", "Order successfully updated");
                }else{
                    return App::message("error", "Error occurred please try again");
                }
             }
             
             public function edit_ward(){
                 $get_ward = ORM::for_table("wards")
                         ->find_one(get("id"));
                 
                 $get_ward->name = trim(post("name"));
                 $get_ward->description = post("description");
                 
                 if($get_ward->save()){
                     return App::message("success", "Updated successfully");
                 }else{
                     return App::message("error", "Error Occurred");
                 }
             }
              public function edit_department(){
                 $get_ward = ORM::for_table("departments")
                         ->find_one(get("id"));
                 
                 $get_ward->name = trim(post("name"));
                 $get_ward->about = post("about");
                 $get_ward->slug = url_title(post("name"));
                 if($get_ward->save()){
                     return App::message("success", "Updated successfully");
                 }else{
                     return App::message("error", "Error Occurred");
                 }
             }
            public function update_account(){
                $message = "";
                $get_user = ORM::for_table("users")
                        ->find_one(post("user_id"));
                
                
                    if($this->_valid_inputs($_POST, $message)){
                        $get_user->fullname = post("fullname");
                        $get_user->username = post("username");
                        $get_user->gender = post("gender");
                        $get_user->email = post("email");
                        if($get_user->save()){
                            $get_official = ORM::for_table("officials")
                                    ->where_raw("user_id = ?", [post("user_id")])
                                    ->find_one();
                            $get_official->about = post("about");
                            $get_official->save();
                            if(post("opening_speech") != null){
                                $conf = ORM::for_table("configuration")
                                        ->find_one();
                                $conf->Sykup_page = post("opening_speech");
                                $conf->save();
                            }
                            $message = App::message("success", "Account updated successfully");
                        }else{
                            $message = App::message("error", "Error Occurred, try again");
                        }
                    }else{
                        $message = App::message("error", $message);
                    }
              if(post("oldpassword") != "" && post("newpassword") != ""){
                    //change passwword
                    if(password_verify(post("oldpassword"), $get_user->password)){
                        $get_user->password = password_hash(post("newpassword"), PASSWORD_BCRYPT);
                        $get_user->save();
                    }else{
                        $message = App::message("error", "Incorrect Old password supplied");
                    }
                      }
                return $message;
            }
            
            public function _valid_inputs(array $inputs, &$return_message){
                $tof = TRUE;
                foreach ($inputs as $name=>$value){
                 if($name != "user_id" && $name != "oldpassword" && $name != "newpassword"){
                    if(strlen($value) < 3){
                        $return_message .= $name." Must be greater than 3"."<br>";
                        $tof = false;
                       
                    }
                }
                }
                return $tof;
            }
            
            public function add_about(){
                $new_about = ORM::for_table("about")
                        ->create();
                $new_about->title = post("title");
                $new_about->body = post("body");
                if($new_about->save()){
                    return App::message("success", "Successfully added a new section");
                } else{
                    return App::message("error", "Error occurred");
                }               
            }
            public function modify_about(){
                $get_about = ORM::for_table("about")
                        ->find_one(get("id"));
                $get_about->title = trim(post("title"));
                $get_about->body = post("body");
                if($get_about->save()){
                    return App::message("success", "About Section successfully modified");
                }else{
                    return App::message("error", "Error occurred");
                }
            }
            
            public function get_abouts(){
                return ORM::for_table("about")
                        ->find_many();
            }
            
            public function get_about_by_id(){
                return ORM::for_table("about")
                        ->find_one(get("action"));
            }
             public function get_produce_by_id(){
                return ORM::for_table("product")
                        ->find_one(get("action"));
            }
            public function submit_contact(){
                
                $new_contact = ORM::for_table("contact")
                        ->create();
                $new_contact->fullname = post("fullname");
                $new_contact->email = post("email");
                $new_contact->phone_number = post("phone");
                $new_contact->message = post("message");
                $new_contact->department_id = post("department_id");
                $new_contact->set_expr("created_at", "NOW()");
                if($new_contact->save()){
                    return App::message("success", "Your message have been submitted we will get back to you soon");
                }else{
                    return App::message("error", "Error occurred please try again");
                }
            }
              
        public function get_contact_message($dept_id){
                  
            $get_message = ORM::for_table("contact")
                    ->where_raw("department_id = ?", [$dept_id])
                    ->find_many();
            
            return $get_message;
            
        }
        
        public function count_unread_contact_message($dept_id){
            $get_message = ORM::for_table("contact")
                    ->where_raw("department_id = ? and seen = ?", [$dept_id,0])
                    ->find_array();
            return count($get_message);
        }
        
        public function  read_contact_message($message_id){
            $message = [];
            $get_message = ORM::for_table("contact")
                    ->find_one($message_id);
            
            $get_message->seen = 1;
            $get_message->save();
            $message = $get_message;
            return $message;
        }
        
        public function send_reply_contact() {
            if(post("through") == "phone"){
                $message = send_sms(post("message"), post("phone"));
                if(trim($message) == "-2906."){
                    return App::message("error", "Insufficient Account balance");
                }else{
                    return App::message("success", "SMS sent successfully") ;
                }
               
            }
        }
        public function get_user_id_with_order(){
            $ids = [];
            $get_orders = ORM::for_table("product_orders")
                    ->find_many();
            foreach ($get_orders as $order ){
                if(!in_array($order["user_id"], $ids)){
                    $ids[] = $order["user_id"];
                }
            }
            return $ids;
        }
        
        public function get_officials_id(){
            $officials = array();
            $get_officials = ORM::for_table("officials")
                    ->find_array();
            foreach ($get_officials as $item){
                $officials[] = $item["user_id"];
            }
            return $officials;
        }
        
        public function get_numbers(){
            $data["code"] = 0;
            $data["numbers"] = "";
            $data["message"] = "";
            $data["option"] = post("option");
            $option = (int)post("option");
            $get_users = [];
            $officials_id = $this->get_officials_id();
            if($option == 4){
                //officials
                
                $get_users = ORM::for_table("users")
                        ->where_id_in($officials_id)
                        ->find_many();
                
            }elseif($option == 3){
                // all with officials
                $get_users = ORM::for_table("users")
                        ->find_many();
               
            }elseif($option == 2){
                $get_users = ORM::for_table("users")
                        ->where_not_in("id", $officials_id)
                        ->find_many();
            }elseif ($option == 1) {
            //users with orders
                $users_with_order = $this->get_user_id_with_order();
                $get_users = ORM::for_table("users")
                        ->where_id_in($users_with_order)
                        ->find_many();
                
              }
              if(count($get_users) > 0){
                  $data["code"] = 1;
                  $data["message"] = "Phone numbers generated";
                  foreach ($get_users as $user){
                      $data["numbers"] .= $user[post("type")].",";
                  }
                  $data["numbers"] = trim($data["numbers"]);
                  $data["numbers"] = substr($data["numbers"], 0, strlen($data["numbers"] )-1);
              }
            
        
       print json_encode($data);      
            
       }
       
       public function send_sms_message(){
           
           $numbers = post("numbers");
           $message = post("message");
           $type = post("type");
           if($type == "phone_number"){
           $return_message = send_sms($message, $numbers);
           $data["message"] = "Sms Sent";
           $data["type"] = "success";
           }else{
               if(mail($numbers, "Paikoro Local Government", $message)){
                   $data["message"] = "Email Sent";
                     $data["type"] = "success";
               }
           }
           print json_encode($data);
     
       }
       
       public function delete_all_message($user_id,$dept_id=null){
           if(post("type") == "messages"){
           $get_message = ORM::for_table("message")
                   ->where_raw("to_user_id = ?", $user_id)
                   ->delete_many();
           }else{
               $get_message = ORM::for_table("contact")
                       ->where_raw("department_id = ?", [$dept_id])
                       ->delete_many();
           }
       }

       public function get_sent_message($user_id){
           
           
       }
       
       public function add_account(){
           
           $new_account = ORM::for_table("banks")
                   ->create();
           $new_account->bank = post("bank");
           $new_account->name = post("name");
           $new_account->number = post("number");
           if($new_account->save()){
               return App::message("success", "Account added successfully");
           }else{
               return App::message("error", "Error Occurred try again later");
           }
       }
       
       public function list_account(){
           return ORM::for_table("banks")
                   ->find_many();
       }
       
       public function add_video(){
           $new_video = ORM::for_table("video")
                   ->create();
           $video = $this->upload("video",".mp4");
           $new_video->title = post("title");
           $new_video->video = $video;
           if($video != ""){
           if($new_video->save()){
               return App::message("success", "Video Successfully Added");
           }else{
               return App::message("error", "Error occur");
           }
              }else{
                return App::message("error", "Please select an MP4 video");  
              }
       }
       
       public function get_videos(){
           $videos = ORM::for_table("video")
                   ->limit(2)
                   ->order_by_desc("id")
                   ->find_many();
           return $videos;
       }
       
       public function get_officials(){
           
           $get_officials = ORM::for_table("officials")
                   ->select(["users.fullname","users.gender","users.id","officials.department","departments.name"])
                   ->inner_join("users", "users.id = officials.user_id")
                   ->inner_join("departments", "departments.id = officials.department")
                   ->find_many();
           return $get_officials;
       }
       
       public function get_monthly_sales(){
           $data = [];
           $month = [];
           for($i = 1; $i<=12; $i++){
               $month[$this->parse_month($i < 10? "0$i" : "$i")] = [];
               //parse date 
               $mn = $i < 10 ? "0$i" : "$i";
               $year = date("Y");
               $created_at = "$year-$mn-";
               $get_sales = ORM::for_table("product_orders")
                       ->where_like("created_at", "%$created_at%")
                       ->find_many();
               if($get_sales){
                   $total_sales = 0;
                   foreach ($get_sales as $sales){
                       if($sales->status > 1){
                           $order = $this->get_product_order_by_invoice($sales->invoice_number);
                           $total_sales += $order["total_price_unmodified"];
                       }
                       
                   }
                 $month[$this->parse_month($i < 10? "0$i" : "$i")]["total_sales"] = $total_sales;  
               }else{
               $month[$this->parse_month($i < 10? "0$i" : "$i")]["total_sales"] = 10;     
               }
                
               
           }
           return $month;
       }
       
       public function send_token(){
           $token = $this->generate_token();
           $get_user = ORM::for_table("users")
                   ->where_raw("email = ?", [post("email")])
                   ->find_one();
           
           $new_remember = ORM::for_table("forget_password")
                   ->create();
           $new_remember->token = $token;
           $new_remember->user_id = $get_user->id();
           $new_remember->set_expr("created_at", "now()");
           $new_remember->save();
           library("email");
           $link = APP::route("forget_password", "token/".$token, FALSE, TRUE);
           $message = "<h1>Hi $get_user->fullname</h1>"
                   . "<p>Click below link to recover your password .</p>"
                   . "{unwrap}$link{/unwrap}<br>"
                   . "".  img(App::Assets()->getImage("paikoroo.jpg"))."";
           
         $this->email->clear();
        $this->email->to(post("email"));
        $this->email->from('wapjude@gmail.com');
        $this->email->subject('Paikoro Password Recovery');
        $this->email->message($message);
       if($this->email->send()) {
           return App::message("success", "Check your email,recovery link has been sent to your email");
       }else{
           return App::message("error", "Error recovering your password, try again");
       }
           
       }
       
       
       public function email_exists($email){
           $check = ORM::for_table("users")
                   ->where_raw("email = ?", [$email])
                   ->find_one();
           return $check;
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
       
       public function edit_produce(){
           $get_produce = ORM::for_table("product")
                   ->find_one(get("id"));
           $get_produce->product_name = post("name");
           $get_produce->product_description = post("description");
           $get_produce->product_price = post("price");
           $get_produce->measurement_type = post("measurement");
           if($get_produce->save()){
               return App::message("success", "Product Successfully Modified");
           }else{
               return App::message("error", "Error Occurred, try again");
           }
       }
       
       public function insert_order_message(){
           $new_message = ORM::for_table("product_message")
                   ->create();
           $new_message->invoice_number = post("invoice");
           $new_message->message = post("order_message");
           $new_message->status = 0;
           $new_message->images = post("image");
           $new_message->user_id = post("user_id");
           $new_message->set_expr("created_at", "NOW()");
           $new_message->set_expr("updated_at", "NOW()");
           if($new_message->save()){
               return App::message("success", "Message sent successfully");
           }else{
               return App::message("error", "Could not send at this time try again later");
           }
           
       }
       
       public function get_order_messages($invoice_id){
           $messages = [];
           $get_messages = ORM::for_table("product_message")
                   ->select(["users.fullname","users.profile_pics","users.gender"])
                   ->select(["product_message.id","product_message.message","product_message.invoice_number","product_message.status"])
                   ->select(["product_message.created_at","product_message.updated_at","product_message.images"])
                   ->select("product_message.user_id")
                   ->where_raw("invoice_number = ?", [$invoice_id])
                   ->order_by_desc("id")
                   ->inner_join("users", "users.id = product_message.user_id")
                   ->find_many();
           foreach ($get_messages as $single_message){
               
               if($single_message["profile_pic"] == null){
                   $single_message["hasPicture"] = false;
               }else{
                   $single_message["hasPicture"] = true;
                   $single_message["picture"] = App::Assets()->getUploads()->getImage($single_message["profile_pic"]);
               }
               if($single_message["images"] != null){
                   $single_message["hasImages"] = true;
                   $get_images = explode("-", $single_message["images"]);
                   $single_message["images"] = $get_images;
               }else{
                   $single_message["hasImages"] = false;
               }
               $messages[] = $single_message;
           }
           $this->update_message_status($invoice_id);
           return $messages;
       }
       
       
       /**
        * @return array return list of your invoice ids
        */
      public function get_invoice_numbers($user_id){
          $invoices = [];
          
          $get_orders = ORM::for_table("product_orders")
                  ->where_raw("user_id = ?", [$user_id])
                  ->find_many();
          foreach ($get_orders as $order){
              $invoices[] = $order["invoice_number"];
          }
          
          return $invoices;
      } 
      /**
       * 
       * @param int $invoice_number
       * @return int
       */
      
      public function order_has_message($invoice_number){
          $get_message = ORM::for_table("product_message")
                  ->where_raw("invoice_number = ? && status = 0", [$invoice_number])
                  
                  ->find_array();
          return count($get_message);
      }
      
      public function count_total_order_messages($user_id){
          if(count($this->get_invoice_numbers($user_id)) > 0){
          $get_message = ORM::for_table("product_message")
                  ->where_in("invoice_number",$this->get_invoice_numbers($user_id) )
                  ->find_array();
          return count($get_message);
          }else{
              return 0;
          }
      }
      
      public function get_unread_order_message($user_id){
          if(count($this->get_invoice_numbers($user_id)) > 0){
          $get_message = ORM::for_table("product_message")
                  ->where("status", 0)
                  ->where_in("invoice_number", $this->get_invoice_numbers($user_id))
                  ->find_array();
          return count($get_message);
          }else{
              return 0;
          }
      }
      
      public function get_order_with_message($user_id){
          $invoice = [];
          foreach ($this->get_invoice_numbers($user_id) as $inv){
              if($this->order_has_message($inv)){
                  $invoice[] = $inv;
              }
          }
          return $invoice;
      }
      
      public function update_message_status($invoice_number){
          
          $get_messages = ORM::for_table("product_message")
                  ->where_raw("invoice_number = ?", [$invoice_number])
                  ->find_many();
          foreach ($get_messages as $message){
              $message->status = 1;
              $message->save();
          }
      }
      public function delete_product_order($pkm){
      
          $get_order = ORM::for_table("product_orders")
                  ->where_raw("invoice_number = ?", [$pkm])
                  ->find_one();
          $get_order->view = 0;
          $get_order->save();
          
      }
      
}