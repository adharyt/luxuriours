<?php
	class User extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('UserModel');
		}

		public function publicUserData__GET(){
			allowedMethod(array("GET"));

      $username=$this->input->get('username');
      $f_userdata = $this->UserModel->getPublicUser($username);

      if(!is_null($f_userdata)){
        if(!is_null($f_userdata->photo)){
          $photo=$this->ConfigModel->getAppInfo('PATH__ASSETS_USERDATA').'/'.$f_userdata->username.'/my-data/profilepicture/'.$f_userdata->photo;
        }else{
          $photo=$this->ConfigModel->getAppInfo('PATH__ASSETS_SHARED').'/'.'images/image-default/default_user_'.strtolower($f_userdata->gender).'.svg';
        }
        $data=(object)array(
          "name"    => $f_userdata->name,
          "gender"  => $f_userdata->gender,
          "photo"   => $photo
        );
        $response=setResponseHTTP(200,"OK",$data);
      }else{
        $response=setResponseHTTP(404);
      }

      //OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;
		}

    public function confidentialUserData__GET(){
			allowedMethod(array("GET"));

			$jwt_decode=jwt_decode('BEARER-FROM-HEADER');
      if($jwt_decode->message=="OK"){
				$jwt_data=$jwt_decode->payload->data;
        $username=$jwt_data->username;
        $f_userdata = $this->UserModel->getConfidentialUser($username);

        if(!is_null($f_userdata)){
          if(!is_null($f_userdata->photo)){
            $photo=$this->ConfigModel->getAppInfo('PATH__ASSETS_USERDATA').'/'.$f_userdata->username.'/my-data/profilepicture/'.$f_userdata->photo;
          }else{
            $photo=$this->ConfigModel->getAppInfo('PATH__ASSETS_SHARED').'/'.'images/image-default/default_user_'.strtolower($f_userdata->gender).'.svg';
          }
          $data=(object)array(
            "name"          			=> $f_userdata->name,
            "gender"        			=> $f_userdata->gender,
            "photo"         			=> $photo,
            "birthdate"     			=> $f_userdata->birthdate,
            "email"         			=> $f_userdata->email,
            "phone"        			  => $f_userdata->phone,
						"validated_email_at"	=> $f_userdata->validated_email_at,
						"validated_phone_at"	=> $f_userdata->validated_phone_at,
            "register_date" 			=> $f_userdata->register_date
          );
          $response=setResponseHTTP(200,"OK",$data);
        }else{
          $response=setResponseHTTP(404);
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

		public function updateUserData__PATCH(){
			allowedMethod(array("PATCH"));

			$jwt_decode=jwt_decode('BEARER-FROM-HEADER');
      if($jwt_decode->message=="OK"){
				$jwt_data=$jwt_decode->payload->data;

				$username=$jwt_data->username;
				$name=$this->input->input_stream('name',TRUE);
				$phone=$this->input->input_stream('phone',TRUE);
				$gender= $this->input->input_stream('gender',TRUE);
	      $birthdate= $this->input->input_stream('birthdate',TRUE);

				$fault=array();

				//CHECK IS VALID NAME
				$t_endpoint=$this->ConfigModel->getEndpoint("services__global__account_user","CheckData/Check__POST");
				$payload_req_0=(object)array(
					"user"				=> $username,
					"request"			=> (object)array(
						"method"		=> "POST",
						"endpoint"	=> $t_endpoint->link_local.'/'.$t_endpoint->endpoint,
						"data"			=> array(
														"endpoint"	=> 'name',
														"value"			=> $name
													),
						"auth"			=> (object)array(
														"type" => "jwt-bearer-token",
														"token"	=> jwt_getBearerToken()
												),
						"expected"	=> array(200)
					),
					"response"	=> NULL
				);
				$payload_req_0->response=callAPI($payload_req_0);

				if(in_array($payload_req_0->response->code,$payload_req_0->request->expected)){
					$response_api=json_decode($payload_req_0->response->body);
					if($response_api->message!="OK"){
						array_push($fault,$response_api->data);
					}
				}else{
					$data=(object)array(
						"error"	=> "API_CALL__FAILED",
						"data"	=> array(
												$payload_req_0
										)
					);
					$this->MonitorModel->API_CALL__log_failed__insert(json_encode($data));
					array_push($fault,"ERROR");
				}

				//CHECK IS VALID PHONE
				$t_endpoint=$this->ConfigModel->getEndpoint("services__global__account_user","CheckData/Check__POST");
				$payload_req_0=(object)array(
					"user"				=> $username,
					"request"			=> (object)array(
						"method"		=> "POST",
						"endpoint"	=> $t_endpoint->link_local.'/'.$t_endpoint->endpoint,
						"data"			=> array(
														"endpoint"	=> 'phone',
														"value"			=> $phone
													),
						"auth"			=> (object)array(
														"type" => "jwt-bearer-token",
														"token"	=> jwt_getBearerToken()
												),
						"expected"	=> array(200)
					),
					"response"	=> NULL
				);
				$payload_req_0->response=callAPI($payload_req_0);

				if(in_array($payload_req_0->response->code,$payload_req_0->request->expected)){
					$response_api=json_decode($payload_req_0->response->body);
					if($response_api->message!="OK"){
						array_push($fault,$response_api->data);
					}
				}else{
					$data=(object)array(
						"error"	=> "API_CALL__FAILED",
						"data"	=> array(
												$payload_req_0
										)
					);
					$this->MonitorModel->API_CALL__log_failed__insert(json_encode($data));
					array_push($fault,"ERROR");
				}

	      if(!empty($fault)){
	        $response=setResponseHTTP(200,"FAILED",$fault);
	      }else{
					$data_update=(object)array(
						"name"			=> $name,
						"birthdate"	=> $birthdate,
						"phone"			=> $phone,
						"gender"		=> $gender,
						"username"	=> $jwt_data->username
					);

					$update=$this->UserModel->updateUserData($data_update);
					if($update==TRUE){
						$response=setResponseHTTP(200,"OK");
					}else{
						$response=setResponseHTTP(400);
					}
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

		public function updateUserPhoto__POST(){
			 allowedMethod(array("POST"));

			 $jwt_decode=jwt_decode('BEARER-FROM-HEADER');
       if($jwt_decode->message=="OK"){
			 	 $username=$jwt_decode->payload->data->username;

				 if($this->input->post('image')!=''){
					 $this->load->helper('files');
					 $image_to_upload=base64ToImage($this->input->post('image'));
				 }else{
					 $image_to_upload = $_FILES['image'];
				 }

				 if(!is_null($image_to_upload['tmp_name']) && $image_to_upload['tmp_name']!='' ){
					 if(exif_imagetype($image_to_upload['tmp_name'])){
						$image_mime=$image_to_upload['type'];
						$extension =explode("/", $image_mime)[1];

						//UPLOAD DATA
						$t_endpoint=$this->ConfigModel->getEndpoint("services__global__assets_uploader","UserProfile/profile_picture__POST");
						$upload_data=(object)array(
							"user"				=> $username,
							"request"			=> (object)array(
								"method"		=> "POST",
								"endpoint"	=> $t_endpoint->link_local.'/'.$t_endpoint->endpoint,
								"data"			=> array(
																'fileToUpload' => curl_file_create($image_to_upload['tmp_name'],$image_mime,'temp_image.'.$extension)
															),
								"auth"			=> (object)array(
																"type" => "jwt-bearer-token",
																"token"	=> jwt_getBearerToken()
														),
								"expected"	=> array(200)
							),
							"response"	=> NULL
						);
						$upload_data->response=callAPI($upload_data);

						if(in_array($upload_data->response->code,$upload_data->request->expected)){
							$response_api=json_decode($upload_data->response->body);
							if($response_api->message=="OK"){
								$data_update=(object)array(
									"photo"			=> $response_api->data->file_name,
									"username"	=> $username
								);

								$update=$this->UserModel->updateUserProfilePhoto($data_update);
								if($update==TRUE){
									$data_response=(object)array(
										'file_name'	=> $this->ConfigModel->getAppInfo('PATH__ASSETS_USERDATA').'/'.$username.'/'.$this->ConfigModel->getAppInfo('PATH__ASSETS_USERDATA_SUB__PROFILE_PICTURE').'/'.$response_api->data->file_name
									);
									$response=setResponseHTTP(200,"OK",$data_response);
								}else{
									$response=setResponseHTTP(400,"UPDATE_DB_FAILED");
								}
							}else{
								$response=setResponseHTTP(400,$response_api->message);
							}
						}else{
							$data=(object)array(
								"error"	=> "API_CALL__FAILED",
								"data"	=> array(
														$upload_data
												)
							);
							$this->MonitorModel->API_CALL__log_failed__insert(json_encode($data));
							$response=setResponseHTTP(500,"NETWORK_ERROR");
						}
					}else{
						$response=setResponseHTTP(400,"IMAGE_NOT_VALID");
					}
				 }else{
					 $response=setResponseHTTP(400,"NO_UPLOADED_DATA");
				 }
			}else{
				$response=setResponseHTTP(401);
			}
			//OUTPUT
			$this->output->set_status_header($response->code)
			 						 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;
		}

	}
