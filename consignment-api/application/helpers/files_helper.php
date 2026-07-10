<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function base64ToImage($img){
  $ci =& get_instance();

  $folderPath = $ci->ConfigModel->getAppInfo('PATH__ASSETS_TEMP__ABSOLUTE').'/';
  $image_mime=explode(";", $img)[0];
  $extension =explode("/", $image_mime)[1];

  $image_parts = explode(";base64,", $img);
  $image_type_aux = explode("image/", $image_parts[0]);
  $image_type = $image_type_aux[1];
  $image_base64 = base64_decode($image_parts[1]);

  $name=uniqid() . '.'.$extension;
  $file = $folderPath . $name;
  file_put_contents($file, $image_base64);

  $result=array(
    'name'=> $name,
    'type'=> $image_mime,
    'tmp_name' => $file
  );

  return $result;
}

function upload_files($property,$is_image_manipulation=FALSE){
  $ci =& get_instance();
  $ci->load->library('upload', $property->config);

  if (!file_exists($property->config['upload_path'])) {
    mkdir($property->config['upload_path'], 0777, true);
  }

  if(!$ci->upload->do_upload($property->file_name)){
      $response=(object)array(
        "is_success" => FALSE,
        "data"       => array('error' => $ci->upload->display_errors())
      );
  }else{
      $uploaded_file=$ci->upload->data();
      if($is_image_manipulation==TRUE && $uploaded_file['is_image']==TRUE){
        $config__image_resize=$property->config_image->size;
        $config__image_resize['source_image']=$uploaded_file['full_path'];
        $ci->load->library('image_lib', $config__image_resize);

        if($ci->image_lib->resize()){
          $resize_image="OK";
        }else{
          $resize_image=$ci->image_lib->display_errors();
        }
        $uploaded_file['resize_image']=$resize_image;
      }
      $response=(object)array(
        "is_success" => TRUE,
        "data"       => $uploaded_file
      );
  }
  return $response;
}

?>
