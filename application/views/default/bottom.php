<footer>
  <div class="jumbotron footer">
    <div class="container">
      <div class="col-md-4">
			<?php 
			if($setting['content']){
				echo $setting['content'];
			}
			?>
      </div>
       <div class="col-md-4">
        <p class="title">Chính sách và quy định chung</p>
        <p><a href="#">Chính sách & Quy định chung</a></p>
        <p><a href="#">Hình thức thanh toán</a></p>
        <p><a href="#">Chính sách vận chuyển, giao nhận</a></p>
        <p><a href="#">Chính sách đổi hàng</a></p>
        <p><a href="#">Chính sách bảo mật thông tin</a></p>
      </div>
      <div class="col-md-4">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14900.524965933393!2d105.8667844727204!3d20.98737562633099!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac1e06978b5f%3A0xa5397e918c285e5d!2zVsSpbmggSMawbmcsIEhvw6BuZyBNYWksIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1499335936556" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </div>
  </div>
<nav class="navbar navbar-inverse navbarfooter">
<p>Designed by GiaoVu</p>
</nav>
</footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>public/default/js/bootstrap.min.js"></script>
  </body>
</html>