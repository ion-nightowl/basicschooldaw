<?php


	class groupsModel extends CI_Model{

		public function getGroups(){

			$userid = $this->session->userdata['user']['id'];

			$sql	= "SELECT * FROM tbl_groups";
			$res	= $this->db->query($sql);

			$groups = [];

			if ($res->num_rows()>0) {
				
				foreach ($res->result_array() as $key) {
					
					$members 	= explode(',', $key['group_members']);

					foreach ($members as $member) {
						
						if ($member == $userid) {
							$groups[] = $key;
						}

					}

					

				}

			}

			return $groups;

		}

		public function joinGroup(){

		}

	}