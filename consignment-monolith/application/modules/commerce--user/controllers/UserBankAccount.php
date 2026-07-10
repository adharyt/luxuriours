<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class UserBankAccount extends CI_Controller{
		public function __construct(){
			parent::__construct();
		}

		public function index(){
			if($this->session->userdata("is_login")==TRUE){
				//LOAD VIEW
				$page_content['view']=(object)array(
					'style'		=> $this->load->view(static::class.'/_style',NULL,TRUE),
					'content'	=> $this->load->view(static::class.'/content',null,TRUE),
					'script'	=> $this->load->view(static::class.'/_script',NULL,TRUE)
				);
				$this->template->load('PAGE_COMMERCE--profile',$page_content);
			}else{
				//REDIRECT TO LOGIN
				$this->session->set_flashdata('redirect_link',current_url());
				redirect(base_url());
			}
		}



}
