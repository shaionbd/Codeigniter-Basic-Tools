<?php
	class MY_Controller extends CI_Controller{
		public function auth($user_id){
			$this->session->set_userdata('user_id',$user_id);
		}
		public function user(){
			return $this->session->user_id;
		}
		public function isUser($user_id){
			return ($this->user() == $user_id) ? true : false;
		}
	}