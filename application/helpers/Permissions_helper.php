<?php
function checkPermission($permissions="",$key,$level){
	checkLevel($level);
	if($permissions != "null"){
		$permission = json_decode($permissions);
		if(is_array($permission)){
			foreach($permission as $value){
				if($value == $key){
					redirect(base_url()."gcms/home/permissions");
				}
			}
		}
	}
}
function checkLevel($level){
	if($level != 1) {
		redirect(base_url()."gcms");
	}
}