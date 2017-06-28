<?php
class Contact extends AdminController{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->_data ['title'] = "Danh sách liên hệ";
		$this->_data ['loadPage'] = "mail/index_view";
		$this->_data ['error'] = $this->session->flashdata ( "flash_error" );
		$this->_data ['success'] = $this->session->flashdata ( "flash_mess" );
		$this->_data ['data'] = "";
		$this->_data ['keyword'] = "";
		$this->_data ['countSearch'] = "";
		// config setting phần phân trang.
		$config ['base_url'] = ($this->input->get ( "keyword" )) ? base_url () . "gcms/contact/index/?keyword=" . $this->input->get ( "keyword" ) : base_url () . "gcms/user/index/";
		// $config ['base_url'] = base_url () . "gcms/user/index/";
		$config ['total_rows'] = ($this->input->get ( "keyword" )) ? $this->Mcontact->countSearchUser ( $this->input->get ( "keyword" ) ) : $this->Mmail->countAll ();
		$config ['per_page'] = ($this->session->userdata ( "limit" )) ? $this->session->userdata ( "limit" ) : 10;
		$config ['uri_segment'] = 4;
		$config ['full_tag_open'] = '<ul class="pagination">';
		$config ['full_tag_close'] = '</ul>';
		$config ['first_link'] = 'Đầu trang';
		$config ['last_link'] = 'Cuối trang';
		$config ['first_tag_open'] = '<li>';
		$config ['first_tag_close'] = '</li>';
		$config ['last_tag_open'] = '<li>';
		$config ['last_tag_close'] = '</li>';
		$config ['prev_link'] = '&laquo;';
		$config ['prev_tag_open'] = '<li>';
		$config ['prev_tag_close'] = '</li>';
		$config ['next_link'] = '&raquo;';
		$config ['next_tag_open'] = '<li>';
		$config ['next_tag_close'] = '</li>';
		$config ['num_tag_open'] = '<li>';
		$config ['num_tag_close'] = '</li>';
		$config ['cur_tag_open'] = '<li class="active"><a href="#">';
		$config ['cur_tag_close'] = '</a></li>';
		$config ['use_page_numbers'] = TRUE;
		$config ['page_query_string'] = TRUE;
		// $config ['page_query_string'] = TRUE;
		// Truyền $config vào initialize.
		$this->pagination->initialize ( $config );
		$this->_data ['pagination'] = $this->pagination->create_links ();
		$current_page = ($this->input->get ( "per_page" )) ? $this->input->get ( "per_page" ) : 1;
		$start = ($current_page - 1) * $config ['per_page'];
		// echo $start;
		// echo $config ['per_page'];
		if ($this->input->post ( "locds" )) {
			$ses_locds = array (
					"locds" => $this->input->post ( "locds" )
			);
			$this->session->set_userdata ( $ses_locds );
		}
		$locds = $this->session->userdata ( "locds" );
		$this->_data ['locds'] = $locds;
		
		if ($this->input->get ( "keyword" )) {
			// $ses_search = array("keyword" => $this->input->get("keyword"));
			// $this->session->set_userdata($ses_search);
			$this->_data ['keyword'] = $this->input->get ( "keyword" );
			$this->_data ['countSearch'] = $this->Mcontact->countSearchUser ( $this->_data ['keyword'] );
			$this->_data ['data'] = $this->Mcontact->SearchUserByKeyword ( $this->_data ['keyword'], $config ['per_page'], $start );
		} elseif ($locds == "desc" || $locds == "asc") {
			$this->_data ['data'] = $this->Mcontact->listAllUser ( $config ['per_page'], $start, $locds );
		} elseif ($locds == "1" || $locds == "2") {
			$this->_data ['data'] = $this->Mcontact->listAllUser ( $config ['per_page'], $start, "", $locds );
		} else {
			$this->_data ['data'] = $this->Mcontact->listAllUser ( $config ['per_page'], $start );
		}
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function view($id=""){
		$this->_data ['error'] = "";
		$this->_data ['title'] = "Xem thông tin người liên hệ";
		$this->_data ['loadPage'] = "user/edit_view";
		// Hiển thị thông tin member khi get được ID.
		$this->_data ['data'] = $this->contact->getUserById ( $id );
		if ($this->form_validation->run () == TRUE) {
			// Mảng chưa dữ liệu cần update
			$data_update = array (
					"username" => $this->input->post ( "username" ),
					"group_id" => $this->input->post ( "group" ),
					"updated" => date ( "Y-m-d" ),
					"active" => $this->input->post ( "active" )
			);
			// Sửa liên hệ vào trong CSDL.
			$this->Mcontact->updateUser ( $data_update, $id );
			// Flashdata báo sửa thành công.
			$this->session->set_flashdata ( "flash_mess", "Trả lời liên hệ thành công." );
			redirect ( base_url () . "gcms/contact/index" );
		}
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function delete($id=""){
		$this->Mcontact->deleteUser ( $id );
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục xóa thành viên." );
			redirect ( base_url () . "gcms/contact/index" );
	}
	public function deleteCB($id=""){
		if ($this->input->post ( "checkAll" )) {
			foreach ( $this->input->post ( "checkAll" ) as $del_id ) {
				$del_id = ( int ) $del_id;
				$this->Mcontact->deleteUser ( $del_id );
			}
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục xóa thành viên." );
			redirect ( base_url () . "gcms/contact/index" );
		} else {
			$this->session->set_flashdata ( "flash_error", "Bạn chưa chọn thành viên cần xóa." );
			redirect ( base_url () . "gcms/contact/index" );
		}
	}
}