<legend>Danh sách chuyên mục</legend>
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
		<a href="<?php echo base_url()."gcms/categorie/add"; ?>" class="btn btn-primary active">Thêm mới</a>
	</div>

</div>
<div class="cls"></div>
<form action="<?php echo base_url()."gcms/categorie/deletecb" ?>" method="post" name="formdeletecb" id="formdeletecb" >
	<div id="result">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
			<thead>
				<tr class="info">
					<th><input type="checkbox" id="checkedAll" name="checkedAll"></th>
					<th>ID</th>
					<th>Chuyên mục</th>
					<th>Ngày tạo</th>
					<th>Ngày sửa</th>
					<th>Trạng thái</th>
					<th>Sửa</th>
					<th>Xóa</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				listMenu($listmenu);
			?>
			</tbody>
			</table>
		</div>
	</div>	
<div align="right">
<button type="submit" name="deletecb" class='btn btn-default'><img src='<?php echo base_url()  ?>public/gcms/img/garbage.png' alt='Delete All' title='Delete All' /></button>
</form>
</div>