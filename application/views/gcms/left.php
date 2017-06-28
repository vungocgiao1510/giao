<div id="left">
	<ul class="nav nav-pills nav-stacked">
<?php
/*
 * Đây là phần hiển thị Menu bên trái trong trang quản trị.
 * $leftmenu là một cái mảng được lấy từ $this->_data['leftmenu'] ở phần construct tại file AdminController trong thư mục core.
 * Đổ dữ liệu menu từ mảng ra bên ngoài.
 */
foreach ( $leftmenu as $val ) {
	echo '<li '; 
	if(isset ( $val ['controller'] ) && $val ['controller'] == $this->uri->segment ( 2 )){
		echo 'class="active"';
	}
	echo '><a href="' . $val ['url'] . '"><img
			src="' . $val ['img'] . '" />
			' . $val ['root'] . '</a>';
	if (isset ( $val ['parent'] )) {
		echo '<ul class="dropdown">';
		foreach ( $val ['parent'] as $parent ) {
			echo '<li><a href="' . $parent ['parenturl'] . '">' . $parent ['parentname'] . '</a></li>';
		}
		echo '</ul>';
		if (isset ( $val ['controller'] ) && $val ['controller'] == $this->uri->segment ( 2 )) {
			echo '<ul class="dropdown2">';
			foreach ( $val ['parent'] as $parent2 ) {
				if ($parent2 ['parenturl'] == base_url ( uri_string () )) {
					echo '<li class="active"><a href="' . $parent2 ['parenturl'] . '">' . $parent2 ['parentname'] . '</a></li>';
				} else {
					echo '<li><a href="' . $parent2 ['parenturl'] . '">' . $parent2 ['parentname'] . '</a></li>';
				}
			}
			echo '</ul>';
		}
	}
	echo "</li>";
}
?>
</ul>
</div>