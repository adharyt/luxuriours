<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ini comment
	class Cache extends CI_Controller{

		public function DatabaseCache_clear__POST(){
			$this->load->helper($this->config->item('helpers_ext').'appsettings');


			foreach(json_decode($this->input->post('payload')) as $data){
				switch($data){
					case 'clear_cache__config':
						clear_cache__config();
						break;
					case 'clear_cache__language':
						clear_cache__language();
						break;
					case 'clear_cache__promotion':
						//clear_cache__promotion();
						break;
				}
			}

			$response=setResponseHTTP(200);
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;

		}

	}
