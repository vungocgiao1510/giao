<div class="col-md-12">
	<legend>Sửa thành viên</legend>
</div>
<form class="form-horizontal" action="" method="POST">
	<div class="col-md-8">
<?php
if (validation_errors () != "") {
	echo '<div class="alert alert-warning" role="alert">';
	echo validation_errors ();
	echo '</div>';
}
?>
			<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Tài khoản</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="username"
					placeholder="Tài khoản" value="<?php echo $data['username']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="password" class="col-sm-3 control-label">Mật khẩu</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" id="" name="password"
					placeholder="Mật khẩu">
			</div>
		</div>
		<div class="form-group">
			<label for="password2" class="col-sm-3 control-label">Xác nhận mật
				khẩu</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" id="" name="password2"
					placeholder="Xác nhận mật khẩu">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-11">
				<button type="submit" class="btn btn-primary" name="ok">Sửa</button>
				<button type="reset" class="btn btn-primary" name="rs">Nhập lại</button>
			</div>
		</div>

	</div>
	<div class="col-md-4">
		<div class="rightselect">
			<label for="" class="">Cấp độ</label> <select multiple
				class="form-control" name="level" style="height:50px;">
				<option value="1" <?php if($data['level'] == 1) echo "selected"; ?>>Administrator</option>
				<option value="2" <?php if($data['level'] == 2) echo "selected"; ?>>Member</option>
			</select>
		</div>
		<div class="rightselect">
		<label for="" class="">Chức vụ</label> <select multiple
			class="form-control" name="role" style="height:110px;">
			<option value="1">Quản trị cấp cao</option>
			<option value="2">Quản trị viên</option>
			<option value="3">Biên tập viên</option>
			<option value="4">Tác giả</option>
			<option value="5" selected>Cộng tác viên</option>
		</select>
		</div>
		<div class="rightselect">
			<label for="" class="">Trạng thái</label> <select multiple
				class="form-control" name="active" style="height:50px;">
				<option value="1" <?php if($data['active'] == 1) echo "selected"; ?>>Kích hoạt</option>
				<option value="2" <?php if($data['active'] == 2) echo "selected"; ?>>Chưa kích hoạt</option>
			</select>
		</div>
	</div>
</form>
