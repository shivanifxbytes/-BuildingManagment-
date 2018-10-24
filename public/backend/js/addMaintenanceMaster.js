  jQuery(document).ready(function() {
    var value = attrid ='';
    jQuery('#flat_number').change(function() {
      value = $(this).val();
      jQuery.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      jQuery.ajax({
        url: base_url + '/flats/getflattype',
        type: 'post',
        data: {
          id:value,
        },
        success: function(result) {
          $('#flat_type').val(result[0]);
        },
        error: function(xhr) {

        }
      });
    });
  });