<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link href="<?php echo ($setting['favicon']) ? $setting['favicon'] : ''; ?>" rel="shortcut icon" type="image/x-icon" />
    <meta http-equiv="content-language" content= "<?php echo $lang; ?>" />
    <title><?php echo isset($title) ? $title : "Homepage"; ?></title>
    <meta property="fb:admins" content="100000094761041"/>
    <meta name="description" content="<?php echo isset($descriptionseo) ? $descriptionseo: ""; ?>"/>
	<meta name="keywords" content="<?php echo isset($keywords) ? $keywords: ""; ?>"/>
	<meta name="robots" content="noodp,index,follow" />
	<meta name='revisit-after' content="1 days" />
    <meta property="og:image" content="<?php echo isset($imageseo) ? $imageseo : ""; ?>"/>
    <meta property="og:url"                content="<?php echo base_url(uri_string()); ?>"/>
    <meta property="og:title"              content="<?php echo isset($titleseo) ? $titleseo : ""; ?>"/>
    <meta property="og:description"        content="<?php echo isset($descriptionseo) ? $descriptionseo: ""; ?>"/>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>public/default/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/default/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/default/css/responsive.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="<?php echo base_url(); ?>public/default/js/jquery-3.2.1.min.js"></script>
    <script>
    var baseUrl="<?php echo base_url();?>";
    </script>
    <script src="<?php echo base_url(); ?>public/default/js/jquery_code.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>

    </script>
  </head>
  <body>
<nav class="navbar navbar-default" id="topnavbar">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url().$lang ?>"><?php echo ($setting['logo'] != "") ? "<img style='margin-top:-5px;' src='$setting[logo]' width='50' />" : "LOGO"  ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
		<li><a href="<?php echo base_url().$lang; ?>"><?php echo $this->lang->line("homepage"); ?></a></li>
		<?php 
		showMenu($menu,0,$lang);
		?>
      </ul>
      <form class="navbar-form navbar-right">
        <div class="form-group">
          <select class="form-control" id="lang">
            <option value='vn' <?php echo ($this->uri->segment(1) == 'vn') ? 'selected' : '' ?>>Vietnamese</option>
            <option value='en' <?php echo ($this->uri->segment(1) == 'en') ? 'selected' : '' ?>>English</option>
          </select>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo $this->lang->line("cart"); ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url().$lang."/gio-hang" ?>">
            <b><span class="glyphicon glyphicon-eye-open"></span> <?php echo $this->lang->line("totalitems"); ?>:</b> <?php echo $this->cart->total_items(); ?> <br /><br />
            <b><span class="glyphicon glyphicon-usd"></span> <?php echo $this->lang->line("totalprice"); ?>:</b> <font color='red'><?php echo str_replace(",", ".", number_format($this->cart->total())); ?></font>
              

            </a></li>
            <?php
              if($this->cart->total_items() != 0){
                echo '<li role="separator" class="divider"></li>';
                echo '<li><a href="'.base_url().$lang.'/dat-hang"><b><span class="glyphicon glyphicon-ok-sign"></span> Thanh toán</b></a></li>';
              }
            ?>
          </ul>
          </li>
      </ul>
      <form class="navbar-form navbar-right" action="<?php echo base_url().$lang.'/tim-kiem'; ?>" method="GET">
        <div class="form-group">
          <input type="text" class="form-control" name="keyword" placeholder="<?php echo $this->lang->line("enterkeyword"); ?>..">
        </div>
        <button type="submit" class="btn btn-default"><?php echo $this->lang->line("search"); ?></button>
      </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
