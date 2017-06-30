<div class="col-md-12">
	<legend>Thêm mới liên kết</legend>
</div>
<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
	<div class="col-md-8">
<?php
if (validation_errors () != "") {
	echo '<div class="alert alert-warning" role="alert">';
	echo validation_errors ();
	echo '</div>';
}
?>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Tên liên kết</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="title"
					placeholder="Tiêu đề">
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Link</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="link"
					placeholder="Link">
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Thứ tự</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="link_order"
					placeholder="Thứ tự">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label">Miêu tả</label>
			<div class="col-sm-9">
				<textarea class="form-control" rows="5" placeholder="Nội dung" name="description"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Hình ảnh</label>
			<div class="col-sm-8">
				<input type="text" class="form-control txtupload" id="thumb_img" name="image"
					placeholder="Chưa có hình ảnh nào..">
			</div>
			<div class="col-sm-1">
				<a href="javascript:void(0)"><img readonly="readonly" onclick="openKCFinder(thumb_img)" src="<?php echo base_url()."public/gcms/img/photos.png"?>" /></a>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-11">
				<button type="submit" class="btn btn-primary" name="ok">Thêm liên kết</button>
				<button type="reset" class="btn btn-primary" name="rs">Nhập lại</button>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="rightselect">
			<label for="" class="">Vị trí</label> <select multiple
				class="form-control" name="properties" style="height: 300px;">
			<?php 
			if($properties){
				foreach($properties as $key => $value){
					echo "<option value='$key'";
					if($key == 1){
						echo "selected";
					}
					echo ">$value</option>";
				}
			}
			?>
			</select>
		</div>
	</div>
</form>
