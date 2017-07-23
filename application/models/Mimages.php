<?php
class Mimages extends CI_Model{
	protected $_table = "images";
	public function __construct(){
		parent::__construct();
	}
	public function listAllImages($all, $start, $lang="vn", $order="desc", $active="") {
		// Hiển thị toàn bộ bài viết.
		if($active != ""){
			$this->db->where("active", $active);
		}
		$this->db->where("lang",$lang);
		$this->db->order_by("id",$order);
		$this->db->limit ( $all, $start );
		return $this->db->get ( $this->_table )->result_array ();
	}
	public function getImagesById($id){
		$this->db->where("id",$id);
		return $this->db->get($this->_table)->row_array();
	}
	public function insertImages($data){
		$this->db->insert($this->_table,$data);
	}
	public function updateImages($id,$data){
		$this->db->where("id",$id);
		$this->db->update($this->_table,$data);
	}
	public function deleteImages($id){
		$this->db->where("id",$id);
		$this->db->delete($this->_table);
	}
	public function SearchImagesByKeyword($keyword,$all,$start,$order="desc", $active="",$lang="vn"){
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
	public function countSearchImages($keyword,$lang="vn"){
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
	public function getImagesByProperties($lang="vn",$properties,$limit = "10"){
		$this->db->where("lang",$lang);
		$this->db->limit($limit);
		$this->db->order_by("image_order","asc");
		$this->db->where("properties",$properties);
		return $this->db->get($this->_table)->result_array();
	}
}
