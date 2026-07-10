<?php
	class Config_AppInfo extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('Config_AppInfoModel');
		}

		public function index__GET(){
			allowedMethod(array("GET"));

			$session=jwt_session(jwt_getBearerToken(),array('admin'));
			if($session->authenticated==TRUE){
				$response=setResponseHTTP(200,"OK",$this->Config_AppInfoModel->fetchAppInfo());
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
				$response=setResponseHTTP(200,"OK",$this->Config_AppInfoModel->getAppInfoExt($key));
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
					"key"					 => $this->input->post('key'),
					"value"				 => $this->input->post('value'),
					"current_time" => datetime_getCurrent()
				);

				if($this->Config_AppInfoModel->checkAppInfo($data)==0){
					$this->Config_AppInfoModel->addAppInfo($data);
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
					"current_key"	 => $this->input->input_stream('current_key'),
					"key"					 => $this->input->input_stream('key'),
					"value"				 => $this->input->input_stream('value'),
					"current_time" => datetime_getCurrent()
				);

				if($this->Config_AppInfoModel->checkAppInfo($data)<=1){
					$this->Config_AppInfoModel->editAppInfo($data);
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
				$this->Config_AppInfoModel->deleteAppInfo($data);
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
