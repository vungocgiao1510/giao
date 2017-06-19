<?php
class LoginController extends MY_Controller {
	protected $_data;
	public function __construct() {
		$this->_data ['title'] = "GCMS Control Panel";
		$this->_data ['filename'] = "login_view";
	}
}