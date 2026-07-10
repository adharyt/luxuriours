<?php
 class Config_AppInfoOriginModel extends CI_Model {

   function __construct(){

   }

   public function fetchAppInfoAllowedOrigin(){
     $this->db->cache_off();
     $data=$this->db->query("SELECT * FROM app_info__allowed_origin")->result();
     $this->db->cache_on();
     return $data;
   }

   public function getAppInfoAllowedOriginExt($id){
     $this->db->cache_off();
     $data=$this->db->query("SELECT * FROM app_info__allowed_origin WHERE `id`='$id'")->row();
     $this->db->cache_on();
     return $data;
   }



   public function checkAppInfoAllowedOrigin($data){
     $this->db->cache_off();
     $count=$this->db->query("SELECT `id`
                              FROM app_info__allowed_origin
                              WHERE `id`= ? ",
                              array(
                                $data->id
                              ))->num_rows();

     $this->db->cache_on();
     return $count;
   }

   public function addAppInfoAllowedOrigin($data){
     $this->db->cache_off();
     $this->db->query("INSERT INTO app_info__allowed_origin (`id`,`created_at`)
                              VALUES (?,?)",
                              array(
                                $data->id,
                                $data->current_time
                              ));
     $this->db->cache_on();
     return TRUE;
   }

   public function editAppInfoAllowedOrigin($data){
     $this->db->cache_off();
     $this->db->query("UPDATE app_info__allowed_origin
                       SET `id`= ?,
                           `updated_at`= ?
                       WHERE `id`= ?",
                            array(
                              $data->id,
                              $data->current_time,
                              $data->current_id
                            ));
     $this->db->cache_on();
     return TRUE;
   }

   public function deleteAppInfoAllowedOrigin($data){
     $this->db->cache_off();
     $this->db->query("DELETE FROM app_info__allowed_origin
                       WHERE `id`= ?",
                            array(
                              $data->current_id
                            ));
     $this->db->cache_on();
     return TRUE;
   }


}

?>
