<?php
 class Config_WordingModel extends CI_Model {

   function __construct(){

   }

   public function getWordingKey(){
     $db_language = $this->load->database('global__language', TRUE);
     $data=$db_language->query("SELECT `key`
                                FROM `wording`
                                GROUP BY `key`")->result();
     return $data;
   }

   public function fetchWording($language){
     $db_language = $this->load->database('global__language', TRUE);

     $column=array();
     $join_table=array();
     $where=array();
     foreach($language as $lang){
       array_push($column,",w_".$lang->id.".`value` as value_".$lang->id);
       array_push($join_table,"INNER JOIN `wording` as w_".$lang->id." ON wk.`key`=w_".$lang->id.'.`key`');
       array_push($where,"AND w_".$lang->id.".`language`='$lang->id'");
     }

     //JOIN
     $str_column=implode(" ",$column);
     $str_join_table=implode(" ",$join_table);
     $str_where=implode(" ",$where);

     $data= $db_language->query("SELECT wk.`key`
                                        $str_column
                                 FROM `wording` as wk
                                      $str_join_table
                                 WHERE 1=1 $str_where
                                 GROUP BY wk.`key`")->result();
     return $data;
   }

   public function checkWording($language,$key){
     $db_language = $this->load->database('global__language', TRUE);

     $column=array();
     $join_table=array();
     $where=array();
     foreach($language as $lang){
       array_push($column,",w_".$lang->id.".`value` as value_".$lang->id);
       array_push($join_table,"INNER JOIN `wording` as w_".$lang->id." ON wk.`key`=w_".$lang->id.'.`key`');
       array_push($where,"AND w_".$lang->id.".`language`='$lang->id'");
     }

     //JOIN
     $str_column=implode(" ",$column);
     $str_join_table=implode(" ",$join_table);
     $str_where=implode(" ",$where);

     $data= $db_language->query("SELECT wk.`key`
                                        $str_column
                                 FROM `wording` as wk
                                      $str_join_table
                                      AND wk.`key`= ?
                                 WHERE 1=1 $str_where
                                 GROUP BY wk.`key`",
                                 array(
                                   $key
                                 ));
     return $data;
   }

   public function addWording($final_data){
     $db_language = $this->load->database('global__language', TRUE);

     $db_language->trans_begin();
     foreach($final_data as $data){
       $db_language->query("INSERT INTO `wording`
                                  (`key`,`language`,`value`)
                                  VALUES
                                  (?,?,?)",
                                  array(
                                    $data->key,
                                    $data->language,
                                    $data->value
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

   public function editWording($final_data){
     $db_language = $this->load->database('global__language', TRUE);

     $db_language->trans_begin();
     foreach($final_data as $data){
       $db_language->query("UPDATE `wording`
                            SET `key`= ?,
                                `value` = ?
                            WHERE `key`=?
                                  AND `language`= ?",
                            array(
                              $data->key,
                              $data->value,
                              $data->current_key,
                              $data->language
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

   public function deleteWording($key){
     $db_language = $this->load->database('global__language', TRUE);
     $data=$db_language->query("DELETE FROM `wording`
                                WHERE `key`= ?",
                                array(
                                  $key
                                ));
     return TRUE;
   }


}

?>
