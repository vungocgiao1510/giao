<?php
class Mlinks extends CI_Model{
	protected $_table = "links";
	public function __construct(){
		parent::__construct();
	}
	public function listAllLinks($all, $start, $lang="vn", $order="desc", $active="") {
		// Hiển thị toàn bộ bài viết.
		if($active != ""){
			$this->db->where("active", $active);
		}
		$this->db->where("lang",$lang);
		$this->db->order_by("id",$order);
		$this->db->limit ( $all, $start );
		return $this->db->get ( $this->_table )->result_array ();
	}
	public function getLinksById($id){
		$this->db->where("id",$id);
		return $this->db->get($this->_table)->row_array();
	}
	public function insertLinks($data){
		$this->db->insert($this->_table,$data);
	}
	public function updateLinks($id,$data){
		$this->db->where("id",$id);
		$this->db->update($this->_table,$data);
	}
	public function deleteLinks($id){
		$this->db->where("id",$id);
		$this->db->delete($this->_table);
	}
	public function SearchLinksByKeyword($keyword,$all,$start,$order="desc", $active="",$lang="vn"){
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
	public function countSearchLinks($keyword,$lang="vn"){
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
}