<div class="col-md-12">
	<legend>Cập nhật bài viết</legend>
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
					placeholder="Tên chuyên mục" value="<?php echo $data['title'] ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Link</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="link"
					placeholder="Link" value="<?php echo $data['linkseo'] ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Tên Title</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="titleseo"
					placeholder="Tên Title" value="<?php echo $data['titleseo'] ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Keyword</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="" name="keyword"
					placeholder="Keyword" value="<?php echo $data['keyword'] ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label">Miêu tả</label>
			<div class="col-sm-9">
				<textarea class="form-control" rows="5" placeholder="Nội dung" name="description"><?php echo $data['description'] ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-3 control-label">Nội dung</label>
			<div class="col-sm-9">
				<textarea style='z-index:99999;' class="form-control" id="content" rows="5" placeholder="Nội dung" name="content"><?php echo $data['content'] ?></textarea>
				<script>
	                // Replace the <textarea id="editor1"> with a CKEditor
	                // instance, using default configuration.
	                CKEDITOR.replace( 'content' );
	            </script>
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Ảnh đại diện</label>
			<div class="col-sm-8">
				<input type="text" class="form-control txtupload" id="thumb_img" name="image"
					placeholder="Chưa có hình ảnh nào.." value="<?php echo $data['image']; ?>">
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
			<label for="username" class="col-sm-3 control-label">Thêm hình ảnh</label>
			<div class="col-sm-8">
				<textarea style='z-index:99999;' class="form-control" id="list_image" rows="5" name="list_image" placeholder="Thêm hình ảnh.."><?php echo $data['list_image']; ?></textarea>
			</div>
			<div class="col-sm-1">
				<a href="javascript:void(0)"><img readonly="readonly" onclick="openKCFinder1(list_image)" src="<?php echo base_url()."public/gcms/img/photos.png"?>" /></a>
			</div>
		</div>
		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Thể loại</label>
			<div class="col-sm-9">
				<label class="radio-inline"> <input type="radio"
					name="type" id="" value="1" <?php if($data['type'] == 1) echo "checked='checked'"; ?>> Bài viết nổi bật
				</label>
			</div>
		</div>

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

<!-- 		<div class="form-group"> -->
<!-- 			<label for="username" class="col-sm-3 control-label">Trạng thái hiển -->
<!-- 				thị</label> -->
<!-- 			<div class="col-sm-9"> -->
<!-- 				<label class="checkbox-inline"> <input type="checkbox" -->
<!-- 					id="" value=""> Hiển thị tại trang chủ -->
<!-- 				</label> -->
<!-- 			</div> -->
<!-- 		</div> -->
		<hr>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-11">
				<button type="submit" class="btn btn-primary" name="ok">Sửa bài viết</button>
				<button type="reset" class="btn btn-primary" name="rs">Nhập lại</button>
			</div>
		</div>

	</div>
	<div class="col-md-4">
		<div class="rightselect">
			<label for="" class="">Chuyên mục</label> <select multiple
				class="form-control" name="menu" style="height: 300px;">
				<?php 
				callMenu($menu,0,"--",$data['cate_id']);
				?>
			</select>
		</div>
	</div>
</form>
