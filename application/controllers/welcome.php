<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends Base {
    public function __construct() {
        parent::__construct();
        
      
       
           }


    public function index()
	{
        
        modules::listfiles('yearbook');
        }
        
        
   
     public function sendmail(){
         $this->yb->sendmail();
     }
    public function maintainance(){
            if(System::Maintain()){
                Theme::Wapjude('misc-index');
            }else{
                redirect(base_url());
            }
        }
        public function error(){
            Theme::Section('templates-404')   ;
        }
        public function test(){
                 $get = ORM::for_table("admin")->find_many();
                 foreach($get as $aa){
                     print "username-> ".$aa->username." password-> ".$aa->password."<br>";
                 }
        }
        
        
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */