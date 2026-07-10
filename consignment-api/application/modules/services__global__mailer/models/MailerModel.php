<?php
 class MailerModel extends CI_Model {

   function __construct(){

   }

   public function addToQueue($data){
     $db_mailer = $this->load->database('global__mailer', TRUE);

     $db_mailer->query("INSERT INTO `queue` (
                                              `endpoint`,
                                              `mailer`,
                                              `data`,
                                              `created_at`
                                            )
                                     VALUES (
                                              ?,
                                              ?,
                                              ?,
                                              ?
                                            )",
                                       array(
                                              $data->endpoint,
                                              $data->mailer,
                                              json_encode($data->data),
                                              $data->created_at
                                            ));
     return TRUE;
   }

   public function getFromQueue($by_mailer,$value,$id='LATEST'){
     if($by_mailer==TRUE){
       $where_clause_0="mailer=";
     }else{
       $where_clause_0="endpoint=";
     }

     if($id!="LATEST"){
       $where_clause_1="AND `id`='$id'";
     }else{
       $where_clause_1="";
     }

     $db_mailer = $this->load->database('global__mailer', TRUE);
     $data=$db_mailer->query("SELECT * FROM `queue`
                                       WHERE $where_clause_0 ?
                                             AND deleted_at is null
                                             AND try__is_success!=1
                                             AND try__count<5
                                             $where_clause_1
                                       ORDER BY created_at DESC
                                       LIMIT 1",
                                       array(
                                         $value
                                       ))->row();
     return $data;
   }

   public function updateQueueData($id,$data){
     $db_mailer = $this->load->database('global__mailer', TRUE);
     $data=$db_mailer->query("UPDATE `queue`
                              SET try__count=try__count+1,
                                  try__last_time= ?,
                                  try__last_message= ?,
                                  try__is_success= ?,
                                  updated_at= ?
                              WHERE id= ?",
                              array(
                                $data->try__last_time,
                                $data->try__last_message,
                                $data->try__is_success,
                                $data->updated_at,
                                $id
                              ));
     return TRUE;
   }


}

?>
