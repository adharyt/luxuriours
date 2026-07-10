<?php
	class Mailer extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('MailerModel');
      $this->load->helper('mailer');
		}

    private function executeEmail($queueData){
      if(!is_null($queueData)){
        $data_payload=json_decode($queueData->data);
        $content=$this->load->view('template/mail-template/'.$data_payload->template,(object)array("data"=>$data_payload->content),TRUE);


				$receivers=array();
				foreach($data_payload->receivers as $receiver){
					$dt=(object)array(
						"email" => $receiver->email,
						"alias" => $receiver->name
					);
					array_push($receivers,$dt);
				}

        $data_smtp=$this->ConfigModel->getMailerAccount($queueData->mailer);
        $data_mail=(object)array(
                      "subject"    => $data_payload->subject,
                      "receiver"   => (object)$receivers,
                      "carboncopy" => (object)array(),
                      "attachment" => (object)array(),
                      "content"    => $content
                    );
        $send=mailer_sendMail($data_smtp,$data_mail);
        $update_queueData=(object)array(
          "updated_at"        => $this->config->item('current_datetime'),
          "try__last_time"    => $this->config->item('current_datetime'),
          "try__last_message" => $send->message,
          "try__is_success"   => $send->success
        );
        $this->MailerModel->updateQueueData($queueData->id,$update_queueData);
        $response=setResponseHTTP(200,"OK",$send);
      }else{
        $response=setResponseHTTP(200,"OK","NOT_FOUND");
      }

      return $response;
    }

		public function Cron__Global__AccountUser__Registration__GET(){
			allowedMethod(array("GET"));

			if($this->input->get('id')!=''){
				$id=$this->input->get('id');
			}else{
				$id='LATEST';
			}
      $queueData=$this->MailerModel->getFromQueue(TRUE,'user-account',$id);
      $response=$this->executeEmail($queueData);

      //OUTPUT
			$this->output->set_status_header($response->code)
									 ->set_content_type('application/json')
									 ->set_output(json_encode($response->body),JSON_PRETTY_PRINT)
									 ->_display();
			exit;
		}


	}
