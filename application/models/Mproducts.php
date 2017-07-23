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
	public function listAllProductHot($limit="5",$lang="vn"){
		$this->db->where("products.active", 1);
		$this->db->where("products.type",1);
		$this->db->where("products.lang",$lang);
		$this->db->select("products.id, products.title, products.linkseo, products.promotion, products.price, products.image, products.active, categorie.linkseo as cate_linkseo");
		$this->db->order_by("products.id","desc");
		$this->db->limit ($limit);
		$this->db->join("categorie","categorie.id = products.cate_id");
		return $this->db->get ( $this->_table )->result_array ();
	}
	public function listAllProductNews($lang="vn"){
		$this->db->where("products.active", 1);
		$this->db->where("products.lang",$lang);
		$this->db->select("products.id, products.title, products.linkseo, products.promotion, products.price, products.image, products.active, categorie.linkseo as cate_linkseo");
		$this->db->order_by("products.id","desc");
		$this->db->limit (8);
		$this->db->join("categorie","categorie.id = products.cate_id");
		return $this->db->get ( $this->_table )->result_array ();
	}
	public function listAllProductByCateMain($all,$start,$lang="vn",$cate) {
		// Hiển thị toàn bộ bài viết.
		$this->db->select("products.id,products.title,products.linkseo,products.titleseo,products.price,products.promotion,products.image, categorie.cate_parent");
		$this->db->where("products.lang",$lang);
		$this->db->where("categorie.cate_parent",$cate);
		$this->db->where("products.active",1);
		$this->db->limit($all,$start);
		$this->db->order_by("products.id","desc");
		$this->db->join("categorie","categorie.id = products.cate_id");
		return $this->db->get($this->_table)->result_array();
	}
	public function listAllProductByCate($all,$start,$lang="vn",$cate) {
		// Hiển thị toàn bộ bài viết.
		$this->db->where("lang",$lang);
		$this->db->where("cate_id",$cate);
		$this->db->where("active",1);
		$this->db->select("id,title,titleseo,linkseo,image,promotion,price,cate_id");
		$this->db->limit($all,$start);
		$this->db->order_by("id","desc");
		return $this->db->get($this->_table)->result_array();
	}
	public function listAllProductOtherMain($lang="vn",$cate,$id) {
		// Hiển thị toàn bộ bài viết.
		$this->db->select("products.id,products.title,products.linkseo,products.titleseo,products.price,products.promotion,products.image, categorie.cate_parent");
		$this->db->where("products.id !=",$id);
		$this->db->where("products.lang",$lang);
		$this->db->where("categorie.cate_parent",$cate);
		$this->db->where("products.active",1);
		$this->db->limit(8);
		$this->db->order_by("products.id","desc");
		$this->db->join("categorie","categorie.id = products.cate_id");
		return $this->db->get($this->_table)->result_array();
	}
	public function listAllProductOther($lang="vn",$cate,$id) {
		$this->db->select("id,title,titleseo,linkseo,image,promotion,price,cate_id,lang");
		$this->db->where("id !=",$id);
		$this->db->where("cate_id",$cate);
		$this->db->where("lang",$lang);
		$query=$this->db->get($this->_table);
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return FALSE;
		}
	}
	public function getProductsById($id,$lang="vn"){
		$this->db->where("id",$id);
		$this->db->where("lang",$lang);
		return $this->db->get($this->_table)->row_array();
	}
	public function getProductById($id){
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
	public function searchProduct($keyword,$all,$start,$lang="vn"){
		$this->db->select("products.id, products.title,products.linkseo, products.price, products.promotion,products.image, products.active, categorie.title as cate_title, categorie.linkseo as cate_linkseo");
		$this->db->where("products.lang",$lang);
		$this->db->limit($all,$start);
		$this->db->order_by("products.id","desc");
		$this->db->like("products.title",$keyword);
		$this->db->join("categorie","categorie.id = products.cate_id");
		return $this->db->get($this->_table)->result_array();
	}
	public function countSearchProducts($keyword,$lang="vn"){
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