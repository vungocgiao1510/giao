<?php
class Mcategorie extends CI_Model{
	protected $_table = "categorie";
	public function __construct(){
		parent::__construct();
	}
	public function listCategorie(){
		$this->db->where("active",1);
		$this->db->order_by("cate_order","asc");
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
	}
	public function insertCategorie($data){
		$this->db->insert($this->_table,$data);
	}
	public function editCategorie(){
		
	}
	public function deleteCategorie(){
		
	}
}