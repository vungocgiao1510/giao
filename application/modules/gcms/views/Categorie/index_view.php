<legend>Danh sách chuyên mục</legend>
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
		<a href="<?php echo base_url()."gcms/categorie/add"; ?>" class="btn btn-primary active">Thêm mới</a>
	</div>

</div>
<div class="cls"></div>
	<div id="result">
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr class="info">
					<th>ID</th>
					<th>Chuyên mục</th>
					<th>Ngày tạo</th>
					<th>Ngày sửa</th>
					<th>Trạng thái</th>
					<th>Sửa</th>
					<th>Xóa</th>
				</tr>
			<?php 
			listMenu($listmenu);
			?>
			</table>
		</div>
	</div>	