<?php
class Setting extends AdminController{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->_data ['error'] = "";
		$this->_data ['title'] = "Cấu hình hệ thống";
		$this->_data ['loadPage'] = "setting/index_view";
		$this->_data['success'] = $this->session->flashdata ( "flash_mess");
		// Hiển thị thông tin member khi get được ID.
// 		$this->_data ['data'] = $this->Msetting->getUserById ( $id );
		$this->_data['data'] = $this->Msetting->getSettingById();
		$this->form_validation->set_message ( 'required', '{field} không được để trống.' );
		$this->form_validation->set_message ( 'min_length', '{field} phải nhiều hơn 5 ký tự.' );
		$this->form_validation->set_message ( 'max_length', '{field} phải nhỏ hơn 14 ký tự.' );
		$this->form_validation->set_message ( 'matches', '{field} không đúng, vui lòng nhập lại.' );
		$this->form_validation->set_rules ( 'title', 'Tài khoản', 'required|min_length[5]');
		if ($this->form_validation->run () == TRUE) {
			// Mảng chưa dữ liệu cần update
			$data_update = array (
					"title" => $this->input->post ( "title" ),
					"keywords" => $this->input->post ( "keywords" ),
					"description" => $this->input->post ( "description" ),
					"logo" => $this->input->post ( "logo" ),
					"favicon" => $this->input->post ( "favicon" ),
					"hotline" => $this->input->post ( "hotline" ),
					"phone" => $this->input->post ( "phone" ),
					"address" => $this->input->post ( "address" ),
					"content" => $this->input->post ( "content" ),
					"lang" => $this->session->userdata("lang"),
			);
			// Sửa liên hệ vào trong CSDL.
			$this->Msetting->updateSetting ( $data_update );
			// Flashdata báo sửa thành công.
			$this->session->set_flashdata ( "flash_mess", "Cấu hình thành công." );
		}
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
}