<?php
 class RegistrationModel extends CI_Model {

   function __construct(){

   }

   public function create_user($data){
     $db_authentication = $this->load->database('global__authentication', TRUE);
     $db_global__user = $this->load->database('global__user', TRUE);

     $db_authentication->trans_begin();
     $db_global__user->trans_begin();

     $db_authentication->query("INSERT INTO `user_login` (
                                                          `username`,
                                                          `password`,
                                                          `salt`,
                                                          `registration_source`,
                                                          `registration_api`,
                                                          `status`,
                                                          `account_activation_code`,
                                                          `account_activation_expiry_time`,
                                                          `created_at`
                                                        )
                                                 VALUES (?,
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
                                                         $data->username,
                                                         $data->hashed_password,
                                                         $data->salt,
                                                         $data->registration_source,
                                                         $data->registration_api,
                                                         $data->account_status,
                                                         $data->account_activation_code,
                                                         $data->account_activation_expiry_time,
                                                         $data->created_at
                                                        )
                                                    );

      $db_global__user->query("INSERT INTO `profile` (
                                                       `username`,
                                                       `name`,
                                                       `gender`,
                                                       `birthdate`,
                                                       `email`,
                                                       `phone`,
                                                       `created_at`
                                                     )
                                              VALUES (
                                                      ?,
                                                      ?,
                                                      ?,
                                                      ?,
                                                      ?,
                                                      ?,
                                                      ?
                                                     )",
                                                array(
                                                      $data->username,
                                                      $data->name,
                                                      $data->gender,
                                                      $data->birthdate,
                                                      $data->email,
                                                      $data->phone,
                                                      $data->created_at
                                                     )
                                                 );

     if($db_authentication->trans_status() === FALSE || $db_global__user->trans_status() === FALSE){
       $db_authentication->trans_rollback();
       $db_global__user->trans_rollback();
       $response=FALSE;
     }else{
       $db_authentication->trans_commit();
       $db_global__user->trans_commit();
       $response=TRUE;
     }
     return $response;
   }

   public function activate_user($data){
     $db_authentication = $this->load->database('global__authentication', TRUE);
     $db_global__user = $this->load->database('global__user', TRUE);

     $check_data_auth=$db_authentication->query("SELECT username
                                                 FROM user_login
                                                 WHERE username= ?
                                                       AND account_activation_code= ?
                                                       AND status=0
                                                       AND deleted_at IS NULL",
                                                 array(
                                                   $data->username,
                                                   $data->account_activation_code
                                                 ))->row();

     $check_data_user=$db_global__user->query("SELECT username,name,email
                                               FROM profile
                                               WHERE username= ?
                                                     AND deleted_at IS NULL",
                                               array(
                                                 $data->username
                                               ))->row();

      if(!is_null($check_data_auth) && !is_null($check_data_user)){
        $db_authentication->trans_begin();
        $db_global__user->trans_begin();

        $db_authentication->query("UPDATE user_login
                                   SET status=1,
                                       account_activation_time= ?,
                                       updated_at= ?
                                   WHERE username= ?
                                         AND account_activation_code= ?
                                         AND status=0
                                         AND deleted_at IS NULL",
                                   array(
                                     $data->current_time,
                                     $data->current_time,
                                     $data->username,
                                     $data->account_activation_code
                                   ));
         $db_global__user->query("UPDATE profile
                                  SET validated_email_at= ?,
                                      updated_at= ?
                                  WHERE username= ?
                                        AND validated_email_at IS NULL
                                        AND deleted_at IS NULL",
                                    array(
                                      $data->current_time,
                                      $data->current_time,
                                      $data->username
                                    ));

          if($db_authentication->trans_status() === FALSE || $db_global__user->trans_status() === FALSE){
            $db_authentication->trans_rollback();
            $db_global__user->trans_rollback();
            $response=(object)array(
                         "status"  => FALSE
                      );
          }else{
            $db_authentication->trans_commit();
            $db_global__user->trans_commit();
            $response=(object)array(
                         "status"  => TRUE,
                         "data"    => $check_data_user
                      );
          }
      }else{
        $response=(object)array(
                     "status"  => FALSE
                  );
      }
      return $response;
   }


}

?>
