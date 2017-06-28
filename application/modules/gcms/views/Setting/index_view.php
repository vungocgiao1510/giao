<div class="col-md-12">
	<legend>Cấu hình hệ thống</legend>
</div>
<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
	<div class="col-md-8">
<?php
if (validation_errors () != "") {
	echo '<div class="alert alert-warning" role="alert">';
	echo validation_errors ();
	echo '</div>';
}
if ($success!= ""){
	echo '<div class="alert alert-success" role="alert">' . $success. '</div>';
}
?>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label">Tên website</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="title"
					placeholder="Tên website" value="<?php echo $data['title']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Keyword</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="keywords"
					placeholder="Keywords" value="<?php echo $data['keywords']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label">Description</label>
			<div class="col-sm-9">
				<textarea class="form-control" rows="5" placeholder="Description" name="description"><?php echo $data['description']; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Logo</label>
			<div class="col-sm-8">
				<input type="text" class="form-control txtupload" id="thumb_img" name="logo"
					placeholder="Chưa có hình ảnh nào.." value="<?php echo $data['logo']; ?>">
			</div>
			<div class="col-sm-1">
				<a href="javascript:void(0)"><img readonly="readonly" onclick="openKCFinder(thumb_img)" src="<?php echo base_url()."public/gcms/img/photos.png"?>" /></a>
			</div>
			<div class="col-sm-3">
			</div>
			<div class="col-sm-9" style="margin-top:10px;">
				<img src='<?php echo $data['logo']; ?>' class="img-responsive" width="100" />
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Favicon</label>
			<div class="col-sm-8">
				<input type="text" class="form-control txtupload" id="thumb_img2" name="favicon"
					placeholder="Chưa có hình ảnh nào.." value="<?php echo $data['favicon']; ?>">
			</div>
			<div class="col-sm-1">
				<a href="javascript:void(0)"><img readonly="readonly" onclick="openKCFinder(thumb_img2)" src="<?php echo base_url()."public/gcms/img/photos.png"?>" /></a>
			</div>
			<div class="col-sm-3">
			</div>
			<div class="col-sm-9" style="margin-top:10px;">
				<img src='<?php echo $data['favicon']; ?>' class="img-responsive" width="100" />
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Hotline</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="hotline"
					placeholder="Hotline" value="<?php echo $data['hotline']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Phone</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="phone"
					placeholder="Phone" value="<?php echo $data['phone']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Địa chỉ</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="address"
					placeholder="Địa chỉ" value="<?php echo $data['address']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-12 control-label">Nội dung</label>
			<div class="col-sm-12">
				<textarea style='z-index:99999;' class="form-control" id="content" rows="5" placeholder="Nội dung" name="content"><?php echo $data['content']; ?></textarea>
				<script>
	                // Replace the <textarea id="editor1"> with a CKEditor
	                // instance, using default configuration.
	                CKEDITOR.replace( 'content' );
	            </script>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-11">
				<button type="submit" class="btn btn-primary" name="ok">Cấu hình</button>
				<button type="reset" class="btn btn-primary" name="rs">Nhập lại</button>
			</div>
		</div>

	</div>
	<div class="col-md-4">
		<div class="rightselect">
			<label for="" class="">Cấu hình</label> <select multiple
				class="form-control" name="menu" style="height: 300px;">

			</select>
		</div>
	</div>
</form>
