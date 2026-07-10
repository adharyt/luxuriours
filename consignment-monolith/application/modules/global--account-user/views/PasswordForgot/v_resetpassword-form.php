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
          <input id="code" type="hidden" name="code" value="<?php echo $code;?>" readonly>
					<div class="wrap-input100 validate-input" data-validate = "Valid username is required: ex@abc.xyz">
						<input id="username" class="input100 has-val" type="text" name="username" value="<?php echo $username;?>" readonly>
						<span class="focus-input100"></span>
						<span class="label-input100">Username</span>
					</div>


					<div class="wrap-input100 validate-input">
						<input id="password" class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">New Password</span>
					</div>
          <div id="validate_password" style="color:red;font-style:oblique;margin-bottom:5px;"></div>

          <div class="wrap-input100 validate-input">
						<input id="rpassword" class="input100" type="password" name="password-confirm">
						<span class="focus-input100"></span>
						<span class="label-input100">Confirm Password</span>
					</div>
          <div id="validate_rpassword" style="color:red;font-style:oblique;margin-bottom:5px;"></div>




					<div class="container-login100-form-btn">
						<button onClick="reset();" class="login100-form-btn" style="background-color:#099245;border-color:#099245;">
							Ganti Password
						</button>
					</div>

				</div>

				<div class="login100-more" style="background-image: url('<?php echo $this->config->item('stil_assets_url');?>/web_template/page_login/images/bg-01.jpg');">
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
  var typingTimer;
  var doneTypingInterval = 1000;
  var validate_password_status=false;

  $('#password').on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(validate_password, doneTypingInterval);
  });
  function validate_password(){
      var password=$('#password').val();
      $.ajax({
        url: services__global__account_user___CheckData__Check__POST.endpoint,
        type: services__global__account_user___CheckData__Check__POST.method,
        data: {
            endpoint: 'password',
            value:password
        },
        success: function (response,textStatus, xhr) {
          if(xhr.status==200){
            if(response.message=='OK'){
              $('#validate_password').hide();
              $('#password').css("border-color","#ebebeb");
            }else{
              $('#validate_password').text(response.data.text);
              $('#validate_password').show();
              $('#password').css("border-color","red");
            }
          }else{
            alert_400();
          }
        },
        error: function(xhr, textStatus, errorThrown) {
           alert_error(xhr.status);
        }
      });
  }

  $('#rpassword').on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(validate_rpassword, doneTypingInterval);
  });
  function validate_rpassword(){
    var password=$('#password').val();
    var rpassword=$('#rpassword').val();
    if(rpassword!=''){
      if(password==rpassword){
        validate_password_status=true;
        $('#validate_rpassword').hide();
        $('#rpassword').css("border-color","#ebebeb");
      }else{
        validate_password_status=false;
        $('#validate_rpassword').text('Kombinasi password tidak cocok!');
        $('#validate_rpassword').show();
        $('#rpassword').css("border-color","red");
      }
    }else{
      validate_password_status=false;
      $('#validate_rpassword').text('Konfirmasi password harus diisi!');
      $('#validate_rpassword').show();
      $('#rpassword').css("border-color","red");
    }
  }

  function reset(){
    var username=$('#username').val();
    var code=$('#code').val();
    var password=$('#password').val();
    var rpassword=$('#rpassword').val();

    validate_rpassword();
    if(validate_password_status!=true){
      return false;
    }else{
      loading_ajax();
      $.ajax({
              url: services__global__account_user___PasswordForgot__reset__PATCH.endpoint,
              type: services__global__account_user___PasswordForgot__reset__PATCH.method,
              data: {
                  username:username,
                  code:code,
                  password:password
              } ,
              success: function (response,textStatus, xhr) {
                Swal.close();
                if(xhr.status==200 && response.message=="OK"){
                  Swal.fire({
                    type: 'success',
                    title: 'Ok',
                    html:   "Password berhasil dirubah",
                    showCloseButton: true,
                    showCancelButton: false,
                    showConfirmButton:true,
                    confirmButtonColor:'#099245',
                    allowEnterKey:false
                  }).then((result) => {
                     location.href='<?php echo base_url();?>login';
                   });
                }else if(xhr.status==200 && response.message=="FAILED"){
                  validate_password();
                  validate_rpassword();
                  fault="<b>Data tidak dapat diproses</b><br>";
                  fault=fault+"<hr>"+data['text'];
                  alert_warning(fault,'FALSE');
                }else{
                  alert_400();
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                 alert_error(jqXHR);
              }
          })
    }

  }


  </script>
</body>
</html>
