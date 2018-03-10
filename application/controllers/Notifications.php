<?php


	class Notifications extends CI_Controller{


		public function getNotif(){

			$result = $this->notifications_model->getMsgnotif();

			echo json_encode($result);


		}

	}