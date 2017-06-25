<?php
class News extends AdminController{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->_data ['title'] = "Danh sách bài viết";
		$this->_data ['loadPage'] = "news/index_view";
		$this->_data ['error'] = $this->session->flashdata ( "flash_error" );
		$this->_data ['success'] = $this->session->flashdata ( "flash_mess" );
		$this->_data ['data'] = "";
		$this->_data ['keyword'] = "";
		$this->_data ['countSearch'] = "";
		// config setting phần phân trang.
		$config ['base_url'] = ($this->input->get ( "keyword" )) ? base_url () . "gcms/news/index/?keyword=" . $this->input->get ( "keyword" ) : base_url () . "gcms/news/index/";
		// $config ['base_url'] = base_url () . "gcms/user/index/";
		$config ['total_rows'] = ($this->input->get ( "keyword" )) ? $this->Mnews->countSearchNews( $this->input->get ( "keyword" ) ) : $this->Mnews->countAll ();
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
			$this->_data ['countSearch'] = $this->Mnews->countSearchNews( $this->_data ['keyword'] );
			$this->_data ['data'] = $this->Mnews->SearchNewsByKeyword( $this->_data ['keyword'], $config ['per_page'], $start );
		} elseif ($locds == "desc" || $locds == "asc") {
			$this->_data ['data'] = $this->Mnews->listAllNews( $config ['per_page'], $start, $locds );
		} elseif ($locds == "1" || $locds == "2") {
			$this->_data ['data'] = $this->Mnews->listAllNews( $config ['per_page'], $start, "", $locds );
		} else {
			$this->_data ['data'] = $this->Mnews->listAllNews( $config ['per_page'], $start );
		}
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function add(){
		$this->_data ['error'] = "";
		$this->_data ['title'] = "Thêm mới thành viên";
		$this->_data ['loadPage'] = "news/add_view";
		$data_insert['content'] = "";
		$data_insert['list_image'] = "";
		$this->_data['menu'] = $this->Mcategorie->listCategorieNews($this->session->userdata('lang'));
		// Validation Form khi nhập sai
		$this->form_validation->set_message ( 'required', '{field} không được để trống.' );
		$this->form_validation->set_message ( 'min_length', '{field} phải nhiều hơn 5 ký tự.' );
		$this->form_validation->set_message ( 'max_length', '{field} phải nhỏ hơn 14 ký tự.' );
		$this->form_validation->set_message ( 'matches', '{field} không đúng, vui lòng nhập lại.' );
		$this->form_validation->set_rules ( 'title', 'Tên bài viết', 'required|min_length[4]');
		$this->form_validation->set_rules ( 'link', 'Link', 'required|min_length[4]');
		$this->form_validation->set_rules ( 'titleseo', 'Tiêu đề', 'required|min_length[4]');
		$this->form_validation->set_rules ( 'keyword', 'Từ khóa', 'required|min_length[4]');
		$this->form_validation->set_rules ( 'description', 'Mô tả', 'required|min_length[4]');
		$this->form_validation->set_rules ( 'image', 'Hình ảnh', 'required|min_length[4]');
		$this->form_validation->set_rules ( 'menu', 'Chuyên mục', 'required');
		
		// 		$this->form_validation->set_rules ( 'group', 'Nhóm', 'required' );
		if ($this->form_validation->run () == TRUE) {
			// Mảng chứa dữ liệu cần insert
			$data_insert = array (
					"title" => $this->input->post ( "title" ),
					"linkseo" => unicode($this->input->post ( "link" )),
					"titleseo" => $this->input->post ( "titleseo" ),
					"keyword" => $this->input->post ( "keyword" ),
					"description" => $this->input->post ( "description" ),
					"image" => $this->input->post ( "image" ),
					"type" => $this->input->post ( "type" ),
					"user_id" => $this->session->userdata("id"),
					"cate_id" => $this->input->post ( "menu" ),
					"created" => date ( "Y-m-d" ),
					"active" => "1",
					"content" => $this->session->userdata("lang"),
			);
			if($this->input->post("content") != ""){
				$data_insert['content'] = $this->input->post ( "content" );
			}
			if($this->input->post("list_image") != ""){
				$data_insert['list_image'] = $this->input->post ( "list_image" );
			}
			// Insert dữ liệu
			$this->Mnews->insertNews($data_insert );
			// Flash mess thông báo insert thành công
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục thêm bài viết." );
			redirect ( base_url () . "gcms/news/index" );
		}
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function edit(){
		
	}
	public function delete(){
		
	}
}