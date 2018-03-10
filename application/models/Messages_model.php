<?php
defined('BASEPATH') OR exit('No direct script access allowed');


	class Messages_model extends CI_Model{


		public function __construct(){
			$this->load->database();
		}

		public function getMessages($data){

			$myid = $this->session->userdata['user']['id'];

			$sql = "SELECT * FROM tbl_messages WHERE sender = ? AND receiver = ? OR sender = ? AND receiver = ?";
			$datax = [$data['sender'], $data['receiver'], $data['receiver'], $data['sender']];
			$result = $this->db->query($sql, $datax);

			$info = "SELECT * FROM tbl_users WHERE id = ? LIMIT 1";
			$res  = $this->db->query($info, $data['receiver']);
			$row1 = $res->row_array();

			$msg = [];

			if ($result->num_rows()>0) {
				
				$data1['messages'] = $result->result_array();
				$data1['userinfo'] = $row1;

				return $data1;


			}else{
				return 0;
			}

		}

		public function newMessage($data){

			$info 	 = "SELECT id,fname,mname,lname,email,image FROM tbl_users WHERE id = ? LIMIT 1";
			$res  	 = $this->db->query($info, $data['sender']);
			$row1	 = $res->row_array();

			$ins 	 = [$data['sender'], $data['receiver'], $data['message'], $data['date']];

			$sql 	 = "INSERT INTO tbl_messages (`sender`, `receiver`, `message_body`, `message_date`,`message_status`) VALUES (?,?,?,?,'unread')";
			$result  = $this->db->query($sql, $ins);

			$newdata['message'] 	 = array('sender' => $data['sender'], 'receiver' => $data['receiver'], 'body' => $data['message'], 'date' => $data['date']);
			$newdata['userinfo']	 = $row1;


			return $newdata;

			

		}


		public function messageRead($data){

			$sql = "UPDATE tbl_messages SET message_status = 'read' WHERE sender = ?";
			$res = $this->db->query($sql, $data);
			return true;


		}


	}