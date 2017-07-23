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
		<div class="cls"></div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-8">
						<div class="detailproduct">
							<div class="slideimg">
								<!-- Nav tabs -->
								<div class="col-md-2 npdl">
									<ul class="nav nav-tabs imgclick" role="tablist">
		        <?php
										if ($data ['list_image'] != NULL) {
											$list_images = explode ( "|", $data ['list_image'] );
											$stt = 0;
											foreach ( $list_images as $image ) {
												$stt ++;
												if ($image != NULL && $stt < 5) {
													if ($stt == 1) {
														echo '<li role="presentation" class="active"><a href="#slideimg' . $stt . '" aria-controls="slideimg' . $stt . '" role="tab" data-toggle="tab"><img src="' . $image . '" width="100"></a></li>';
													} else {
														echo '<li role="presentation"><a href="#slideimg' . $stt . '" aria-controls="slideimg' . $stt . '" role="tab" data-toggle="tab"><img src="' . $image . '" width="100"></a></li>';
													}
												}
											}
										}
										?>
        </ul>
								</div>

								<!-- Tab panes -->
								<div class="col-md-10 npd">
									<div class="tab-content">
          		        <?php
																				if ($data ['list_image'] != NULL) {
																					$list_images = explode ( "|", $data ['list_image'] );
																					$stt = 0;
																					foreach ( $list_images as $image ) {
																						$stt ++;
																						if ($image != NULL && count ( $image ) <= 4) {
																							if ($stt == 1) {
																								echo '            <div role="tabpanel" class="tab-pane active" id="slideimg' . $stt . '">
              <img src="' . $image . '" class="img-responsive">
            </div>';
																							} else {
																								echo '            <div role="tabpanel" class="tab-pane" id="slideimg' . $stt . '">
              <img src="' . $image . '" class="img-responsive">
            </div>';
																							}
																						}
																					}
																				} else {
																					echo '<div role="tabpanel" class="tab-pane active" id="">
	              <img src="' . $data ['image'] . '" class="img-responsive">
	            </div>';
																				}
																				?>
          </div>
								</div>

							</div>
						</div>
					</div>
					<!-- Image -->

					<div class="col-md-4">
						<div class="profile">
							<h1 class="title"><?php echo $data['title'] ?></h1>
							<p class="promotion">
								<b>Giá cũ</b>: <strike><?php echo str_replace(",", ".", number_format($data['promotion'])); ?></strike>
							</p>
							<p class="price">
								<b>Giá mới</b>: <font color="red"><?php echo str_replace(",", ".", number_format($data['price'])); ?></font>
							</p>
							<p class="description">
                	<?php echo $data['description']; ?>
                </p>
							<p class="hotline">
								<b>Hotline</b>: <?php echo $setting['hotline']?></p>
							<a href="<?php echo base_url()."home/addcart/".$data['id']; ?>"
								class="btn btn-default addcart"><span
								class="glyphicon glyphicon-shopping-cart"></span> Thêm vào giỏ
								hàng</a>
							<hr />
							<!-- AddToAny BEGIN -->
							<div id="fb-root"></div>
							<div id="fb-root"></div>
							<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

							<div class="fb-like"
								data-href="<?php echo base_url().$lang."/".$cate['linkseo']."/".$data['linkseo']; ?>"
								data-layout="button_count" data-action="like" data-size="large"
								data-show-faces="true" data-share="false"></div>
							<hr />
							<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
								<a class="a2a_button_facebook"></a> <a
									class="a2a_button_twitter"></a> <a
									class="a2a_button_google_plus"></a> <a class="a2a_dd"
									href="<?php echo base_url().$lang."/".$cate['linkseo']."/".$data['linkseo']; ?>"></a>
							</div>
							<script async src="<?php echo base_url()."public/default/js/page.js" ?>"></script>
							<!-- AddToAny END -->
						</div>
					</div>
					<!-- Profile -->
					<div class="cls"></div>
					<div class="col-md-8">
						<div class="description-product">

							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#gt"
									aria-controls="gt" role="tab" data-toggle="tab">Giới thiệu</a></li>
								<li role="presentation"><a href="#bl" aria-controls="bl"
									role="tab" data-toggle="tab">Bình luận</a></li>
							</ul>

							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="gt">
              <?php
														if ($data ['content']) {
															echo $data ['content'];
														}
														?>                         
            </div>
								<div role="tabpanel" class="tab-pane" id="bl">

									<div id="fb-root"></div>
									<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
									<div class="fb-comments"
										data-href="<?php echo base_url().$lang."/".$cate['linkseo']."/".$data['linkseo']; ?>"
										data-numposts="5" data-width="100%"></div>


								</div>
							</div>

						</div>
					</div>
					<!-- col-md-8-->
					<div class="col-md-4 sanphamnb">
						<div class="title">
							<h2 align="center">Sản phẩm nổi bật</h2>
						</div>
         <?php
									// echo "<pre>";
									// print_r($productnews);
									// echo "</pre>";
									if ($productnb) {
										foreach ( $productnb as $value ) {
											$promotion = number_format ( $value ['promotion'] );
											$promotion = str_replace ( ",", ".", $promotion );
											$price = number_format ( $value ['price'] );
											$price = str_replace ( ",", ".", $price );
											$sales = ($value ['promotion'] - $value ['price']) * 100;
											$sale = ceil ( $sales / $value ['promotion'] );
											echo '<div class="col-md-12">
            <div class="product">
                  <a href="' . base_url () . $lang . '/' . $value ['cate_linkseo'] . '/' . $value ['linkseo'] . '-p/' . $value ['id'] . '">
                  <img class="img-responsive" src="' . $value ['image'] . '" />
                  <h3 class="ptitle">' . $value ['title'] . '</h3>
                  <p class="promotion">Giá cũ: <strike>' . $promotion . '</strike></p>
                  <p class="price">Giá hiện tại: <font color="red">' . $price . '</font></p>';
											if ($value ['promotion']) {
												echo '<div class="sale">
                    <span>
                      ' . $sale . '%
                    </span>
                  </span>    
                  </div></a>';
											}
											
											echo '</div></div>';
										}
									}
									?>

      </div>
					<!-- col-md-4 -->
				</div>
				<!-- P-Body -->
			</div>
			<!-- Panel -->

			<!-- Sản phẩm cùng chuyên mục  -->
		</div>
		<!-- col-md-12-->
		<div class="col-md-12">
			<div class="title">
				<h2 align="center">Sản phẩm cùng chuyên mục</h2>
			</div>
		</div>
	  <?php
			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";
			if ($other) {
				foreach ( $other as $value ) {
					$promotion = number_format ( $value ['promotion'] );
					$promotion = str_replace ( ",", ".", $promotion );
					$price = number_format ( $value ['price'] );
					$price = str_replace ( ",", ".", $price );
					$sales = ($value ['promotion'] - $value ['price']) * 100;
					$sale = ceil ( $sales / $value ['promotion'] );
					echo '<div class="col-md-3 col-sm-6 col-xs-6">
				    <div class="product">
				          <a href="' . base_url () . $lang . '/' . $cate ['linkseo'] . '/' . $value ['linkseo'] . '-p/' . $value ['id'] . '">
				          <img class="img-responsive" src="' . $value ['image'] . '" />
				          <h3 class="ptitle">' . $value ['title'] . '</h3>
				          <p class="promotion">Giá cũ: <strike>' . $promotion . '</strike></p>
				          <p class="price">Giá hiện tại: <font color="red">' . $price . '</font></p>';
					if ($value ['promotion']) {
						echo '<div class="sale">
				            <span>
				              ' . $sale . '%
				            </span>
				          </span>    
				          </div></a>';
					}
					
					echo '</div></div>';
				}
			}
			?>
 </div>
	<!-- Container -->


</article>