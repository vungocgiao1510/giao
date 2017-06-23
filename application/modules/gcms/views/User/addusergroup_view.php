<div class="col-md-12">
	<legend>Thêm mới nhóm thành viên</legend>
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
			<label for="username" class="col-sm-3 control-label">Tên nhóm</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="usergroup"
					placeholder="Tên nhóm">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label">Nội dung</label>
			<div class="col-sm-9">
				<textarea class="form-control" rows="5" placeholder="Nội dung" name="description"></textarea>
			</div>
		</div>
		
		<?php 
		if($checkboxgroup){
			foreach($checkboxgroup as $key => $value){
				echo '<div class="col-md-4" style="margin-bottom: 20px; height:350px;">';
				echo "<hr>";
				echo "<label>$key</label>";
				foreach($value as $key2 => $name)
				{
					echo '<div class="checkbox">
					<label> <input type="checkbox" name="cbpermissions[]" value="'.$key2.'"> '.$name[0].' &nbsp;&nbsp; </label></div>';
				}
				echo '</div>';
			}
		}
		?>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-11">
				<button type="submit" class="btn btn-primary" name="ok">Tạo nhóm</button>
				<button type="reset" class="btn btn-primary" name="rs">Nhập lại</button>
			</div>
		</div>

	</div>
	<div class="col-md-4">
		<div class="rightselect">
			<label for="" class="">Cấp độ</label> <select multiple
				class="form-control" name="level" style="height: 50px;">
				<option value="1" selected>Administrator</option>
				<option value="2">Member</option>
			</select>
		</div>
	</div>
</form>
