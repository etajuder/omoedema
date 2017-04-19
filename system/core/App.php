<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of App
 *
 * @author Wapjude
 */
class App {
   
    public static function message($type,$message,$code=''){
        if($type=='error'){
            return '<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               '.$message.' <a class="alert-link" href="#">'.$code.'</a>.
                            </div>';
        }else{
             return '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               '.$message.' <a class="alert-link" href="#">'.$code.'</a>.
                            </div>';
        }
    }
    
   public static function Theme($type,$string,$from=null){
        $CI = &get_instance();
        $CI->load->helper('url');
        if($from == null){
     $sd = base_url().THEMEPATH.'assets/';
      $basetheme = $sd;
        switch ($type) {
            case 'css':
                return '<link rel="stylesheet" href="'.$basetheme.'css/'.$string.'" />';

                break;
            case 'js':
                return '<script type="text/javascript" src="'.$basetheme.'js/'.$string.'"></script>';
                break;
            case 'im':
                return $basetheme.'im/';
            default:
                break;
        }
        }else{
           $sd = base_url()."themes/".$from.'/assets/'; 
           $basetheme = $sd;
            switch ($type) {
            case 'css':
                return '<link rel="stylesheet" href="'.$basetheme.'css/'.$string.'" />';

                break;
            case 'js':
                return '<script type="text/javascript" src="'.$basetheme.'js/'.$string.'"></script>';
                break;
            case 'im':
                return $basetheme.'im/';
            default:
                break;
        }
        }
    }
     public static function ImageLink($image,array $att=null){
        $CI = &get_instance();
        $CI->load->helper('url');
          $basetheme = base_url().THEMEPATH;
        if($att==null){
            return "<img src='$basetheme/images/$image'>";
        }else{
            $sat='';
           foreach ($att as $value => $key) {
                $sat.=$value.' = '.$key.' ';
            }
            return "<img src='$basetheme/images/$image' $sat >";
        }
    }
    public static function routeHome(){
        $CI = &get_instance();
        $CI->load->helper('url');
        return base_url().corelang::getLang();
    }
    
    public static function RoundColor($i){
        $color = ["btn-primary","btn-p","btn-r","btn-g","btn-a","btn-y"];
        
        if($i <= count($color)){
            return $color[$i];
        }else{
            return $color[rand(0, count($color)-1)];
        }
    }

    public static function route($con,$loc='',$bool=FALSE,$lang_query=FALSE){
         
         $CI = &get_instance();
        $CI->load->helper('url');
        $jk = base_url();
        $basesite = $sd=str_replace('index.php', '', $jk);
        if($lang_query==FALSE){
        if($loc !=''){
        if($bool==TRUE){
     
        return $basesite.corelang::getLang().'/'.$con.'/'.$loc;    
        }
        else{
            return $basesite.$con.'/'.$loc;
        }
        }else{
            if($bool==TRUE){
                return $basesite.corelang::getLang().'/'.$con;
            }else{
                return $basesite.$con;
            }
        }
        }
        else{
            if($loc !=''){
               return $basesite.$con.'/'.$loc;   
            }else{
               return $basesite.$con;; 
            }
        }
    }
    public static function getRandWord(){
        $CI = &get_instance();
        
        $word = '';
        for ($index = 0; $index < 5; $index++) {
            $word.=self::getWord();
            $word.=self::getNum();
            $word.=self::getChar();
        }
        return $word;
    }
private static function getWord(){
    $arr1 = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
    return $arr1[rand(1, count($arr1)-1)];
}
private static function getNum(){
    $arr1 = [1,2,3,4,5,6,7,8,9,0];
    return $arr1[rand(1, count($arr1)-1)];
}
private static function getChar(){
    $arr1 = ["@","#","$","%","&","*","[","]","?",":",";"];
     return $arr1[rand(1, count($arr1)-1)];
}


    public static function Assets(){
        return new Assets();
    }
    
    public static function Routes($value){
        $data=array();
        return in_array($value, $data);
    }
    

    



    public static function getConfig($con){
        $CI=&get_instance();
       $cond= $CI->configurationprovider->get($con);
       return $cond;
    }
    
    public static function setConfig($data){
         $CI=&get_instance();
       $CI->configurationprovider->set($data);
    }

    public static function ThemeDir(){
        $CI = &get_instance();
        $CI->load->helper('url');
        $loc = 'themes/';
        return $loc;
    }
    public static function FaceBookSetUp(){
   return '<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : "1576542049264614",
      xfbml      : true,
      version    : "v2.3"
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, "script", "facebook-jssdk"));
</script>';
}
}


class Assets{
      public function getAsset($file,$from=null){
         $base = "default";
          $CI = &get_instance();
         $CI->load->helper('url');
         if($from == null){
         if(System::Installed()){
             $base = App::getConfig('theme');
         }
        
          return base_url()."themes/$base/assets/".$file;
         }else{
             
             return base_url()."themes/$from/assets/".$file;
             
         }
     }
     public function getImage($image,$from=null){
         $base = "default";
          $CI = &get_instance();
         $CI->load->helper('url');
         if($from == null){
         if(System::Installed()){
             $base = App::getConfig('theme');
         }
        
          return base_url()."themes/$base/assets/images/".$image;
         }else{
             
             return base_url()."themes/$from/assets/images/".$image;
             
         }
     }
     public function getCss($css,$from=null){
         $base = "default";
         if(System::Installed()){
             $base = App::getConfig('theme');
         }
         $CI = &get_instance();
          $CI->load->helper('url');
          if($from == null){
         if($css=="style.css" && $base=="default"){
             return base_url()."themes/$base/assets/".$css;
         }else{
           
          return base_url()."themes/$base/assets/css/".$css;
         }
          }else{
              return base_url()."themes/$from/assets/css/".$css;
          }
         
     }
     
     public function getJs($js, $from=null){
         $base = "default";
         if(System::Installed()){
             $base = App::getConfig('theme');
         }
           $CI = &get_instance();
          $CI->load->helper('url');
          if($from == null){
          return base_url()."themes/$base/assets/js/".$js;
          }else{
         return base_url()."themes/$from/assets/js/".$js; 
          }
     }

     
     public function emotImage($image){
         $CI = &get_instance();
          $CI->load->helper('url'); 
           return base_url().'themes/default/assets/images/emoticon/'.$image;
         
     }
     public function getUploads(){
         return new Uploads();
     }
     
}
 class Uploads{
     
     public function getImage($image){
         $CI = &get_instance();
          $CI->load->helper('url');
          return base_url()."uploads/".$image;
         
     }
      
     public function getTestImage($image){
         $CI = &get_instance();
          $CI->load->helper('url');
          return base_url()."uploads/images/".$image;
         
     }
     public function emotAudio($audio){
         $CI = &get_instance();
          $CI->load->helper('url'); 
           return base_url().'uploads/audio/'.$audio;
     }
     
     public function getVideos($video){
            $CI = &get_instance();
          $CI->load->helper('url'); 
           return base_url().'uploads/'.$video;
     }
     
     
}
class DropdownAdapter{
    protected $_data = array();
    protected $_value = array();
    public function __construct($data,$value=[]) {
        $this->_data = $data;
        $this->_value = $value;
    }
    
    
    
}