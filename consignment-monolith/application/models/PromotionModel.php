<?php
 class PromotionModel extends CI_Model {

   function __construct(){

   }

   public function getBanner(){
     $db_promotion = $this->load->database('commerce__promotion', TRUE);
     $this->db->cache_on();

     $data=$db_promotion->query("SELECT * FROM banner WHERE `is_active`=1")->result();
     return $data;
   }

}

?>
