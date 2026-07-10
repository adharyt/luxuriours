<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=true.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $this->ConfigModel->getAppInfo('TITLE');?></title>
		<link rel="icon" href="<?php echo $this->ConfigModel->getAppInfo('FAVICON');?>" type="image/x-icon">
    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/web_template/global__account_user__login/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/nouislider/nouislider.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/web_template/global__account_user__login/css/style.css">
    <link href="<?php echo base_url();?>assets/web_template/global__account_user__login/css/global__account_user__login.css" rel="stylesheet" media="screen">
		<link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
		<link href="<?php echo base_url();?>assets/vendor/bootstrap-datepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

    <div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="<?php echo base_url();?>assets/web_template/global__account_user__login/images/form-img.png" alt="">
                    <div class="signup-img-content" style="z-index:3">
						                <img src="<?php echo $this->ConfigModel->getAppInfo('LOGO');?>" width="90%" alt="">
                        <p style="color:black"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__REGISTER_NOW');?></p>
                    </div>
                </div>
                <div class="signup-form">

                <div class="register-form">
					         <h1><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__REGISTER_ACCOUNT');?> <?php echo $this->ConfigModel->getBusinessInfo('NAME');?></h1>
                   <h5><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__ALREADY_HAVE_ACCOUNT');?>
                      <a href="<?php echo base_url();?>login">
                        <?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__LOGIN_HERE');?>
                      </a>
                   </h5>
			             <button class="loginBtn loginBtn--google">
				               <?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__REGISTER_VIA');?> Google
			              </button>
			              <button class="loginBtn loginBtn--facebook">
				               <?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__REGISTER_VIA');?> Facebook
              			</button>
			               <br>&nbsp;
                  <form>
                  <div class="form-row">
							       <div class="form-group">
								         <div class="form-input">
                            <label for="name" class="required"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__FORM_FULL_NAME');?></label>
                              <input type="text" name="name" id="name" maxlength="50"/>
                            <div id="validate_name" style="color:red;font-style:oblique"></div>
                          </div>
                          <div class="form-input" style="margin-bottom:0px">
                            <label for="birthdate" class="required"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__FORM_BIRTH_DATE');?></label>
														<div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
							                   <input  id="dateshowv" size="16" type="text" value="" readonly onChange="validate_date();">
																<span id="dateshow"class="input-group-addon" style="background-color:white;border: 1px solid #ebebeb"><span class="glyphicon glyphicon-calendar"></span></span>
							               </div>
                            <div id="validate_date" style="color:red;font-style:oblique"></div>
														<input type="hidden" id="dtp_input2" value="" /><br/>
                          </div>
                          <div class="form-input">
                            <label for="phone" class="required"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__FORM_PHONE_NUMBER');?></label>
                                <input type="text" name="phone" id="phone" onKeyUp="number_only(this);" maxlength="15"/>
                            <div id="validate_phone" style="color:red;font-style:oblique"></div>
                          </div>
                          <div class="form-radio">
                            <div class="label-flex">
                                <label for="payment"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__FORM_GENDER');?></label>
                            </div>
                            <div class="form-radio-group">
                                <div class="form-radio-item">
                                    <input type="radio" name="gender" id="gmale" value="M" checked>
                                    <label for="gmale"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__FORM_GENDER__MALE');?></label>
                                    <span class="check"></span>
                                </div>
                                <div class="form-radio-item">
                                    <input type="radio" name="gender" id="gfemale" value="F">
                                    <label for="gfemale"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__FORM_GENDER__FEMALE');?></label>
                                    <span class="check"></span>
                                </div>
                            </div>
                           </div>
                      </div>
                      <div class="form-group">
                        <div class="form-input">
                            <label for="email" class="required">Email</label>
                            <input type="text" name="email" id="email" placeholder="yourname@domain.com" maxlength="50"/>
                            <div id="validate_email" style="color:red;font-style:oblique"></div>
                        </div>
                        <div class="form-input">
                            <label for="phone" class="required">Username</label>
                            <input type="text" name="username" id="username"/>
                            <div id="validate_username" style="color:red;font-style:oblique"></div>
                        </div>
					              <div class="form-input">
                              <label for="password" class="required">Password</label>
                              <input type="password" name="password" id="password"/>
                              <div id="validate_password" style="color:red;font-style:oblique"></div>
                        </div>
					              <div class="form-input">
                              <label for="rpassword" class="required"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__FORM_PASSWORD_CONFIRMATION');?></label>
                              <input type="password" name="rpassword" id="rpassword"/>
                              <div id="validate_rpassword" style="color:red;font-style:oblique"></div>
                        </div>
					              <br>
                      </div>
                    </div>
                    </form>
                    <div class="form-submit">
          						<center>
            						 <?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__FORM_TERMS_1');?>
                         <a href="#"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__FORM_TERMS_2');?></a>
                         <?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__FORM_TERMS_3');?>
                         <a href="#"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__FORM_TERMS_4');?></a>
                         <?php echo $this->ConfigModel->getBusinessInfo('NAME_LEGAL');?>.
                         <br><br>
                         <input type="submit" value="<?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__REGISTER__FORM_SUBMIT_BUTTON');?>" class="submit submitButton" id="submit" style="margin-right:0px;" onClick="register();" />
          						</center>

                    </div>
                </div>

              </div>
            </div>
        </div>
    </div>

    <!-- JS-INNER -->
    <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/keyboard.min.js');?>"></script>
    <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/endpoint.js');?>"></script>
    <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/regex.js');?>"></script>
    <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/alert/ajax_response.js');?>"></script>
    <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/alert/loading.js');?>"></script>

    <!-- JS -->
    <script src="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/nouislider/nouislider.min.js"></script>
    <script src="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/wnumb/wNumb.js"></script>
    <script src="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo base_url();?>assets/web_template/global__account_user__login/vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="<?php echo base_url();?>assets/web_template/global__account_user__login/js/main.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js" charset="UTF-8"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/vendor/bootstrap-datepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/vendor/bootstrap-datepicker/js/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>


		<script type="text/javascript">
      var typingTimer;
      var doneTypingInterval = 1000;
      var validate_date_status=false;
      var validate_password_status=false;
      $('#validate_username').hide();
      $('#validate_name').hide();
      $('#validate_password').hide();
      $('#validate_rpassword').hide();
      $('#validate_email').hide();
      $('#validate_phone').hide();
      $('#validate_date').hide();
      $('#validate_edu').hide();

			$('.form_date').datetimepicker({
		    weekStart: 1,
		    todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				minView: 2,
				forceParse: 0
		    });

		</script>
		<script>
      function validate_date(){
        var date=$('#dtp_input2').val();
        if(date!=''){
          validate_date_status=true;
          $('#validate_date').hide();
          $('#dateshowv').css("border-color","#ebebeb");
        }else{
          validate_date_status=false;
          $('#validate_date').text('Tanggal lahir harus diisi!');
          $('#validate_date').show();
          $('#dateshowv').css("border-color","red");
        }
      }

        $('#name').on('keyup', function () {
          clearTimeout(typingTimer);
          typingTimer = setTimeout(validate_name, doneTypingInterval);
        });
        function validate_name(){
            var name=$('#name').val();
            $.ajax({
	            url: services__global__account_user___CheckData__Check__POST.endpoint,
	            type: services__global__account_user___CheckData__Check__POST.method,
              data: {
                  endpoint: 'name',
	                value:name
	            },
              beforeSend: function (xhr) {   //Include the bearer token in header
                xhr.setRequestHeader("Authorization", 'Bearer '+ 'BLANK_TOKEN');
              },
	            success: function (response,textStatus, xhr) {
                if(xhr.status==200){
                  if(response.message=='OK'){
                    $('#validate_name').hide();
                    $('#name').css("border-color","#ebebeb");
                  }else{
                    $('#validate_name').text(response.data.text);
                    $('#validate_name').show();
                    $('#name').css("border-color","red");
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

        $('#username').on('keyup', function () {
          clearTimeout(typingTimer);
          typingTimer = setTimeout(validate_username, doneTypingInterval);
        });
        function validate_username(){
            var username=$('#username').val();
            $.ajax({
	            url: services__global__account_user___CheckData__Check__POST.endpoint,
	            type: services__global__account_user___CheckData__Check__POST.method,
              data: {
                  endpoint: 'username',
	                value:username
	            },
              beforeSend: function (xhr) {   //Include the bearer token in header
                xhr.setRequestHeader("Authorization", 'Bearer '+ 'BLANK_TOKEN');
              },
	            success: function (response,textStatus, xhr) {
                if(xhr.status==200){
                  if(response.message=='OK'){
                    $('#validate_username').hide();
                    $('#username').css("border-color","#ebebeb");
                  }else{
                    $('#validate_username').text(response.data.text);
                    $('#validate_username').show();
                    $('#username').css("border-color","red");
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

        $('#phone').on('keyup', function () {
          clearTimeout(typingTimer);
          typingTimer = setTimeout(validate_phone, doneTypingInterval);
        });
        function validate_phone(){
            var phone=$('#phone').val();
            $.ajax({
	            url: services__global__account_user___CheckData__Check__POST.endpoint,
	            type: services__global__account_user___CheckData__Check__POST.method,
              data: {
                  endpoint: 'phone',
	                value:phone
	            },
              beforeSend: function (xhr) {   //Include the bearer token in header
                xhr.setRequestHeader("Authorization", 'Bearer '+ 'BLANK_TOKEN');
              },
	            success: function (response,textStatus, xhr) {
                if(xhr.status==200){
                  if(response.message=='OK'){
                    $('#validate_phone').hide();
                    $('#phone').css("border-color","#ebebeb");
                  }else{
                    $('#validate_phone').text(response.data.text);
                    $('#validate_phone').show();
                    $('#phone').css("border-color","red");
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

        $('#email').on('keyup', function () {
          clearTimeout(typingTimer);
          typingTimer = setTimeout(validate_email, doneTypingInterval);
        });
        function validate_email(){
            var email=$('#email').val();
            $.ajax({
	            url: services__global__account_user___CheckData__Check__POST.endpoint,
	            type: services__global__account_user___CheckData__Check__POST.method,
              data: {
                  endpoint: 'email',
	                value:email
	            },
              beforeSend: function (xhr) {   //Include the bearer token in header
                xhr.setRequestHeader("Authorization", 'Bearer '+ 'BLANK_TOKEN');
              },
	            success: function (response,textStatus, xhr) {
                if(xhr.status==200){
                  if(response.message=='OK'){
                    $('#validate_email').hide();
                    $('#email').css("border-color","#ebebeb");
                  }else{
                    $('#validate_email').text(response.data.text);
                    $('#validate_email').show();
                    $('#email').css("border-color","red");
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
              beforeSend: function (xhr) {   //Include the bearer token in header
                xhr.setRequestHeader("Authorization", 'Bearer '+ 'BLANK_TOKEN');
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

				function register(){
            var name=$('#name').val();
            var date=$('#dtp_input2').val();
            var username=$('#username').val();
            var phone=$('#phone').val();
            var email=$('#email').val();
            var password=$('#password').val();
            var rpassword=$('#rpassword').val();
            var gender=$('input[name=gender]').val();

            validate_date();
            validate_rpassword();
            if(validate_date_status!=true || validate_password_status!=true){
              return false;
            }else{
              loading_ajax();
              $.ajax({
    	            url: services__global__account_user___Registration__register__POST,
    	            type: "POST",
    	            data: {
    	                name:name,
    	                date:date,
    	                gender:gender,
    	                phone:phone,
                      email:email,
                      password:password,
                      username:username
    	            },
                  beforeSend: function (xhr) {   //Include the bearer token in header
                    xhr.setRequestHeader("Authorization", 'Bearer '+ 'BLANK_TOKEN');
                  },
    	            success: function (response,textStatus, xhr) {
                    Swal.close();
                    if(xhr.status==200 && response.message=="OK"){
                      Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'Akun Anda berhasil dibuat!',
                        html: 'Kami telah mengirimkan link verifikasi ke email <b>'+email+'</b>. Harap lakukan verifikasi dalam waktu 24 jam karna jika dalam kurun waktu 24 jam akun Anda belum diverifikasi maka pendaftaran akun Anda akan dibatalkan secara otomatis.',
                        showConfirmButton: true,
                        confirmButtonColor: '#099245',
                        showCancelButton:false
                      }).then((result) => {
                        if (result.value) {
                          window.location.href="<?php echo base_url();?>login";
                        }
                      });
                    }else if(xhr.status==200 && response.message=="FAILED"){
                      validate_name();
                      validate_phone();
                      validate_email();
                      validate_username();
                      validate_password();
                      validate_rpassword();
                      validate_date();
                      fault="<b>Data tidak dapat diproses</b><br>";
                      response.data.forEach(function(data){
                        fault=fault+"<hr>"+data['text'];
                      });
                      alert_warning(fault,'FALSE');
                    }else{
                      alert_400();
                    }
    	            },
    	            error: function(jqXHR, textStatus, errorThrown) {
    	               alert_400();
    	            }
      	       });
            }

				}
		</script>
</body>
</html>
