
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
<script>
  $(function() {
    $('#newsletterstatus').bootstrapToggle({
      on: 'Enabled',
      off: 'Disabled'
    });
  });

  $('#newsletterstatus').on('change',function(e) {
    if($(this).prop('checked')==true){
      var val=1;
      var popup="Berlangganan...";
    }else{
      var val=0;
      var popup="Berhenti berlangganan...";
    }
    loading_ajax(popup);
    $.ajax({
          url: "<?php echo base_url();?>subscribe/toggleProfile",
          type: "post",
          data: {
            prop:val
          },
          success: function (response,textStatus, xhr){
            Swal.close();
            if(xhr.status==200){
              var body = JSON.parse(response);
              Swal.fire({
                type: 'success',
                html:  body.content,
                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton:true,
                allowEnterKey:true,
                confirmButtonColor:'#009245'
              });
            }else{
              alert_400();
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            alert_error(xhr.status);
          }

      });
  });
</script>
</body>

</html>
