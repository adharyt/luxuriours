<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getSessionLanguage(){
  $ci =& get_instance();

  $available_language=array();
  foreach($ci->LanguageModel->getLanguage() as $lang){
    array_push($available_language,$lang->id);
  }

  if($ci->session->userdata('language')!=''){
     $language=$ci->session->userdata('language');
  }else{
    $language='ID';
  }


  if(!in_array($language,$available_language)){
    $language='ID';
  }

  return $language;
}

?>
