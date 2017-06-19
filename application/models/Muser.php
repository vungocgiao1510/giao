<?php
class Muser extends CI_Model {
	protected $_table = "users";
	public function __construct() {
		parent::__construct ();
	}
	public function checkLogin($user, $pass) {
		// Kiểm tra đăng nhập
		$this->db->where ( 'username', $user );
		$this->db->where ( 'password', $pass );
		$query = $this->db->get ( $this->_table );
		if ($query->num_rows () > 0) {
			return $query->row_array ();
		} else {
			return FALSE;
		}
	}
	public function insertUser($insert) {
		// Thêm thành viên
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
	public function listAllUser($all, $start) {
		// Hiển thị toàn bộ thành viên.
		$this->db->order_by("id","desc");
		$this->db->limit ( $all, $start );
		return $this->db->get ( $this->_table )->result_array ();
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
}