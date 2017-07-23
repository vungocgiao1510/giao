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
						<th>Trạng thái</th>
					</tr>
				</thead>
				<tbody>
						<?php 
						$stt=0;
						$totals = 0;
						if($this->cart->contents()){
							foreach($this->cart->contents() as $items){
								$stt++;
								$total = $items['price']*$items['qty'];
								echo "<tr>";
								echo "<input type='hidden' id='".$stt."rowid' name='".$stt."[rowid]' value='$items[rowid]' />";
								echo "<td>$stt</td>";
								echo "<td><img src='$items[image]' width='80' />'</td>";
								echo "<td><b>$items[name]</b></td>";
								echo "<td><font color='red'>".str_replace(",", ".", number_format($items['price']))."</font></td>";
								echo "<td><input id='".$stt."qty' type='number' value='$items[qty]' style='width:50px' nax='99' min='0' /></td>";
								echo "<td><font color='red'>".str_replace(",", ".", number_format($total))."</font></td>";
								echo "<td><a href='".base_url()."home/deletecart/$items[id]' class='btn btn-default' onclick='return confirm(\"Bạn có muốn xóa sản phẩm này không?\");'><img src='".base_url()."public/default/images/garbage.png'</a></td>";
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
							echo "<td colspan='7' style='text-align:center'>Không có sản phẩm nào</td>";
						}
						?>
				</tbody>
				<?php
					if($totals != 0){
					echo '<tfoot><tr>
					<td colspan="7" style="text-align: right;"><b>Tổng tiền: <font color="red">'. str_replace(',', '.', number_format($totals)) .'</font></b></td>
					</tr>
					</tfoot>';
					}
				?>
			</table>