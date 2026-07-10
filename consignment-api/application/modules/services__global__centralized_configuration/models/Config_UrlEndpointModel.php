<?php
 class Config_UrlEndpointModel extends CI_Model {

   function __construct(){

   }

   public function fetchAppLinkEndpoint($base_point){
     $this->db->cache_off();
     $data=$this->db->query("SELECT * FROM link_endpoint
                             WHERE base_url= ? ",
                             array(
                               $base_point
                             ))->result();
     $this->db->cache_on();
     return $data;
   }

   public function getAppLinkEndpoint($data){
     $this->db->cache_off();
     $data=$this->db->query("SELECT *
                              FROM link_endpoint
                              WHERE `key`= ?
                                    AND `base_url`= ?",
                              array(
                                $data->key,
                                $data->basepoint_key
                              ));

     $this->db->cache_on();
     return $data;
   }

   public function addAppLinkEndpoint($data){
     $this->db->cache_off();
     $this->db->query("INSERT INTO link_endpoint
                              (
                               `base_url`,
                               `key`,
                               `ci_path_function`,
                               `value`,
                               `allowed_method`,
                               `visibility`,
                               `type`,
                               `expose_local`,
                               `expose_public`,
                               `created_at`
                              )
                              VALUES
                              (
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?
                              )",
                              array(
                                $data->basepoint_key,
                                $data->key,
                                $data->module_function,
                                $data->value,
                                $data->method,
                                $data->visibility,
                                $data->type,
                                $data->expose_local,
                                $data->expose_public,
                                $data->current_time
                              ));
     $this->db->cache_on();
     return TRUE;
   }

   public function editAppLinkEndpoint($data){
     $this->db->cache_off();
     $this->db->query("UPDATE link_endpoint
                       SET `key`= ?,
                           `ci_path_function`= ?,
                           `value`= ?,
                           `allowed_method`= ?,
                           `visibility`= ?,
                           `type`= ?,
                           `expose_local`= ?,
                           `expose_public`= ?,
                           `updated_at`= ?
                       WHERE `base_url`= ?
                             AND `key`= ?",
                            array(
                              $data->key,
                              $data->module_function,
                              $data->value,
                              $data->method,
                              $data->visibility,
                              $data->type,
                              $data->expose_local,
                              $data->expose_public,
                              $data->current_time,
                              $data->basepoint_key,
                              $data->current_key
                            ));
     $this->db->cache_on();
     return TRUE;
   }

   public function deleteAppLinkEndpoint($data){
     $this->db->cache_off();
     $this->db->query("DELETE FROM link_endpoint
                       WHERE `base_url`=?
                             AND `key`= ?",
                            array(
                              $data->basepoint_key,
                              $data->current_key
                            ));
     $this->db->cache_on();
     return TRUE;
   }


}

?>
