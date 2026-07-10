<?php
	class Config_AppInfoOrigin extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('Config_AppInfoOriginModel');
		}

		public function index__GET(){
			allowedMethod(array("GET"));

			$session=jwt_session(jwt_getBearerToken(),array('admin'));
			if($session->authenticated==TRUE){
				$response=setResponseHTTP(200,"OK",$this->Config_AppInfoOriginModel->fetchAppInfoAllowedOrigin());
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
				$response=setResponseHTTP(200,"OK",$this->Config_AppInfoOriginModel->getAppInfoAllowedOriginExt($key));
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
					"id"					 => $this->input->post('key'),
					"current_time" => datetime_getCurrent()
				);

				if($this->Config_AppInfoOriginModel->checkAppInfoAllowedOrigin($data)==0){
					$this->Config_AppInfoOriginModel->addAppInfoAllowedOrigin($data);
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
					"current_id"	 => $this->input->input_stream('current_key'),
					"id"					 => $this->input->input_stream('key'),
					"current_time" => datetime_getCurrent()
				);

				if($this->Config_AppInfoOriginModel->checkAppInfoAllowedOrigin($data)<=1){
					$this->Config_AppInfoOriginModel->editAppInfoAllowedOrigin($data);
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
					"current_id"	 => $this->input->input_stream('current_key')
				);
				$this->Config_AppInfoOriginModel->deleteAppInfoAllowedOrigin($data);
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
