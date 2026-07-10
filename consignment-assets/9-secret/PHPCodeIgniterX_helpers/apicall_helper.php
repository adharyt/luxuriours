<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function callAPI($payload_req){
   $curl = curl_init();
   switch ($payload_req->request->method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if (!empty($payload_req->request->data))
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload_req->request->data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if (!empty($payload_req->request->data))
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload_req->request->data);
         break;
      default:
         if (!empty($payload_req->request->data))
            $payload_req->request->endpoint = sprintf("%s?%s", $payload_req->request->endpoint, http_build_query($payload_req->request->data));
   }
   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $payload_req->request->endpoint);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

   switch($payload_req->request->auth->type){
      default:
      case "no-auth":
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      break;
      case "jwt-bearer-token":
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$payload_req->request->auth->token));
      break;
   }

   // EXECUTE:
   $result = curl_exec($curl);
   $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
   if($result===false){
     $response=(object)array(
       "code"     => 500,
       "body"     => 'ERROR CODE '.curl_errno($curl).': '.curl_error($curl)
     );
    curl_close($curl);
    return($response);
   }
   curl_close($curl);
   $response=(object)array(
     "code"     => $httpcode,
     "body"     => $result
   );
   return $response;
}


function getResponseFromHTTPCall($payload){
  $ci =& get_instance();
  $payload->response=callAPI($payload);
  $body=json_decode($payload->response->body);
  if(in_array($payload->response->code,$payload->request->expected)){
    $response=(object)array(
      "status"  => TRUE,
      "code"    => $payload->response->code,
      "message" => $body->message,
      "data"    => $body->data
    );
  }else{
    $data=(object)array(
      "error"	=> "API_CALL__FAILED",
      "data"	=> array(
                  $payload
              )
    );
    $ci->MonitorModel->API_CALL__log_failed__insert(json_encode($data));
    $response=(object)array(
      "status"  => FALSE,
      "code"    => $payload->response->code
    );
  }
  return $response;
}

function callAPI_jwtAuth($method, $url, $data,$jwt){
   $curl = curl_init();
   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }
   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$jwt));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   // EXECUTE:
   $result = curl_exec($curl);
   $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
   if(!$result){
     $response=(object)array(
       "code"     => 500,
       "body"     => ""
     );
     die($response);
   }
   curl_close($curl);
   $response=(object)array(
     "code"     => $httpcode,
     "body"     => $result
   );
   return $response;
}

?>
