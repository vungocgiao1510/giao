<?php 
echo "<pre>";
print_r($this->input->post());
echo "</pre>";
?>
<form action="<?php echo base_url()."gcms/order/view/".$data['id'] ?>" method="POST">
<legend>Thông tin chi tiết đơn hàng</legend>
<p>Họ tên: <?php echo $data['fullname'] ?></p>
<p>Điện thoại: <?php echo $data['phone'] ?></p>
<p>Email: <?php echo $data['email'] ?></p>
<p>Địa chỉ: <?php echo $data['address'] ?></p>
<p>Nội dung: <?php echo $data['content'] ?></p>
<hr />
<select name="active">
	<option value="1" <?php if($data['active'] == 1) echo "selected"; ?>>Đã duyệt</option>
	<option value="2" <?php if($data['active'] == 2) echo "selected"; ?>>Chưa duyệt</option>
</select>
<hr />
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
						$stt = 0;
						if ($data ['items']) {
							$item = unserialize ( $data ['items'] );
							$totals = 0;
							foreach ( $item as $items ) {
								$stt ++;
								$total = $items ['price'] * $items ['qty'];
								echo "<tr>";	
								echo "<td>$stt</td>";
								echo "<td><img src='$items[image]' width='80' />'</td>";
								echo "<td><b>$items[name]</b></td>";
								echo "<td><font color='red'>" . str_replace ( ",", ".", number_format ( $items ['price'] ) ) . "</font></td>";
								echo "<td>$items[qty]</td>";
								echo "<td><font color='red'>" . str_replace ( ",", ".", number_format ( $total ) ) . "</font></td>";
								echo "</tr>";
								?>
							<?php
								$totals += $total;
							}
						} else {
							redirect ( base_url () );
						}
						?>
				</tbody>
		<tfoot>
			<tr>
				<td colspan="7" style="text-align: right;"><b>Tổng tiền: <font
						color='red'><?php echo str_replace(',', '.', number_format($totals)); ?></font></b></td>
			</tr>
		</tfoot>
	</table>
</div>
<div align="center">

<a href="<?php echo base_url()."gcms/order/index" ?>" class="btn btn-primary">Quay lại</a>
<button type="submit" name="ok" class="btn btn-primary">Duyệt</button>
</div>
</form>