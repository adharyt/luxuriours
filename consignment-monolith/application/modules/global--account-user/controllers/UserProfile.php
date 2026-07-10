<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class UserProfile extends CI_Controller{
		public function __construct(){
			parent::__construct();
		}

		public function index(){
			if($this->session->userdata("is_login")==TRUE){
				//LOAD VIEW
				$page_content['view']=(object)array(
					'style'		=> $this->load->view(static::class.'/summary/_style',NULL,TRUE),
					'content'	=> $this->load->view(static::class.'/summary/content',null,TRUE),
					'script'	=> $this->load->view(static::class.'/summary/_script',NULL,TRUE)
				);
				$this->template->load('PAGE_COMMERCE--profile',$page_content);
			}else{
				//REDIRECT TO LOGIN
				$this->session->set_flashdata('redirect_link',current_url());
				redirect(base_url());
			}
		}

		public function edit(){
			if($this->session->userdata("is_login")==TRUE){

				//GET USERDATA
				$t_endpoint=$this->ConfigModel->getEndpoint("services__global__user","User/confidentialUserData__GET");
				$payload_req_0=(object)array(
					"user"				=> $this->session->userdata('username'),
					"request"			=> (object)array(
						"method"		=> "GET",
						"endpoint"	=> $t_endpoint->link_local.'/'.$t_endpoint->endpoint,
						"data"			=> array(),
						"auth"			=> (object)array(
														"type" => "jwt-bearer-token",
														"token"	=> $this->session->userdata('jwt')
												),
						"expected"	=> array(200)
					),
					"response"	=> NULL
				);
				$payload_req_0->response=callAPI($payload_req_0);

				if(in_array($payload_req_0->response->code,$payload_req_0->request->expected)){
					$data['userdata']=json_decode($payload_req_0->response->body)->data;
					//LOAD VIEW
					$page_content['view']=(object)array(
						'style'		=> $this->load->view(static::class.'/edit/_style',NULL,TRUE),
						'content'	=> $this->load->view(static::class.'/edit/content',$data,TRUE),
						'script'	=> $this->load->view(static::class.'/edit/_script',NULL,TRUE)
					);
					$this->template->load('PAGE_COMMERCE--profile',$page_content);
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
			}else{
				//REDIRECT TO LOGIN
				$this->session->set_flashdata('redirect_link',current_url());
				redirect(base_url());
			}
		}

		public function passwordChange(){
			if($this->session->userdata("is_login")==TRUE){
				//LOAD VIEW
				$page_content['view']=(object)array(
					'style'		=> $this->load->view(static::class.'/passwordChange/_style',NULL,TRUE),
					'content'	=> $this->load->view(static::class.'/passwordChange/content',null,TRUE),
					'script'	=> $this->load->view(static::class.'/passwordChange/_script',NULL,TRUE)
				);
				$this->template->load('PAGE_COMMERCE--profile',$page_content);
			}else{
				//REDIRECT TO LOGIN
				$this->session->set_flashdata('redirect_link',current_url());
				redirect(base_url());
			}
		}



}
