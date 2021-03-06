<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
				aria-expanded="false">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url()."gcms/home/index"; ?>"><?php echo $module; ?></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse"
			id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a target="_blank" href="<?php echo base_url().$this->session->userdata['lang']; ?>"><img src="<?php echo base_url(); ?>public/gcms/img/home.png" alt="home" title="" /> Trang
						chủ <span class="sr-only">(current)</span></a></li>
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false"><img src="<?php echo base_url(); ?>public/gcms/img/plus-black-symbol.png"
						alt="plus-black-symbol" title="" /> Mới <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Bài viết</a></li>
						<li><a href="#">Sản phẩm</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">Chuyên mục</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="<?php echo base_url () . "gcms/user/add" ?>">Thành viên</a></li>
					</ul></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false"><img src="<?php echo base_url(); ?>public/gcms/img/plane.png" alt="plane" title="" />
						Đơn hàng mới <span class="caret"></span></a>
						<ul class="dropdown-menu">
						<?php 
						if($listOrderOnTop){
							foreach($listOrderOnTop as $value){
								echo '<li><a href="'.base_url()."gcms/order/view/".$value['id'].'">'.$value['fullname'].' - '.$value['email'].'</a></li>
						<li role="separator" class="divider"></li>';
							}
						}
						?>
						<li style="float: right"><a href="<?php echo base_url()."gcms/order/index" ?>">Xem toàn bộ...</a></li>
						</ul>
						</li>
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false"><img
						src="<?php echo base_url(); ?>public/gcms/img/speech-bubbles-comment-option.png"
						alt="speech-bubbles-comment-option" title="" /> Thư mới <span
						class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php 
						if($listContactOnTop){
							foreach($listContactOnTop as $value){
								echo '<li><a href="'.base_url()."gcms/contact/view/".$value['id'].'">'.$value['name'].' - '.$value['email'].'</a></li>
						<li role="separator" class="divider"></li>';
							}
						}
						?>
						<li style="float: right"><a href="<?php echo base_url()."gcms/contact/index" ?>">Xem toàn bộ...</a></li>
					</ul></li>
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false"><img src="<?php echo base_url(); ?>public/gcms/img/user-shape.png"
						alt="user-shape" title="" /> <?php echo $this->session->userdata("username"); ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url()."gcms/user/myprofile"; ?>">Thông tin cá nhân</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="<?php echo base_url(); ?>gcms/home/logout">Đăng xuất</a></li>
					</ul></li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>