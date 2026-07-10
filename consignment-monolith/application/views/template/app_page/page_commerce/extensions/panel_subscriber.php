<!-- Newsletter -->
<div class="newsletter" style="background-color:white!important">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
          <div class="newsletter_title_container">
            <div class="newsletter_icon"><img width="60" src="<?php echo base_url();?>assets/images/icon-img/send.png" alt=""></div>
            <div class="newsletter_title">Berlangganan Newsletter</div>
            <div class="newsletter_text"><p>...dan dapatkan berbagai promo menarik!</p></div>
          </div>
          <div class="newsletter_content clearfix">
            <div class="newsletter_form">
              <input id="newsletter_email" type="email" class="newsletter_input" required="required" placeholder="contoh: nama@domain.com">
              <button onClick="subscribe();" class="newsletter_button">Berlangganan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function subscribe(){
  var subs_email=$('#newsletter_email').val();

  if(subs_email!=''){
    if(REGEX_email.test(subs_email)){
    loading_ajax();
    $.ajax({
      url: "<?php echo base_url();?>subscribe",
      type: "post",
      data: {
          email:subs_email
      } ,
      success: function (response,textStatus, xhr) {
         Swal.close();
         if(xhr.status==200){
           var rbody= JSON.parse(response);
           if(rbody.status=='NEW' || rbody.status=='RESEND'){
             $('#newsletter_email').val('');
             Swal.fire({
               title: 'Pendaftaran newsletter berhasil!',
               html:   "Untuk memulai berlangganan, silahkan verifikasi email Anda dengan cara menekan tombol konfirmasi yang telah kami kirim ke email Anda!",
               type: 'success',
               reverseButtons:true,
               showCancelButton: false,
               confirmButtonColor: '#099235',
               confirmButtonText: 'OK'
              });
           }else if(rbody.status=='REGISTERED'){
             $('#newsletter_email').val('');
             Swal.fire({
               title: 'Pendaftaran newsletter gagal!',
               html:   "Email Anda sudah terdaftar!",
               type: 'warning',
               reverseButtons:true,
               showCancelButton: false,
               confirmButtonColor: '#099235',
               confirmButtonText: 'OK'
              });
            }else{
              code_400();
            }
         }else{
           code_400();
         }
      },
      error: function(xhr, textStatus, errorThrown) {
        alert_error(xhr.status);
      }
    });
  }else{
    Swal.fire({
      title: 'Pendaftaran newsletter gagal!',
      html:   "Alamat email tidak valid!",
      type: 'warning',
      reverseButtons:true,
      showCancelButton: false,
      confirmButtonColor: '#099235',
      confirmButtonText: 'OK'
     });
  }
}else{
  Swal.fire({
    title: 'Pendaftaran newsletter gagal!',
    html:   "Alamat email wajib diisi!",
    type: 'warning',
    reverseButtons:true,
    showCancelButton: false,
    confirmButtonColor: '#099235',
    confirmButtonText: 'OK'
   });
  }
}
</script>
