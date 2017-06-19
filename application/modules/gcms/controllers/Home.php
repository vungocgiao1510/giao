<?php
class Home extends AdminController {
	public function __construct() {
		parent::__construct ();
	}
	public function index() {
		$this->_data ['title'] = "Trang quản trị hệ thống";
		$this->_data ['loadPage'] = "home/index_view";
		// $this->_data ['loadPage'] Đường dẫn đến phần nổi dung hiển thị views ở trang chủ.
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function logout() {
		$this->session->sess_destroy();
		session_start();
		session_destroy();
		redirect(base_url()."gcms");
	}
}