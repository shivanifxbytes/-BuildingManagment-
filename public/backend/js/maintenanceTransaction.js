/* -----------------------------------------------------------------
Add datepicker for maintenance transaction table
-------------------------------------------------------------------- */   
$(document).ready(function () {
    $(".date").datepicker({
        changeMonth: true,
        changeYear: true
    });
});

/* -------------------------------------------------------------------
Get values from maintenance transaction form and insert data using ajax
--------------------------------------------------------------------- */   
function payMaintence(flatNumber){
    var flatNumber=$("#flat_num_"+flatNumber).val();
    var amount=$("#amount_"+flatNumber).val();
    var pendingAmount=$("#pending_amount_"+flatNumber).val();
    var reasonPendingAmount=$("#rPendingAmout_"+flatNumber).val();
    var extraAmount=$("#extra_amount_"+flatNumber).val();
    var reasonExtraAmount=$("#extra_rAmount_"+flatNumber).val();
    var paidBy=$("#paid_by_"+flatNumber).val();
    var date=$("#date_"+flatNumber).val();
    if(pendingAmount > 0)
    {
        status = '2';
    }
    else
    {
        status = '1';
    }
    $.ajax({
        url: base_url + '/paid',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        data: {
            flatNumber:flatNumber,
            amount: amount,
            pendingAmount: pendingAmount,
            reasonPendingAmount: reasonPendingAmount,
            extraAmount: extraAmount,
            reasonExtraAmount: reasonExtraAmount,
            paidBy: paidBy,
            date:date,
            status:status
        },
        success: function (response) {
            if (response.success == "Paid") {
                swal("paid!", "Your entry has been paid.", "success");
            } else if(response.success == 'Data Updated')
            {
                swal("updated", "flat maintenance has been paid for the month.", "success");
            }
            else {
                swal("error", "Something want wrong, Please try again later", "error");
            }
        },
    });
}