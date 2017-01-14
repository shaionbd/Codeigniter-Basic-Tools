<?php 
	/**
	* 
	*/
	class Post extends MY_Model
	{
		function __construct(){
			parent::__construct('posts');
		}
		public function find($id){
			try {
				return $this->db->order_by('id','DESC')->get_where($this->table,['user_id'=>$id])->result();
			} catch (Exception $e) {
				return false;
			}	
		}
	}