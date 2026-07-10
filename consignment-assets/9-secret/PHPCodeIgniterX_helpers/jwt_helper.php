<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use \Firebase\JWT\JWT;

function jwt_encode($data,$expiry_time=7200){
  require_once APPPATH . 'third_party/Firebase/JWT/JWT.php';
  $issued_at=time();

  $payload=array(
    "iss" => "consignment-general-user",
    "aud" => "consignment.id",
    "iat" => $issued_at, //issued at
    //"nbf" => $issued_at+10, //not before claim
    "exp" => $issued_at+$expiry_time, //expire claim
    "data" => $data
  );


  $token = JWT::encode($payload, file_get_contents(APPPATH.'config/certificate/private.pem'), 'RS256');
  return $token;
}

function jwt_decode($token='BEARER-FROM-HEADER'){
  require_once APPPATH . 'third_party/Firebase/JWT/JWT.php';

    if($token=='BEARER-FROM-HEADER'){
      if(isset(apache_request_headers()['Authorization'])){
        $token=jwt_getBearerToken();
      }else{
        $token='BLANK_TOKEN';
        $payload = $response=(object)array(
          "message"  => "NO_HEADER"
        );
      }
    }

    if($token!='BLANK_TOKEN'){
      $payload = JWT::decode($token, file_get_contents(APPPATH.'config/certificate/public.pem'), array('RS256'));
    }else{
      $payload = $response=(object)array(
        "message"  => "BLANK_TOKEN"
      );
    }

  return $payload;
}

function jwt_getBearerToken(){
  if(isset(apache_request_headers()['Authorization'])){
    $token=str_replace("Bearer ","",apache_request_headers()['Authorization']);
  }else{
    $token="BLANK_TOKEN";
  }
  return $token;
}

function jwt_session($token,$allowed_entity){
  $jwt_decode=jwt_decode($token);
  if($jwt_decode->message=="OK"){
    $jwt_data=$jwt_decode->payload->data;
    if(isset($jwt_data->is_login)==TRUE){
      $check=TRUE;
      $entity="user";
    }else if(isset($jwt_data->is_admin_login)==TRUE){
      $check=TRUE;
      $entity="admin";
    }else{
      $check=FALSE;
    }
    if($check==TRUE){
      if(in_array($entity,$allowed_entity)){
        $response=(object)array(
          "authenticated" => TRUE,
          "message"       => $jwt_decode->message,
          "data"          => $jwt_data
        );
      }else{
        $response=(object)array(
          "authenticated" => FALSE,
          "message"       => "ENTITY_NOT_PERMITTED"
        );
      }
    }else{
      $response=(object)array(
        "authenticated" => FALSE,
        "message"       => "ENTITY_NOT_KNOWN"
      );
    }
  }else{
    $response=(object)array(
      "authenticated" => FALSE,
      "message"       => $jwt_decode->message
    );
  }
  return $response;
}

function jwt_isLogin($entity='user'){
  $ci =& get_instance();

  switch($entity){
    default:
    case 'user':
      $var='is_login';
      break;
    case 'admin':
      $var='is_admin_login';
      break;
  }

  if($ci->session->userdata($var)==TRUE){
    $jwt_decode=jwt_decode($ci->session->userdata('jwt'));
    if($jwt_decode->message=="OK"){
      $data=$jwt_decode->payload->data;
      if($data->{$var}==TRUE){
        $response=(object)array(
          'status'  => TRUE,
          'message' => $jwt_decode->message,
          'data'    => $data
        );
      }else{
        $response=(object)array(
          'status'  => FALSE,
          'message'   => "LOGIN_JWT_NOT_SET"
        );
      }
    }else{
      $response=(object)array(
        'status'  => FALSE,
        'message'   => $jwt_decode->message
      );
    }
  }else{
    $response=(object)array(
      'status'  => FALSE,
      'message'   => "LOGIN_SESSION_NOT_SET"
    );
  }

  return $response;
}


?>
