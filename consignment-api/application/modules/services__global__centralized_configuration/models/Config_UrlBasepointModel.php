<?php
 class Config_UrlBasepointModel extends CI_Model {

   function __construct(){

   }

   public function fetchAppLinkBaseUrl(){
     $this->db->cache_off();
     $data=$this->db->query("SELECT * FROM link_base_url")->result();
     $this->db->cache_on();
     return $data;
   }

   public function getAppLinkBaseUrl($key){
     $this->db->cache_off();
     $data=$this->db->query("SELECT *
                              FROM link_base_url
                              WHERE `key`= ? ",
                              array(
                                $key
                              ));

     $this->db->cache_on();
     return $data;
   }

   public function addAppLinkBaseUrl($data){
     $this->db->cache_off();
     $this->db->query("INSERT INTO link_base_url (`key`,`ci_path`,`link_local`,`link_public`,`created_at`)
                              VALUES (?,?,?,?,?)",
                              array(
                                $data->key,
                                $data->path,
                                $data->local_basepoint,
                                $data->public_basepoint,
                                $data->current_time
                              ));
     $this->db->cache_on();
     return TRUE;
   }

   public function editAppLinkBaseUrl($data){
     $this->db->cache_off();

     $this->db->trans_begin();
     $this->db->query("UPDATE link_base_url
                       SET `key`= ?,
                           `ci_path`= ?,
                           `link_local`= ?,
                           `link_public`= ?,
                           `updated_at`= ?
                       WHERE `key`= ?",
                            array(
                              $data->key,
                              $data->path,
                              $data->local_basepoint,
                              $data->public_basepoint,
                              $data->current_time,
                              $data->current_key
                            ));

      $this->db->query("UPDATE link_endpoint
                        SET `base_url`= ?
                        WHERE `base_url`= ?",
                             array(
                               $data->key,
                               $data->current_key
                             ));
     $this->db->cache_on();

     if($this->db->trans_status() === FALSE){
       $this->db->trans_rollback();
       $response=FALSE;
     }else{
       $this->db->trans_commit();
       $response=TRUE;
     }
     return $response;
   }

   public function deleteAppLinkBaseUrl($data){
     $this->db->cache_off();

     $this->db->trans_begin();
     $this->db->query("DELETE FROM link_base_url
                       WHERE `key`= ?",
                            array(
                              $data->current_key
                            ));

      $this->db->query("DELETE FROM link_endpoint
                        WHERE `base_url`=?",
                             array(
                               $data->current_key
                             ));
     $this->db->cache_on();

     if($this->db->trans_status() === FALSE){
       $this->db->trans_rollback();
       $response=FALSE;
     }else{
       $this->db->trans_commit();
       $response=TRUE;
     }
     return $response;
   }


}

?>
