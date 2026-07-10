<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {


		function load($template = '', $data = ''){
			$this->CI =& get_instance();

      switch($template){
        case 'PAGE_COMMERCE':
          $directory='template/app_page/page_commerce/_main/_init';
          break;
				case 'PAGE_COMMERCE--profile':
          $directory='template/app_page/page_commerce/_profile/_init';
          break;
        default:
          break;
      }

			return $this->CI->load->view($directory, $data);
		}

		function callModal($modal_name='',$data=''){
			$this->CI =& get_instance();
			$directory=debug_backtrace()[1]['class'].'/modal/'.$modal_name;
			return $this->CI->load->view($directory,$data,TRUE);
		}




}
