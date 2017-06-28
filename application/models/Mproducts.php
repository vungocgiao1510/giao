<?php
class Mproducts extends CI_Model{
	protected $_table = "products";
	public function __construct(){
		parent::__construct();
	}
	public function listAllProduct($all, $start, $lang="vn", $order="desc", $active="") {
		// Hiển thị toàn bộ bài viết.
		if($active != ""){
			$this->db->where("products.active", $active);
		}
		$this->db->where("products.lang",$lang);
		$this->db->select("products.id, products.title, products.price, products.created, products.updated,products.image, products.active, users.username, categorie.title as cate_title");		
		$this->db->order_by("products.id",$order);
		$this->db->limit ( $all, $start );
		$this->db->join("categorie","categorie.id = products.cate_id");
		$this->db->join("users","users.id = products.user_id");
		return $this->db->get ( $this->_table )->result_array ();
	}
	public function getProductsById($id){
		$this->db->where("id",$id);
		return $this->db->get($this->_table)->row_array();
	}
	public function insertProducts($data){
		$this->db->insert($this->_table,$data);
	}
	public function updateProducts($id,$data){
		$this->db->where("id",$id);
		$this->db->update($this->_table,$data);
	}
	public function deleteProducts($id){
		$this->db->where("id",$id);
		$this->db->delete($this->_table);
	}
	public function SearchProductsByKeyword($keyword,$all,$start,$order="desc", $active="",$lang="vn"){
		if($active != ""){
			$this->db->where("products.active", $active);
		}
		$this->db->where("products.lang",$lang);
		$this->db->select("products.id, products.title,products.price, products.created, products.updated,products.image, products.active, users.username, categorie.title as cate_title");
		$this->db->limit ( $all, $start );
		$this->db->order_by("products.id",$order);
		$this->db->like('products.title',$keyword);
		$this->db->join("categorie","categorie.id = products.cate_id");
		$this->db->join("users","users.id = products.user_id");
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}
	public function countSearchProducts($keyword,$lang="vn"){
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