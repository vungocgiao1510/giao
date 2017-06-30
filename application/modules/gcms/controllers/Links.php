<?php
class Links extends AdminController {
	public function __construct() {
		parent::__construct ();
		$this->_data ['properties'] = array (
				"1" => "Liên kết chân trang",
				"2" => "Liên kết khác",
		);
	}
	public function index() {
		$this->_data ['title'] = "Danh sách hình ảnh";
		$this->_data ['loadPage'] = "links/index_view";
		$this->_data ['error'] = $this->session->flashdata ( "flash_error" );
		$this->_data ['success'] = $this->session->flashdata ( "flash_mess" );
		$this->_data ['data'] = "";
		$this->_data ['keyword'] = "";
		$this->_data ['countSearch'] = "";
		$lang = $this->session->userdata ['lang'];
		// config setting phần phân trang.
		$config ['base_url'] = ($this->input->get ( "keyword" )) ? base_url () . "gcms/links/index/?keyword=" . $this->input->get ( "keyword" ) : base_url () . "gcms/links/index/";
		// $config ['base_url'] = base_url () . "gcms/user/index/";
		$config ['total_rows'] = ($this->input->get ( "keyword" )) ? $this->Mlinks->countSearchLinks( $this->input->get ( "keyword" ), $lang ) : $this->Mlinks->countAll ( $lang );
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
			$this->_data ['countSearch'] = $this->Mlinks->countSearchLinks ( $this->_data ['keyword'], $lang );
			$this->_data ['data'] = $this->Mlinks->SearchLinksByKeyword ( $this->_data ['keyword'], $config ['per_page'], $start, $lang );
		} elseif ($locds == "desc" || $locds == "asc") {
			$this->_data ['data'] = $this->Mlinks->listAllLinks ( $config ['per_page'], $start, $lang, $locds );
		} elseif ($locds == "1" || $locds == "2") {
			$this->_data ['data'] = $this->Mlinks->listAllLinks ( $config ['per_page'], $start, $lang, "", $locds );
		} else {
			$this->_data ['data'] = $this->Mlinks->listAllLinks ( $config ['per_page'], $start, $lang );
		}
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function add() {
		$this->_data ['error'] = "";
		$this->_data ['title'] = "Thêm mới liên kết";
		$this->_data ['loadPage'] = "links/add_view";
		// Validation Form khi nhập sai
		$this->form_validation->set_message ( 'required', '{field} không được để trống.' );
		$this->form_validation->set_message ( 'min_length', '{field} phải nhiều hơn 5 ký tự.' );
		$this->form_validation->set_message ( 'max_length', '{field} phải nhỏ hơn 14 ký tự.' );
		$this->form_validation->set_message ( 'matches', '{field} không đúng, vui lòng nhập lại.' );
		$this->form_validation->set_rules ( 'title', 'Tên bài viết', 'required|min_length[4]' );
		$this->form_validation->set_rules ( 'link', 'Link', 'required|min_length[4]' );
		$this->form_validation->set_rules ( 'description', 'Mô tả', 'required|min_length[4]' );
// 		$this->form_validation->set_rules ( 'image', 'Hình ảnh', 'required|min_length[4]' );
		$this->form_validation->set_rules ( 'properties', 'Chuyên mục', 'required' );
		
		// $this->form_validation->set_rules ( 'group', 'Nhóm', 'required' );
		if ($this->form_validation->run () == TRUE) {
			// Mảng chứa dữ liệu cần insert
			$data_insert = array (
					"title" => $this->input->post ( "title" ),
					"link" => unicode ( $this->input->post ( "link" ) ),
					"link_order" => $this->input->post ( "link_order" ),
					"description" => $this->input->post ( "description" ),
					"image" => $this->input->post ( "image" ),
					"properties" => $this->input->post ( "properties" ),
					// 					"type" => $this->input->post ( "type" ),
					"created" => date ( "Y-m-d" ),
					"active" => "1",
					"lang" => $this->session->userdata ( "lang" )
			);
			// Insert dữ liệu
			$this->Mlinks->insertLinks ( $data_insert );
			// Flash mess thông báo insert thành công
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục thêm liên kết." );
			redirect ( base_url () . "gcms/links/index" );
		}
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function edit($id = "") {
		$this->_data ['error'] = "";
		$this->_data ['title'] = "Cập nhật liên kết";
		$this->_data ['loadPage'] = "links/edit_view";
		$this->_data ['data'] = $this->Mlinks->getLinksById( $id );
		// Validation Form khi nhập sai
		$this->form_validation->set_message ( 'required', '{field} không được để trống.' );
		$this->form_validation->set_message ( 'min_length', '{field} phải nhiều hơn 5 ký tự.' );
		$this->form_validation->set_message ( 'max_length', '{field} phải nhỏ hơn 14 ký tự.' );
		$this->form_validation->set_message ( 'matches', '{field} không đúng, vui lòng nhập lại.' );
		$this->form_validation->set_rules ( 'title', 'Tên bài viết', 'required|min_length[4]' );
		$this->form_validation->set_rules ( 'link', 'Link', 'required|min_length[4]' );
		$this->form_validation->set_rules ( 'description', 'Mô tả', 'required|min_length[4]' );
		$this->form_validation->set_rules ( 'properties', 'Chuyên mục', 'required' );
		
		// $this->form_validation->set_rules ( 'group', 'Nhóm', 'required' );
		if ($this->form_validation->run () == TRUE) {
			// Mảng chứa dữ liệu cần update
			$data_update = array (
					"title" => $this->input->post ( "title" ),
					"link" =>  $this->input->post ( "link" ),
					"link_order" => $this->input->post ( "link_order" ),
					"description" => $this->input->post ( "description" ),
					"image" => $this->input->post ( "image" ),
					"properties" => $this->input->post ( "properties" ),
// 					"type" => $this->input->post ( "type" ),
					"updated" => date ( "Y-m-d" ),
					"active" => "1",
					"lang" => $this->session->userdata ( "lang" )
			);
			// Insert dữ liệu
			$this->Mlinks->updateLinks ( $id, $data_update );
			// Flash mess thông báo insert thành công
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ sửa liên kết." );
			redirect ( base_url () . "gcms/links/index" );
		}
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function delete($id = "") {
		$this->Mlinks->deleteLinks ( $id );
		redirect ( base_url () . "gcms/links/index" );
	}
	public function deleteCB() {
		if ($this->input->post ( "checkAll" )) {
			foreach ( $this->input->post ( "checkAll" ) as $del_id ) {
				$del_id = ( int ) $del_id;
				$this->Mlinks->deleteLinks ( $del_id );
			}
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục xóa liên kết." );
			redirect ( base_url () . "gcms/links/index" );
		} else {
			$this->session->set_flashdata ( "flash_error", "Bạn chưa chọn liên kết cần xóa." );
			redirect ( base_url () . "gcms/links/index" );
		}
	}
}