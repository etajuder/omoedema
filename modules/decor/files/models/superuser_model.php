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
    
    public function get_albums($id=null,$category_id = null,$search_terms=null){
        if($id == NULL){
            $albums = [];
            if($category_id == null){
                if($search_terms == null){
            $get_albums = $this->for_table("photo_album")
                    ->select(["photo_album.id","photo_album.name","photo_album.category_id","photo_album.can_view","photo_album.cover_photo","photo_album.albums","photo_album.created_at"])
                    ->select("categories.name","category_name")
                    ->inner_join("categories", "categories.id = photo_album.category_id")
                    ->order_by_desc("id")
                    ->find_many();
                }else{
                     $get_albums = $this->for_table("photo_album")
                    ->select(["photo_album.id","photo_album.name","photo_album.category_id","photo_album.can_view","photo_album.cover_photo","photo_album.albums","photo_album.created_at"])
                    ->select("categories.name","category_name")
                   ->where_raw("photo_album.name like '%$search_terms%'",[])
                    ->inner_join("categories", "categories.id = photo_album.category_id")
                    ->order_by_desc("id")
                    ->find_many();
                }
            }else{
                
                $get_albums = $this->for_table("photo_album")
                    ->select(["photo_album.id","photo_album.name","photo_album.category_id","photo_album.can_view","photo_album.cover_photo","photo_album.albums","photo_album.created_at"])
                    ->select("categories.name","category_name")
                    ->inner_join("categories", "categories.id = photo_album.category_id")
                    ->where_raw("category_id = ?", [$category_id])
                    ->order_by_desc("id")
                    ->find_many();
            }
            foreach ($get_albums as $album){
                $photos = [];
                $album["cover_photo"] = App::Assets()->getUploads()->getImage($album["cover_photo"]);
                $list_image = explode(";", $album["albums"]);
                $index = 1;
                foreach ($list_image as $image){
                    if($index != 1){
                        array_push($photos, $image);
                    }
                    $index ++;
                }
                $album["photos"] = $photos;
                $album["link"] = Auth::user() ? App::route('photo_album',  url_title($album["name"])."/".$album["id"]) : App::route("register");
               $albums[] = $album;
            }
            return $albums;
        }else{
            
            $album = $this->for_table("photo_album")
                    ->select(["photo_album.id","photo_album.name","photo_album.category_id","photo_album.can_view","photo_album.cover_photo","photo_album.albums","photo_album.created_at"])
                    ->select("categories.name","category_name")
                    ->inner_join("categories", "categories.id = photo_album.category_id")
                    ->where_raw("photo_album.id = ?", [$id])
                    ->find_one();
            
            if($album){
            $photos = [];
                $album["cover_photo"] = App::Assets()->getUploads()->getImage($album["cover_photo"]);
                $list_image = explode(";", $album["albums"]);
                $index = 1;
                foreach ($list_image as $image){
                    if($index ==1){
                      $photos[] = $album["cover_photo"];   
                    }else{
                    $photos[] = $image;
                    }
                    $index ++;
                }
                $album["photos"] = $photos;
                return $album;
            }else{
                return [];
            }
        }
    }

    public function delete_photo_album($id){
        $album = $this->get_albums($id);
       //delete cover photo 
         
         $cover_photo = explode("/", $album["cover_photo"]);
         $real_cover = $cover_photo[count($cover_photo)-1];
         if(unlink("./uploads/".$real_cover)){
              log($real_cover." deleted");
         }
         
       //delete photos 
        foreach ($album["photos"] as $photo){
            $file_name = explode("/", $photo);
            
            $real_file = $file_name[count($file_name)-1];
            if(unlink("./uploads/".$real_file)){
                log($real_file." deleted") ;
            }
        }
      $this->for_table("photo_album")->find_one($id)->delete();  
    }
    
    public function addvideo(){
        $new_video = $this->for_table("videos")
                ->create();
        $new_video->title = post("title");
        $new_video->category_id = post("category");
        $new_video->can_view = post("canview");
        $sp = explode("/", post("albums"));
        $new_video->cover_photo =  $sp[count($sp)-1];
        $sp = explode("/", post("video"));
        $new_video->video = $sp[count($sp)-1];
        $new_video->lenght = post("len");
        $new_video->set_expr("created_at", "NOW()");
        if($new_video->save()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function get_videos($id=null,$category_id=null,$search_terms=null){
         if($id == NULL){
            $videos = [];
            if($category_id == null){
                if($search_terms == null){
            $get_albums = $this->for_table("videos")
                    ->select(["videos.id","videos.lenght","videos.title","videos.category_id","videos.can_view","videos.cover_photo","videos.video","videos.created_at"])
                    ->select("categories.name","category_name")
                    ->inner_join("categories", "categories.id = videos.category_id")
                    ->order_by_desc("videos.id")
                    ->find_many();
                }else{
                    $get_albums = $this->for_table("videos")
                    ->select(["videos.id","videos.lenght","videos.title","videos.category_id","videos.can_view","videos.cover_photo","videos.video","videos.created_at"])
                    ->select("categories.name","category_name")
                    ->where_raw("videos.title like '%$search_terms%'",[])
                    ->inner_join("categories", "categories.id = videos.category_id")
                    ->order_by_desc("videos.id")
                    ->find_many();
                }
            }else{
                 $get_albums = $this->for_table("videos")
                    ->select(["videos.id","videos.lenght","videos.title","videos.category_id","videos.can_view","videos.cover_photo","videos.video","videos.created_at"])
                    ->select("categories.name","category_name")
                    ->where_raw("videos.category_id = ?", [$category_id])
                    ->inner_join("categories", "categories.id = videos.category_id")
                   ->order_by_desc("videos.id")
                    ->find_many();
            }
            foreach ($get_albums as $album){
                
                $album["cover_photo"] = App::Assets()->getUploads()->getImage($album["cover_photo"]);
                $album["link"] = Auth::user() ? App::route("video", url_title($album["title"])."/".$album["id"]) : App::route("memberjoin", url_title($album["title"])."/".$album["id"]);
               $videos[] = $album;
            }
            return $videos;
        }else{
            $album = $this->for_table("videos")
                    ->select(["videos.id","videos.title","videos.category_id","videos.can_view","videos.cover_photo","videos.video","videos.created_at"])
                    ->select("categories.name","category_name")
                    ->inner_join("categories", "categories.id = videos.category_id")
                    ->where_raw("videos.id = ?", [$id])
                    ->find_one();
            if($album){
           
                $album["video"] = App::Assets()->getUploads()->getVideos($album["video"]);
                $album["cover_photo"] = App::Assets()->getUploads()->getImage($album["cover_photo"]);
                return $album;
            }else{
                return [];
            }
        }
    }
    public function  get_category_by_name($name){
        $get_cate = $this->for_table("categories")
                ->where_raw("name = ?", [$name])
                ->find_one();
        return $get_cate;
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
        $new_plan->duration = post("duration");
        $new_plan->set_expr("created_at", "NOW()");
        if($new_plan->save()){
            return true;
        }else{
            return false;
        }
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
    
    public function update_misc(){
        $misc = $this->get_misc();
        $misc->terms = post("terms");
        $misc->about = post("about");
        $misc->privacy = post("privacy");
        $misc->business_inc = post("business");
        $misc->save();
        return TRUE;
    }
    
    public function create_admin(){
        $new_admin = $this->for_table("admin")
                ->create();
        $new_admin->fullname = post("fullname");
        $new_admin->username = post("username");
        $new_admin->password = post("password");
        $new_admin->save();
    }
    
    public function get_admins(){
        return $this->for_table("admin")->find_many();
    }

        public function get_plans(){
        return $this->for_table("sub_plans")
                ->find_many();
    }
    
   
    
    public function has_temp(){
        $username = $this->session_manager->getSession("temp_username");
        return $username != null;
    }
    
    

    public function delete_content_by_id($table,$id){
      $this->for_table($table)->find_one($id)->delete();
  }
  
  public function get_users(){
      $get_user = $this->for_table( "users")
              ->select("users.*")
              ->select(["payments.time_start","payments.status","payments.sub_id"])
              ->select("sub_plans.name","sub_plan")
              ->select("sub_plans.price")
              ->select("sub_plans.duration")
              ->innerJoin("payments", "users.email = payments.user_email")
             ->left_outer_join("sub_plans", "payments.sub_id = sub_plans.id") 
              ->find_many();
      return $get_user;
  }
}
