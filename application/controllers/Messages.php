<?php


defined('BASEPATH') OR exit('No direct script access allowed');



	class Messages extends CI_Controller{

		public function newmessage(){

			date_default_timezone_set("Asia/Manila");

    		$date 		= date("Y-m-d G:i:s");
			$sender 	= $this->session->userdata['user']['id'];
			$receiver	= $this->input->post('receiver');
			$message 	= $this->input->post('message');

			$data 		= array(
									'sender' 	=> $sender,
									'receiver'	=> $receiver,
									'message'	=> $message,
									'date'		=> $date
								);

			$msg 		= $this->messages_model->newMessage($data);

			echo json_encode($msg);

			
		}


		public function getmessage($userid){

			if (!$this->input->is_ajax_request()) {
			   #exit('No direct script access allowed');
				exit(show_404());
			}

			$data = array('sender' => $this->session->userdata['user']['id'], 'receiver' => $userid);
			$result = $this->messages_model->getMessages($data);

			echo json_encode($result);

		}
 

		public function messageRead($userid){

			if (!$this->input->is_ajax_request()) {
			   #exit('No direct script access allowed');
				exit(show_404());
			}

			$result = $this->messages_model->messageRead($userid);

			echo json_encode(array('reply' => 1));

		}




	}