<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $this->ConfigModel->getAppInfo('TITLE');?></title>
  <link rel="icon" href="<?php echo $this->ConfigModel->getAppInfo('FAVICON');?>" type="image/x-icon">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/web_template/global__account_user__login/css/main.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<!--===============================================================================================-->
<style media="screen">
.input-checkbox100:checked + .label-checkbox100::before {
  color: #099245;
}
.label-checkbox100::before {
  border:1px solid #099245;
}
</style>
</head>

<body style="background-color: #666666;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form validate-form">
					<span class="login100-form-title p-b-43" style="font-family: 'Roboto', sans-serif;">
						<?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__LOGIN__TITLE');?> <?php echo $this->ConfigModel->getBusinessInfo('NAME');?>
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input id="username" class="input100" type="text" name="email" style="font-family: 'Roboto', sans-serif;">
						<span class="focus-input100"></span>
						<span class="label-input100" style="font-family: 'Roboto', sans-serif;"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__LOGIN__FORM_USEREMAIL');?></span>
					</div>


					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input id="password" class="input100" type="password" name="password" style="font-family: 'Roboto', sans-serif;">
						<span class="focus-input100"></span>
						<span class="label-input100" style="font-family: 'Roboto', sans-serif;"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__LOGIN__FORM_PASSWORD');?></span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1" style="font-family: 'Roboto', sans-serif;">
								<?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__LOGIN__FORM_REMEMBER_ME');?>
							</label>
						</div>

						<div>
							<a href="<?php echo base_url();?>forgot-password" class="txt1" style="font-family: 'Roboto', sans-serif;">
								<?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__LOGIN__FORGOT_PASSWORD');?>
							</a>
						</div>
					</div>


					<div class="container-login100-form-btn" >
						<button onClick="auth();" class="login100-form-btn" style="background-color:#099245;border-color:#099245;">
							<?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__LOGIN__FORM_SUBMIT_BUTTON');?>
						</button>
					</div>

					<div class="text-center p-t-46 p-b-20">
						<span class="txt2" style="font-family: 'Roboto', sans-serif;">
							<?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__LOGIN__REGISTER_NOW_0');?> <a href="<?php echo base_url();?>register" style="font-family: 'Roboto', sans-serif;font-family: 'Roboto', sans-serif;"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__LOGIN__REGISTER_NOW_1');?></a>
						</span>
					</div>
				</div>

				<div class="login100-more" style="background-image: url('<?php echo base_url();?>assets/web_template/global__account_user__login/images/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>





<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/web_template/global__account_user__login/js/main.js"></script>
  <!-- JS-INNER -->
  <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/keyboard.min.js');?>"></script>
  <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/endpoint.js');?>"></script>
  <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/regex.js');?>"></script>
  <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/alert/ajax_response.js');?>"></script>
  <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/alert/loading.js');?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script type="text/javascript">
  function auth(){
    var username=$('#username').val();
    var password=$('#password').val();

    if(username!='' && password!=''){
      $.ajax({
              url: services__global__authentication___Authentication__login__POST.endpoint,
              type: services__global__authentication___Authentication__login__POST.method,
              data: {
                  username:username,
                  password:password
              } ,
              success: function (body,textStatus, xhr) {
                Swal.close();
								if(xhr.status==200){
                   if(body.message=='PASSWORD_MATCH'){
                     set_session(body.data.jwt,"<?php echo $this->input->get('redirect_link');?>");
                   }else{
                     Swal.fire({
                       type: 'warning',
                       html:   body.data.text,
                       showCloseButton: true,
                       showCancelButton: false,
                       showConfirmButton:true,
                       confirmButtonColor:'#099245',
                       allowEnterKey:false
                     });
                   }
                 }else{
                   alert_400();
                 }
              },
              error: function(xhr, textStatus, errorThrown) {
  					     alert_error(xhr.status);
  					   }


          })
    }else{
      Swal.fire({
        type: 'error',
        title: 'Autentikasi Gagal',
        html:   "Email/Username/Password tidak boleh kosong!;",
        showCloseButton: true,
        showCancelButton: false,
        showConfirmButton:true,
        confirmButtonColor:'#099245',
        allowEnterKey:false
      });

    }
  }

  <?php

  if($this->session->flashdata('swalert')!=''){
  	switch($this->session->flashdata('swalert')){
  		case 'register_email_success':
  			echo "
        const Toast = Swal.mixin({
        				toast: true,
        				position: 'center',
        				showConfirmButton: false,
        				timer: 3000,
        				timerProgressBar: true,
        			});

        			Toast.fire({
        				icon: 'success',
        				title: 'Email akun Anda berhasil diverifikasi, silahkan login!'
        			});
            ";
  			break;
  	}


  }
  ?>


  </script>
</body>
</html>
