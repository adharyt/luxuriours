<?php
 class PasswordUpdateModel extends CI_Model {

   function __construct(){

   }

   public function updatePassword($username,$cred){
     $db_authentication = $this->load->database('global__authentication', TRUE);

     $response=$db_authentication->query("UPDATE user_login
                                               SET password= ?,
                                                   salt= ?
                                          WHERE username= ?
                                              AND deleted_at IS NULL",
                                          array(
                                            $cred->g_password,
                                            $cred->g_salt,
                                            $username
                                          ));
     return TRUE;
   }

}

?>
