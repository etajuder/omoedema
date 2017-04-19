<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ads_model
 *
 * @author JUDE
 */
class ads_model extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function add_ads(){
        $new_ads = $this->for_table("customadvert")
                ->create();
        $new_ads->type = post("type");
        $new_ads->script = post("script");
        $new_ads->image = $this->upload("image");
        $new_ads->imagelink = post("imagelink");
        if($new_ads->save()){
            return App::message("success", "Advert Added successfully");
        }else{
            return App::message("error", "Error adding advert please try again");
        }
    }
    
    public function get_all_ads(){
        return $this->for_table("customadvert")
                ->find_many();
    }
    
    
    public function get_ads($type = "box"){
        $ads = [];
        $get_ads = $this->for_table("customadvert")
                ->where_raw("type = ?", [$type])
                ->find_many();
        foreach ($get_ads as $ad){
            if($ad["script"] != null){
                $ad["is_script"] = TRUE;
            }else{
                $ad["is_script"] = false;
                if($ad["imagelink"] == null){
                    $ad["is_link"] = FALSE;
                    $ad["image"] = App::Assets()->getUploads()->getImage($ad["image"]);
                }else{
                    $ad["is_link"] = TRUE;
                }
            }
            $ads[] = $ad;
        }
        return $ads;
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
        
     
}
