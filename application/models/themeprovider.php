<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of install
 *
 * @author ETANUWOMA JUDE Wapjude@gmail.com
 * @access public
 * Changing Theme mechanism  App Program fully by Etanuwoma Jude 
 * please contact me if you are going to be using this
 * @copyright (c) 2014, Peter Jude
 * Remember to create a configuration table 
 * to store current theme
 */
class ThemeProvider extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
        helper('file');
        helper('path');
        helper('directory');
    }
    
    public function read_theme(){
       $theme = array();
       $themes_as = directory_map($this->base_theme());
       foreach ($themes_as as $themes => $list){
           array_push($theme, array('name'=>$themes));
       }
       return $theme;
    }
    
    public function read_details($folder){
        $theme['image'] = base_url().'themes/'.$folder.'/preview.png';
       $directory = App::ThemeDir().$folder;
       $pat = set_realpath($directory);
       include $pat.'/detail.php';
       $theme['name'] = $detail['name'];
       $theme['type'] = $detail['type'];
       $theme['description'] = $detail['description'];
       $theme['Author'] = $detail['design_by'];
       return $theme;
    }
    
    
    public function base_theme(){
        return App::ThemeDir();
    }
    public function activatetheme(){
        $theme = get('theme');
        DBA::operation('update', 'configuration', ['theme'=>$theme]);
    }
    
}
