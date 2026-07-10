<?php
 class LanguageModel extends CI_Model {

   function __construct(){


   }

   public function getLanguage(){
     $db_language = $this->load->database('daemon__language', TRUE);

     $db_language->cache_on();
     $data=$db_language->query("SELECT * FROM language WHERE is_active=1")->result();
     return $data;
   }

   public function getWording($key,$selected_language=''){
     $db_language = $this->load->database('daemon__language', TRUE);

     if($selected_language!=''){
       $language=$selected_language;
     }else{
       $language=getSessionLanguage();
     }

     $db_language->cache_on();
     $data=$db_language->query("SELECT `value` FROM wording WHERE `key`='$key' and language='$language'")->row();
     return $data->value;
   }


   public function fetchWording($selected_language=''){
     $db_language = $this->load->database('daemon__language', TRUE);

     $db_language->cache_off();
     $data=$db_language->query("SELECT * FROM wording")->result();
     $db_language->cache_on();
     return $data;
   }


}

?>
