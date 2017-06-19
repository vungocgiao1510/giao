<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<link href="<?php echo base_url(); ?>public/gcms/css/bootstrap.min.css"
	rel="stylesheet">
<link href="<?php echo base_url(); ?>public/gcms/css/style.css"
	rel="stylesheet">
<link href="<?php echo base_url(); ?>public/gcms/css/responsive.css"
	rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto"
	rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script>
var baseUrl="<?php echo base_url();?>";
</script>
<script
	src="<?php echo base_url(); ?>public/gcms/js/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>public/gcms/js/jquery_code.js"></script>
</head>
<body>
	<div id="topmenu">
		<?php $this->load->view("gcms/top"); ?>
	</div>
	<div id="leftmenu" class="col-md-2">
	<?php $this->load->view("gcms/left"); ?>		
	</div>
	<div id="main" class="col-md-10">
		<?php $this->load->view($loadPage); ?>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="<?php echo base_url(); ?>public/gcms/js/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url(); ?>public/gcms/js/bootstrap.min.js"></script>
</body>
</html>