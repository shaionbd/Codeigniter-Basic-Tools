<?php
	class User extends MY_Model{

		function __construct(){
			parent::__construct('users');
		}

		public function check($email, $password){
			/**
			* Get the user user row which one is matched with
			*	email and password info
			*/
			$sql = $this->db->get_where('users',['email'=>$email, 'password'=>$password]);
			if($sql->num_rows()){
				return $sql->row()->id;
			}
			return FALSE;
		}

	}