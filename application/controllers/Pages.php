<?php


	class Pages extends CI_Controller{

		public function login(){

			if (isset($this->session->userdata['user'])) {

				$data['title'] = 'Home';

				redirect('home');
			}else{

				$data['error_msg'] = '';
				$this->load->view('templates/header');
				$this->load->view('pages/login',$data);
				$this->load->view('templates/footer');

			}

			

		}


		public function view($page = 'home'){

			if ($page == 'group') {
				# code...
			}else{

				if (!file_exists(APPPATH.'views/pages/home/'.$page.'.php')) {
				show_404();
				
				}else{

						if (!isset($this->session->userdata['user'])) {
							redirect(base_url());
						}else{

							$data['title'] = ucfirst($page);

							if ($page == 'home') {
								$data['posts'] = $this->posts_model->getPost();

							}

							$data['groups']		= $this->groupsModel->getGroups();
							$pages 				= ['login','home','messages'];
							$data['notifs']		= $this->notifications_model->getMsgnotif();
							$data['contacts']	= $this->contacts_model->getContacts();
							$data['userid']		= $this->session->userdata['user']['id'];

							if (in_array($page, $pages)) {
								$this->load->view('templates/mheader',$data);
								$this->load->view('pages/home/'.$page,$data);
								$this->load->view('templates/mfooter');
							}else{
								$this->load->view('templates/mheader',$data);
								$this->load->view('pages/home/accounts/',$data);
								$this->load->view('templates/mfooter');
							}		

						}

				}
					
			}

		}

			



	}