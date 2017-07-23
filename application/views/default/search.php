<?php
// echo "<pre>";
// print_r($data);
// echo "</pre>";
?>
<article>
 <div class="container">
  <div class="col-md-12">

  <ol class="breadcrumb">
    <li><a href="<?php echo base_url().$lang ?>"><?php echo $this->lang->line("homepage"); ?></a></li>
    <li class="active"><?php echo 'Tìm kiếm' ?></li>
  </ol>
  </div>
  <?php 
//   echo "<pre>";
//   print_r($data);
//   echo "</pre>";
	if($data){
		foreach($data as $value){
			$promotion = number_format($value['promotion']);
			$promotion = str_replace(",", ".", $promotion);
			$price = number_format($value['price']);
			$price= str_replace(",", ".", $price);
			$sales = ($value['promotion'] - $value['price']) * 100;
			$sale = ceil($sales / $value['promotion']);
			echo '<div class="col-md-3 col-sm-6 col-xs-6">
				    <div class="product">
				          <a href="'.base_url().$lang.'/'.$value['cate_linkseo'].'/'.$value['linkseo'].'-p/'.$value['id'].'">
				          <img class="img-responsive" src="'.$value['image'].'" />
				          <h3 class="ptitle">'.$value['title'].'</h3>
				          <p class="promotion">Giá cũ: <strike>'.$promotion.'</strike></p>
				          <p class="price">Giá hiện tại: <font color="red">'.$price.'</font></p>';
			if($value['promotion']){
				echo '<div class="sale">
				            <span>
				              '.$sale.'%
				            </span>
				          </span>    
				          </div></a>';
			}
					
			echo '</div></div>';
		}
	} else {
		echo '<div class="cls"></div>';
		echo '<div class="col-md-12">';
		echo '  <div class="panel panel-default">
     					 <div class="panel-body">';
		echo '<p align="center">Không có sản phẩm nào.</p>';
		echo '</div>
				</div>
				 	</div>
						</div>';
	}
  ?>




<div class="cls"></div>
  <!-- End Sản phẩm mới  -->
<div class="page" align="center">
	<?php echo $pagination; ?>
</div>
</div>  <!--  End Container-->
</article>