<?php
class Mnews extends CI_Model{
	protected $_table = "news";
	public function __construct(){
		parent::__construct();
	}
	public function listAllNews($all, $start, $lang="vn", $order="desc", $active="") {
		// Hiển thị toàn bộ bài viết.
		if($active != ""){
			$this->db->where("news.active", $active);
		}
		$this->db->where("news.lang",$lang);
		$this->db->select("news.id, news.title, news.created, news.updated,news.image, news.active, users.username, categorie.title as cate_title");		
		$this->db->order_by("news.id",$order);
		$this->db->limit ( $all, $start );
		$this->db->join("categorie","categorie.id = news.cate_id");
		$this->db->join("users","users.id = news.user_id");
		return $this->db->get ( $this->_table )->result_array ();
	}
	public function getNewsById($id){
		$this->db->where("id",$id);
		return $this->db->get($this->_table)->row_array();
	}
	public function insertNews($data){
		$this->db->insert($this->_table,$data);
	}
	public function updateNews($id,$data){
		$this->db->where("id",$id);
		$this->db->update($this->_table,$data);
	}
	public function deleteNews($id){
		$this->db->where("id",$id);
		$this->db->delete($this->_table);
	}
	public function SearchNewsByKeyword($keyword,$all,$start,$order="desc", $active="",$lang="vn"){
		if($active != ""){
			$this->db->where("news.active", $active);
		}
		$this->db->where("news.lang",$lang);
		$this->db->select("news.id, news.title, news.created, news.updated,news.image, news.active, users.username, categorie.title as cate_title");
		$this->db->limit ( $all, $start );
		$this->db->order_by("news.id",$order);
		$this->db->like('news.title',$keyword);
		$this->db->join("categorie","categorie.id = news.cate_id");
		$this->db->join("users","users.id = news.user_id");
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}
	public function countSearchNews($keyword,$lang="vn"){
		$this->db->where("lang",$lang);
		$this->db->like('title',$keyword);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
	public function countAll($lang="vn") {
		$this->db->where("lang",$lang);
		return $this->db->count_all ( $this->_table );
	}
}