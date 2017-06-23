<?php
class Categorie extends AdminController{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->_data ['title'] = "Danh sách chuyên mục";
		$this->_data ['loadPage'] = "categorie/index_view";
		$this->_data ['error'] = $this->session->flashdata ( "flash_error" );
		$this->_data ['success'] = $this->session->flashdata ( "flash_mess" );
		$this->_data ['data'] = "";
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function add(){
		$this->_data ['title'] = "Thêm mới chuyên mục";
		$this->_data ['loadPage'] = "categorie/add_view";
		$this->_data ['data'] = "";
		$this->form_validation->set_message ( 'required', '{field} không được để trống.' );
		$this->form_validation->set_message ( 'min_length', '{field} phải nhiều hơn 5 ký tự.' );
		$this->form_validation->set_message ( 'max_length', '{field} phải nhỏ hơn 14 ký tự.' );
		$this->form_validation->set_message ( 'matches', '{field} không đúng, vui lòng nhập lại.' );
		$this->form_validation->set_rules ( 'title', 'Tên chuyên mục', 'required|min_length[5]|max_length[14]' );
		$this->form_validation->set_rules ( 'link', 'Link', 'required|min_length[5]|max_length[14]' );
		$this->form_validation->set_rules ( 'titleseo', 'Tên chuyên mục', 'required|min_length[5]|max_length[14]' );
		$this->form_validation->set_rules ( 'order', 'Thứ tự hiển thị', 'required|min_length[5]|max_length[14]' );
		$this->form_validation->set_rules ( 'image', 'Ảnh đại diện', 'required|min_length[5]|max_length[14]' );
		if ($this->form_validation->run () == TRUE) {
			
		}
		
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function edit($id=""){
		$this->_data ['title'] = "Sửa chuyên mục";
		$this->_data ['loadPage'] = "categorie/edit_view";
		$this->_data ['data'] = "";
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function delete($id=""){
		
	}
}