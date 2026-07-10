<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function mailer_sendMail($data_smtp,$data_mail){
    // Load PHPMailer library
    $ci =& get_instance();
    $ci->load->library('phpmailer_lib');

    // PHPMailer object
    $mail = $ci->phpmailer_lib->load();

    // SMTP configuration
    $mail->isSMTP();
    $mail->isHTML(true);
    $mail->SMTPAuth   = true;
    $mail->Host       = $data_smtp->SMTP_address;
    $mail->Username   = $data_smtp->SMTP_user;
    $mail->Password   = $data_smtp->SMTP_password;
    $mail->SMTPSecure = $data_smtp->SMTP_secure;
    $mail->Port       = $data_smtp->SMTP_port;

    $mail->setFrom($data_smtp->SMTP_user, $data_smtp->SMTP_user_alias);

    // Add a recipient
    foreach($data_mail->receiver as $receiver){
      $mail->addAddress($receiver->email,$receiver->alias);
    }

    // Add cc
    foreach($data_mail->carboncopy as $carboncopy){
      $mail->addCC($carboncopy->email,$carboncopy->alias);
    }

    // Email subject
    $mail->Subject = $data_mail->subject;

    // Email body content
    $mail->Body = $data_mail->content;

    // Send email
    if(!$mail->send()){
        $response=(object)array(
          'success' => FALSE,
          'message' => 'Message could not be sent. Error: '. $mail->ErrorInfo
        );
    }else{
      $response=(object)array(
        'success' => TRUE,
        'message' => 'Message has been sent'
      );
    }
    return $response;
}

?>
