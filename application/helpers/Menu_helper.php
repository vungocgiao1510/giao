<?php
function callMenu($data, $parent = 0, $text = "--", $select = 0) {
	foreach ( $data as $k => $value ) {
		if ($value ['cate_parent'] == $parent) {
			$id = $value ['cate_id'];
			if ($select != 0 && $id == $select) {
				echo "<option value='$value[cate_id]' selected='selected'>" . $text . $value ['cate_title'] . "</option>";
			} else {
				echo "<option value='$value[cate_id]'>" . $text . $value ['cate_title'] . "</option>";
			}
			unset ( $data [$k] );
			callMenu ( $data, $id, $text . "--", $select );
		}
	}
}
