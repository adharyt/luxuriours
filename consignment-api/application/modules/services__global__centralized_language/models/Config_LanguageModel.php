<?php
 class Config_LanguageModel extends CI_Model {

   function __construct(){

   }

   public function fetchLanguage(){
     $db_language = $this->load->database('global__language', TRUE);
     $data=$db_language->query("SELECT * FROM `language`")->result();
     return $data;
   }

   public function checkLanguage($id){
     $db_language = $this->load->database('global__language', TRUE);
     $data=$db_language->query("SELECT * FROM `language`
                                WHERE id= ?",
                                array(
                                  $id
                                ));
     return $data;
   }

   public function addLanguage($data){
     $db_language = $this->load->database('global__language', TRUE);

     $db_language->trans_begin();
     $db_language->query("INSERT INTO `language`
                          (`id`,`language`,`is_active`,`created_at`)
                          VALUES
                          (?,?,?,?)",
                          array(
                            $data->id,
                            $data->language,
                            $data->is_active,
                            $data->current_time
                          ));

      $this->load->model('Config_WordingModel');
      $wording=$this->Config_WordingModel->getWordingKey();
      foreach($wording as $v){
        $db_language->query("INSERT INTO `wording`
                             (`key`,`language`,`value`)
                             VALUES
                             (?,?,?)",
                             array(
                               $v->key,
                               $data->id,
                               'NO_WORDING'
                             ));
      }

      if($db_language->trans_status() === FALSE){
         $db_language->trans_rollback();
         $response=FALSE;
      }else{
         $db_language->trans_commit();
         $response=TRUE;
      }

     return $response;
   }

   public function editLanguage($data){
     $db_language = $this->load->database('global__language', TRUE);

     $db_language->trans_begin();
     $db_language->query("UPDATE `language`
                          SET `id` = ?,
                              `language` = ?,
                              `is_active` = ?,
                              `updated_at` = ?
                          WHERE id= ?",
                          array(
                            $data->id,
                            $data->language,
                            $data->is_active,
                            $data->current_time,
                            $data->current_id
                          ));

      $db_language->query("UPDATE `wording`
                           SET `language`= ?
                           WHERE `language`= ?",
                           array(
                             $data->id,
                             $data->current_id
                           ));

      if($db_language->trans_status() === FALSE){
         $db_language->trans_rollback();
         $response=FALSE;
      }else{
         $db_language->trans_commit();
         $response=TRUE;
      }
     return $response;
   }

   public function deleteLanguage($data){
     $db_language = $this->load->database('global__language', TRUE);

     $db_language->trans_begin();
     $db_language->query("DELETE FROM `language`
                          WHERE id= ?",
                          array(
                            $data->current_id
                          ));

     $db_language->query("DELETE FROM `wording`
                          WHERE `language`= ?",
                          array(
                            $data->current_id
                          ));

      if($db_language->trans_status() === FALSE){
         $db_language->trans_rollback();
         $response=FALSE;
      }else{
         $db_language->trans_commit();
         $response=TRUE;
      }
     return $response;
   }


}

?>
