<div id="slideshow" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#slideshow" data-slide-to="0" class="active"></li>
    <li data-target="#slideshow" data-slide-to="1"></li>
    <li data-target="#slideshow" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  <?php 
    if($slide){
      $stt=0;
      foreach($slide as $item){
          $stt++;
          $link = ($item['link'] != 0) ? $item['link'] : '#';
          // echo $link;
          if($stt == 1){
            echo '<div class="item active">';
          } else {
          echo '<div class="item">';
          }
            echo '<a href="'.$link.'"><img src="'.$item['image'].'" alt="..." class="img-responsive"></a>
            <div class="carousel-caption">
            </div>
            </div>';
        }
    }
  ?>

  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#slideshow" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#slideshow" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<article>
 <div class="container">
  <div class="col-md-12">
  <div class="title"><h2 align="center"><?php echo $this->lang->line("latestproduct"); ?></h2></div>
  </div>
  
  <?php 
//   echo "<pre>";
//   print_r($productnews);
//   echo "</pre>";
	if($productnews){
		foreach($productnews as $value){
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
	}
  ?>
    

  <!-- End Sản phẩm mới  -->

  <!-- Chuyên mục hiển thị -->

    <div id="showcate">
		<?php
		if($qc){
			$i = 0;
			foreach($qc as $value){
				$link = ($value['link'] != "0") ? $value['link'] : "#";
				$i++;
				echo '<div class="';
				if($i==1 || $i==4){
					echo 'col-md-8 col-sm-6 col-xs-12';
				} else {
					echo 'col-md-4 col-sm-6 col-xs-12';
				}
				if($i==2 || $i ==4){
					echo ' showcate1';
				} else {
					echo ' showcate';
				}
				echo '">
				<a href="'.$link.'">
          <img src="'.$value['image'].'" alt="'.$value['title'].'" title="'.$value['title'].'" class="img-responsive">
        </a>
        </div>';
			}
		}
		?>
    </div>
    <div class="cls"></div>

  <!-- End Chuyên mục hiển thị -->

  <div class="col-md-12">
  <div class="title"><h2 align="center"><?php echo $this->lang->line("featuredproducts"); ?></h2></div>
  </div>
  <?php 
//   echo "<pre>";
//   print_r($productnews);
//   echo "</pre>";
	if($productnb){
		foreach($productnb as $value){
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
	}
  ?>

  <!-- End Sản phẩm nổi bật -->

  <div class="col-md-12">
  <div class="title"><h2 align="center"><?php echo $this->lang->line("news"); ?></h2></div>
  </div>
  <?php 
  if($news){
  	foreach($news as $value){
  		echo '<div class="col-md-3 col-sm-6 col-xs-6">
    <div class="news">
      <a href="'.base_url().$lang.'/'.$value['cate_linkseo'].'/'.$value['linkseo'].'-n/'.$value['id'].'">
      <img class="img-responsive" src="'.$value['image'].'" />
      <h3 class="ntitle">'.$value['title'].'</h3>
      <p class="description">
       '.$value['description'].'
      </p>
      </a>
    </div>
  </div>';
  	}
  }
  ?>

</div> 
</article>
