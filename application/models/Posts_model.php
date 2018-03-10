<?php


	class Posts_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function getPost($post = ''){


			if ($post == '') {
				
				$query = "SELECT * from tbl_posts ORDER BY id DESC";
				$result = $this->db->query($query);
			
				if ($result->num_rows()>0) {

					$data = [];
					$x = 0;
					$control = 0;
					
					foreach ($result->result_array() as $row) {


						$id = $row['user_id'];
						$sql = "SELECT * FROM tbl_users WHERE id = ? LIMIT 1";
						$res = $this->db->query($sql, $id);
						$row1 = $res->row_array();

						if ($row1['email'] == $this->session->userdata['user']['email']) {
							$control = 1;
						}else{
							$control = 0;
						}

						if ($res->num_rows() >0) {
							$data[$x] = [
											'name' => $row1['fname'].' '.$row1['mname'].' '.$row1['lname'], 
											'body' => $row['post_body'], 
											'date' => $row['post_date'], 
											'control' => $control, 
											'postid' => $row['id'], 
											'userid' => $row['user_id']
										];
						}

						

						$x++;
							
					}

					return $data;

				}else{
					return 0;
				}

			}else{

				$sql = "SELECT * FROM tbl_posts WHERE id = ?";
				$result= $this->db->query($sql, $post);
				$row = $result->row_array();

				$sql1 = "SELECT * FROM tbl_users WHERE id = ?";
				$res = $this->db->query($sql1, $row['user_id']);

				$data = [];

				if ($res->num_rows() >0) {

					$row1 = $res->row_array();

							$data 	= 	[
											'name' => $row1['fname'].' '.$row1['mname'].' '.$row1['lname'], 
											'body' => $row['post_body'], 
											'date' => $row['post_date'], 
											'postid' => $row['id'],
											'userid' => $row['user_id']
										];

					return $data;
				}


			}

			

		}

		public function newpost($data){

			$this->db->insert('tbl_posts', $data);
			$post_id = $this->db->insert_id();

			return $post_id;



		}

		public function deletepost($data){

			$sql = "DELETE FROM tbl_posts WHERE id = ?";
			$this->db->query($sql, $data);


		}


		public function editpost($data){

			$sql = "UPDATE tbl_posts set post_body = ? WHERE id = ?";
			$res = $this->db->query($sql, $data);

			

		}

	}