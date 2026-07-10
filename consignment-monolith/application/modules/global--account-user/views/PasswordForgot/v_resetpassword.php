<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $this->ConfigModel->getAppInfo('TITLE');?></title>
  <link rel="icon" href="<?php echo $this->ConfigModel->getAppInfo('FAVICON');?>" type="image/x-icon">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/css/main.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body style="background-color: #666666;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form validate-form">
					<span class="login100-form-title p-b-43">
						Reset Password
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input id="email" class="input100" type="text" name="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>

					<div class="container-login100-form-btn">
						<button onClick="reset();" class="login100-form-btn" style="background-color:#099245;border-color:#099245;">
							Kirim Email Validasi
						</button>
					</div>

				</div>

				<div class="login100-more" style="background-image: url('<?php echo $this->config->item('stil_assets_url');?>/web_template/global__account_user__forgot_password/images/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>





  <!--===============================================================================================-->
  	<script src="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  	<script src="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  	<script src="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/vendor/bootstrap/js/popper.js"></script>
  	<script src="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  	<script src="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  	<script src="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/vendor/daterangepicker/moment.min.js"></script>
  	<script src="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
  	<script src="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
  	<script src="<?php echo base_url();?>assets/web_template/global__account_user__forgot_password/js/main.js"></script>
    <!-- JS-INNER -->
    <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/keyboard.min.js');?>"></script>
    <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/endpoint.js');?>"></script>
    <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/regex.js');?>"></script>
    <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/alert/ajax_response.js');?>"></script>
    <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/alert/loading.js');?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script type="text/javascript">
  function reset(){
    var email=$('#email').val();

    if(email!=''){
      loading_ajax();
      $.ajax({
          url: services__global__account_user___PasswordForgot__request__POST.endpoint,
          type: services__global__account_user___PasswordForgot__request__POST.method,
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          data: JSON.stringify({
              email:email
          }) ,
          success: function (response,textStatus, xhr) {
            Swal.close();
            if(xhr.status==200 && response.message=="OK"){
              Swal.fire({
                type: 'success',
                title: 'Permohonan Berhasil',
                html:   "Kami telah mengirimkan link verifikasi ke email <b>"+email+"</b>. Harap lakukan verifikasi dalam waktu 45 menit karna jika dalam kurun waktu 30 menit Anda belum melakukan verifikasi maka permohonan <i>reset password</i> akun Anda akan dibatalkan secara otomatis.",
                showCloseButton: true,
                showCancelButton: false,
                showConfirmButton:true,
                confirmButtonColor:'#099245',
                allowEnterKey:false
              }).then((result) => {
                if (result.value) {
                  window.location.href="<?php echo base_url();?>login";
                }
              });
            }else if(xhr.status==200 && response.message=="DATA_NOT_FOUND"){
              alert_warning("Email yang Anda masukan salah atau akun Anda belum aktif terdaftar sebagai member STIL!",'FALSE');
            }else{
              alert_400();
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
             alert_400();
          }
       });
    }else{
      Swal.fire({
        type: 'error',
        title: 'Error',
        html:   "Email tidak boleh kosong!",
        showCloseButton: true,
        showCancelButton: false,
        showConfirmButton:true,
        confirmButtonColor:'#099245',
        allowEnterKey:false
      });

    }
  }


  </script>
</body>
</html>
