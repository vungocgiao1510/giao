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
		$this->db->select("news.id, news.title, news.created, news.updated, news.image, news.active, users.username, categorie.title as cate_title");		
		$this->db->order_by("news.id",$order);
		$this->db->limit ( $all, $start );
		$this->db->join("categorie","categorie.id = news.cate_id");
		$this->db->join("users","users.id = news.user_id");
		return $this->db->get ( $this->_table )->result_array ();
	}
	public function listAllNewsByCate($all,$start,$lang="vn",$cate){
		$this->db->where("news.active", 1);
		$this->db->where("news.cate_id",$cate);
		$this->db->where("news.lang",$lang);
		$this->db->select("news.id, news.title, news.linkseo, news.titleseo, news.description, news.created, news.updated,news.image, news.active, users.username, categorie.title as cate_title");
		$this->db->order_by("news.id","desc");
		$this->db->limit ( $all, $start );
		$this->db->join("categorie","categorie.id = news.cate_id");
		$this->db->join("users","users.id = news.user_id");
		return $this->db->get ( $this->_table )->result_array ();
	}
	public function listAllNews2($lang="vn"){
		$this->db->where("news.active", 1);
		$this->db->where("news.lang",$lang);
		$this->db->select("news.id, news.title, news.linkseo, news.description, news.image, news.active, categorie.linkseo as cate_linkseo");
		$this->db->order_by("news.id","desc");
		$this->db->limit (4);
		$this->db->join("categorie","categorie.id = news.cate_id");
		return $this->db->get ( $this->_table )->result_array ();
	}
	public function listAllNewsOther($lang="vn",$id,$limit="5"){
		$this->db->select("id,title,linkseo,titleseo,image");
		$this->db->where("lang",$lang);
		$this->db->where("id !=",$id);
		$this->db->limit($limit);
		$this->db->order_by("id","desc");
		return $this->db->get($this->_table)->result_array();
	}
	public function getNewsById($id){
		$this->db->where("id",$id);
		return $this->db->get($this->_table)->row_array();
	}
	public function getNewsById2($lang="vn",$id){
		$this->db->where("news.active", 1);
		$this->db->where("news.lang",$lang);
		$this->db->where("news.id",$id);
		$this->db->select("news.id, news.title, news.keyword, news.linkseo, news.titleseo, news.description, news.content, news.created, news.updated,news.image, news.active, users.username, categorie.title as cate_title");
		$this->db->join("categorie","categorie.id = news.cate_id");
		$this->db->join("users","users.id = news.user_id");
		return $this->db->get ( $this->_table )->row_array();
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
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
}