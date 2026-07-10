<?php
	class Config_UrlEndpoint extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('Config_UrlEndpointModel');
		}

		public function index__GET(){
			allowedMethod(array("GET"));

			$session=jwt_session(jwt_getBearerToken(),array('admin'));
			if($session->authenticated==TRUE){
				$response=setResponseHTTP(200,"OK",$this->Config_UrlEndpointModel->fetchAppLinkEndpoint($this->input->get('base_point')));
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
				$data=(object)array(
					"key"						=> $this->input->get('key'),
					"basepoint_key"	=> $this->input->get('basepoint_key')
				);
				$response=setResponseHTTP(200,"OK",$this->Config_UrlEndpointModel->getAppLinkEndpoint($data)->row());
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
				$method=$this->input->post('method');
				$data=(object)array(
					"basepoint_key"		=> $this->input->post('basepoint_key'),
					"method"				 	=> $method,
					"key"							=> $this->input->post('key').'__'.$method,
					"module_function"	=> $this->input->post('module_function').'__'.$method,
					"value"						=> $this->input->post('value'),
					"visibility"			=> $this->input->post('visibility'),
					"type"						=> $this->input->post('type'),
					"expose_public"		=> $this->input->post('expose_public'),
					"expose_local"		=> $this->input->post('expose_local'),
					"current_time" 		=> datetime_getCurrent()
				);

				if($this->Config_UrlEndpointModel->getAppLinkEndpoint($data)->num_rows()==0){
					$this->Config_UrlEndpointModel->addAppLinkEndpoint($data);
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
				$method=$this->input->input_stream('method');
				$data=(object)array(
					"current_key"			=> $this->input->input_stream('current_key'),
					"basepoint_key"		=> $this->input->input_stream('basepoint_key'),
					"method"				 	=> $method,
					"key"							=> $this->input->input_stream('key').'__'.$method,
					"module_function"	=> $this->input->input_stream('module_function').'__'.$method,
					"value"						=> $this->input->input_stream('value'),
					"visibility"			=> $this->input->input_stream('visibility'),
					"type"						=> $this->input->input_stream('type'),
					"expose_public"		=> $this->input->input_stream('expose_public'),
					"expose_local"		=> $this->input->input_stream('expose_local'),
					"current_time" 		=> datetime_getCurrent()
				);

				if($this->Config_UrlEndpointModel->getAppLinkEndpoint($data)->num_rows()<=1){
					$this->Config_UrlEndpointModel->editAppLinkEndpoint($data);
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
					"basepoint_key"		=> $this->input->input_stream('basepoint_key'),
					"current_key"	 => $this->input->input_stream('current_key')
				);
				$this->Config_UrlEndpointModel->deleteAppLinkEndpoint($data);
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
