
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-select/bootstrap-select.js"></script>
<script src="<?php echo base_url();?>assets/plugins/croppie/croppie.js"></script>

<!-- CROPPIE -->
<script>
$(document).ready(function(){

 $image_crop = $('#image_to_crop').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'circle' //square
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        //console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('#crop_and_upload').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(cropped_images){
      loading_ajax('Mengganti foto profil...');
      $.ajax({
        url:services__global__user___User__updateUserPhoto__POST.endpoint,
        type: services__global__user___User__updateUserPhoto__POST.method,
        data:{"image": cropped_images},
        beforeSend: function (xhr) {   //Include the bearer token in header
          xhr.setRequestHeader("Authorization", 'Bearer '+ $('#jwt-token').val());
        },
        success: function (body,textStatus, xhr) {
          Swal.close();
          $('#uploadimageModal').modal('hide');
          if(xhr.status==200 && body.message=="OK"){
            $('#currentpic').attr("src",body.data.file_name);
            $('#imgProfileHeader').attr("src",body.data.file_name);
            rebuild_session();
          }else{
            alert_400();
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           alert_error(jqXHR);
        }
      });
    })
  });

});
</script>
<!-- Profile Summary -->
<script>
var typingTimer;
var doneTypingInterval = 1000;
var validate_date_status=false;
var validate_password_status=false;

  function editProfile() {
    $('#btnEdit').hide();
    $('#btnCancel').show();
    $('#btnSave').show();
    $('#name').css("background-color","white").prop( "readonly", false );
    $('#date-label').css("background-color","white").prop( "readonly", false );
    $('#jeniskelamin-label').css("background-color","white").prop( "disabled", false );
    $('#phone').css("background-color","white").prop( "readonly", false );
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
          xhr.setRequestHeader("Authorization", 'Bearer '+ $('#jwt-token').val());
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
          xhr.setRequestHeader("Authorization", 'Bearer '+ $('#jwt-token').val());
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



  function saveProfile() {
    var nama=$('#name').val();
    var birthdate=$('#date-label').val();
    var gender=$('#jeniskelamin-label').val();
    var phone=$('#phone').val();

    loading_ajax();
    $.ajax({
          url: services__global__user___User__updateUserData__PATCH.endpoint,
          type: services__global__user___User__updateUserData__PATCH.method,
          data: {
            name:nama,
            birthdate:birthdate,
            gender:gender,
            phone:phone,
          },
          beforeSend: function (xhr) {   //Include the bearer token in header
            xhr.setRequestHeader("Authorization", 'Bearer '+ $('#jwt-token').val());
          },
          success: function (body,textStatus, xhr) {
            Swal.close();
            if(xhr.status==200 && body.message=="OK"){
              rebuild_session();
              Swal.fire({
                type: 'success',
                html:   "Perubahan berhasil disimpan!",
                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton:true,
                allowEnterKey:true,
                confirmButtonColor:'#009245'
              }).then((result) => {
                $('#btnEdit').show();
                $('#btnCancel').hide();
                $('#btnSave').hide();
                $('#name').attr("style","background-color:  #E8E8E8 !important").prop( "readonly", true );
                $('#date-label').attr("style","background-color:  #E8E8E8 !important").prop( "readonly", true );
                $('#jeniskelamin-label').attr("style","background-color:  #E8E8E8 !important").prop( "disabled", true );
                $('#pendidikan-label').attr("style","background-color:  #E8E8E8 !important").prop( "disabled", true );
                $('#ktp-label').attr("style", "background-color :#E8E8E8 !important").prop( "readonly", true );
                $('#phone').attr("style","background-color:  #E8E8E8 !important").prop( "readonly", true );
              });
            }else if(xhr.status==200 && body.message=="FAILED"){
              validate_name();
              validate_phone();
              //validate_date();
              fault="<b>Data tidak dapat diproses</b><br>";
              body.data.forEach(function(data){
                fault=fault+"<hr>"+data['text'];
              });
              alert_warning(fault,'FALSE');
            }else{
              alert_400();
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
             alert_error(jqXHR);
          }
      });


  }
</script>
</body>

</html>
