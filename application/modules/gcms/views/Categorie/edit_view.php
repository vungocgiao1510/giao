<div class="col-md-12">
	<legend>Cập nhật chuyên mục</legend>
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
			<label for="username" class="col-sm-3 control-label">Tên chuyên mục</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="title"
					placeholder="Tên chuyên mục" value="<?php echo $data['title']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Link</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="link"
					placeholder="Link" value="<?php echo $data['linkseo']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Tên Title</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="titleseo"
					placeholder="Tên Title" value="<?php echo $data['titleseo']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Thứ tự hiển thị</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="order"
					placeholder="Thứ tự hiển thị" value="<?php echo $data['cate_order']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Ảnh đại diện</label>
			<div class="col-sm-8">
				<input type="text" class="form-control txtupload" id="thumb_img" name="image"
					placeholder="Hình ảnh cần cập nhật..">
			</div>
			<div class="col-sm-1">
				<a href="javascript:void(0)"><img readonly="readonly" onclick="openKCFinder(thumb_img)" src="<?php echo base_url()."public/gcms/img/photos.png"?>" /></a>
			</div>
			<div class="col-sm-3">
			</div>
			<div class="col-sm-9" style="margin-top:10px;">
				<img src='<?php echo $data['image']; ?>' class="img-responsive" width="100" />
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label">Nội dung</label>
			<div class="col-sm-9">
				<textarea class="form-control" rows="5" placeholder="Nội dung" name="description"><?php echo $data['description']; ?>
				</textarea>
			</div>
		</div>
<!-- 		<div class="form-group"> -->
<!-- 			<label for="username" class="col-sm-3 control-label">Chọn kiểu chủ đề</label> -->
<!-- 			<div class="col-sm-9"> -->
<!-- 				<label class="radio-inline"> <input type="radio" -->
<!-- 					name="" id="" value=""> Đơn -->
<!-- 					bài -->
<!-- 				</label> <label class="radio-inline"> <input type="radio" -->
<!-- 					name="" id="" value=""> Đa Bài -->
<!-- 				</label> -->
<!-- 			</div> -->
<!-- 		</div> -->

<!-- 		<div class="form-group"> -->
<!-- 			<label for="username" class="col-sm-3 control-label">Chọn vị trí hiển -->
<!-- 				thị</label> -->
<!-- 			<div class="col-sm-9"> -->
<!-- 				<label class="radio-inline"> <input type="radio" -->
<!-- 					name="" id="" value=""> Menu -->
<!-- 					Top -->
<!-- 				</label> <label class="radio-inline"> <input type="radio" -->
<!-- 					name="" id="" value=""> Không -->
<!-- 					chọn -->
<!-- 				</label> -->
<!-- 			</div> -->
<!-- 		</div> -->

		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Trạng thái hiển
				thị</label>
			<div class="col-sm-9">
				<label class="checkbox-inline"> <input type="checkbox"
					id="" value="1" name="check_parent" <?php if($data['check_parent']==1) echo "checked='checked'"; ?>> Chứa chuyên mục con
				</label>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-11">
				<button type="submit" class="btn btn-primary" name="ok">Cập nhật chuyên mục</button>
				<button type="reset" class="btn btn-primary" name="rs">Nhập lại</button>
			</div>
		</div>

	</div>
	<div class="col-md-4">
		<div class="rightselect">
			<label for="" class="">Dịch vụ</label> <select multiple
				class="form-control" name="service" style="height: 70px;">
				<option value="1" <?php if($data['service'] == 1) echo "selected"; ?>>Tin tức</option>
				<option value="2" <?php if($data['service'] == 2) echo "selected"; ?>>Sản phẩm</option>
				<option value="3" <?php if($data['service'] == 3) echo "selected"; ?>>Liên hệ</option>
			</select>
		</div>
		<div class="rightselect">
			<label for="" class="">Chủ đề cha</label> <select multiple
				class="form-control" name="menu" style="height: 300px;">
				<option value="0" <?php if($data['cate_parent'] == 0) echo "selected"; ?>>Chủ đề gốc</option>
				<?php 
				callMenu($menu,0,"--",$data['cate_parent'],$data['id']);
				?>
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
