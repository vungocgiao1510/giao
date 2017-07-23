<article>
 <div class="container">
  <div class="col-md-12">
  <div id="banner">
    <img src="<?php echo $cate['image']; ?>" class="img-responsive" />
  </div>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url().$lang ?>"><?php echo $this->lang->line("homepage"); ?></a></li>
    <li><a href="<?php echo base_url().$lang."/".$cate['linkseo']; ?>"><?php echo $cate['title']; ?></a></li>
    <li class="active"><?php echo $data['title']; ?></li>
  </ol>
  </div>
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-body tintuchitiet">
      
          <img align="left" src="<?php echo $data['image']; ?>" alt="" class="img-responsive">
          <h1 class="title"><?php echo $data['title']; ?></h1>
          <p class="time"><span class="glyphicon glyphicon-calendar"></span> <?php echo date("m/d/Y", strtotime($data['created']))?></p>
          <p class="author"><span class="glyphicon glyphicon-user"></span> <?php echo $data['username']; ?></p>
          <div class="content">
           <?php echo $data['content']; ?>
          </div>
          <hr>
          <h3>Tin tức khác</h3>
          <div class="otherNews">
              <?php
                if($other){
                  foreach($other as $value){
                    echo "<a href='".base_url().$lang."/".$cate['linkseo']."/".$value['linkseo']."-n/".$value['id']."'>";
                    echo "<img align='left' src='$value[image]' width='' />";
                    echo "<h2>$value[title]</h2>";
                    echo "</a>";
                    echo "<div class='cls2'></div>";
                  }
                }
              ?>
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