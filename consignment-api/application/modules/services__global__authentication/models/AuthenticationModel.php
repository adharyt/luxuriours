<?php
 class AuthenticationModel extends CI_Model {

   function __construct(){

   }

   public function checkDataByUsername($user_login){
     $db_authentication = $this->load->database('global__authentication', TRUE);
     $data=$db_authentication->query("SELECT
                                      ul.username,
                                      ul.password,
                                      ul.salt,
                                      ul.status,
                                      ul.created_at,
                                      ul.language,
                                      ut.name as privilege
                               FROM user_login as ul
                                    INNER JOIN user_type as ut ON ul.user_type_id=ut.id
                               WHERE username= ?
                                     AND ul.deleted_at IS NULL
                               ORDER BY ul.created_at DESC
                               LIMIT 1",
                               array(
                                 $user_login
                               ))->row();

       return $data;
   }

   public function getAccountPrivilege($privilege){
     $db_authentication = $this->load->database('global__authentication', TRUE);
     $data=$db_authentication->query("SELECT
                              up.id as privilege_rules,
                              up.value as privilege_rules_value
                       FROM user_type as ut
                            INNER JOIN user_privilege as up ON ut.id=up.user_type_id
                       WHERE ut.name= ?
                             AND ut.deleted_at IS NULL
                             AND up.deleted_at IS NULL",
                       array(
                         $privilege
                       ))->result();

       $final_data=array();
       foreach($data as $x){
         $final_data+=array($x->privilege_rules => $x->privilege_rules_value);
       }
       return $final_data;
   }

   public function insertLog($data){
     $db_authentication = $this->load->database('global__authentication', TRUE);
     $db_authentication->query("INSERT INTO
                                user_log_session (session_id,username,agent,platform,ip_address,created_at,jwt)
                                VALUES (?,?,?,?,?,now(),?)",
                                array(
                                      $data->session_id,
                                      $data->username,
                                      $data->agent,
                                      $data->platform,
                                      $data->ip_address,
                                      $data->jwt
                                ));

       return $data;
   }

}

?>
