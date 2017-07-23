<?php
class Mcontact extends CI_Model{
	protected $_table = "contact";
	public function __construct(){
		parent::__construct();
	}
	public function listAllContact($all, $start, $lang="vn", $order="desc", $active="") {
		// Hiển thị toàn bộ bài viết.
		if($active != ""){
			$this->db->where("active", $active);
		}
		$this->db->where("lang",$lang);
		$this->db->order_by("id",$order);
		$this->db->limit ( $all, $start );
		return $this->db->get ( $this->_table )->result_array ();
	}
	public function getContactById($id){
		$this->db->where("id",$id);
		return $this->db->get($this->_table)->row_array();
	}
	public function updateContact($id,$data){
		$this->db->where("id",$id);
		$this->db->update($this->_table,$data);
	}
	public function deleteContact($id){
		$this->db->where("id",$id);
		$this->db->delete($this->_table);
	}
	public function SearchContactByKeyword($keyword,$all,$start,$order="desc", $active="",$lang="vn"){
		if($active != ""){
			$this->db->where("active", $active);
		}
		$this->db->where("lang",$lang);
		$this->db->limit ( $all, $start );
		$this->db->order_by("id",$order);
		$this->db->like('title',$keyword);
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}
	public function countSearchContact($keyword,$lang="vn"){
		$this->db->where("lang",$lang);
		$this->db->like('title',$keyword);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
	public function countAll($lang="vn") {
		$this->db->where("lang",$lang);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
	public function insertContact($insert){
		$this->db->insert($this->_table,$insert);
	}
	public function listContactOnTop($lang){
		$this->db->where("lang",$lang);
		$this->db->where("active",2);
		$this->db->order_by("id","desc");
		return $this->db->get($this->_table)->result_array();
	}
}