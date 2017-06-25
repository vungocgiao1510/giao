<?php
class Categorie extends AdminController {
	public function __construct() {
		parent::__construct ();
	}
	public function index() {
		$this->_data ['title'] = "Danh sách chuyên mục";
		$this->_data ['loadPage'] = "categorie/index_view";
		$this->_data ['error'] = $this->session->flashdata ( "flash_error" );
		$this->_data ['success'] = $this->session->flashdata ( "flash_mess" );
		$this->_data ['data'] = "";
		if ($this->Mcategorie->listCategorie () != FALSE) {
			$this->_data ['listmenu'] = $this->Mcategorie->listCategorie ($this->session->userdata('lang'));
		}
// 		 echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function add() {
		$this->_data ['title'] = "Thêm mới chuyên mục";
		$this->_data ['loadPage'] = "categorie/add_view";
		$this->_data ['data'] = "";
		$data_insert ['image'] = "";
		$this->_data ['error'] = "";
		// Hiển thị danh sách chuyên mục qua select box.
		if ($this->Mcategorie->listCategorie () != FALSE) {
			$this->_data ['menu'] = $this->Mcategorie->listCategorie ($this->session->userdata('lang'));
		}
		$this->form_validation->set_message ( 'required', '{field} không được để trống.' );
		$this->form_validation->set_message ( 'min_length', '{field} phải nhiều hơn 5 ký tự.' );
		$this->form_validation->set_message ( 'max_length', '{field} phải nhỏ hơn 14 ký tự.' );
		$this->form_validation->set_message ( 'matches', '{field} không đúng, vui lòng nhập lại.' );
		$this->form_validation->set_rules ( 'title', 'Tên chuyên mục', 'required|min_length[4]' );
		$this->form_validation->set_rules ( 'link', 'Link', 'required|min_length[4]' );
		$this->form_validation->set_rules ( 'titleseo', 'Tên chuyên mục', 'required|min_length[4]' );
		$this->form_validation->set_rules ( 'order', 'Thứ tự hiển thị', 'required' );
		if ($this->form_validation->run () == TRUE) {
			$data_insert = array (
					"title" => $this->input->post ( "title" ),
					"linkseo" => unicode ( $this->input->post ( "link" ) ),
					"titleseo" => $this->input->post ( "titleseo" ),
					"cate_order" => $this->input->post ( "order" ),
					"description" => $this->input->post ( "description" ),
					"image" => $this->input->post ( "image" ),
					"service" => $this->input->post ( "service" ),
					"cate_parent" => $this->input->post ( "menu" ),
					"created" => date ( "Y-m-d" ),
					"active" => 1 
			);
			// Insert dữ liệu
			$this->Mcategorie->insertCategorie ( $data_insert );
			// Flash mess thông báo insert thành công
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục thêm chuyên mục." );
			redirect ( base_url () . "gcms/categorie/index" );
		}
		
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function edit($id = "") {
		$this->_data ['title'] = "Cập nhật chuyên mục";
		$this->_data ['loadPage'] = "categorie/edit_view";
		$this->_data ['data'] = "";
		$data_insert ['image'] = "";
		$this->_data ['error'] = "";
		$data_update['image'] = "";
		// Hiển thị danh sách chuyên mục qua select box.
		if ($this->Mcategorie->listCategorie () != FALSE) {
			$this->_data ['menu'] = $this->Mcategorie->listCategorie ($this->session->userdata('lang'));
		}
		$this->_data ['data'] = $this->Mcategorie->listCategorieById ( $id );
		$this->form_validation->set_message ( 'required', '{field} không được để trống.' );
		$this->form_validation->set_message ( 'min_length', '{field} phải nhiều hơn 5 ký tự.' );
		$this->form_validation->set_message ( 'max_length', '{field} phải nhỏ hơn 14 ký tự.' );
		$this->form_validation->set_message ( 'matches', '{field} không đúng, vui lòng nhập lại.' );
		$this->form_validation->set_rules ( 'title', 'Tên chuyên mục', 'required|min_length[4]' );
		$this->form_validation->set_rules ( 'link', 'Link', 'required|min_length[4]' );
		$this->form_validation->set_rules ( 'titleseo', 'Tên chuyên mục', 'required|min_length[4]' );
		$this->form_validation->set_rules ( 'order', 'Thứ tự hiển thị', 'required' );
		if ($this->form_validation->run () == TRUE) {
			$data_update = array (
					"title" => $this->input->post ( "title" ),
					"linkseo" => unicode ( $this->input->post ( "link" ) ),
					"titleseo" => $this->input->post ( "titleseo" ),
					"cate_order" => $this->input->post ( "order" ),
					"description" => $this->input->post ( "description" ),
					"service" => $this->input->post ( "service" ),
					"cate_parent" => $this->input->post ( "menu" ),
					"updated" => date ( "Y-m-d" ),
					"active" => $this->input->post ( "active" ) 
			);
			if($this->input->post ( "image" ) != ""){
				$data_update['image'] = $this->input->post ( "image" );
			}
			// Insert dữ liệu
			$this->Mcategorie->updateCategorie ( $id, $data_update );
			// Flash mess thông báo insert thành công
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục cập nhật chuyên mục." );
			redirect ( base_url () . "gcms/categorie/index" );
		}
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function delete($id = "") {
		$this->Mcategorie->deleteCategorie($id);
		$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục xóa chuyên mục." );
		redirect ( base_url () . "gcms/categorie/index" );
	}
}