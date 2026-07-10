<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function setResponseHTTP($res=200,$msg='',$data=''){
  $ok_array=array(200,201);

  if($msg==''){
    if(in_array($res,$ok_array)){
      $msg="OK";
    }else{
      $msg="ERROR";
    }
  }

  switch($res){
    default:
    case 200:
      $response=(object)array(
        'code'  	=> 200,
        'body'  	=> array('status'  => $res, 'message' => $msg, 'data'=> $data)
      );
    break;
    case 201:
      $response=(object)array(
        'code'  	=> 201,
        'body'  	=> array('status'  => $res, 'message' => $msg, 'data'=> $data)
      );
    break;
    case 400:
      $response=(object)array(
        'code'  	=> 400,
        'body'  	=> array('status'  => $res, 'message' => $msg, 'data'=> $data)
      );
    break;
    case 401:
      $response=(object)array(
        'code'  	=> 401,
        'body'  	=> array('status'  => $res, 'message' => $msg, 'data'=> $data)
      );
    break;
    case 404:
      $response=(object)array(
        'code'  	=> 404,
        'body'  	=> array('status'  => $res, 'message' => $msg, 'data'=> $data)
      );
    break;
    case 405:
      $response=(object)array(
        'code'  	=> 405,
        'body'  	=> array('status'  => $res, 'message' => $msg, 'data'=> $data)
      );
    break;
    case 500:
      $response=(object)array(
        'code'  	=> 500,
        'body'  	=> array('status'  => $res, 'message' => $msg, 'data'=> $data)
      );
    break;

  }
  return $response;
}

function allowedMethod($allowed_method){
  $ci =& get_instance();
  if($ci->input->method(TRUE)=="OPTIONS"){
    $response=setResponseHTTP();
    $ci->output->set_status_header($response->code)
                ->set_content_type('application/json')
                ->set_output(json_encode($response->message),JSON_PRETTY_PRINT)
                ->_display();
    exit;
  }else if(!in_array($ci->input->method(TRUE),$allowed_method)){
    $ci->output->set_status_header(405)
                ->set_content_type('application/json')
                ->set_output(json_encode("Method not allowed."),JSON_PRETTY_PRINT)
                ->_display();
    exit;
  }

}

?>
