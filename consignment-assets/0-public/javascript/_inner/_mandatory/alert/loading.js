function loading_ajax(message){
  message = typeof message !== 'undefined' ? message : 'Mohon menunggu...';
  Swal.fire({
   text:message,
   background:'#FFFFFF',
   width:'300px',
   height:'100px',
   confirmButtonColor:'#009245',
   showConfirmButton:false,
   allowOutsideClick: false,
   allowEscapeKey: false,
   allowEnterKey: false,
   onBeforeOpen: () =>{
   },
   onOpen: () => {
     swal.showLoading()
   }
  });
}
