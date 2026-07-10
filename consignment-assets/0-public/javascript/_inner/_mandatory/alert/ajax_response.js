function alert_400(){
  Swal.fire({
     type: 'error',
     title: 'ERROR',
     text: 'Bad request.',
     confirmButtonColor: '#099235',
     confirmButtonText: 'OK',
     allowOutsideClick: false,
     allowEscapeKey: false
   }).then((result) => {
     if (result.value) {
       location.reload();
     }
   });
}

function alert_404(){
  Swal.fire({
     type: 'error',
     title: 'ERROR',
     text: 'Data not found!',
     confirmButtonColor: '#099235',
     confirmButtonText: 'OK',
     allowOutsideClick: false,
     allowEscapeKey: false
   }).then((result) => {
     if (result.value) {
       location.reload();
     }
   });
}

function alert_401(){
  Swal.fire({
     type: 'warning',
     title: 'SESSION EXPIRED',
     text: "Anda harus login kembali untuk melakukan hal ini!",
     confirmButtonColor: '#099235',
     confirmButtonText: 'OK',
     allowOutsideClick: false,
     allowEscapeKey: false
   }).then((result) => {
     if (result.value) {
       location.href=$('#APPATH_login').val()+'?redirect_link='+window.location.href;
     }
   });
}

function alert_412(){
  Swal.fire({
    type: 'warning',
    html:   "Semua field harus diisi!",
    showCloseButton: false,
    showCancelButton: false,
    showConfirmButton:true,
    allowEnterKey:true,
    confirmButtonColor:'#009245'
  });
}

function alert_error(error_code){
  switch(error_code){
    default:
    case 400:
      alert_400();
      break;
    case 401:
      alert_401();
      break;
    case 404:
      alert_404();
      break;
  }
}

function alert_warning(msg,reload='TRUE'){
  if(reload!='FALSE'){
    Swal.fire({
       type: 'warning',
       html: msg,
       confirmButtonColor: '#099235',
       confirmButtonText: 'OK',
       allowOutsideClick: false,
       allowEscapeKey: false
     }).then((result) => {
       if (result.value) {
         location.reload();
       }
     });
  }else{
    Swal.fire({
       type: 'warning',
       html: msg,
       confirmButtonColor: '#099235',
       confirmButtonText: 'OK',
       allowOutsideClick: false,
       allowEscapeKey: false
     });
  }

}


function rebuild_session(){
    $.ajax({
      url: services__global__authentication___Authentication__update_session__GET,
      type: "GET",
      data: {},
      beforeSend: function (xhr) {   //Include the bearer token in header
        xhr.setRequestHeader("Authorization", 'Bearer '+ $('#jwt-token').val());
      },
      success: function (response,textStatus, xhr) {
        if(xhr.status==200 && response.message=="OK"){
          set_session(response.data.new_token);
        }
      },
      error: function(xhr, textStatus, errorThrown) {
      }
    });
}

function set_session(token,redirect_link=''){
    $.ajax({
      url: 'http://consignment.id/Auth/setSession',
      type: "POST",
      data: {},
      beforeSend: function (xhr) {   //Include the bearer token in header
        xhr.setRequestHeader("Authorization", 'Bearer '+ token);
      },
      success: function (response,textStatus, xhr) {
        if(xhr.status==200 && response.message=="OK"){
          $('#jwt-token').val(response.data.token);
          if(redirect_link!=''){
            window.location.href=redirect_link;
          }
        }
      },
      error: function(xhr, textStatus, errorThrown) {
      }
    });
}

function set_sessionAdmin(token,redirect_link=''){
    $.ajax({
      url: 'http://admin.consignment.id/Auth/setSession',
      type: "POST",
      data: {},
      beforeSend: function (xhr) {   //Include the bearer token in header
        xhr.setRequestHeader("Authorization", 'Bearer '+ token);
      },
      success: function (response,textStatus, xhr) {
        if(xhr.status==200 && response.message=="OK"){
          $('#jwt-token').val(response.data.token);
          if(redirect_link!=''){
            window.location.href=redirect_link;
          }
        }
      },
      error: function(xhr, textStatus, errorThrown) {
      }
    });
}
