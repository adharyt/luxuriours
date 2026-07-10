<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
  <span class="symbol-btn-back-to-top">
    <i class="fa fa-angle-double-up" aria-hidden="true"></i>
  </span>
</div>

<!-- Container Selection1 -->
<div id="dropDownSelect1"></div>



<!--===============================================================================================-->
<script type="text/javascript" src="<?php echo base_url('assets/web_template/commerce/main/');?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?php echo base_url('assets/web_template/commerce/main/');?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?php echo base_url('assets/web_template/commerce/main/');?>vendor/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/web_template/commerce/main/');?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?php echo base_url('assets/web_template/commerce/main/');?>vendor/select2/select2.min.js"></script>
<script type="text/javascript">
  $(".selection-1").select2({
    minimumResultsForSearch: 20,
    dropdownParent: $('#dropDownSelect1'),
    width: '165px'
  });
  $(".selection-1").on('select2:selecting', function(e){
    location.replace('<?php echo base_url();?>Settings/changeLanguage?value='+e.params.args.data.id);
});
</script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?php echo base_url('assets/web_template/commerce/main/');?>vendor/slick/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/web_template/commerce/main/');?>js/slick-custom.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?php echo base_url('assets/web_template/commerce/main/');?>vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?php echo base_url('assets/web_template/commerce/main/');?>vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript">
  $('.block2-btn-addcart').each(function(){
    var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
    $(this).on('click', function(){
      swal(nameProduct, "is added to cart !", "success");
    });
  });

  $('.block2-btn-addwishlist').each(function(){
    var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
    $(this).on('click', function(){
      swal(nameProduct, "is added to wishlist !", "success");
    });
  });
</script>

<!--===============================================================================================-->
<script src="<?php echo base_url('assets/web_template/commerce/main/');?>js/main.js"></script>
<input type="hidden" id="APPATH_login" value="<?php echo base_url('login');?>"/>
<input type="hidden" id="jwt-token" value="<?php echo $this->session->userdata('jwt')!=''?$this->session->userdata('jwt'):"BLANK_TOKEN";?>"/>
