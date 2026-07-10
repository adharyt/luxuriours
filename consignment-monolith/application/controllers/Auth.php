<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ini comment
	class Auth extends CI_Controller{

		public function setSession(){
			$token=jwt_getBearerToken();
			$jwt_decode=jwt_decode($token);
      if($jwt_decode->message=="OK"){
				if($jwt_decode->payload->data->is_login==TRUE){
          $jwt_data=(array)$jwt_decode->payload->data;
  				$jwt_data['jwt']=$token;
  				$this->session->set_userdata($jwt_data);
  				$data_response=(object)array(
  					"token"  =>  $token
  				);
          $response=setResponseHTTP(200,"OK",$data_response);
        }else{
          $response=setResponseHTTP(200,"LOGIN_JWT_NOT_SET");
        }
      }else{
        $response=setResponseHTTP(200,$jwt_decode->message);
      }

      //OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;
		}

		public function logout(){
			$this->session->sess_destroy();
			redirect(base_url());
		}
	}
