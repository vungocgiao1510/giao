<div class="container">
 <div class="col-md-12">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url().$lang ?>"><?php echo $this->lang->line("homepage"); ?></a></li>
    <li class="active"><?php echo $this->lang->line("contact"); ?></li>
  </ol>
 	<div class="panel panel-default">
	  <div class="panel-body">

<script>
function validateForm() {
    var fullname = document.forms["myform"]["fullname"].value;
    if (fullname == "") {
        alert("Họ tên không được bỏ trống");
        return false;
    }
    var phone = document.forms["myform"]["phone"].value;
    if (phone == "") {
        alert("Điện thoại không được bỏ trống");
        return false;
    }
    var email = document.forms["myform"]["email"].value;
    if (email == "") {
        alert("Email không được bỏ trống");
        return false;
    }
    var address = document.forms["myform"]["address"].value;
    if (address == "") {
        alert("Địa chỉ không được bỏ trống");
        return false;
    }    
}
</script>
			<form id="contactform" name="myform" onsubmit="return validateForm()" method="POST" action="<?php echo base_url()."home/successcontact" ?>">
			<div class="col-sm-12"><legend>Liên hệ với chúng tôi</legend></div>
			<div class="col-sm-6">
			  <div class="form-group">
			    <label for="">Họ tên</label>
			    <input type="text" class="form-control" name="fullname" id="" placeholder="Họ tên" required>
			  </div>
			  <div class="form-group">
			    <label for="">Điện thoại</label>
			    <input type="number" class="form-control" name="phone" id="" placeholder="Điện thoại" required>
			  </div>
			  <div class="form-group">
			    <label for="">Email</label>
			    <input type="email" class="form-control" name="email" id="" placeholder="Email" required>
			  </div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group">
			    <label for="">Địa chỉ</label>
			    <input type="text" class="form-control" name="address" id="" placeholder="Địa chỉ" required>
			  </div>
			  <div class="form-group">
			    <label for="">Nội dung</label>
			    <textarea class="form-control" name="content" rows="5" required></textarea>
			  </div>
			  <div class="form-group">
			  <div class="col-sm-4 npd">
			  <?php
			  echo $cap['image']; 
			  ?>
			  </div>
			  <!-- <button type="submit" name="ok" class="btn btn-default">Load</button> -->
			  <div class="col-sm-8 npd">

			  <input type="text" class="form-control" name="captcha" id="" placeholder="Captcha.." required>
			  </div>
			  </div>
			  <br />
			  <hr />
			  <div class="form-group">
			  <button type="submit" name="ok" class="btn btn-default">Đặt hàng</button>
			  </div>
			</div>			  			  			  			  
			</form>



	  </div>
	</div>
 </div>
</div>