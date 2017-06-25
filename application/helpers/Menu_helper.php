<?php
function callMenu($data, $parent = 0, $text = "--", $select = 0) {
	foreach ( $data as $k => $value ) {
		if ($value ['cate_parent'] == $parent) {
			$id = $value ['id'];
			if ($select != 0 && $id == $select) {
				echo "<option value='$value[id]' selected='selected'>" . $text . $value ['title'] . "</option>";
			} else {
				echo "<option value='$value[id]'>" . $text.  $value ['title'] . "</option>";
			}
			unset ( $data [$k] );
			callMenu ( $data, $id, $text . "--", $select );
		}
	}
}
function listMenu($data, $parent = 0, $text = "--", $select = 0) {
	if($data){
		foreach ( $data as $k => $value ) {
			if ($value ['cate_parent'] == $parent) {
				$id = $value ['id'];
				echo "<tr>";
				echo "<td>$value[cate_order]</td>";
				echo "<td style='text-align:left; padding-left: 10px;'>" . $text . $value ['title'] . "</td>";
				echo "<td>" . date ( "d/m/Y", strtotime ( $value["created"] ) ) . "</td>";
				echo "<td>" . date ( "d/m/Y", strtotime ( $value["updated"] ) ) . "</td>";
				if ($value['active'] == 1) {
					echo "<td><a class='btn btn-info active'>Kích hoạt</a></td>";
				} else {
					echo "<td><a class='btn btn-danger active'>Đã khóa</a></td>";
				}
				echo "<td><a href='" . base_url () . "gcms/categorie/edit/$value[id]'><img src='".base_url()."public/gcms/img/edit.png' alt='Edit' title='Edit' /></a></td>";
				echo "<td><a href='" . base_url () . "gcms/categorie/delete/$value[id]' onclick='return confirm(\"Bán có muốn xóa bản ghi này không?\");'><img src='".base_url()."public/gcms/img/garbage.png' alt='Delete' title='Delete' /></a></td>";
				echo "</tr>";
				unset ( $data [$k] );
				listMenu( $data, $id, $text . "--", $select );
			}
		}
	} else {
		echo "<tr>";
		echo "<td colspan='7'>Không có dữ liệu</td>";
		echo "</tr>";
	}
}