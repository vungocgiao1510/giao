<?php
class Msetting extends CI_Model{
	protected $_table = "setting";
	public function updateSetting($data,$lang){
		$this->db->where("lang",$lang);
		$this->db->update($this->_table,$data);
	}
	
	public function getSettingById($lang){
		$this->db->where("lang",$lang);
		return $this->db->get($this->_table)->row_array();
	}
}