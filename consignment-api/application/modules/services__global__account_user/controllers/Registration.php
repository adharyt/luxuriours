<?php
	class Registration extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('AccountUserSchema');
      $this->load->model('RegistrationModel');
		}

		public function register__POST(){
			allowedMethod(array("POST"));

			$name       = strtoupper($this->input->post('name'));
      $username   = strtolower($this->input->post('username'));
      $phone      = $this->input->post('phone');
      $email      = strtolower($this->input->post('email'));
      $password   = $this->input->post('password');
      $gender     = $this->AccountUserSchema->checkGender($this->input->post('gender'));
      $birthdate  = $this->AccountUserSchema->checkBirthdate($this->input->post('date'));

      $fault=array();

      $t_check=$this->AccountUserSchema->checkName($name);
      if($t_check->message!="OK"){array_push($fault,$t_check->data);}
      $t_check=$this->AccountUserSchema->checkUsername($username);
      if($t_check->message!="OK"){array_push($fault,$t_check->data);}
      $t_check=$this->AccountUserSchema->checkPhone($phone, $username);
      if($t_check->message!="OK"){array_push($fault,$t_check->data);}
      $t_check=$this->AccountUserSchema->checkEmail($email, $username);
      if($t_check->message!="OK"){array_push($fault,$t_check->data);}
      $t_check=$this->AccountUserSchema->checkPassword($password);
      if($t_check->message!="OK"){array_push($fault,$t_check->data);}

      if(!empty($fault)){
        $response=setResponseHTTP(200,"FAILED",$fault);
      }else{
        $this->load->helper('cryptmgr');

        $cred=crypt_generateSaltedPassword($password);
        $created_at=$this->config->item('current_datetime');
        $dt_expired_time=datetime_manipulate($created_at,'+45 minutes');
        $dt_account_activation_code=crypt_generateRandomString(50);

				//create link
				$t_endpoint=$this->ConfigModel->getEndpoint("services__global__account_user","Registration/activation__GET");
				$dt_link=$t_endpoint->link_public.'/'.$t_endpoint->endpoint.'?username='.$username.'&code='.$dt_account_activation_code;

        $registration_data=(object)array(
            #global data
            "username"                        => $username,
            "created_at"                      => $created_at,
            #authentication data
            "registration_source"             => 'WEB',
            "registration_api"                => 'NONE',
            "salt"                            => $cred->g_salt,
            "hashed_password"                 => $cred->g_password,
            "account_activation_expiry_time"  => $dt_expired_time,
            "account_activation_code"         => $dt_account_activation_code,
            "account_status"                  => 0,
            #user data from Body
            "name"                            => $name,
            "phone"                           => $phone,
            "email"                           => $email,
            "gender"                          => $gender,
            "birthdate"                       => $birthdate
        );
        $register=$this->RegistrationModel->create_user($registration_data);

        if($register==TRUE){
          $this->load->model('services__global__mailer/MailerModel');
          $data_cron=(object)array(
              "endpoint"    => "userAccountRegistration",
              "mailer"      => "user-account",
              "data"        => (object)array(
                                "subject" 		=> "Aktivasi akun ".$this->ConfigModel->getBusinessInfo('NAME'),
                                "template"		=> "account-user/registration_confirmation",
                                "receivers" 	=> array(
																									(object)array(
			                                              "username"  => $username,
			                                              "email"     => $email,
			                                              "name"      => $name
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
			                                              "name"                => $name,
			                                              "expired_time"        => $dt_expired_time,
			                                              "link"                => $dt_link
			                                          )
                            ),
              "created_at"  => $created_at
          );
          $send_email=$this->MailerModel->addToQueue($data_cron);
          $response=setResponseHTTP(200);
        }else{
          $response=setResponseHTTP(400);
        }

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

			//FETCH POST DATA
			$username=$this->input->get('username');
			$code=$this->input->get('code');
			$created_at=datetime_getCurrent();

      $activation_data=(object)array(
        "username"                => $username,
        "account_activation_code" => $code,
        "current_time"            => $this->config->item('current_datetime')
      );

      $activate=$this->RegistrationModel->activate_user($activation_data);

      if($activate->status==TRUE){
        $this->load->model('services__global__mailer/MailerModel');

        $name=$activate->data->name;
        $email=$activate->data->email;
        $data_cron=(object)array(
            "endpoint"    => "userAccountRegistrationActivate",
            "mailer"      => "user-account",
            "data"        => (object)array(
                              "subject" 		=> "Aktivasi akun ".$this->ConfigModel->getBusinessInfo('NAME')." berhasil!",
                              "template"		=> "account-user/registration_activation",
                              "receivers" 	=> array(
																								(object)array(
                                            			"username"  => $username,
                                            			"email"     => $email,
                                            			"name"      => $name
                                        				)
																			     		 ),
														 "cc"						=> array(),
															"bcc"					=> array(),
															"attachment" 	=> array(),
		                          "content" 		=> (object)array(
		                                            "business_name"       => $this->ConfigModel->getBusinessInfo('NAME'),
		                                            "business_name_legal" => $this->ConfigModel->getBusinessInfo('NAME_LEGAL'),
		                                            "business_email"      => $this->ConfigModel->getBusinessInfo('CONTACT_EMAIL'),
		                                            "logo"                => $this->ConfigModel->getAppInfo('LOGO'),
		                                            "banner"              => $this->ConfigModel->getAppInfo('PATH_ASSETS').'/banner.jpg',
		                                            "name"                => $name,
		                                            "link_login"          => base_url('login')
		                                        )
                          ),
            "created_at"  => $created_at
        );
        $send_email=$this->MailerModel->addToQueue($data_cron);
        $response=setResponseHTTP(200);
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


	}
