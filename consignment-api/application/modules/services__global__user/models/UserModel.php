<?php
 class UserModel extends CI_Model {

   function __construct(){

   }

   public function getPublicUser($username){
     $db_global_user = $this->load->database('global__user', TRUE);
     $data= $db_global_user->query("SELECT name,
                                           photo,
                                           username,
                                           gender
                                    FROM `profile`
                                    WHERE username= ?
                                          AND deleted_at IS NULL
                                    LIMIT 1",
                                    array(
                                      $username
                                    ))->row();
     return $data;
   }

   public function getConfidentialUser($username){
     $db_global_user = $this->load->database('global__user', TRUE);
     $data=$db_global_user->query("SELECT name,
                                          photo,
                                          username,
                                          birthdate,
                                          gender,
                                          email,
                                          phone,
                                          validated_email_at,
                                          validated_phone_at,
                                          created_at as register_date
                                   FROM `profile`
                                   WHERE username= ?
                                         AND deleted_at IS NULL
                                   LIMIT 1",
                                   array(
                                     $username
                                   ))->row();
     return $data;
   }

   public function updateUserData($data){
     $db_global_user = $this->load->database('global__user', TRUE);
     $data=$db_global_user->query("UPDATE `profile`
                                   SET name= ?,
                                       birthdate= ?,
                                       phone= ?,
                                       gender= ?
                                   WHERE username= ?
                                         AND deleted_at IS NULL",
                                   array(
                                     $data->name,
                                     $data->birthdate,
                                     $data->phone,
                                     $data->gender,
                                     $data->username
                                   ));
     return TRUE;
   }

   public function updateUserProfilePhoto($data){
     $db_global_user = $this->load->database('global__user', TRUE);
     $data=$db_global_user->query("UPDATE `profile`
                                   SET photo= ?
                                   WHERE username= ?
                                         AND deleted_at IS NULL",
                                   array(
                                     $data->photo,
                                     $data->username
                                   ));
     return TRUE;
   }


}

?>
