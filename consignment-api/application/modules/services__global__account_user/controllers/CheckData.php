<?php
	class CheckData extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('AccountUserSchema');
		}

		public function Check__POST(){
			allowedMethod(array("POST"));

			$endpoint=$this->input->post('endpoint');
			$value=$this->input->post('value');

			$jwt_decode=jwt_decode('BEARER-FROM-HEADER');
      if($jwt_decode->message=="OK"){
				$jwt_data=$jwt_decode->payload->data;
				$username=$jwt_data->username;
			}else if($jwt_decode->message=="NO_HEADER" || $jwt_decode->message=="BLANK_TOKEN"){
				$username=NULL;
			}else{
				//OUTPUT
				$this->output->set_status_header(401)
										 ->set_content_type('application/json')
										 ->set_output(json_encode($jwt_decode->message),JSON_PRETTY_PRINT)
										 ->_display();
				exit;
			}

			$fault=array();
			$checked=FALSE;

			switch($endpoint){
				case 'name':
					$check=$this->AccountUserSchema->checkName($value);
					$checked=TRUE;
					break;
				case 'username':
					$check=$this->AccountUserSchema->checkUsername($value);
					$checked=TRUE;
					break;
				case 'phone':
					$check=$this->AccountUserSchema->checkPhone($value,$username);
					$checked=TRUE;
					break;
				case 'email':
					$check=$this->AccountUserSchema->checkEmail($value,$username);
					$checked=TRUE;
					break;
				case 'password':
					$check=$this->AccountUserSchema->checkPassword($value);
					$checked=TRUE;
					break;
				case 'passworddb':
					$check=$this->AccountUserSchema->checkPasswordDB($username,$value);
					$checked=TRUE;
					break;
				default:
					$checked=FALSE;
					break;
			}

			if($checked==TRUE){
				$response=setResponseHTTP(200,$check->message,$check->data);
			}else{
				$response=setResponseHTTP(404,"ENDPOINT_NOT_FOUND");
			}

			//OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;


		}


	}
