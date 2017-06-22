<?php
class User extends AdminController {
	public function __construct() {
		parent::__construct ();
	}
	public function index() {
		$this->_data ['title'] = "Danh sách thành viên";
		$this->_data ['loadPage'] = "user/index_view";
		$this->_data ['error'] = $this->session->flashdata ( "flash_error" );
		$this->_data ['success'] = $this->session->flashdata ( "flash_mess" );
		$this->_data ['data'] = "";
		$this->_data ['keyword'] = "";
		$this->_data ['countSearch'] = "";
		// config setting phần phân trang.
		$config ['base_url'] = ($this->input->get ( "keyword" )) ? base_url () . "gcms/user/index/?keyword=" . $this->input->get ( "keyword" ) : base_url () . "gcms/user/index/";
		// $config ['base_url'] = base_url () . "gcms/user/index/";
		$config ['total_rows'] = ($this->input->get ( "keyword" )) ? $this->Muser->countSearchUser ( $this->input->get ( "keyword" ) ) : $this->Muser->countAll ();
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
			$this->_data ['countSearch'] = $this->Muser->countSearchUser ( $this->_data ['keyword'] );
			$this->_data ['data'] = $this->Muser->SearchUserByKeyword ( $this->_data ['keyword'], $config ['per_page'], $start );
		} elseif ($locds == "desc" || $locds == "asc") {
			$this->_data ['data'] = $this->Muser->listAllUser ( $config ['per_page'], $start, $locds );
		} elseif ($locds == "1" || $locds == "2") {
			$this->_data ['data'] = $this->Muser->listAllUser ( $config ['per_page'], $start, "", $locds );
		} else {
			$this->_data ['data'] = $this->Muser->listAllUser ( $config ['per_page'], $start );
		}
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	/*
	 * Phần jQuery Ajax để hiển thị số bài viết theo number được chọn ở select box.
	 */
	public function shownumber() {
		$number = $this->input->post ( "number" );
		$ses_number = array (
				"limit" => $number 
		);
		$this->session->set_userdata ( $ses_number );
	}
	public function add() {
		$this->_data ['error'] = "";
		$this->_data ['title'] = "Thêm mới thành viên";
		$this->_data ['loadPage'] = "user/add_view";
		$this->_data ['group_user'] = $this->Muser->listUserGroupSelectBox ();
		// Validation Form khi nhập sai
		$this->form_validation->set_message ( 'required', '{field} không được để trống.' );
		$this->form_validation->set_message ( 'min_length', '{field} phải nhiều hơn 5 ký tự.' );
		$this->form_validation->set_message ( 'max_length', '{field} phải nhỏ hơn 14 ký tự.' );
		$this->form_validation->set_message ( 'matches', '{field} không đúng, vui lòng nhập lại.' );
		$this->form_validation->set_rules ( 'username', 'Tài khoản', 'required|min_length[5]|max_length[14]|callback_check_user' );
		$this->form_validation->set_rules ( 'password', 'Mật khẩu', 'required|min_length[5]|max_length[14]' );
		$this->form_validation->set_rules ( 'password2', 'Xác nhận mật khẩu', 'trim|required|matches[password]|min_length[5]|max_length[14]' );
// 		$this->form_validation->set_rules ( 'group', 'Nhóm', 'required' );
		if ($this->form_validation->run () == TRUE) {
			// Mảng chứa dữ liệu cần insert
			$data_insert = array (
					"username" => $this->input->post ( "username" ),
					"password" => $this->input->post ( "password" ),
					"group_id" => $this->input->post ( "group" ),
					"created" => date ( "Y-m-d" ),
					"active" => "1" 
			);
			// Insert dữ liệu
			$this->Muser->insertUser ( $data_insert );
			// Flash mess thông báo insert thành công
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục thêm thành viên." );
			redirect ( base_url () . "gcms/user/index" );
		}
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function myprofile() {
		$this->_data ['error'] = "";
		$this->_data ['title'] = "Hồ sơ của bạn";
		$this->_data ['loadPage'] = "user/myprofile_view";
		$this->_data ['success'] = $this->session->flashdata ( "flash_mess" );
		// Hiển thị thông tin member khi get được ID.
		$this->_data ['data'] = $this->Muser->getUserById ( $this->session->userdata ( "id" ) );
		$this->_data ['group_user'] = $this->Muser->listUserGroupSelectBox ();
		// Validation Form khi nhập sai thông tin.
		$this->form_validation->set_message ( 'required', '{field} không được để trống.' );
		$this->form_validation->set_message ( 'min_length', '{field} phải nhiều hơn 5 ký tự.' );
		$this->form_validation->set_message ( 'max_length', '{field} phải nhỏ hơn 14 ký tự.' );
		$this->form_validation->set_message ( 'matches', '{field} không đúng, vui lòng nhập lại.' );
		// $this->form_validation->set_rules ( 'username', 'Tài khoản', 'required|min_length[5]|max_length[14]|callback_check_user' );
		$this->form_validation->set_rules ( 'password', 'Mật khẩu', 'min_length[5]|max_length[14]' );
		$this->form_validation->set_rules ( 'password2', 'Xác nhận mật khẩu', 'trim|matches[password]|min_length[5]|max_length[14]' );
		if ($this->form_validation->run () == TRUE) {
			// Mảng chưa dữ liệu cần update
			$data_update = array (
					// "username" => $this->input->post ( "username" ),
					// "level" => $this->input->post ( "level" ),
					"updated" => date ( "Y-m-d" ),
					"active" => $this->input->post ( "active" ) 
			);
			// Kiểm tra xem mật khẩu có hay không, nếu có thì thêm một mảng password vào để update.
			if ($this->input->post ( "password" )) {
				$data_update ["password"] = $this->input->post ( "password" );
			}
			// Update thành viên vào trong CSDL.
			$this->Muser->updateUser ( $data_update, $this->session->userdata ( "id" ) );
			// Flashdata báo sửa thành công.
			$this->session->set_flashdata ( "flash_mess", "Cập nhật hồ sơ thành công." );
			redirect ( base_url () . "gcms/user/myprofile" );
		}
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function check_user($user) {
		/*
		 * Kiểm tra xem username có tồn tại trong cơ sở dữ liệu hay không.
		 */
		$id = $this->uri->segment ( 4 );
		if ($this->Muser->checkUser ( $user, $id ) == FALSE) {
			$this->form_validation->set_message ( "check_user", "Tài khoản này đã tồn tại." );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function delete($id = "") {
		// Kiểm tra xem id có bằng 1 không, nếu id bằng 1 không được quyền thêm.
		if ($id == 1) {
			$this->session->set_flashdata ( "flash_error", "Bạn không đủ quyền hạn để xóa thành viên này." );
			redirect ( base_url () . "gcms/user/index" );
		} else {
			$this->Muser->deleteUser ( $id );
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục xóa thành viên." );
			redirect ( base_url () . "gcms/user/index" );
		}
	}
	public function edit($id = "") {
		// Kiểm tra xem id có bằng 1 không, nếu id bằng 1 không được quyền sửa.
		if ($id == 1) {
			$this->session->set_flashdata ( "flash_error", "Bạn không đủ quyền hạn để sửa thành viên này." );
			redirect ( base_url () . "gcms/user/index" );
		}
		$this->_data ['error'] = "";
		$this->_data ['title'] = "Sửa thành viên";
		$this->_data ['loadPage'] = "user/edit_view";
		// Hiển thị thông tin member khi get được ID.
		$this->_data ['data'] = $this->Muser->getUserById ( $id );
		$this->_data ['group_user'] = $this->Muser->listUserGroupSelectBox ();
		// Validation Form khi nhập sai thông tin.
		$this->form_validation->set_message ( 'required', '{field} không được để trống.' );
		$this->form_validation->set_message ( 'min_length', '{field} phải nhiều hơn 5 ký tự.' );
		$this->form_validation->set_message ( 'max_length', '{field} phải nhỏ hơn 14 ký tự.' );
		$this->form_validation->set_message ( 'matches', '{field} không đúng, vui lòng nhập lại.' );
		$this->form_validation->set_rules ( 'username', 'Tài khoản', 'required|min_length[5]|max_length[14]|callback_check_user' );
		$this->form_validation->set_rules ( 'password', 'Mật khẩu', 'min_length[5]|max_length[14]' );
		$this->form_validation->set_rules ( 'password2', 'Xác nhận mật khẩu', 'trim|matches[password]|min_length[5]|max_length[14]' );
		if ($this->form_validation->run () == TRUE) {
			// Mảng chưa dữ liệu cần update
			$data_update = array (
					"username" => $this->input->post ( "username" ),
					"group_id" => $this->input->post ( "group" ),
					"updated" => date ( "Y-m-d" ),
					"active" => $this->input->post ( "active" ) 
			);
			// Kiểm tra xem mật khẩu có hay không, nếu có thì thêm một mảng password vào để update.
			if ($this->input->post ( "password" )) {
				$data_update ["password"] = $this->input->post ( "password" );
			}
			// Update thành viên vào trong CSDL.
			$this->Muser->updateUser ( $data_update, $id );
			// Flashdata báo sửa thành công.
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục sửa thành viên." );
			redirect ( base_url () . "gcms/user/index" );
		}
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function deleteCB() {
		if ($this->input->post ( "checkAll" )) {
			foreach ( $this->input->post ( "checkAll" ) as $del_id ) {
				$del_id = ( int ) $del_id;
				$this->Muser->deleteUser ( $del_id );
			}
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục xóa thành viên." );
			redirect ( base_url () . "gcms/user/index" );
		} else {
			$this->session->set_flashdata ( "flash_error", "Bạn chưa chọn thành viên cần xóa." );
			redirect ( base_url () . "gcms/user/index" );
		}
	}
	public function usergroup() {
		// List User Group
		$this->_data ['title'] = "Danh sách nhóm thành viên";
		$this->_data ['loadPage'] = "user/usergroup_view";
		$this->_data ['error'] = $this->session->flashdata ( "flash_error" );
		$this->_data ['success'] = $this->session->flashdata ( "flash_mess" );
		$this->_data ['data'] = "";
		$this->_data ['keyword'] = "";
		$this->_data ['countSearch'] = "";
		// config setting phần phân trang.
		$config ['base_url'] = ($this->input->get ( "keyword" )) ? base_url () . "gcms/user/usergroup/?keyword=" . $this->input->get ( "keyword" ) : base_url () . "gcms/user/index/";
		// $config ['base_url'] = base_url () . "gcms/user/index/";
		$config ['total_rows'] = ($this->input->get ( "keyword" )) ? $this->Muser->countSearchUserGroup ( $this->input->get ( "keyword" ) ) : $this->Muser->countAllUserGroup ();
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
			$this->_data ['countSearch'] = $this->Muser->countSearchUserGroup ( $this->_data ['keyword'] );
			$this->_data ['data'] = $this->Muser->SearchUserGroupByKeyword ( $this->_data ['keyword'], $config ['per_page'], $start );
		} elseif ($locds == "desc" || $locds == "asc") {
			$this->_data ['data'] = $this->Muser->listUserGroup ( $config ['per_page'], $start, $locds );
		} else {
			$this->_data ['data'] = $this->Muser->listUserGroup ( $config ['per_page'], $start );
		}
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function add_usergroup() {
		$this->_data ['checkboxgroup'] = array (
				"Quản lý bài viết" => array (
						"news/index" => array (
								"Danh sách bài viết" 
						),
						"news/add" => array (
								"Thêm mới bài viết" 
						),
						"news/edit" => array (
								"Sửa bài viết" 
						) 
				),
				"Quản lý sản phẩm" => array (
						"products/index" => array (
								"Danh sách sản phẩm" 
						),
						"products/add" => array (
								"Thêm mới sản phẩm" 
						),
						"products/edit" => array (
								"Sửa sản phẩm" 
						) 
				),
				"Quản lý đơn hàng" => array (
						"order/index" => array (
								"Tất cả đơn hàng" 
						),
						"order/deactive" => array (
								"Đơn hàng chưa xử lý" 
						),
						"order/active" => array (
								"Đơn hàng đã xử lý" 
						),
						"order/view" => array (
								"Xem đơn hàng" 
						) 
				),
				"Quản lý chuyên mục" => array (
						"categorie/index" => array (
								"Danh sách chuyên mục" 
						),
						"categorie/add" => array (
								"Thêm mới chuyên mục" 
						),
						"categorie/edit" => array (
								"Sửa chuyên mục" 
						) 
				),
				"Giao diện website" => array (
						"designed/index" => array (
								"Giao diện website" 
						) 
				),
				"Quản lý thành viên" => array (
						"user/index" => array (
								"Danh sách thành viên" 
						),
						"user/add" => array (
								"Thêm mới thành viên" 
						),
						"user/edit" => array (
								"Sửa thành viên" 
						),
						"user/delete" => array (
								"Xóa thành viên"
						),
						"user/deletecb" => array (
								"Chọn thành viên xóa"
						),
						"user/usergroup" => array (
								"Nhóm thành viên" 
						),
						"user/add_usergroup" => array (
								"Thêm nhóm thành viên" 
						),
						"user/edit_usergroup" => array (
								"Sửa nhóm thành viên" 
						) ,
						"user/del_usergroup" => array (
								"Xóa nhóm thành viên"
						) ,
						"user/deletecbgroup" => array (
								"Chọn nhóm xóa"
						) 
				),
				"Hòm thư liên hệ" => array (
						"mail/index" => array (
								"Danh sách liên hệ" 
						),
						"mail/view" => array (
								"Trả lời thư" 
						) 
				),
				"Bình luận phản hồi" => array (
						"comment/index" => array (
								"Danh sách bình luận" 
						),
						"comment/view" => array (
								"Trả lời bình luận" 
						) 
				),
				"Cài đặt hệ thống" => array (
						"setting/index" => array (
								"Cài đặt hệ thống" 
						) 
				) 
		);
		$this->_data ['error'] = "";
		$this->_data ['title'] = "Thêm mới nhóm thành viên";
		$this->_data ['loadPage'] = "user/addusergroup_view";
		// Validation Form khi nhập sai
		$this->form_validation->set_message ( 'required', '{field} không được để trống.' );
		$this->form_validation->set_message ( 'min_length', '{field} phải nhiều hơn 5 ký tự.' );
		$this->form_validation->set_message ( 'max_length', '{field} phải nhỏ hơn 14 ký tự.' );
		$this->form_validation->set_rules ( 'usergroup', 'Tài khoản', 'required|min_length[5]|max_length[14]' );
		if ($this->form_validation->run () == TRUE) {
			// Mảng chứa dữ liệu cần insert
			$permission = json_encode ( $this->input->post ( "cbpermissions" ) );
			$data_insert = array (
					"usergroup" => $this->input->post ( "usergroup" ),
					"description" => $this->input->post ( "description" ),
					"level" => $this->input->post ( "level" ),
					"created" => date ( "Y-m-d" ) 
			);
			if ($permission != NULL) {
				$data_insert ["permissions"] = $permission;
			}
			// Insert dữ liệu
			$this->Muser->insertUserGroup ( $data_insert );
			// Flash mess thông báo insert thành công
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục thêm nhóm thành viên." );
			redirect ( base_url () . "gcms/user/usergroup" );
		}
		// echo $this->db->last_query();
		$this->load->view ( $this->_data ['path'], $this->_data );
	}
	public function edit_usergroup() {
	}
	public function del_usergroup($id = "") {
		// Kiểm tra xem id có bằng 1 không, nếu id bằng 1 không được quyền thêm.
		if ($id == 1) {
			$this->session->set_flashdata ( "flash_error", "Bạn không đủ quyền hạn để xóa thành viên này." );
			redirect ( base_url () . "gcms/user/usergroup" );
		} else {
			$this->Muser->deleteUserGroup( $id );
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục xóa thành viên." );
			redirect ( base_url () . "gcms/user/usergroup" );
		}
	}
	public function deleteCBGroup() {
		if ($this->input->post ( "checkAll" )) {
			foreach ( $this->input->post ( "checkAll" ) as $del_id ) {
				$del_id = ( int ) $del_id;
				$this->Muser->deleteUserGroup ( $del_id );
			}
			$this->session->set_flashdata ( "flash_mess", "Hoàn tất thủ tục xóa thành viên." );
			redirect ( base_url () . "gcms/user/usergroup" );
		} else {
			$this->session->set_flashdata ( "flash_error", "Bạn chưa chọn thành viên cần xóa." );
			redirect ( base_url () . "gcms/user/usergroup" );
		}
	}
}