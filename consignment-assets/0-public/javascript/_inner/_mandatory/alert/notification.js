
  //data-type="inverse"
  //data-animation-in="animated fadeIn"
  //data-animation-out="animated fadeOut"
  //data-from="top"
  //data-align="right"
  //data-icon="fa fa-check"
  function notify(message,type){
    switch(type){
      default:
      case 'success':
        notificationSuccess(message);
        break;
    }
  }

  function notificationSuccess(message){
      $.growl({
          //icon: 'fa fa-check',
          title: '&nbsp',
          message: message,
          url: ''
      },{
          type: 'success',
          allow_dismiss: true,
          label: 'Cancel',
          className: 'btn-xs',
          spacing: 10,
          z_index: 999999,
          timer: 1000,
          url_target: '_blank',
          mouse_over: true,
          icon_type: 'class',
          placement: {
              from: 'top',
              align: 'right'
          },
          delay: 5000,
          animate: {
                  enter: 'animated fadeInRight',
                  exit: 'animated fadeOutRight'
          },
          offset: {
              x: 30,
              y: 30
          }
      });
  }
