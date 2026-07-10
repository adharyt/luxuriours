<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ini comment
	class Settings extends CI_Controller{

		public function changeLanguage(){
			$language=$this->input->get('value');

			$available_language=array();
			foreach($this->LanguageModel->getLanguage() as $lang){
				array_push($available_language,$lang->id);
			}

		  if(!in_array($language,$available_language)){
		    $language='ID';
		  }

			$this->session->set_userdata('language',$language);
			redirect($_SERVER['HTTP_REFERER']);

		}

	}
