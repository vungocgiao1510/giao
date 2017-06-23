<?php
class Mcategorie extends CI_Model{
	protected $_table = "categorie";
	public function __construct(){
		parent::__construct();
	}
	public function listCategorie(){
		
	}
	public function addCategorie($data){
		$this->db->insert($this->_table,$data);
	}
	public function editCategorie(){
		
	}
	public function deleteCategorie(){
		
	}
}