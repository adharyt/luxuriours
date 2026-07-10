<?php
	class Config_UrlBasepoint extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('Config_UrlBasepointModel');
		}

		public function index__GET(){
			allowedMethod(array("GET"));

			$session=jwt_session(jwt_getBearerToken(),array('admin'));
			if($session->authenticated==TRUE){
				$response=setResponseHTTP(200,"OK",$this->Config_UrlBasepointModel->fetchAppLinkBaseUrl());
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
				$key=$this->input->get('key');
				$response=setResponseHTTP(200,"OK",$this->Config_UrlBasepointModel->getAppLinkBaseUrl($key)->row());
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
					"key"					 	 		=> $this->input->post('key'),
					"path"				 			=> $this->input->post('path'),
					"local_basepoint"		=> $this->input->post('local_basepoint'),
					"public_basepoint"	=> $this->input->post('public_basepoint'),
					"current_time" 			=> datetime_getCurrent()
				);

				if($this->Config_UrlBasepointModel->getAppLinkBaseUrl($data->key)->num_rows()==0){
					$this->Config_UrlBasepointModel->addAppLinkBaseUrl($data);
					$response=setResponseHTTP(200,"OK");
				}else{
					$response=setResponseHTTP(200,"DUPLICATE_PK");
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

		public function index__PATCH(){
			allowedMethod(array("PATCH"));

			$session=jwt_session(jwt_getBearerToken(),array('admin'));
			if($session->authenticated==TRUE){
				$data=(object)array(
					"current_key"	 			=> $this->input->input_stream('current_key'),
					"key"					 	 		=> $this->input->input_stream('key'),
					"path"				 			=> $this->input->input_stream('path'),
					"local_basepoint"		=> $this->input->input_stream('local_basepoint'),
					"public_basepoint"	=> $this->input->input_stream('public_basepoint'),
					"current_time" 			=> datetime_getCurrent()
				);

				if($this->Config_UrlBasepointModel->getAppLinkBaseUrl($data->key)->num_rows()<=1){
					$this->Config_UrlBasepointModel->editAppLinkBaseUrl($data);
					$response=setResponseHTTP(200,"OK");
				}else{
					$response=setResponseHTTP(200,"DUPLICATE_PK");
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

		public function index__DELETE(){
			allowedMethod(array("DELETE"));

			$session=jwt_session(jwt_getBearerToken(),array('admin'));
			if($session->authenticated==TRUE){
				$data=(object)array(
					"current_key"	 => $this->input->input_stream('current_key')
				);
				$this->Config_UrlBasepointModel->deleteAppLinkBaseUrl($data);
				$response=setResponseHTTP(200,"OK");
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
