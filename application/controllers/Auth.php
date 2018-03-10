<?php

	

	class Auth extends CI_Controller{

		public function login(){

			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('pass', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				echo json_encode(array('code' => '3', 'msg' => 'Invalid Inputs'));
			}else{

				$password = md5($this->input->post('pass'));
				$data = array(
						"email" => $this->input->post('email'),
						"password" => $password
					);

				$reply = $this->auth_model->login($data);

				if ($reply == TRUE) {

					$email = $this->input->post('email');
					$res = $this->auth_model->get_info($email);

					
					$session_data = array(
							'email' 	=> $email, 
							'fname' 	=> $res['fname'], 
							'mname' 	=> $res['mname'], 
							'lname' 	=> $res['lname'], 
							'id' 		=> $res['id'],
							'username'  => $res['username']
						);

					$this->session->set_userdata('user', $session_data);
					echo json_encode(array('code' => '1'));
					
				}else{

					echo json_encode(array('code' => '3', 'msg' => 'Incorrect email or password'));

				}

			}


			//echo json_encode(array('reply' => $reply));


			
		}

		public function logout(){
			$data = array('email' => '', 'fname' => '', 'mname' => '', 'lname' => '', 'id' => '','username' => '');
			$this->session->unset_userdata('user',$data);
			redirect(base_url());
			
		}

		public function register(){

			$this->form_validation->set_rules('fname', 'Text', 'trim|required');
			$this->form_validation->set_rules('mname', 'Text', 'trim|required');
			$this->form_validation->set_rules('lname', 'Text', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				echo json_encode(array('code' => '3', 'msg' => 'Invalid Inputs'));
			}else{

				$data = [$this->input->post('email'),$this->input->post('fname'),$this->input->post('mname'),$this->input->post('lname')];
				$check = $this->auth_model->check_user($data);

				if ($check == TRUE) {
					echo json_encode(array('code' => '3', 'msg' => 'Account is existing'));
				}else{

					$password = md5($this->input->post('password'));

					$username = strtolower($this->input->post('fname').$this->input->post('mname').$this->input->post('lname'));
					$username = str_replace(' ', '', $username);

					$data = [$this->input->post('fname'),$this->input->post('mname'),$this->input->post('lname'),$this->input->post('email'),$username,$password];
					$result = $this->auth_model->new_user($data);

					echo json_encode(array('code' => '2', 'msg' => 'You are now registered'));

				}
			}

		}

	}
