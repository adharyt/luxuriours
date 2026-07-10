function init_bank_option(select_id){
  $('#'+select_id).select2({
      minimumInputLength: 0,
      allowClear: true,
      placeholder: 'Ketik nama bank...',
      ajax: {
         dataType: 'json',
         url: $('#APPATH').val()+'API_payment/getBankOption',
         delay: 800,
         data: function(params) {
           return {
             search: params.term
           }
         },
         processResults: function (data, page) {
         var data_final = $.map(data, function (obj) {
            obj.text = obj.nama_bank;
            obj.id = obj.id;
            return obj;
          });
         return {
           results: data_final
         };
       },
     }
 }).on('select2:select', function (evt) {
   $('#'+select_id).val($('#'+select_id+" option:selected").val());
 });
}

function init_datetimepickersingle(id_node,date1){
  $(function() {
    $('#'+id_node).daterangepicker({
      timePicker:true,
      singleDatePicker:true,
      timePicker24Hour:true,
      startDate: moment(),
      maxDate:moment(),
      opens: 'bottom',
      locale: {
        format: 'YYYY-MM-DD HH:mm'
      }
    }, function(start, end, label) {
      $('#'+date1).val(start.format('YYYY-MM-DD HH:mm')+':00');
    });
  });
  $('#'+date1).val(moment().format('YYYY-MM-DD HH:mm')+':00');
}
