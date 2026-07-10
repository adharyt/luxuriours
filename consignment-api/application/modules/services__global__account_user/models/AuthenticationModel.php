<?php
 class AuthenticationModel extends CI_Model {

   function __construct(){

   }

   public function getAccountCredentials($username){
     $db_authentication = $this->load->database('global__authentication', TRUE);

     $response=$db_authentication->query("SELECT password,salt
                                          FROM user_login
                                          WHERE username= ?
                                              AND deleted_at IS NULL",
                                          array(
                                            $username
                                          ))->row();
     return $response;
   }

   public function checkUsername($value){
     $db_authentication = $this->load->database('global__authentication', TRUE);

     $response=$db_authentication->query("SELECT username
                                FROM `user_login`
                                WHERE username= ?",
                                array(
                                  $value
                                ))->row();
     return $response;
   }

}

?>
