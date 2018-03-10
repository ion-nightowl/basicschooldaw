<?php


	class Auth_model extends CI_Model{

		var $table = 'tbl_users';

		public function __construct(){

			$this->load->database();

		}

		public function login($data){

			$condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "'";

			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();

			if ($query->num_rows() == 1) {
				return TRUE;
			}else{
				return FALSE;
			}

		}

		public function register($data){

			$condition = "email = '".$data['email']."'";
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();


		}

		public function get_info($data){


			$query = $this->db->get_where($this->table, array('email' => $data));
			return $query->row_array();

		}

		public function check_user($data){

			$query = "SELECT * FROM tbl_users WHERE email = ? AND fname = ? AND mname = ? AND lname = ?";
			$result = $this->db->query($query, $data);

			if ($result->num_rows()>0) {
				return TRUE;
			}else{
				return FALSE;
			}

		}

		public function new_user($data){



			$sql = "INSERT INTO tbl_users (`fname`,`mname`,`lname`,`email`,`username`,`password`) VALUES (?,?,?,?,?,?)";
			$result = $this->db->query($sql, $data);
			return TRUE;	
		}
	}