<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConfigurationProvider
 *
 * @author wapjude
 */
class configurationprovider extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function get($val){
        $db = $this->db->get('configuration');
        return $db->row_array()[$val];
    }
    public function set($data){
        $db = $this->db->update('configuration',$data);
    }
}
