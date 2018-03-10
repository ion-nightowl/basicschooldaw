<?php

	class Contacts_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}


		public function getContacts(){

			$id = $this->session->userdata['user']['id'];

			$sql = "SELECT * FROM tbl_users WHERE id != ?";
			$res = $this->db->query($sql,$id);

			return $res->result_array();

		}

	}