<?php
	class Config_Language extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('Config_LanguageModel');
		}

		public function index__GET(){
			allowedMethod(array("GET"));

			$session=jwt_session(jwt_getBearerToken(),array('admin'));
			if($session->authenticated==TRUE){
				$response=setResponseHTTP(200,"OK",$this->Config_LanguageModel->fetchLanguage());
			}else{
				$response=setResponseHTTP(401,$session->message);
			}
			//OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;
		}

		public function search__GET(){
			allowedMethod(array("GET"));

			$session=jwt_session(jwt_getBearerToken(),array('admin'));
			if($session->authenticated==TRUE){
				$data_req=(object)array(
					"id"						=> $this->input->get('id')
				);
				$data=$this->Config_LanguageModel->checkLanguage($data_req->id)->row();
				if(!is_null($data)){
					$response=setResponseHTTP(200,"OK",$data);
				}else{
					$response=setResponseHTTP(404);
				}
			}else{
				$response=setResponseHTTP(401,$session->message);
			}
			//OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;
		}

		public function index__POST(){
			allowedMethod(array("POST"));

			$session=jwt_session(jwt_getBearerToken(),array('admin'));
			if($session->authenticated==TRUE){
				$data=(object)array(
					"id"					 => $this->input->post('id'),
					"language"		 => $this->input->post('language'),
					"is_active"		 => $this->input->post('is_active'),
					"current_time" => datetime_getCurrent()
				);

				if($this->Config_LanguageModel->checkLanguage($data->id)->num_rows()==0){
					$exe=$this->Config_LanguageModel->addLanguage($data);
					if($exe==TRUE){
						$response=setResponseHTTP(200,"OK");
					}else{
						$response=setResponseHTTP(400);
					}
				}else{
					$response=setResponseHTTP(200,"DUPLICATE_PK");
				}
			}else{
				$response=setResponseHTTP(401,$session->message);
			}
			//OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;
		}

		public function index__PATCH(){
			allowedMethod(array("PATCH"));

			$session=jwt_session(jwt_getBearerToken(),array('admin'));
			if($session->authenticated==TRUE){
				$data=(object)array(
					"current_id"	 => $this->input->input_stream('current_id'),
					"id"					 => $this->input->input_stream('id'),
					"language"		 => $this->input->input_stream('language'),
					"is_active"		 => $this->input->input_stream('is_active'),
					"current_time" => datetime_getCurrent()
				);

				if($this->Config_LanguageModel->checkLanguage($data->id)->num_rows()<=1){
					$exe=$this->Config_LanguageModel->editLanguage($data);
					if($exe==TRUE){
						$response=setResponseHTTP(200,"OK");
					}else{
						$response=setResponseHTTP(400);
					}
				}else{
					$response=setResponseHTTP(200,"DUPLICATE_PK");
				}
			}else{
				$response=setResponseHTTP(401,$session->message);
			}
			//OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;
		}

		public function index__DELETE(){
			allowedMethod(array("DELETE"));

			$session=jwt_session(jwt_getBearerToken(),array('admin'));
			if($session->authenticated==TRUE){
				$data=(object)array(
					"current_id"	 => $this->input->input_stream('current_id')
				);

				if($this->Config_LanguageModel->checkLanguage($data->current_id)->num_rows()==1){
					$exe=$this->Config_LanguageModel->deleteLanguage($data);
					if($exe==TRUE){
						$response=setResponseHTTP(200,"OK");
					}else{
						$response=setResponseHTTP(400);
					}
				}else{
					$response=setResponseHTTP(200,"NOT_FOUND");
				}
			}else{
				$response=setResponseHTTP(401,$session->message);
			}
			//OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;
		}



	}
