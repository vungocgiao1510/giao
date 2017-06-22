<div class="col-md-12">
	<legend>Thêm mới thành viên</legend>
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
					placeholder="Tài khoản">
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Địa chỉ Email</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="email"
					placeholder="Địa chỉ Email">
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
		<hr>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-11">
				<button type="submit" class="btn btn-primary" name="ok">Đăng ký</button>
				<button type="reset" class="btn btn-primary" name="rs">Nhập lại</button>
			</div>
		</div>

	</div>
	<div class="col-md-4">
		<div class="rightselect">
			<label for="" class="">Nhóm</label> <select multiple
				class="form-control" name="group" style="height: 110px;">
				<?php 
				if($group_user){
					foreach($group_user as $value){
						echo "<option value='$value[group_id]'>$value[usergroup]</option>";
					}
				}
				?>
			</select>
		</div>
	</div>
</form>
