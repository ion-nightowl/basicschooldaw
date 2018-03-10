<?php


	class Notifications_model extends CI_Model{

		public function __construct(){

			$this->load->database();

		}

		public function getMsgnotif(){

			$id = $this->session->userdata['user']['id'];

			$sql 	= "SELECT * FROM tbl_messages WHERE receiver = ? AND message_status = 'unread' AND id IN(SELECT MAX(id) FROM tbl_messages GROUP BY sender) ORDER BY id DESC";
			$res 	= $this->db->query($sql, $id);

			

			if ($res->num_rows()>0) {



				$data['notifcount'] = $res->num_rows();
				$data['messages'] 	= $res->result_array();
				$data['senderinfo'] = [];

		
				foreach ($res->result_array() as $row) {
					$sql1 = "SELECT * FROM tbl_users WHERE id = ? LIMIT 1";
					$res1 = $this->db->query($sql1, $row['sender']);

					$sender = $res1->row_array();

					array_push($data['senderinfo'], $sender);
				}

				


				return $data;
			}else{
				return 0;
			}
			
		}

	}