<?php
 class UserModel extends CI_Model {

   function __construct(){

   }

   public function checkUsername($value){
     $db_global_user = $this->load->database('global__user', TRUE);

     $response=$db_global_user->query("SELECT username
                                              FROM `profile`
                                              WHERE username= ?
                                                    AND deleted_at IS NULL",
                                              array(
                                                $value
                                              ))->row();
     return $response;
   }

   public function checkPhone($value,$username){
     $db_global_user = $this->load->database('global__user', TRUE);

     if($username!=NULL){
       $where_clause="AND username!='$username'";
     }else{
       $where_clause="";
     }

     $response=$db_global_user->query("SELECT phone
                                       FROM `profile`
                                       WHERE phone= ?
                                             AND deleted_at IS NULL
                                             $where_clause",
                                              array(
                                                $value
                                              ))->row();
     return $response;
   }

   public function checkEmail($value,$username){
     $db_global_user = $this->load->database('global__user', TRUE);

     if($username!=NULL){
       $where_clause="AND username!='$username'";
     }else{
       $where_clause="";
     }

     $response=$db_global_user->query("SELECT email
                                       FROM `profile`
                                       WHERE email= ?
                                             AND deleted_at IS NULL
                                             $where_clause",
                                              array(
                                                $value
                                              ))->row();
     return $response;
   }

   public function checkUserdataByEmail($email){
     $db_global_user = $this->load->database('global__user', TRUE);

     $response=$db_global_user->query("SELECT name,username
                                       FROM `profile`
                                       WHERE email= ?
                                             AND deleted_at IS NULL",
                                       array(
                                         $email
                                       ))->row();
     return $response;
   }

}

?>
