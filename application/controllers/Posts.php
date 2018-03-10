<?php


	class Posts extends CI_Controller{

		public function newpost(){

			$this->form_validation->set_rules('postbody', 'Text', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				echo json_encode(array('code' => '3', 'msg' => 'Body is required'));
			}else{


				date_default_timezone_set("Asia/Manila");

    			$date= date("Y-m-d G:i:s");
				$user_id = $this->session->userdata['user']['id'];
				$post_body = $this->input->post('postbody');

				$data = array(
							'user_id' 	=> $user_id,
							'post_body' => $post_body,
							'post_date' => $date
						);

				$post_id = $this->posts_model->newpost($data);

				$newpost = $this->posts_model->getPost($post_id);

				echo json_encode($newpost);


			}

		}

		public function deletepost(){

			$data = $this->input->post('postid');
			$res = $this->posts_model->deletepost($data);

			echo json_encode(array('code' => '1'));
			

		}


		public function editpost(){

			$data = [$this->input->post('postbody'), $this->input->post('postid')];
			$res  = $this->posts_model->editpost($data);

			echo json_encode(array('code' => '1'));
		}
		
		
	}