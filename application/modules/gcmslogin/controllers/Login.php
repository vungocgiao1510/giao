<?php
class Login extends LoginController {
	public function __construct() {
		parent::__construct ();
	}
	public function index() {
		$this->_data ['error'] = "";
		$this->lang->load ( "gcmslogin", 'vietnamese' );
		$this->form_validation->set_message ( 'required', '{field} không được để trống.' );
		$this->form_validation->set_message ( 'min_length', '{field} phải nhiều hơn 5 ký tự.' );
		$this->form_validation->set_message ( 'max_length', '{field} phải nhỏ hơn 14 ký tự.' );
		$this->form_validation->set_rules ( 'txtuser', 'Tài khoản', 'required|min_length[5]|max_length[14]' );
		$this->form_validation->set_rules ( 'password', 'Mật khẩu', 'required|min_length[5]|max_length[14]' );
		if ($this->form_validation->run () == TRUE) {
			$user = $this->input->post ( "txtuser" );
			$pass = $this->input->post ( "password" );
			$data = $this->Muser->checkLogin ( $user, $pass );
			if ($data == TRUE) {
				$ses_user = array (
						'id' => $data ['id'],
						'username' => $data ['username'],
						'level' => $data ['level'],
						'lang' => $this->input->post ( "lang" ) 
				);
				$this->session->set_userdata ( $ses_user );
				$this->session->set_flashdata ( "flash_mess", "Success" );
				redirect ( base_url () . "gcms/home/index/" );
			} else {
				$this->_data ['error'] = 'Tài khoản hoặc mật khẩu không đúng.';
			}
		}
		$this->load->view ( $this->_data ['filename'], $this->_data );
	}
}