       $(document).ready(function () {
            $(".date").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });
    function payMaintence(flatNumber){
        var flatNumber=$("#flat_num_"+flatNumber).val();
        var amount=$("#amount_"+flatNumber).val();
        var pendingAmount=$("#pending_amount_"+flatNumber).val();
        var reasonPendingAmount=$("#rPendingAmout_"+flatNumber).val();
        var extraAmount=$("#extra_amount_"+flatNumber).val();
        var reasonExtraAmount=$("#extra_rAmount_"+flatNumber).val();
        var paidBy=$("#paid_by_"+flatNumber).val();
        var date=$("#date_"+flatNumber).val();
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
                date:date
            },
            success: function (response) {
                if (response.success == "Paid") {
                    swal("paid!", "Your entry has been paid.", "success");
                } else if(response.error)
                {
                    console.log(response.error);
                    swal("already paid!", "flat maintenance already been paid for the month.", "error");
                }
                else {
                    swal("error", "Something want wrong, Please try again later", "error");
                }
            },
        });
    }