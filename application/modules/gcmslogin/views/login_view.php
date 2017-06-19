<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title><?php echo $title; ?></title>
<link href="<?php echo base_url(); ?>public/gcms/css/bootstrap.min.css"
	rel="stylesheet">
<link href="<?php echo base_url(); ?>public/gcms/css/login.css"
	rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<div id="banner">
		<img src="<?php echo base_url(); ?>public/gcms/img/banner.jpg"
			class="responsiveimg">
	</div>
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<form action="" method="POST">
					<legend><?php echo $this->lang->line('logingcms'); ?></legend>
						      <?php 
							      if(validation_errors() != ""){
							      	echo '<div class="alert alert-warning" role="alert">'.validation_errors().'</div>';
							      }
							      if($error != ""){
							      	echo '<div class="alert alert-warning" role="alert">'.$error.'</div>';
							      }
							  ?> 
					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo $this->lang->line('user'); ?></label>
						<input type="text" class="form-control" id="txtuser"
							name="txtuser"
							placeholder="<?php echo $this->lang->line('user'); ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1"><?php echo $this->lang->line('pass'); ?></label>
						<input type="password" class="form-control" id="password"
							name="password"
							placeholder="<?php echo $this->lang->line('pass'); ?>">
					</div>
					<div class="form-group languages">
						<label for="lang"><?php echo $this->lang->line('lang'); ?></label>
						<select class="form-control" name="lang">
							<option value="vn"><?php echo $this->lang->line('vi'); ?></option>
							<option value="en"><?php echo $this->lang->line('en'); ?></option>
						</select>
					</div>
					<button type="submit" name="ok" class="btn btn-primary"><?php echo $this->lang->line('submit'); ?></button>
				</form>
			</div>
		</div>

	</div>
	<div class="col-md-4"></div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url(); ?>public/gcms/js/bootstrap.min.js"></script>
</body>
</html>