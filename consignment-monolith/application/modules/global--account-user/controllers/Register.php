<?php
	class Register extends CI_Controller{

		public function index(){
			//LOAD VIEW
			$this->load->view('Register/v_register');
		}

		public function activation(){
			$username=$this->input->get('username');
			$code=$this->input->get('code');

			$data=array(
				"username"	=> $username,
				"code"			=> $code
			);

			//CHECK USERNAME & CODE
			$t_endpoint=$this->ConfigModel->getEndpoint("services__global__account_user","Registration/activation__GET");
			$payload_req_0=(object)array(
				"user"				=> $username,
				"request"			=> (object)array(
					"method"		=> "GET",
					"endpoint"	=> $t_endpoint->link_local.'/'.$t_endpoint->endpoint,
					"data"			=> $data,
					"auth"			=> (object)array(
													"type" => "no-auth"
											),
					"expected"	=> array(200)
				),
				"response"	=> NULL
			);
			$payload_req_0->response=callAPI($payload_req_0);

			if(in_array($payload_req_0->response->code,$payload_req_0->request->expected)){
				$response_body=json_decode($payload_req_0->response->body);
				if($response_body->message=="OK"){
					//REDIRECT KE LOGIN DENGAN NOTIF SUKSES
	        $this->session->set_flashdata('swalert','register_email_success');
	        redirect(base_url('login'));
				}else{
					$dt['message']=$response_body->message;
					$this->load->view('errors/html/custom/error_warning',$dt);
				}

			}else{
				$data=(object)array(
					"error"	=> "API_CALL__FAILED",
					"data"	=> array(
											$payload_req_0
									)
				);
				$this->MonitorModel->API_CALL__log_failed__insert(json_encode($data));
				if($payload_req_0->response->code==401){
					redirect($this->ConfigModel->getEndpoint("services__global__authentication","Authentication/logout__GET")->endpoint);
				}else{
					$this->load->view('errors/html/custom/error_500');
				}
			}

		}


	}
