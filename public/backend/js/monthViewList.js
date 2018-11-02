jQuery(document).ready(function() {
        var d = new Date();
        var year = $('#yearlist').val();
        var month = $('#monthlist').val();
        dataTables(year,month);
        jQuery('#yearlist').change(function() {
            year = $(this).val();
            if(year!='')
            {
                jQuery('#monthlist').change(function()
                {
                    var month = $(this).val();
                    dataTables(year,month);
                });
            }
  
        });
    });
    function dataTables(year,month)
    {
        $('#flat_types').DataTable({
            destroy: true,
            pageLength: 10,
            processing: true,
            serverSide: true,
            ajax:{
                url: base_url + '/showmonthlytransaction',
                 headers: {
                'X-CSRF-TOKEN': csrf_token
            },
                dataType: "json",
                type: "POST",
                data:{ _token: csrf_token, year:year,
                month:month},
            },
            columns: [
            { data: "flat_number" },
            { data: "owner" },
            { data: "amount" },
            { data: "pending_amount" },
            { data: "extra_amount" },
            { data: "status" },
            { data: "action" }
            ]    
        });      
    }