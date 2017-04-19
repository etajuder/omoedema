<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of corelang
 *
 * @author Wapjude
 */
class corelang {
    private static $lang='en';
    private static function Init(){
        $CI= &get_instance();
        $CI->load->helper('file');
        $CI->load->helper('directory');
        $CI->load->helper('path');
        return $CI;
    }

    public static function AvailLangs(){
        self::Init();
        $langs =array();
        $langfold= directory_map(self::langfolder());
        foreach ($langfold as $key => $value) {
            array_push($langs, array('name'=>$key));
        }
        return $langs;
    }
    public static function setLanguage($language='en'){
        self::$lang = $language;
    }
    
    private static function getTransList(){
        self::Init();
        $translates = array();
        $file_list_dr = directory_map(self::langfolder().self::$lang);
        $path = set_realpath(self::langfolder().self::$lang);
        foreach ($file_list_dr as $key) {
            include $path.$key;
            foreach ($lang as $item =>$value) {
                array_push($translates, [$item=>$value]);
            }
        }
        return $translates;
    }

    public static function trans($word){
        $lists=self::getTransList();
        $translated_word='';
        $int=(int)0;
        foreach ($lists as $key => $value) {
            if(@$value[$word] != null){
                $translated_word = $value[$word];
                $int++;
        }
  
        }
        if($int ==0){
            return $word;
        }else{
            return $translated_word;
        }
    }

    private static function langfolder(){
        return 'lang/';
    }
    public static function getLang(){
        return self::$lang;
    }
}
