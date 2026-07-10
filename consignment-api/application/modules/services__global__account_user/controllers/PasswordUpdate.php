<?php
	class PasswordUpdate extends CI_Controller{

		public function __construct(){
			parent::__construct();
      $this->load->model('PasswordUpdateModel');
			$this->load->model('AuthenticationModel');
			$this->load->model('AccountUserSchema');
		}

		public function update__PATCH(){
			allowedMethod(array("PATCH"));

			$jwt_decode=jwt_decode('BEARER-FROM-HEADER');
      if($jwt_decode->message=="OK"){
				//data from bearer
				$jwt_data=$jwt_decode->payload->data;
        $username=$jwt_data->username;

        //data from body
        $dt_old_password=$this->input->input_stream('old_password',TRUE);
        $dt_new_password=$this->input->input_stream('new_password',TRUE);

				#check
	      $check=$this->AccountUserSchema->checkPasswordDB($username,$dt_old_password);

				if($check->message=="OK"){
					$check_new_password=$this->AccountUserSchema->checkPassword($dt_new_password);
					if($check_new_password->message=="OK"){
							$this->load->helper('cryptmgr');
							$cred=crypt_generateSaltedPassword($dt_new_password);
							$update=$this->PasswordUpdateModel->updatePassword($username,$cred);
							if($update==TRUE){
								$data = (object)array(
                  "text"  => $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__UPDATE_PASSWORD__SUCCESS')
                );
								$response=setResponseHTTP(200,'',$data);
							}else{
								$response=setResponseHTTP(400);
							}
					}else{
						$response=setResponseHTTP(200,"FAILED",$check_new_password->data);
					}
				}else{
					$response=setResponseHTTP(200,"FAILED",$check->data);
				}
			}else{
        $response=setResponseHTTP(401,$jwt_decode->message);
      }

			//OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;

		}


	}
