<?php
	class PasswordForgot extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('PasswordForgotModel');
			$this->load->model('AuthenticationModel');
			$this->load->model('UserModel');
			$this->load->model('AccountUserSchema');
		}

		public function request__POST(){
			allowedMethod(array("POST"));

			$this->load->helper('cryptmgr');
			//data from body
			$dt_email=$this->input->post('email');
			$dt_account_reset_password_code=crypt_generateRandomString(50);
      $dt_created_at=datetime_getCurrent();
      $dt_expired_time=datetime_manipulate($dt_created_at,'+ 45 minutes');

			//check userdata
			$data_user=$this->UserModel->checkUserdataByEmail($dt_email);

			if(!is_null($data_user)){
					$dt_name=$data_user->name;
	        $dt_username=$data_user->username;
	        $expired_data=(object)array(
						"username"										=> $dt_username,
						"account_reset_password_code"	=> $dt_account_reset_password_code,
						"created_at"									=> $dt_created_at,
						"expired_time"								=> $dt_expired_time
					);

					$request_reset=$this->PasswordForgotModel->request_reset($expired_data);
					if($request_reset->is_success==TRUE){
						$this->load->model('services__global__mailer/MailerModel');

						//create link
						$t_endpoint=$this->ConfigModel->getEndpoint("services__global__account_user","PasswordForgot/activation__GET");
						$dt_link=$t_endpoint->link_public.'/'.$t_endpoint->endpoint.'?username='.$dt_username.'&code='.$dt_account_reset_password_code;

	          $data_cron=(object)array(
	              "endpoint"    => "userAccountForgotPassword",
	              "mailer"      => "user-account",
	              "data"        => (object)array(
	                                "subject" 		=> "Lupa Password ".$this->ConfigModel->getBusinessInfo('NAME'),
	                                "template"		=> "account-user/password_forgot__request",
	                                "receivers" 	=> array(
																										(object)array(
																											"username"  => $dt_username,
																											"email"     => $dt_email,
																											"name"      => $dt_name
																										)
																									 ),
																	"cc"					=> array(),
																	"bcc"					=> array(),
																	"attachment" 	=> array(),
			                            "content" 		=> (object)array(
			                                              "business_name"       => $this->ConfigModel->getBusinessInfo('NAME'),
			                                              "business_name_legal" => $this->ConfigModel->getBusinessInfo('NAME_LEGAL'),
			                                              "business_email"      => $this->ConfigModel->getBusinessInfo('CONTACT_EMAIL'),
			                                              "logo"                => $this->ConfigModel->getAppInfo('LOGO'),
			                                              "banner"              => $this->ConfigModel->getAppInfo('PATH_ASSETS').'/banner.jpg',
			                                              "name"                => $dt_name,
			                                              "expired_time"        => $dt_expired_time,
			                                              "link"                => $t_endpoint
			                                          )
	                            ),
	              "created_at"  => $dt_created_at
	          );
	          $send_email=$this->MailerModel->addToQueue($data_cron);
	          $response=setResponseHTTP(200);
					}else{
						$data=(object)array(
							"text"	=> $request_reset->message
						);
						$response=setResponseHTTP(200,$request_reset->message,$data);
					}
			}else{
				$data=(object)array(
					"text"	=> "USER_NOT_FOUND"
				);
				$response=setResponseHTTP(200,"USER_NOT_FOUND",$data);
			}

			//OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;

		}

		public function activation__GET(){
			allowedMethod(array("GET"));

			$username=$this->input->get('username');
			$code=$this->input->get('code');

			$check=$this->PasswordForgotModel->check_data($username,$code);
			if(!is_null($check)){
				$response=setResponseHTTP(200,"OK");
			}else{
				$response=setResponseHTTP(200,"DATA_NOT_FOUND");
			}

			//OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;

		}

		public function reset__PATCH(){
			allowedMethod(array("PATCH"));

			$username=$this->input->input_stream('username',TRUE);
			$code=$this->input->input_stream('code',TRUE);
			$dt_new_password=$this->input->input_stream('password',TRUE);

			$check=$this->PasswordForgotModel->check_data($username,$code);
			if(!is_null($check)){
				$check_new_password=$this->AccountUserSchema->checkPassword($dt_new_password);
				if($check_new_password->message=="OK"){
					$this->load->model('PasswordUpdateModel');
					$this->load->helper('cryptmgr');

					$cred=crypt_generateSaltedPassword($dt_new_password);
					$update=$this->PasswordUpdateModel->updatePassword($username,$cred);
					if($update==TRUE){
						$data = (object)array(
							"text"  => $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__UPDATE_PASSWORD__SUCCESS')
						);
						$response=setResponseHTTP(200,'OK',$data);
					}else{
						$response=setResponseHTTP(400);
					}
				}else{
					$response=setResponseHTTP(200,"FAILED",$check_new_password->data);
				}

			}else{
				$data = (object)array(
					"text"  => "DATA_NOT_FOUND"
				);
				$response=setResponseHTTP(200,"FAILED",$data);
			}

			//OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;

		}

	}
