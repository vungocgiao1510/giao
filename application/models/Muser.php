<?php
class Muser extends CI_Model {
	protected $_table = "users";
	protected $_table2 = "user_permissions";
	public function __construct() {
		parent::__construct ();
	}
	public function checkLogin($user, $pass) {
		// Kiểm tra đăng nhập
		$this->db->where ( 'username', $user );
		$this->db->where ( 'password', $pass );
		$this->db->join("user_permissions","user_permissions.group_id=users.group_id");
		$query = $this->db->get ( $this->_table );
		if ($query->num_rows () > 0) {
			return $query->row_array ();
		} else {
			return FALSE;
		}
	}
	public function insertUser($insert) {
		// Thêm thành viên
// 		$this->db->join('user_role','user_role.id=users.role_id');
		$this->db->insert ( $this->_table, $insert );
	}
	public function checkUser($user, $id = "") {
		/*
		 * Kiểm tra thành viên có tồn tại hay không.
		 * Kiểm tra id để khi sửa, nếu bị trùng username thì vẫn có thể giữ nguyên được username khi sửa.
		 */
		if ($id != "") {
			$this->db->where ( "id !=", $id );
		}
		$this->db->where ( "username", $user );
		$query = $this->db->get ( $this->_table );
		if ($query->num_rows () > 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function listAllUser($all, $start, $order="desc", $active="") {
		// Hiển thị toàn bộ thành viên.
		if($active != ""){
			$this->db->where("active", $active);
		}
		$this->db->order_by("users.id",$order);
		$this->db->limit ( $all, $start );
		$this->db->join("user_permissions","user_permissions.group_id = users.group_id");
		return $this->db->get ( $this->_table )->result_array ();
	}
	public function SearchUserByKeyword($keyword,$all,$start,$order="desc", $active=""){
		if($active != ""){
			$this->db->where("active", $active);
		}
		$this->db->limit ( $all, $start );
		$this->db->order_by("id",$order);
		$this->db->like('username',$keyword);
		$this->db->join("user_permissions","user_permissions.group_id = users.group_id");
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}
	public function countSearchUser($keyword){
		$this->db->like('username',$keyword);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
	public function countAll() {
		return $this->db->count_all ( $this->_table );
	}
	public function getUserById($id) {
		// Hiển thị một thành viên theo id được nhận.
		$this->db->where ( "id", $id );
		$query = $this->db->get ( $this->_table );
		return $query->row_array ();
	}
	public function updateUser($data, $id) {
		// Sửa thành viên.
		$this->db->where ( "id", $id );
		$this->db->update ( $this->_table, $data );
	}
	public function deleteUser($id) {
		// Xóa thành viên
		$this->db->where ( "id", $id );
		$this->db->delete ( $this->_table );
	}
	public function insertUserGroup($insert){
		$this->db->insert ( $this->_table2, $insert );
	}
	public function listUserGroup($all, $start, $order="desc"){
		$this->db->order_by("group_id",$order);
		$this->db->limit ( $all, $start );
		return $this->db->get ( $this->_table2 )->result_array ();
	}
	public function listUserGroupById($id){
		$this->db->where("group_id",$id);
		return $this->db->get ( $this->_table2 )->row_array();
	}
	public function listUserGroupSelectBox(){
		$this->db->order_by("group_id","desc");
		return $this->db->get ( $this->_table2 )->result_array ();
	}
	public function updateUserGroup($data, $id) {
		// Sửa thành viên.
		$this->db->where ( "group_id", $id );
		$this->db->update ( $this->_table2, $data );
	}
	public function countAllUserGroup() {
		return $this->db->count_all ( $this->_table2 );
	}
	public function countSearchUserGroup($keyword){
		$this->db->like('usergroup',$keyword);
		$query = $this->db->get($this->_table2);
		return $query->num_rows();
	}
	public function SearchUserGroupByKeyword($keyword,$all,$start,$order="desc"){
		$this->db->limit ( $all, $start );
		$this->db->order_by("group_id",$order);
		$this->db->like('usergroup',$keyword);
		$query = $this->db->get($this->_table2);
		return $query->result_array();
	}
	public function deleteUserGroup($id) {
		// Xóa thành viên
		$this->db->where ( "group_id", $id );
		$this->db->delete ( $this->_table2 );
	}
}