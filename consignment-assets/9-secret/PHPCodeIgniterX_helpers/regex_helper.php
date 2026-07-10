<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  function regex_accountUser_validateName($value){
    $regex ='/^[A-Za-z ]{3,30}$/';
      if(preg_match($regex,$value)){
        $response=TRUE;
      }else{
        $response=FALSE;
      }
      return $response;
    }

    function regex_accountUser_validateUsername($value){
      $regex ='/^[a-z0-9]{4,25}$/';
        if(preg_match($regex,$value)){
          $response=TRUE;
        }else{
          $response=FALSE;
        }
        return $response;
    }

    function regex_accountUser_validatePhone($value){
      $regex ='/^62[8][0-9]{9,12}$/';
        if(preg_match($regex,$value)){
          $response=TRUE;
        }else{
          $response=FALSE;
        }
        return $response;
    }

    function regex_accountUser_validateEmail($value){
        if(filter_var($value, FILTER_VALIDATE_EMAIL)){
          $response=TRUE;
        }else{
          $response=FALSE;
        }
        return $response;
    }

    function regex_accountUser_validatePassword($value){
      $regex ='/^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,20}$/';
        if(preg_match($regex,$value)){
          $response=TRUE;
        }else{
          $response=FALSE;
        }
        return $response;
    }
?>
