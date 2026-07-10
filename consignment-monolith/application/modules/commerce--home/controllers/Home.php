<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Home extends CI_Controller{

		public function index(){
			//LOAD VIEW
			$this->load->model('PromotionModel');
			$data['promotion_banner']=$this->PromotionModel->getBanner();
			$page_content['view']=(object)array(
				'style'		=> $this->load->view('_style',NULL,TRUE),
				'content'	=> $this->load->view('content',$data,TRUE),
				'script'	=> $this->load->view('_script',NULL,TRUE)
			);
			$this->template->load('PAGE_COMMERCE',$page_content);
		}
	}
