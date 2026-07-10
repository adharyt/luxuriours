<?php
 class ConfigModel extends CI_Model {

   function __construct(){

   }


   public function getAppInfo($key){
     $db_config = $this->load->database('daemon__config', TRUE);

     $db_config->cache_on();
     $data=$db_config->query("SELECT `value` FROM app_info WHERE `key`='$key'")->row();
     return $data->value;
   }

   public function getAppInfo_renewable_file__link($key,$files){
     $db_config = $this->load->database('daemon__config', TRUE);

     $db_config->cache_on();
     $public_path=$db_config->query("SELECT `value` FROM app_info WHERE `key`='$key'")->row();

     $key=$key.'__ABSOLUTE';
     $absolute_path=$db_config->query("SELECT `value` FROM app_info WHERE `key`='$key'")->row();

     return $public_path->value.'/'.$files.'?version='.date("YmdHis", filemtime($absolute_path->value.'/'.$files));
   }


   public function getBusinessInfo($key){
     $db_config = $this->load->database('daemon__config', TRUE);

     $db_config->cache_on();
     $data=$db_config->query("SELECT `value` FROM business_info WHERE `key`='$key'")->row();
     return $data->value;
   }


   public function getEndpoint($base_url,$key){
     $db_config = $this->load->database('daemon__config', TRUE);

     $db_config->cache_on();
     $data=$db_config->query("SELECT b.`key` as key_base,
                                    e.`key` as key_endpoint,
                                    b.`ci_path`,
                                    e.`ci_path_function`,
                                    b.`link_local`,
                                    b.`link_public`,
                                    e.`value` as endpoint,
                                    e.`allowed_method`
                             FROM link_base_url AS b
                                  INNER JOIN link_endpoint AS e ON b.`key`=e.`base_url`
                             WHERE b.`key`='$base_url'
                                   AND e.`key`='$key'
                             ")->row();
     return $data;
   }

   public function getAllRoutes($visibility='all'){
     $db_config = $this->load->database('daemon__config', TRUE);

     switch($visibility){
       default:
       case 'all':
          $where_clause="WHERE `visibility` in('all','user','admin')";
          break;
       case 'user':
          $where_clause="WHERE `visibility` in('user','all')";
          break;
       case 'admin':
          $where_clause="WHERE `visibility` in('admin','all')";
          break;
     }

     $db_config->cache_on();
     $data=$db_config->query("SELECT b.`link_public`,
                                    b.`key` as key_base,
                                    e.`key` as key_endpoint,
                                    b.`ci_path`,
                                    e.`ci_path_function`,
                                    e.`value` as endpoint,
                                    e.`visibility`,
                                    e.`type`,
                                    e.`expose_local`,
                                    e.`expose_public`,
                                    e.`allowed_method`
                             FROM link_base_url AS b
                                  INNER JOIN link_endpoint AS e ON b.`key`=e.`base_url`
                                  $where_clause
                             ")->result();
     return $data;
   }

   public function getMenus($category,$id_parent=NULL){
     $db_config = $this->load->database('daemon__config', TRUE);

     if($id_parent==NULL){
       $where_clause="AND id_parent IS NULL";
     }else{
       $where_clause="AND id_parent='$id_parent'";
     }

     $db_config->cache_on();
     $data=$db_config->query("SELECT * FROM `menu`
                             WHERE `category`= ?
                                   AND `is_active`=1
                                   AND `deleted_at` IS NULL
                                   $where_clause
                             ORDER BY `order` ASC,`created_at` ASC",
                             array(
                               $category
                             ))->result();
     return $data;
   }

   public function getMailerAccount($id){
     $db_config = $this->load->database('daemon__config', TRUE);

     $db_config->cache_on();
     $data=$db_config->query("SELECT * FROM mailer_account WHERE `id`='$id' and deleted_at is null")->row();
     return $data;
   }

   public function fetchBusinessInfo(){
     $db_config = $this->load->database('daemon__config', TRUE);

     $db_config->cache_off();
     $data=$db_config->query("SELECT * FROM business_info")->result();
     $db_config->cache_on();
     return $data;
   }

   public function fetchMailerAccount(){
     $db_config = $this->load->database('daemon__config', TRUE);

     $db_config->cache_off();
     $data=$db_config->query("SELECT * FROM mailer_account WHERE deleted_at is null")->result();
     $db_config->cache_on();
     return $data;
   }





}

?>
