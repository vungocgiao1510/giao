
<div class=" top-nav rsidebar span_1_of_left">
	<h3 class="cate">Danh sách chuyên mục</h3>
		<?php
		if ($data) {
			echo '<ul class="menu">';
			foreach ( $data as $value ) {
				if($value['check_parent'] == 0){
					if ($value ['cate_parent'] == 0) {
						echo '<ul class="kid-menu ">';
						echo '<li><a href="#">' . $value ['title'];
						echo '</a>';
						echo '</li>';
						echo '</ul>';
					}
				} else {
					if ($value ['cate_parent'] == 0) {
						echo '<li class="item1"><a href="#">' . $value ['title'];
						echo '<img class="arrow-img"
					src="' . base_url () . 'public/default/images/arrow1.png"
					alt="" />';
						echo '</a>';
						$id = $value ['id'];
						$i = 0;
						echo '<ul class="cute">';
						foreach ( $data as $value2 ) {
							if ($value2 ['cate_parent'] == $id) {
								$i ++;
								
								echo '<li class="subitem' . $i . '"><a href="product.html">' . $value2 ['title'] . '</a></li>';
							}
						}
						echo '</ul>';
						echo '</li>';
					}
				}
			}
			echo '</ul>';
		}
		?>
	</div>
<!--initiate accordion-->
<script type="text/javascript">
			$(function() {
			    var menu_ul = $('.menu > li > ul'),
			           menu_a  = $('.menu > li > a');
			    menu_ul.hide();
			    menu_a.click(function(e) {
			        e.preventDefault();
			        if(!$(this).hasClass('active')) {
			            menu_a.removeClass('active');
			            menu_ul.filter(':visible').slideUp('normal');
			            $(this).addClass('active').next().stop(true,true).slideDown('normal');
			        } else {
			            $(this).removeClass('active');
			            $(this).next().stop(true,true).slideUp('normal');
			        }
			    });
			
			});
		</script>
<div class=" chain-grid menu-chain">
	<a href="single.html"><img class="img-responsive chain"
		src="<?php echo base_url() ."public/default/"?>images/wat.jpg" alt=" " /></a>
	<div class="grid-chain-bottom chain-watch">
		<span class="actual dolor-left-grid">300$</span> <span
			class="reducedfrom">500$</span>
		<h6>
			<a href="single.html">Lorem ipsum dolor</a>
		</h6>
	</div>
</div>
<a class="view-all all-product" href="product.html">VIEW ALL PRODUCTS<span>
</span></a>