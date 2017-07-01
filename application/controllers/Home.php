<?php 
class Home extends DefaultController{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->_data['data'] = $this->Mcategorie->listCategorie();
		$this->_data['title'] = "Trang chủ";
		$this->load->view("default/top",$this->_data);
		$this->load->view("default/main",$this->_data);
		$this->load->view("default/bottom",$this->_data);
	}
}
?>