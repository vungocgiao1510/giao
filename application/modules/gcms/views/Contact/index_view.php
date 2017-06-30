<legend>Danh sách hình ảnh</legend>
<?php
if ($success != ""){
	echo '<div class="alert alert-success" role="alert">' . $success. '</div>';
}
if ($error != "") {
	echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
}
?>
<div class="row" style="margin-top:-15px;">
	<div class="col-md-1" style="margin-top: 15px;">
		<a href="<?php echo base_url()."gcms/images/add"; ?>" class="btn btn-primary active">Thêm mới</a>
	</div>
	<div class="col-md-3">
		<form action="" method="POST">
			<div class="form-group">
			<div class="col-sm-10 npdr">
				<select class="form-control locds" name="locds">
					<option value="desc" <?php if($locds== "desc") echo "selected"; ?>>Mới nhất</option>
					<option value="asc" <?php if($locds== "asc") echo "selected"; ?>>Cũ nhất</option>
					<option value="1" <?php if($locds== "1") echo "selected"; ?>>Đã kích hoạt</option>
					<option value="2" <?php if($locds== "2") echo "selected"; ?>>Chưa kích hoạt</option>
				</select> 
			</div>
			<div class="col-sm-2">
				<input type="submit" name="loc" value="Lọc" class="btn btn-primary active" />
			</div>
			</div>
		</form>
	</div>
	<div class="col-md-5">
	<form action="" method="GET">
			<div class="form-group">
				<div class="col-sm-10 npdr">
					<input type="text" class="form-control searchds" name="keyword" id="keyword" placeholder="Nhập tên bài viết cần tìm." required>
				</div>
				<div class="col-sm-2">
					<input type="submit" id="searchform" value="Tìm kiếm" class="btn btn-primary active" />
				</div>
			</div>	
	</form>
	</div>
	<div class="col-md-3">
	</div>

</div>
<div class="cls"></div>
<form action="<?php echo base_url()."gcms/images/deletecb" ?>" method="post" name="formdeletecb" id="formdeletecb" >
<div id="result">
<div class="table-responsive">
	<table class="table table-bordered table-hover">
	<thead>
		<tr class="info">
			<th><input type="checkbox" id="checkedAll" name="checkedAll"></th>
			<th>STT</th>
			<th>Họ tên</th>
			<th>Email</th>
			<th>Điện thoại</th>
			<th>Địa chỉ</th>
			<th>Ngày gửi</th>
			<th>Trạng thái</th>
			<th>Sửa</th>
			<th>Xóa</th>
		</tr>
	</thead>
	<tbody>
	<?php
	if ($data) {
		$stt = 0;
		foreach ( $data as $val ) {
			$stt ++;
			echo "<tr class='active'>";
			echo "<td><input type='checkbox' id='box_$val[id]' name='checkAll[]' value='$val[id]' class='checkSingle'></td>";
			echo "<td>$stt</td>";
			echo "<td><img src='$val[image]' width='80' /></td>";
			echo "<td><a class='editname' href='" . base_url () . "gcms/news/edit/$val[id]'>$val[title]</a></td>";
			foreach($properties as $key => $propertie){
				if($key == $val['properties']){
					echo "<td>$propertie</td>";
				}
			}
			echo "<td>" . date ( "d/m/Y", strtotime ( $val ["created"] ) ) . "</td>";
			echo "<td>" . date ( "d/m/Y", strtotime ( $val ["updated"] ) ) . "</td>";
			if ($val ['active'] == 1) {
				echo "<td><a class='btn btn-info active'>Kích hoạt</a></td>";
			} else {
				echo "<td><a class='btn btn-danger active'>Đã khóa</a></td>";
			}
			echo "<td><a href='" . base_url () . "gcms/images/edit/$val[id]'><img src='".base_url()."public/gcms/img/edit.png' alt='Edit' title='Edit' /></a></td>";
			echo "<td><a href='" . base_url () . "gcms/images/delete/$val[id]' onclick='return confirm(\"Bán có muốn xóa bản ghi này không?\");'><img src='".base_url()."public/gcms/img/garbage.png' alt='Delete' title='Delete' /></a></td>";
			echo "</tr>";
		}
	} else {
		echo "<tr class='active'><td align='center' colspan='10'>Không có dữ liệu.</td></tr>";
	}
	?>
	</tbody>
</table>
</div>
<div class="col-md-4 col-md-push-3 npd" align="center">
	<?php echo $pagination; ?>
</div>
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
<button type="submit" name="deletecb" class='btn btn-default'><img src='<?php echo base_url()  ?>public/gcms/img/garbage.png' alt='Delete All' title='Delete All' /></button>
</form>
</div>
</div>