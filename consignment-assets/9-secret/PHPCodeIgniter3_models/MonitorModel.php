<?php
 class MonitorModel extends CI_Model {

   function __construct(){

   }

   public function API_CALL__log_failed__insert($data){
     $db_monitor = $this->load->database('daemon__monitor', TRUE);
     $data=$db_monitor->query("INSERT INTO `error__api_call`
                                          (`data`,`is_solved`,`created_at`)
                                   VALUES (?,0,now())
                            ",
                            array(
                              $data
                            ));
     return TRUE;
   }

}

?>
