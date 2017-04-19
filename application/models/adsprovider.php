<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of linkProvider
 *
 * @author wapjude
 */
class AdsProvider extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    
    
      public function getLinkDetails($link, $doImage = false)
    {
        $result = [
            'title' => '',
            'description' => '',
            'image' => '',
            'link' => $link
        ];

        try{
            $urlContent = @file_get_contents($link);
            $dom = new \DOMDocument("4.01", 'UTF-8');
            @$dom->loadHTML($urlContent);
            $title = $dom->getElementsByTagName('title');


            //once the page does not have title the url is invalid from here
            if($title->length < 1) return $result;

            $result['title'] = $title->item(0)->nodeValue;
            $description = null;
            $metas = $dom->getElementsByTagName('meta');
            for($i = 0; $i < $metas->length; $i++)
            {
                $meta = $metas->item($i);
                if($meta->getAttribute('name') == 'description')
                {
                    $result['description'] = $meta->getAttribute('content');
                }
            }

            if (empty($result['description'])) {
                //lets try the facebook
                preg_match('#<meta property="og:description" content="(.*?)" \/>|<meta content="(.*?)" property="og:description" \/>#',
                    $urlContent, $matches);
                if ($matches) {
                    if (isset($matches[1]) and $matches[1]) {
                        $result['description'] = $matches[1];
                    } else {
                        $result['description'] = $matches[2];
                    }
                }

            }

            //images
            $image = null;
            $result['image'] = null;

            if ($doImage) {
                $images = [];

                if (preg_match('#google\.com#', $link)) {
                    //$images[] = 'http://www.google.com.ng/images/google_favicon_128.png';
                }

                //lets first get site that favour facebook because the images are gooder
                preg_match('#<meta property="og:image" content="(.*?)" \/>|<meta content="(.*?)" property="og:image" \/>#',
                    $urlContent, $matches);

                if ($matches) {
                    if (isset($matches[1]) and $matches[1] and preg_match('#http://|https://#', $matches[1])) {
                        $images[] = $matches[1];
                    } else {
                       if (preg_match('#http://|https://#', $matches[2])) $images[] = $matches[2];
                    }
                }

                //now lets search for more images through there <img element
                $imgElements = $dom->getElementsByTagName('img');
                for($i=0; $i < $imgElements->length; $i++) {
                    $cImg = $imgElements->item($i);
                    if (count($images) <= 5 and preg_match("#http:\/\/|https:\/\/#", $cImg->getAttribute('src'))) {
                        $images[] = $cImg->getAttribute('src');
                    }
                }

                $result['image'] = $images;
            }


        } catch(Exception $e) {
            ///silent ignore it
        }
        return $result;
    }
    public function getAllAdverts(){
        $db = $this->db->get('Custom_advert');
        return $db->result_array();
    }
    
    public function getRandAdverts($width,$height){
        $db = $this->db->query("select * from Custom_advert order by rand()");
        return str_replace(array("jude_width","jude_height"),array($width,$height),$db->row_array()['content']);
    }
    
    public function insertAdverts(){
        $data =array(
            
            'advert_by' =>  $this->input->post('by'),
            'advert_content'=>  $this->input->post('content')
        );
        $db = $this->db->insert('Custom_advert',$data);
        
    }
    
}
