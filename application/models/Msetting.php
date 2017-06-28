<?php
class Msetting extends CI_Model{
	protected $_table = "setting";
	public function updateSetting($data){
		$this->db->where("id",1);
		$this->db->update($this->_table,$data);
	}
	public function getSettingById(){
		$this->db->where("id",1);
		return $this->db->get($this->_table)->row_array();
	}
}