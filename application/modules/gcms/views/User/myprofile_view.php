<div class="col-md-12">
	<legend>Hồ sơ của bạn</legend>
</div>
<form class="form-horizontal" action="" method="POST">
	<div class="col-md-8">
<?php
if ($success != ""){
	echo '<div class="alert alert-success" role="alert">' . $success. '</div>';
}
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
					placeholder="Tài khoản" value="<?php echo $data['username']; ?>" disabled>
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
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-11">
				<button type="submit" class="btn btn-primary" name="ok">Cập nhật hồ sơ</button>
				<button type="reset" class="btn btn-primary" name="rs">Nhập lại</button>
			</div>
		</div>

	</div>
	<div class="col-md-4">
		<div class="rightselect">
			<label for="" class="">Nhóm</label> <select multiple
				class="form-control" name="group" style="height: 110px;" disabled>
				<?php 
				if($group_user){
					foreach($group_user as $value){
						if($value['group_id'] == $data['group_id']){
							echo "<option value='$value[group_id]' selected>$value[usergroup]</option>";
						} else {
							echo "<option value='$value[group_id]'>$value[usergroup]</option>";
						}
					}
				}
				?>
			</select>
		</div>
		<div class="rightselect">
			<label for="" class="">Trạng thái</label> <select multiple
				class="form-control" name="active" style="height:50px;" disabled>
				<option value="1" <?php if($data['active'] == 1) echo "selected"; ?>>Kích hoạt</option>
				<option value="2" <?php if($data['active'] == 2) echo "selected"; ?>>Chưa kích hoạt</option>
			</select>
		</div>
	</div>
</form>
