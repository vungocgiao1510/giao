<article>
 <div class="container">
  <div class="col-md-12">
  <div id="banner">
    <img src="<?php echo $cate['image']; ?>" class="img-responsive" />
  </div>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url().$lang ?>"><?php echo $this->lang->line("homepage"); ?></a></li>
    <li class="active"><?php echo $cate['title']; ?></li>
  </ol>
  </div>
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-body tintuc">
      <?php 
      if($data){
      	foreach($data as $value){
      		echo '<div class="col-md-4 col-sm-6 col-xs-12 npd">
      <a href="'.base_url().$lang."/".$cate['linkseo']."/".$value['linkseo']."-n/".$value['id'].'">
        <img src="'.$value['image'].'" alt="" class="img-responsive">
      </a>
      </div>
        <div class="col-md-8 col-sm-6 col-xs-12">
        <a href="'.base_url().$lang."/".$cate['linkseo']."/".$value['linkseo']."-n/".$value['id'].'">
          <h2 class="title">'.$value['title'].'</h2>
        </a>
          <p class="time"><span class="glyphicon glyphicon-calendar"></span> '.date("m/d/Y", strtotime($value['created'])).'</p>
          <p class="author"><span class="glyphicon glyphicon-user"></span> '.$value['username'].'</p>
          <p class="description">'.trim_length($value['description'],300).'</p>
        </div>
        <div class="cls1"></div>';
      	}
      }
      ?>



          <div class="page" align="right">
				<?php echo $pagination; ?>
          </div>

      </div> <!-- Panel body -->
    </div>
  </div> <!-- col-md-8-->
  <div class="col-md-4">
    <div class="panel panel-default rightlist">
      <div class="panel-heading">Sản phẩm mới nhất</div>
      <div class="panel-body">
	
	 <?php 
//   echo "<pre>";
//   print_r($productnews);
//   echo "</pre>";
	if($productnb){
		foreach($productnb2 as $value){
			$promotion = number_format($value['promotion']);
			$promotion = str_replace(",", ".", $promotion);
			$price = number_format($value['price']);
			$price= str_replace(",", ".", $price);
			$sales = ($value['promotion'] - $value['price']) * 100;
			$sale = ceil($sales / $value['promotion']);
			echo '<div class="col-md-12">
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
	}
  ?>





      </div>
    </div>
  </div>

</div>  <!--  End Container-->
</article>