<?php
	class UserProfile extends CI_Controller{

		public function __construct(){
			parent::__construct();
      $this->load->helper('files_helper');
		}

    public function profile_picture__POST(){
			allowedMethod(array("POST"));

      $jwt_decode=jwt_decode('BEARER-FROM-HEADER');
      if($jwt_decode->message=="OK"){
        $username=$jwt_decode->payload->data->username;

        //CONFIG OBJECT
        $property=(object)array(
                    'username'	    => $username,
                    'file_name'			=> 'fileToUpload',
                    'config'        => array(
                                        'upload_path' 			=> $this->ConfigModel->getAppInfo('PATH__ASSETS_USERDATA__ABSOLUTE').'/'.$username.'/'.$this->ConfigModel->getAppInfo('PATH__ASSETS_USERDATA_SUB__PROFILE_PICTURE').'/',
																				'allowed_types' 		=> 'jpg|png|jpeg',
																				'file_ext_tolower'	=> TRUE,
																				'encrypt_name'			=> TRUE,
																				'remove_spaces'			=> TRUE,
																				'detect_mime'				=> TRUE,
																				'mod_mime_fix'			=> TRUE,
                												'max_size'      		=> 2048,
																				'max_width'					=> 0,
																				'max_height'				=> 0,
																				'min_width'					=> 0,
																				'min_height'				=> 0,
																				'max_filename'			=> 0
                                      ),
                    'config_image' => (object)array(
                                        'size'  => array(
																					'image_library'		=> 'gd2',
                                          'maintain_ratio'  => TRUE,
                                          'master_dim'			=> 'width',
                                          'width'           => 500,
                                          'height'          => 0,
																					'quality' 				=> 70
                                        )
                                      )
        						);



        //START UPLOAD
        $file_upload = upload_files($property,TRUE);
        if($file_upload->is_success){
					$data=(object)array(
						"file_name"	=> $file_upload->data['file_name']
					);
          $response=setResponseHTTP(200,"OK",$data);
        }else{
          $response=setResponseHTTP(400,"",$file_upload->data);
        }
      }else{
        $response=setResponseHTTP(401,$jwt_decode->message);
      }

      //OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;
    }


}
