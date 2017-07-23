<?php  
class Morder extends CI_Model{
	protected $_table = "orders";
	public function __construct(){
		parent::__construct();
	}
	public function insertOrder($insert){
		$this->db->insert($this->_table,$insert);
	}
	public function listOrder($all, $start, $order="desc", $active="") {
		// Hiển thị toàn bộ thành viên.
		if($active != ""){
			$this->db->where("active", $active);
		}
		$this->db->order_by("id",$order);
		$this->db->limit ( $all, $start );
		return $this->db->get ( $this->_table )->result_array ();
	}
	public function listOrderOnTop($lang){
		$this->db->where("lang",$lang);
		$this->db->where("active",2);
		$this->db->order_by("id","desc");
		return $this->db->get($this->_table)->result_array();
	}
	public function getOrderById($id){
		$this->db->where("id",$id);
		return $this->db->get($this->_table)->row_array();
	}
	public function countAll($lang="vn"){
		$this->db->where("lang",$lang);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
	public function updateOrder($id,$data){
		$this->db->where("id",$id);
		$this->db->update($this->_table,$data);
	}
}
?>