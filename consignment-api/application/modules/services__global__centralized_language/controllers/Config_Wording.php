<?php
	class Config_Wording extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('Config_LanguageModel');
			$this->load->model('Config_WordingModel');
		}

		public function index__GET(){
			allowedMethod(array("GET"));

			$session=jwt_session(jwt_getBearerToken(),array('admin'));
			if($session->authenticated==TRUE){
				$language=$this->Config_LanguageModel->fetchLanguage();
				$response=setResponseHTTP(200,"OK",$this->Config_WordingModel->fetchWording($language));
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
				$language=$this->Config_LanguageModel->fetchLanguage();
				$data=$this->Config_WordingModel->checkWording($language,$this->input->get('key'))->row();
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
				$language=$this->Config_LanguageModel->fetchLanguage();
				if($this->Config_WordingModel->checkWording($language,$this->input->post('key'))->num_rows()==0){
					$final_data=array();
					foreach($language as $var){
						$data=(object)array(
							"key"					 => $this->input->post('key'),
							"language"		 => $var->id,
							"value"		 		 => $this->input->post('value_'.$var->id)
						);
						array_push($final_data,$data);
					}
					$insert=$this->Config_WordingModel->addWording($final_data);
					if($insert==TRUE){
						$response=setResponseHTTP(200,"OK",$final_data);
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
				$language=$this->Config_LanguageModel->fetchLanguage();
				if($this->Config_WordingModel->checkWording($language,$this->input->post('key'))->num_rows()<=1){
					$final_data=array();
					foreach($language as $var){
						$data=(object)array(
							"current_key"	 => $this->input->input_stream('current_key'),
							"key"					 => $this->input->input_stream('key'),
							"language"		 => $var->id,
							"value"		 		 => $this->input->input_stream('value_'.$var->id)
						);
						array_push($final_data,$data);
					}
					$insert=$this->Config_WordingModel->editWording($final_data);
					if($insert==TRUE){
						$response=setResponseHTTP(200,"OK",$final_data);
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
				$language=$this->Config_LanguageModel->fetchLanguage();
				if($this->Config_WordingModel->checkWording($language,$this->input->input_stream('current_key'))->num_rows()>=1){
					$this->Config_WordingModel->deleteWording($this->input->input_stream('current_key'));
					$response=setResponseHTTP(200,"OK");
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
