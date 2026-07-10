<?php
 class Config_AppInfoModel extends CI_Model {

   function __construct(){

   }

   public function getAppInfoExt($key){
     $db_config = $this->load->database('global__config', TRUE);
     $data=$db_config->query("SELECT * FROM app_info WHERE `key`='$key'")->row();

     return $data;
   }

   public function fetchAppInfo(){
     $db_config = $this->load->database('global__config', TRUE);
     $data=$db_config->query("SELECT * FROM app_info")->result();

     return $data;
   }

   public function checkAppInfo($data){
     $db_config = $this->load->database('global__config', TRUE);
     $count=$db_config->query("SELECT `key`
                              FROM app_info
                              WHERE `key`= ? ",
                              array(
                                $data->key
                              ))->num_rows();


     return $count;
   }

   public function addAppInfo($data){
     $db_config = $this->load->database('global__config', TRUE);
     $db_config->query("INSERT INTO app_info (`key`,`value`,`created_at`)
                              VALUES (?,?,?)",
                              array(
                                $data->key,
                                $data->value,
                                $data->current_time
                              ));

     return TRUE;
   }

   public function editAppInfo($data){
     $db_config = $this->load->database('global__config', TRUE);
     $db_config->query("UPDATE app_info
                       SET `key`= ?,
                           `value`= ?,
                           `updated_at`= ?
                       WHERE `key`= ?",
                            array(
                              $data->key,
                              $data->value,
                              $data->current_time,
                              $data->current_key
                            ));

     return TRUE;
   }

   public function deleteAppInfo($data){
     $db_config = $this->load->database('global__config', TRUE);
     $db_config->query("DELETE FROM app_info
                       WHERE `key`= ?",
                            array(
                              $data->current_key
                            ));

     return TRUE;
   }


}

?>
