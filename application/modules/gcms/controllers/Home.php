<?php
class Home extends AdminController {
	public function __construct() {
		parent::__construct ();
	}
	public function index() {
		$lang = $this->session->userdata ['lang'];
		$this->_data ['title'] = "Trang quản trị hệ thống";
		$this->_data ['loadPage'] = "home/index_view";
		$this->_data['countnews'] = $this->Mnews->countAll($lang);
		$this->_data['countproducts'] = $this->Mproducts->countAll($lang);
// 		$this->_data['countorder'] = $this->Morder->countAll();
		$this->_data['countcategorie'] = $this->Mcategorie->countAll($lang);
		$this->_data['countimages'] = $this->Mimages->countAll($lang);
		$this->_data['countuser'] = $this->Muser->countAll();
		$this->_data['countcontact'] = $this->Mcontact->countAll($lang);
		$this->_data['countorder'] = $this->Morder->countAll($lang);
// 		$this->_data['countcomment'] = $this->Mcomment->countAll();
		// $this->_data ['loadPage'] Đường dẫn đến phần nổi dung hiển thị views ở trang chủ.
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function permissions(){
		$this->_data ['title'] = "Lỗi truy cập";
		$this->_data ['loadPage'] = "home/permissions_view";
		$this->_data['error'] = "Bạn không đủ quyền hạn để truy cập, vui lòng liên hệ super admin để được cấp quyền truy cập.";
		$this->_data['descriptionerr'] = $this->session->userdata("description");
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