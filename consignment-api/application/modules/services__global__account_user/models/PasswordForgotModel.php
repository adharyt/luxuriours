<?php
 class PasswordForgotModel extends CI_Model {

   function __construct(){

   }

   public function request_reset($data){
     $db_authentication = $this->load->database('global__authentication', TRUE);

     $check_data_log_forgot_password=$db_authentication->query(
         "SELECT ul.username
          FROM user_log_forgot_password as ulfp
                    INNER JOIN user_login as ul ON ul.username=ulfp.username
          WHERE ulfp.username= ?
              AND ulfp.status=0
                     AND ul.status!=0
                     AND ul.deleted_at IS NULL",
          array(
            $data->username
          ))->row();

     if(empty($check_data_log_forgot_password)){
       $db_authentication->query(
           "INSERT INTO `user_log_forgot_password`
           (
            `username`,
            `account_reset_password_code`,
            `status`,
            `created_at`,
            `expired_time`
           )
           VALUES(
            ?,
            ?,
            '0',
            ?,
            ?
           )",
            array(
              $data->username,
              $data->account_reset_password_code,
              $data->created_at,
              $data->expired_time
            ));
        $response=(object)array(
          "is_success"  => TRUE
        );
     }else{
       $response=(object)array(
         "is_success"  => FALSE,
         "message"     => "ALREADY_SUBMITTED"
       );
     }
     return $response;
   }

   public function check_data($username,$code){
     $db_authentication = $this->load->database('global__authentication', TRUE);

     $check=$db_authentication->query(
         "SELECT ul.username
          FROM user_log_forgot_password as ulfp
                    INNER JOIN user_login as ul ON ul.username=ulfp.username
          WHERE ulfp.username= ?
                AND ulfp.account_reset_password_code= ?
                AND ulfp.status=0
                AND ul.status!=0
                AND ul.deleted_at IS NULL",
          array(
            $username,
            $code
          ))->row();

      return $check;   
   }

}

?>
