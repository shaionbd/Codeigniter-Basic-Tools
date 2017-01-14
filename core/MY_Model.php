<?php
	class MY_Model extends CI_Model{
		public $table;
		public function __construct($model){
			$this->table = $model;
			$this->load->database();
		}
		public function all(){
			return $this->db->order_by('id', 'DESC')->get($this->table)->result();
		}
		public function save($data){
			return $this->db->insert($this->table,$data);
		}

		public function update($id, $data){
			return $this->db->where('id', $id)->update($this->table, $data);
		}
		public function delete($id){
			return $this->db->delete($this->table, ['id' => $id]);
		}
		public function find($id){
			try {
				return $this->db->get_where($this->table,['id'=>$id])->row();
			} catch (Exception $e) {
				return false;
			}	
		}
	}