<legend>Danh sách thành viên</legend>
<?php
if ($success != ""){
	echo '<div class="alert alert-success" role="alert">' . $success. '</div>';
}
if ($error != "") {
	echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
}
?>
<div class="hethong">
	<div class="add">
		<a href="<?php echo base_url()."gcms/user/add"; ?>" class="btn btn-primary">Thêm mới</a>
	</div>
	<div class="setting">
		<form>
			<div class="form-group">
				<select class="form-control locds">
					<option>Mới nhất</option>
					<option>Cũ nhất</option>
					<option>Đã kích hoạt</option>
					<option>Chưa kích hoạt</option>
				</select> <input type="submit" name="loc" value="Lọc" class="btn btn-primary" />
			</div>
		</form>
	</div>
	<div class="search">
		<form>
			<div class="form-group">
				<input type="text" class="form-control searchds" id="" name="keyword" placeholder="Nhập tên thành viên cần tìm.">
				<input type="submit" name="loc" value="Tìm kiếm" class="btn btn-primary" />
			</div>
		</form>
	</div>

</div>
<div class="cls"></div>
<form action="<?php echo base_url()."gcms/user/deletecb" ?>" method="post" name="formdeletecb" id="formdeletecb" >
<div id="result">
<div class="table-responsive">
	<table class="table table-bordered">
		<tr class="info">
			<th><input type="checkbox" id="checkedAll" name="checkedAll"></th>
			<th>STT</th>
			<th>Thành viên</th>
			<th>Cấp độ</th>
			<th>Ngày tạo</th>
			<th>Ngày sửa</th>
			<th>Trạng thái</th>
			<th>Sửa</th>
			<th>Xóa</th>
		</tr>
	<?php
	if ($data) {
		$stt = 0;
		foreach ( $data as $val ) {
			$stt ++;
			echo "<tr class='active'>";
			if($val['id'] == 1) {
				echo "<td><input type='checkbox' disabled></td>";
			} else {
				echo "<td><input type='checkbox' id='box_$val[id]' name='checkAll[]' value='$val[id]' class='checkSingle'></td>";
			}
			echo "<td>$stt</td>";
			echo "<td>$val[username]</td>";
			if ($val ['level'] == 1) {
				echo "<td><font color='red'>Administrator</font></td>";
			} else {
				echo "<td>Member</td>";
			}
			echo "<td>" . date ( "d/m/Y", strtotime ( $val ["created"] ) ) . "</td>";
			echo "<td>" . date ( "d/m/Y", strtotime ( $val ["updated"] ) ) . "</td>";
			if ($val ['active'] == 1) {
				echo "<td><a href='#' class='btn btn-success'>Đã kích hoạt</a></td>";
			} else {
				echo "<td><a href='#' class='btn btn-info'>Chưa kích hoạt</a></td>";
			}
			echo "<td><a href='" . base_url () . "gcms/user/edit/$val[id]'>Sửa</a></td>";
			echo "<td><a href='" . base_url () . "gcms/user/delete/$val[id]'>Xóa</a></td>";
			echo "</tr>";
		}
	}
	?>
</table>
</div>
<div class="col-md-4 col-md-push-3 npd" align="center">
	<?php echo $pagination; ?>
</div>
<div class="col-md-4 col-md-pull-4 npd" align="left">
			<div class="form-group">
				<select class="form-control" id="numberpage" style="width: 20%;">
					<option value="5" <?php if($this->session->userdata("limit") == 5) echo "selected"; ?>>5</option>
					<option value="10" <?php if($this->session->userdata("limit") == 10) echo "selected"; ?>>10</option>
					<option value="20" <?php if($this->session->userdata("limit") == 20) echo "selected"; ?>>20</option>
					<option value="30" <?php if($this->session->userdata("limit") == 30) echo "selected"; ?>>30</option>
					<option value="50" <?php if($this->session->userdata("limit") == 50) echo "selected"; ?>>50</option>
					<option value="100" <?php if($this->session->userdata("limit") == 100) echo "selected"; ?>>100</option>
				</select>
			</div>
</div>
<div class="col-md-4 npd" align="right">
<button type="submit" name="deletecb" class="btn btn-danger">Xóa</button>
</form>
</div>
</div>