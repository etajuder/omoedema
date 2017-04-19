<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of superuser_model
 *
 * @author JUDE
 */
class superuser_model extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function login(){
        $get_user = $this->for_table("admin")
                ->where_raw("username = ? and password = ?", [post("username"),  post("password")])
                ->find_one();
        if($get_user){
            $this->session_manager->setSession("admin", post("username"));
            redirect(App::route("superuser"));
        }  else {
            return App::message("error", "Invalid credentials");    
        }
    }
    
    public function get_admin(){
        $get_admin = ORM::for_table("admin")
                ->where_raw("username = ?", [Auth::AdminUsername()])
                ->find_one();
        return $get_admin;
    }
    
    public function count_table($table){
        $get = $this->for_table($table)
                ->find_array();
       return count($get);
    }
    
    public function get_categories(){
        $categories = [];
        $get_categories = $this->for_table("categories")
                
                ->find_many();
    foreach ($get_categories as $category){
        $news = [];
       $get_cate_news = $this->for_table("news")
               ->where_raw("category = ? ", [$category["id"]])
               ->limit(5)
               ->find_many();
       foreach ($get_cate_news as $news_item){
           $news_item["body_short_desc"] = word_limiter(strip_tags($news_item["body"]),16);
                 $news_item["picture"] = App::Assets()->getUploads()->getImage($news_item["picture"]);
           $news_item["audio"] = $news_item["audio"] == null ? null : App::Assets()->getUploads()->getImage($news_item["audio"]);
          if($news_item["video"] != null){
              $news_item["has_video"] = TRUE;
           if($news_item["video_type"] == 0){
              $news_item["video"] = getYoutubeId($news_item["video"]);
              $news_item["is_youtube_video"] = true;
          }else{
             $news_item["video"] = $news_item["audio"] == null ? null : App::Assets()->getUploads()->getImage($news_item["video"]);  
             $news_item["is_youtube_video"] = false;
          }
          }else{
              $news_item["has_video"] = false;
          }
          
           $news_item["link"] = App::route($news_item["id"], url_title($news_item["title"]));
           $news[] = $news_item;
       }
       $category["news"] = $news;
       $categories[] = $category;
    }
    return $categories;
    }
    
    
    public function get_news($id = null, $where = null, $limit = 6, $offset = 0){
        if($id != null){
            
            $news_item  = $this->for_table("news")
                    ->select(["news.*","categories.name"])
                    ->select("categories.id", "category_id")
                    ->innerJoin("categories", "categories.id = category")
                    ->find_one($id);
            $news_item["file_access"] = $news_item["user_id"];
            $news_item["picture"] = App::Assets()->getUploads()->getImage($news_item["picture"]);
           $news_item["audio"] = $news_item["audio"] == null ? null : App::Assets()->getUploads()->getImage($news_item["audio"]);
           $news_item["has_audio"] = $news_item["audio"] != null;
          if($news_item["video"] != null){
              $news_item["has_video"] = TRUE;
           if($news_item["video_type"] == 0){
              $news_item["video"] = getYoutubeId($news_item["video"]);
              $news_item["is_youtube_video"] = true;
          }else{
             $news_item["video"] = $news_item["video"] == null ? null : App::Assets()->getUploads()->getImage($news_item["video"]);  
             $news_item["is_youtube_video"] = false;
          }
          }else{
              $news_item["has_video"] = false;
          }
          
           $news_item["link"] = App::route($news_item["id"], url_title($news_item["title"]));
           
            return $news_item;
        }else{
            $news = [];
            $get_news = [];
            if($where == null){
                $get_news = $this->for_table("news")
                    ->select(["news.*","categories.name"])
                    ->select("categories.id", "category_id")
                    ->limit($limit)
                    ->offset($offset *= $limit)
                    ->order_by_desc("id")
                    ->innerJoin("categories", "categories.id = category")
                    ->find_many();
          
            }else{
                $get_news = $this->for_table("news")
                    ->select(["news.*","categories.name"])
                    ->select("categories.id", "category_id")
                    ->limit($limit)
                    ->offset($offset *= $limit)
                    ->order_by_desc("news.id")
                    ->where_raw($where)
                    ->innerJoin("categories", "categories.id = category")
                    ->find_many();
            }
              foreach ($get_news as $news_item){
                  $news_item["body_short_desc"] = word_limiter(strip_tags($news_item["body"]),16);
                 $news_item["picture"] = App::Assets()->getUploads()->getImage($news_item["picture"]);
           $news_item["audio"] = $news_item["audio"] == null ? null : App::Assets()->getUploads()->getImage($news_item["audio"]);
          if($news_item["video"] != null){
              $news_item["has_video"] = TRUE;
           if($news_item["video_type"] == 0){
              $news_item["video"] = getYoutubeId($news_item["video"]);
              $news_item["is_youtube_video"] = true;
          }else{
             $news_item["video"] = $news_item["audio"] == null ? null : App::Assets()->getUploads()->getImage($news_item["video"]);  
             $news_item["is_youtube_video"] = false;
          }
          }else{
              $news_item["has_video"] = false;
          }
          
           $news_item["link"] = App::route($news_item["id"], url_title($news_item["title"]));
           $news[] = $news_item;
            }
            return $news;
            
        }
        
    }
    public function check_cate($name){
        $get_cate = $this->for_table("categories")
                ->where_raw("name = ?", [$name])
                ->find_one();
        return $get_cate;
    }
    
    
   
    public function get_video_news($limit = 5,$offset=0){
        $news = [];
        $get_news = $this->for_table("news")
              ->select(["news.*","categories.name"])
                    ->select("categories.id", "category_id")
                    ->order_by_desc("news.id")
                    ->inner_join("categories", "categories.id = category")
                    ->find_many()  ;
            foreach ($get_news as $news_item){
                if($news_item["video"] != null)
                $news_item["body_short_desc"] = word_limiter(strip_tags($news_item["body"]),16);
                 $news_item["picture"] = App::Assets()->getUploads()->getImage($news_item["picture"]);
           $news_item["audio"] = $news_item["audio"] == null ? null : App::Assets()->getUploads()->getImage($news_item["audio"]);
          if($news_item["video"] != null){
              $news_item["has_video"] = TRUE;
           if($news_item["video_type"] == 0){
              $news_item["video"] = getYoutubeId($news_item["video"]);
              $news_item["is_youtube_video"] = true;
          }else{
             $news_item["video"] = $news_item["video"] == null ? null : App::Assets()->getUploads()->getImage($news_item["video"]);  
             $news_item["is_youtube_video"] = false;
          }
          }else{
              $news_item["has_video"] = false;
          }
          
           $news_item["link"] = App::route($news_item["id"], url_title($news_item["title"]));
           $news[] = $news_item;
            }
            return $news;
    }
    
    public function get_most_viewed_news( $limit = 4,$offset=0){
        $news = [];
        $get_news = $this->for_table("news")
                ->select(["news.*","categories.name"])
                    ->select("categories.id", "category_id")
                    ->order_by_expr("viewed")
                    ->limit($limit)
                    ->inner_join("categories", "categories.id = category")
                    ->find_many()  ;
            foreach ($get_news as $news_item){
                
                $news_item["body_short_desc"] = word_limiter(strip_tags($news_item["body"]),16);
                 $news_item["picture"] = App::Assets()->getUploads()->getImage($news_item["picture"]);
           $news_item["audio"] = $news_item["audio"] == null ? null : App::Assets()->getUploads()->getImage($news_item["audio"]);
          if($news_item["video"] != null){
              $news_item["has_video"] = TRUE;
           if($news_item["video_type"] == 0){
              $news_item["video"] = getYoutubeId($news_item["video"]);
              $news_item["is_youtube_video"] = true;
          }else{
             $news_item["video"] = $news_item["video"] == null ? null : App::Assets()->getUploads()->getImage($news_item["video"]);  
             $news_item["is_youtube_video"] = false;
          }
          }else{
              $news_item["has_video"] = false;
          }
          
           $news_item["link"] = App::route($news_item["id"], url_title($news_item["title"]));
           $news[] = $news_item;
            }
            return $news;
    }
    public function get_popular_news( $limit = 4,$offset=0){
        $news = [];
        $get_news = $this->for_table("news")
                ->select(["news.*","categories.name"])
                    ->select("categories.id", "category_id")
                    ->order_by_expr("RAND()")
                    ->where("popular", 1)
                    ->inner_join("categories", "categories.id = category")
                    ->find_many()  ;
            foreach ($get_news as $news_item){
                
                $news_item["body_short_desc"] = word_limiter(strip_tags($news_item["body"]),16);
                 $news_item["picture"] = App::Assets()->getUploads()->getImage($news_item["picture"]);
           $news_item["audio"] = $news_item["audio"] == null ? null : App::Assets()->getUploads()->getImage($news_item["audio"]);
          if($news_item["video"] != null){
              $news_item["has_video"] = TRUE;
           if($news_item["video_type"] == 0){
              $news_item["video"] = getYoutubeId($news_item["video"]);
              $news_item["is_youtube_video"] = true;
          }else{
             $news_item["video"] = $news_item["video"] == null ? null : App::Assets()->getUploads()->getImage($news_item["video"]);  
             $news_item["is_youtube_video"] = false;
          }
          }else{
              $news_item["has_video"] = false;
          }
          
           $news_item["link"] = App::route($news_item["id"], url_title($news_item["title"]));
           $news[] = $news_item;
            }
            return $news;
    }
    public function add_news(){
        $new_news = $this->for_table("news")
                ->create();
        $new_news->title = post("title");
        $new_news->category = post("category");
        $new_news->body = post("body");
        $new_news->picture = $this->upload("cover_photo");
        $new_news->audio = $this->upload("audio",".mp4");
        $new_news->video_type = post("youtube") == null;
        $new_news->video = post("youtube");
        $new_news->user_id = post("file_access");
        $new_news->price = post("price");
        $new_news->popular = post("popuar");
        $new_news->hotnews =  post("hot");
        $new_news->set_expr("created_at", "NOW()");
        if($new_news->save()){
            return App::message("success", "News Added Successfully");
        }else{
            return App::message("error", "Error Adding news Please try again");
        }
    }
    
    public function add_category(){
        $new_cate = $this->for_table("categories")->create();
        $new_cate->name = post("name");
        $new_cate->set_expr("created_at", "NOW()");
        if($new_cate->save()){
            return App::message("success", "Category Created!! Please remember to add videos and Photos to category");
        }else{
            return App::message("error", "Error Occurred");
        }
    }
    
    public function delete_record($table,$id){
        $this->for_table($table)
                ->find_one($id)
                ->delete();
    }
    
    public function add_photo_album(){
        $new_album = $this->for_table("photo_album")->create();
        $new_album->name = post("name");
        $new_album->category_id = post("category");
        $new_album->can_view = post("can_view");
        $new_album->cover_photo = $this->decor->upload("cover_photo");
        $new_album->albums = post("albums");
        $new_album->set_expr("created_at", "NOW()");
       if($new_album->save()){
           return true;
       }else{
           return false;
       }
        
    }
    
    public function update_news($id){
        $get_news = $this->for_table("news")
                ->find_one($id);
        $get_news->title = post("title");
        $get_news->body = post("body");
        $get_news->category = post("category");
        $get_news->user_id = post("file_access");
        $get_news->price = post("price");
        if($get_news->save()){
            return App::message("success", "News Updated Successsfully");
        }else{
            return App::message("error", "Error Occurred!! Please try again");
        }
        
    }
    public function get_users(){
      $get_user = $this->for_table( "users")
              ->select("users.*")
              ->find_many();
      return $get_user;
  }
    
    
     public function upload($name,$ext=".png"){
        
        $storage = new \Upload\Storage\FileSystem("./uploads/");
        $file = new Upload\File($name, $storage);
        $new_name = uniqid().md5(time());
        if($ext == ".mp4"){
            $file->addValidations([
            new Upload\Validation\Extension(["mp4","webm","avi","flv","aac","mp3"]),
            new Upload\Validation\Size("100M")
        ]);
        }else{
        $file->addValidations([
            new Upload\Validation\Extension(["png","jpg","jpeg","gif","mp4","webm"]),
            new Upload\Validation\Size("10M")
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
   
 public function addsliders(){
        $new_video = $this->for_table("sliders")
                ->create();
        $new_video->title = post("title");
        $new_video->category_id = post("category");
        $new_video->cover_photo = $this->decor->upload("cover_photo");
        $new_video->video = $this->decor->upload("video",".mp4");
        $new_video->lenght = post("len");
        $new_video->set_expr("created_at", "NOW()");
        if($new_video->save()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
      public function get_sliders($id=null){
         if($id == NULL){
            $videos = [];
            $get_albums = $this->for_table("sliders")
                    ->select(["sliders.id","sliders.lenght","sliders.title","sliders.category_id","sliders.cover_photo","sliders.video","sliders.created_at"])
                    ->select("categories.name","category_name")
                    ->inner_join("categories", "categories.id = sliders.category_id")
                    ->find_many();
            foreach ($get_albums as $album){
                $photos = [];
                $album["cover_photo"] = App::Assets()->getUploads()->getImage($album["cover_photo"]);
                $album["video"] = App::Assets()->getUploads()->getVideos($album["video"]);
               $videos[] = $album;
            }
            return $videos;
        }else{
           $album = $this->for_table("sliders")
                    ->select(["sliders.id","sliders.lenght","sliders.title","sliders.category_id","sliders.cover_photo","sliders.video","sliders.created_at"])
                     ->select("categories.name","category_name")
                    ->inner_join("categories", "categories.id = videos.category_id")
                    ->where_raw("videos.id = ?", [$id])
                    ->find_one();
            if($album){
            $photos = [];
                $album["cover_photo"] = App::Assets()->getUploads()->getImage($album["cover_photo"]);
                return $album;
            }else{
                return [];
            }
        }
    }
    
    public function add_plans(){
        $new_plan = $this->for_table("sub_plans")
                ->create();
        $new_plan->name = post("name");
        $new_plan->price = post("price");
        $new_plan->description = post("description");
        $new_plan->set_expr("created_at", "NOW()");
        if($new_plan->save()){
            return true;
        }else{
            return false;
        }
    }
    
    public function get_plans(){
        return $this->for_table("sub_plans")
                ->find_many();
    }
    
   
    
    public function has_temp(){
        $username = $this->session_manager->getSession("temp_username");
        return $username != null;
    }
     public function get_admins(){
        return $this->for_table("admin")->find_many();
    }
    public function get_misc(){
        $get_misc = $this->for_table("misc")
                ->find_one(1);
        
    if($get_misc){
        return $get_misc;
    }else{
        $new_misc = $this->for_table("misc")
                ->create();
        $new_misc->about = "";
        $new_misc->save();
        return $this->get_misc();
    }
    }
    
      public function create_admin(){
        $new_admin = $this->for_table("admin")
                ->create();
        $new_admin->fullname = post("fullname");
        $new_admin->username = post("username");
        $new_admin->password = post("password");
        $new_admin->save();
    }

    public function delete_content_by_id($table,$id){
      $this->for_table($table)->find_one($id)->delete();
  }
  public function update_misc(){
        $misc = $this->get_misc();
        $misc->terms = post("terms");
        $misc->about = post("about");
        $misc->privacy = post("privacy");
        $misc->business_inc = post("business");
        $misc->price = post("price");
        $misc->save();
        return TRUE;
    }
    
    
}
