<div class="container">
 <div class="col-md-12">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url().$lang ?>"><?php echo $this->lang->line("homepage"); ?></a></li>
    <li class="active">Đặt hàng</li>
  </ol>
 	<div class="panel panel-default">
	  <div class="panel-body">
	  <div id="result">
			<table class="table table-bordered">
				<caption>Giỏ hàng của bạn</caption>
				<thead>
					<tr>
						<th>STT</th>
						<th>Hình ảnh</th>
						<th>Sản phẩm</th>
						<th>Giá</th>
						<th>Số lượng</th>
						<th>Tổng tiền</th>
					</tr>
				</thead>
				<tbody>
						<?php 
						$stt=0;
						if($data){
							$totals = 0;
							foreach($data as $items){
								$stt++;
								$total = $items['price']*$items['qty'];
								echo "<tr>";
								echo "<input type='hidden' id='".$stt."rowid' name='".$stt."[rowid]' value='$items[rowid]' />";
								echo "<td>$stt</td>";
								echo "<td><img src='$items[image]' width='80' />'</td>";
								echo "<td><b>$items[name]</b></td>";
								echo "<td><font color='red'>".str_replace(",", ".", number_format($items['price']))."</font></td>";
								echo "<td>$items[qty]</td>";
								echo "<td><font color='red'>".str_replace(",", ".", number_format($total))."</font></td>";
								echo "</tr>";
							?>
							<script>
							$(document).ready(function(){
								$("#<?php echo $stt ?>qty").on("change",function(){
									rowid = $("#<?php echo $stt ?>rowid").val();
									qty = $("#<?php echo $stt ?>qty").val();
									$.ajax({
										"type":"POST",
										"url": baseUrl+"home/updatecart",
										"data": "rowid="+rowid+"&qty="+qty,
										"async":true,
										"success":function(result){
											// alert(rowid);
											$("#result").html(result);
										}
									})
								})
							})
							</script>
							<?php
							$totals += $total;
							}
						} else {
							redirect(base_url());
						}
						?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="7" style="text-align: right;"><b>Tổng tiền: <font color='red'><?php echo str_replace(',', '.', number_format($totals)); ?></font></b></td>
					</tr>
				</tfoot>
			</table>
			</div>

<script>
function validateForm() {
    var fullname = document.forms["myform"]["fullname"].value;
    if (fullname == "") {
        alert("Họ tên không được bỏ trống");
        return false;
    }
    var phone = document.forms["myform"]["phone"].value;
    if (phone == "") {
        alert("Điện thoại không được bỏ trống");
        return false;
    }
    var email = document.forms["myform"]["email"].value;
    if (email == "") {
        alert("Email không được bỏ trống");
        return false;
    }
    var address = document.forms["myform"]["address"].value;
    if (address == "") {
        alert("Địa chỉ không được bỏ trống");
        return false;
    }      
}
</script>

			<form id="contactform" name="myform" onsubmit="return validateForm()" method="POST" action="">
			<div class="col-sm-12"><legend>Thông tin đặt hàng</legend></div>
			<div class="col-sm-6">
			  <div class="form-group">
			    <label for="">Họ tên</label>
			    <input type="text" class="form-control" name="fullname" id="" placeholder="Họ tên" required>
			  </div>
			  <div class="form-group">
			    <label for="">Điện thoại</label>
			    <input type="number" class="form-control" name="phone" id="" placeholder="Điện thoại" required>
			  </div>
			  <div class="form-group">
			    <label for="">Email</label>
			    <input type="email" class="form-control" name="email" id="" placeholder="Email" required>
			  </div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group">
			    <label for="">Địa chỉ</label>
			    <input type="text" class="form-control" name="address" id="" placeholder="Địa chỉ" required>
			  </div>
			  <div class="form-group">
			    <label for="">Nội dung</label>
			    <textarea class="form-control" name="content" rows="5" required></textarea>
			  </div>
			  <div class="form-group">
<!-- 			  <div class="col-sm-4 npd">
			  <?php
			  echo $cap['image']; 
			  echo $cap['word'];
			  ?>
			  </div> -->
<!-- 			  <div class="col-sm-8 npd">

			  <input type="text" class="form-control" name="captcha" id="" placeholder="Captcha.." required>
			  </div> -->
			  </div>
<!-- 			  <br />
			  <hr /> -->
			  <!-- <div class="form-group"> -->
			  <button type="submit" name="ok" class="btn btn-default">Đặt hàng</button>
			  <!-- </div> -->
			</div>			  			  			  			  
			</form>



	  </div>
	</div>
 </div>
</div>