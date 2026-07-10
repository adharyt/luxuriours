<?php
	class AdminAuthentication extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('AdminAuthenticationModel');
		}

		public function update_session__GET(){
			allowedMethod(array("GET"));

			$token=jwt_getBearerToken();
			$jwt_decode=jwt_decode($token);
      if($jwt_decode->message=="OK"){
				$jwt_data=$jwt_decode->payload->data;
				$username=$jwt_data->username;

				//CEK DATA BERDASARKAN USERNAME
	      $userdata=$this->AdminAuthenticationModel->checkDataByUsername($username);

	      //CEK APAKAH DATA USER ADA DI DATABASE
	      if(isset($userdata)){

					if(1>0){
						//SET DATA SESSION
						$data_session = array(
																'user_id' => $username,
																'username' => $username,
																'language' => $userdata->language,
																'registered_date' => $userdata->created_at,
																'status' => $userdata->status,
																'is_admin_login' => TRUE
															);
						//KIRIM RESPON BAHWA USERNAME/EMAIL TIDAK DITEMUKAN
						$data_response=(object)array(
							"new_token"  =>  jwt_encode($data_session)
						);
		        $response=setResponseHTTP(200,"OK",$data_response);
					}else{
						$data=(object)array(
							"error"	=> "API_CALL__FAILED",
							"data"	=> array(
													$payload_req_0
											)
						);
						$this->MonitorModel->API_CALL__log_failed__insert(json_encode($data));
						$data_response=(object)array(
							"text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__AUTHENTICATION__NETWORK_ERROR')
						);
						$response=setResponseHTTP(500,"NETWORK_ERROR",$data_response);
					}
				}else{
					//KIRIM RESPON BAHWA USERNAME/EMAIL TIDAK DITEMUKAN
					$data_response=(object)array(
						"text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__AUTHENTICATION__NOT_REGISTERED')
					);
	        $response=setResponseHTTP(200,"NOT_REGISTERED",$data_response);
				}
			}else{
				$data_response=(object)array(
					"text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__AUTHENTICATION__NETWORK_ERROR')
				);
				$response=setResponseHTTP(401,"NOT_AUTHENTICATED",$data_response);
			}
			//OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;

		}

		public function login__POST(){
			allowedMethod(array("POST"));

      //FETCH POST DATA
      $user_login = strtolower($this->input->post('username'));
      $password = $this->input->post('password');

      //CEK DATA BERDASARKAN USERNAME
      $userdata=$this->AdminAuthenticationModel->checkDataByUsername($user_login);

      //CEK APAKAH DATA USER ADA DI DATABASE
      if(isset($userdata)){
        //FETCH DATA DARI QUERY
        $password_db=$userdata->password;
        $salt_db=$userdata->salt;
        $status=$userdata->status;
        $username=$userdata->username;
        $privilege=$userdata->privilege;
				$language=$userdata->language;

        //GENERATE PASSWORD TO BE VERIFIED
				$this->load->helper('cryptmgr');
				$password_to_verify=crypt_hashPassword($password,$salt_db,$hash=FALSE);

        //CEK APAKAH PASSWORD YANG DIINPUT OLEH USER SESUAI DENGAN YANG ADA DI DATABASE ATAU TIDAK
        if(password_verify($password_to_verify,$password_db)){

            //CEK STATUS USER
            switch($status){
              case '0':
                //JIKA STATUS=0 MAKA KIRIM RESPON BAHWA AKUN BELUM DIVALIDASI
								$data_response=(object)array(
			          	"text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__AUTHENTICATION__NOT_VALIDATE')
			          );
                $response=setResponseHTTP(200,"NOT_VALIDATE",$data_response);
                break;
              case '1':

                //JIKA STATUS=1 MAKA AKUN AKTIF
								$this->load->library('user_agent');
                if ($this->agent->is_browser()){
                   $agent = $this->agent->browser().' '.$this->agent->version();
                }else if ($this->agent->is_robot()){
                   $agent = $this->agent->robot();
                }else if ($this->agent->is_mobile()){
                   $agent = $this->agent->mobile();
                }else{
                   $agent = 'Unidentified User Agent';
                }

								//CREATE TEMPORARY JWT
                $temp_token_data=array(
                  'username' => $username
                );
                $temp_jwt=jwt_encode($temp_token_data,120);


								if(1>0){

	                //SET DATA SESSION
	                $data_session = array(
	                                    'username' => $username,
																			'language' => $language,
	                                    'registered_date' => $userdata->created_at,
	                                    'status' => $status,
	                                    'is_admin_login' => TRUE
	                                  );
									$data_session['jwt']=jwt_encode($data_session);

	                //INSERT SESSION LOG
	                $data_session_log=(object)array(
	                  "session_id"=>$data_session['jwt'],
	                  "username"=>$userdata->username,
	                  "agent"=>$agent,
	                  "platform"=>$this->agent->platform(),
	                  "ip_address"=>$this->input->ip_address(),
										"jwt"=>$data_session['jwt']
	                );
	                $this->AdminAuthenticationModel->insertLog($data_session_log);

	                // KIRIM RESPON LOGIN SUKSES
									$data_response=(object)array(
				          	"text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__AUTHENTICATION__PASSWORD_MATCH'),
										"jwt"	  => $data_session['jwt']
				          );
	                $response=setResponseHTTP(200,"PASSWORD_MATCH",$data_response);
								}else{
									$data=(object)array(
										"error"	=> "API_CALL__FAILED",
										"data"	=> array(
																$payload_req_0
														)
									);
									$this->MonitorModel->API_CALL__log_failed__insert(json_encode($data));

									$data_response=(object)array(
				          	"text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__AUTHENTICATION__NETWORK_ERROR')
				          );
									$response=setResponseHTTP(500,"NETWORK_ERROR",$data_response);
								}
                break;
              case '2':
                // KIRIM RESPON BAHWA AKUN DIBLOKIR
								$data_response=(object)array(
									"text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__AUTHENTICATION__ACCOUNT_BLOCKED')
								);
                $response=setResponseHTTP(200,"ACCOUNT_BLOCKED",$data_response);
                break;
              case '3':
								$data_response=(object)array(
									"text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__AUTHENTICATION__ACCOUNT_BLOCK_PERMANENT')
								);
                $response=setResponseHTTP(200,"ACCOUNT_BLOCK_PERMANENT",$data_response);
                break;
              default:
                //KIRIM RESPON BAHWA NETWORK ERROR
								$data_response=(object)array(
									"text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__AUTHENTICATION__NETWORK_ERROR')
								);
                $response=setResponseHTTP(500,"NETWORK_ERROR",$data_response);
                break;
          }
        }else{
          //KIRIM RESPON BAHWA PASSWORD SALAH
					$data_response=(object)array(
						"text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__AUTHENTICATION__WRONG_PASSWORD')
					);
          $response=setResponseHTTP(200,"WRONG_PASSWORD",$data_response);
        }
      }else{
        //KIRIM RESPON BAHWA USERNAME/EMAIL TIDAK DITEMUKAN
				$data_response=(object)array(
					"text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__AUTHENTICATION__NOT_REGISTERED')
				);
        $response=setResponseHTTP(200,"NOT_REGISTERED",$data_response);
      }
			//OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;

		}


	}
