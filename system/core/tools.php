<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 function getQuote($str){
        if(is_string($str)){
            return "'$str'";
        }else{
            return $str;
        }
    }
     function Usegment($int){
       $CI = &get_instance();
       return $CI->uri->segment($int);
   }
    function getYoutubeId($link){
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $matches);
        return $matches[0];
    }
    function getYoutubeImage($id){
       return "http://img.youtube.com/vi/$id/hqdefault.jpg";
    }
      /**
     * 
     * @param type $val
     * @return type boolean
     * <h1>
     * Returns the post method
     * </h1>
     * @author Wapjude <wapjude@example@gmail.com>
     */
    function post($val){
        $CI = &get_instance();
        $CI->load->helper('form');
        return $CI->input->post($val);
    }
    /**
     * 
     * @param type $val
     * @return  boolean
     * <h1>
     * Returns the get method
     * </h1>
     * @author Wapjude <wapjude@example@gmail.com>
     */
    function get($val){
        $CI = &get_instance();
        $CI->load->helper('form');
        return $CI->input->get($val);
    }
    
   function model($model,$name=''){
        $CI = &get_instance();
        if($model != ''){
        $CI->load->model($model,$name);
        }else{
            $CI->load->model($model);
        }
    }
    
   function row($db){
       return $db->row_array();
   }
   function results($db){
       return $db->result_array();
   }
   function num_rows($db){
       return $db->num_rows();
   }
   
   function helper($helper){
       $CI = &get_instance();
       $CI->load->helper($helper);
   }
   
   function library($library){
       $CI = &get_instance();
       $CI->load->library($library);
   }
    function set_flashdata($name, $value){
       $CI = &get_instance();
       $CI->session->set_flashdata($name,$value);
   }
   function database($database=''){
       if($database==''){
       $CI = &get_instance();
       $CI->load->database();
       }else{
       $CI = &get_instance();
       $CI->load->database($database);
           
       }
   }
    function OrmConfig(){
   //  if(System::Installed())
     return 'mysql:host=localhost;dbname='.System::Get("db");
 }
 function OrmUser(){
     return System::Get("user");
 }
 function OrmPass(){
     return System::Get("pass");
 }
 
 function ORMconnect(){
    ORM::configure(OrmConfig(), null);
    ORM::configure('username', OrmUser());
    ORM::configure('password', OrmPass());
 }
   function model_request($model,$functionname,$param=null){
       $CI = &get_instance();
       $CI->load->model($model);
       
       return $CI->$model->$functionname($param);
       
   }

function editor($path,$width,$type='Full') {
          helper('url');
         helper('form');
    //Loading Library For Ckeditor
         library('ckeditor');
         library('ckFinder');
    //configure base path of ckeditor folder 
         $CI=&get_instance();
    $CI->ckeditor->basePath = base_url().'js/ckeditor/';
    $CI->ckeditor-> config['toolbar'] = $type;
    $CI->ckeditor->config['language'] = 'en';
    $CI->ckeditor-> config['width'] = $width;
    //configure ckfinder with ckeditor config 
    $CI->ckfinder->SetupCKEditor($CI->ckeditor,$path); 
  }
  
  
  class ENCRYPT{
      public static function Encrypts($word){
          $CI = &get_instance();
           $dynamicEncrypt = DynamicCrypto\DynamicCryptoFactory::buildDynamicEncrypter($CI->config->item('enc'));
            $dynamicDecrypt = DynamicCrypto\DynamicCryptoFactory::buildDynamicDecrypter($CI->config->item("enc"));
           return $encrypt = $dynamicEncrypt->encrypt($word);
      }
      public static function Decrypt($enc){
          $CI = &get_instance();
           $dynamicEncrypt = DynamicCrypto\DynamicCryptoFactory::buildDynamicEncrypter($CI->config->item('enc'));
            $dynamicDecrypt = DynamicCrypto\DynamicCryptoFactory::buildDynamicDecrypter($CI->config->item("enc"));
           return  $decrypt = $dynamicDecrypt->decrypt($enc);
      }
  }
  
  const GET = 'get';
  const GETW = "get_where";
  const SELECT = 'select';
  const RLIST = 'readingList';
  const CONFIG = 'configuration';
  const ICode = 'invitecode';
  const INSERT = 'insert';
  const IUser = 'inviteusers';
  class cURL {
var $headers;
var $user_agent;
var $compression;
var $cookie_file;
var $proxy;
function cURL($cookies=TRUE,$cookie='cookies.txt',$compression='gzip',$proxy='') {
$this->headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
$this->headers[] = 'Connection: Keep-Alive';
$this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
$this->user_agent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)';
$this->compression=$compression;
$this->proxy=$proxy;
$this->cookies=$cookies;

}
function cookie($cookie_file) {
if (file_exists($cookie_file)) {
$this->cookie_file=$cookie_file;
} else {
fopen($cookie_file,'w') or $this->error('The cookie file could not be opened. Make sure this directory has the correct permissions');
$this->cookie_file=$cookie_file;
fclose($this->cookie_file);
}
}
function get($url) {
$process = curl_init($url);
curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
curl_setopt($process, CURLOPT_HEADER, 0);
curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($process,CURLOPT_ENCODING , $this->compression);
curl_setopt($process, CURLOPT_TIMEOUT, 30);
curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy);
curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
$return = curl_exec($process);
curl_close($process);
return $return;
}
function post($url,$data) {
$process = curl_init($url);
curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
curl_setopt($process, CURLOPT_HEADER, 1);
curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
curl_setopt($process, CURLOPT_ENCODING , $this->compression);
curl_setopt($process, CURLOPT_TIMEOUT, 30);
curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy);
curl_setopt($process, CURLOPT_POSTFIELDS, $data);
curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($process, CURLOPT_POST, 1);
curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
$return = curl_exec($process);
curl_close($process);
return $return;
}
function error($error) {
echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>cURL Error</b><br>$error</div></center>";
die;
}
}

function sms_username(){
    return "samfolabi";
}
function sms_password(){
    return "samfolabi123";
}
function sms_Sender(){
    return "PaikoroLGA";
}
function send_sms($message,$numbers){
    $curl = new cURL();
    $user_name = sms_username();
    $password = sms_password();
    $sender = sms_Sender();
  return  $curl->get("http://smsmobile24.com/components/com_spc/smsapi.php?username=$user_name&password=$password&sender=$sender&recipient=$numbers&message=$message");
}