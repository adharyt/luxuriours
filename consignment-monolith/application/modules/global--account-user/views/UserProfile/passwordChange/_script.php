
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-select/bootstrap-select.js"></script>
<script src="<?php echo base_url();?>assets/plugins/croppie/croppie.js"></script>

<!-- Profile Summary -->
<script type="text/javascript">
var typingTimer;
var doneTypingInterval = 1000;
var validate_oldpassword_status=false;
var validate_password_status=false;
var validate_rpassword_status=false;
</script>
<script type="text/javascript">
$('#old_password').on('keyup', function () {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(validate_old_password, doneTypingInterval);
});
function validate_old_password(){
    validate_password_status=false;
    var password=$('#old_password').val();
    $.ajax({
      url: services__global__account_user___CheckData__Check__POST.endpoint,
      type: services__global__account_user___CheckData__Check__POST.method,
      data: {
          endpoint: 'passworddb',
          value:password
      } ,
      beforeSend: function (xhr) {   //Include the bearer token in header
        xhr.setRequestHeader("Authorization", 'Bearer <?php echo $this->session->userdata('jwt');?>');
      },
      success: function (response,textStatus, xhr) {
        if(xhr.status==200){
          if(response.message=='OK'){
            validate_oldpassword_status=true;
            $('#validate_old_password').hide();
            $('#old_password').css("border-color","#ebebeb");
          }else{
            validate_oldpassword_status=false;
            $('#validate_old_password').text(response.data.text);
            $('#validate_old_password').show();
            $('#old_password').css("border-color","red");
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

$('#new_password').on('keyup', function () {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(validate_password, doneTypingInterval);
});
function validate_password(){
    var password=$('#new_password').val();
    $.ajax({
      url: services__global__account_user___CheckData__Check__POST.endpoint,
      type: services__global__account_user___CheckData__Check__POST.method,
      data: {
          endpoint: 'password',
          value:password
      } ,
      success: function (response,textStatus, xhr) {
        if(xhr.status==200){
          if(response.message=='OK'){
            validate_password_status=true;
            $('#validate_password').hide();
            $('#new_password').css("border-color","#ebebeb");
          }else{
            validate_password_status=false;
            $('#validate_password').text(response.data.text);
            $('#validate_password').show();
            $('#new_password').css("border-color","red");
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

$('#new_password_confirm').on('keyup', function () {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(validate_rpassword, doneTypingInterval);
});
function validate_rpassword(){
  var password=$('#new_password').val();
  var rpassword=$('#new_password_confirm').val();
  if(rpassword!=''){
    if(password==rpassword){
      validate_rpassword_status=true;
      $('#validate_rpassword').hide();
      $('#new_password_confirm').css("border-color","#ebebeb");
    }else{
      validate_rpassword_status=false;
      $('#validate_rpassword').text('Kombinasi password tidak cocok!');
      $('#validate_rpassword').show();
      $('#new_password_confirm').css("border-color","red");
    }
  }else{
    validate_rpassword_status=false;
    $('#validate_rpassword').text('Konfirmasi password harus diisi!');
    $('#validate_rpassword').show();
    $('#new_password_confirm').css("border-color","red");
  }
}

function pass_change__update(){
  if(validate_oldpassword_status!=true && validate_password_status!=true && validate_rpassword_status!=true){
    return false;
  }else{
    loading_ajax();
    $.ajax({
      url: services__global__account_user___PasswordUpdate__update__PATCH.endpoint,
      type: services__global__account_user___PasswordUpdate__update__PATCH.method,
      data: {
        old_password:$('#old_password').val(),
        new_password:$('#new_password').val()
      },
      beforeSend: function (xhr) {   //Include the bearer token in header
        xhr.setRequestHeader("Authorization", 'Bearer <?php echo $this->session->userdata('jwt');?>');
      },
      success: function (response,textStatus, xhr) {
        Swal.close();
        if(xhr.status==200 && response.message=="OK"){
          Swal.fire({
            position: 'center',
            type: 'success',
            title: response.data.text,
            showConfirmButton: true,
            confirmButtonColor: '#099245',
            showCancelButton:false
          }).then((result) => {
            if (result.value) {
              window.location.href="<?php echo base_url();?>service/authentication/logout";
            }
          });
        }else if(xhr.status==200 && response.message=="FAILED"){
          validate_rpassword();
          validate_old_password();
          validate_password();
          alert_warning(response.data.text,'FALSE');
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
