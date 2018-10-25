$(document).ready(function(){
    $(".date").datepicker({
        changeMonth: true,
        changeYear: true
    });

    /* ------------------------------------------------
        Append row for monthly expenses
        ------------------------------------------------ */
    var postURL = "<?php echo url('addmore'); ?>";
    var i=1;  
    $('.dynamic-added').remove();
    $('#add_name')[0].reset();
    $('#add').click(function(){  
        i++;  
        $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text"  value="" name="title[]" placeholder="" required/></td><td><input type="text" value="" name="amount[]" class="amount" placeholder="" required></td><td><select name="paid_by[]" class="paid_by" id="paid_by" ><option value="" selected="selected">Paid BY</option><option value="Cash">Cash</option><option value="Cheque">Cheque</option></select></td><td><input type="text" value="" name="card_number[]" placeholder="" required></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Delete</button></td></tr>');  
    });  

    /* ------------------------------------------------
       subtract amount according cash and cheque by an event
        ------------------------------------------------ */
    $(document).on('click', '.btn_remove', function(){  
        var  cheque =   parseFloat($('#cheque_total').val());
        console.log(cheque);
        var cash = parseFloat($('#cash_total').val());
        var button_id = $(this).attr("id");   
        $('#row'+button_id+'').remove();  
        $(this).closest('tr').find('select[name="paid_by[]"]').each(function(){
            if(this.value == "Cash"){
                $(this).closest('tr').find('input[name="amount[]"]').each(function(){
                    var amount = this.value;            
                    cash = cash - parseFloat(amount);
                });   
            }
            else
            {
                $(this).closest('tr').find('input[name="amount[]"]').each(function(){
                    var amount = this.value;
                    cheque = cheque - parseFloat(amount);
                });
            }
        })
        console.log(cash);
        console.log(cheque);
        $('#cheque_total').val(cheque);
        $('#cash_total').val(cash);
        var total = cash+cheque;
        console.log(total);
        $('#total_amount').val(total);
    });  

    /* ------------------------------------------------
        Add amount according cash and cheque by an event
        ------------------------------------------------ */   
    $(document).on('change', 'select[name="paid_by[]"]', function(){
        var cash = 0,cheque = 0;
        $('select[name="paid_by[]"]').each( function() {
            if(this.value == "Cash"){
                $(this).closest('tr').find('input[name="card_number[]"]').prop("disabled", true);
                $(this).closest('tr').find('input[name="amount[]"]').each(function(){
                    var amount = this.value;            
                    cash = cash + parseFloat(amount);
                });         
            }
            else
            {
                $(this).closest('tr').find('input[name="card_number[]"]').prop("disabled", false);
                $(this).closest('tr').find('input[name="amount[]"]').each(function(){
                    var amount = this.value;
                    cheque = cheque + parseFloat(amount);
                });
            }
        });
        $('#cheque_total').val(cheque);
        $('#cash_total').val(cash);
        var total = parseInt(cash)+parseInt(cheque);
        $('#total_amount').val(total);
    })

    /* ------------------------------------------------------------------
        Get values from form and insert data in to monthly expenses table
          ------------------------------------------------------------ */   
    $('#submit').click(function(){            
        var formData = $('#add_name').serialize();         
        var date = [];
        $('input[name="date[]"]').each( function() {
            date.push(this.value);
        }); 
        var title = [];
        $('input[name="title[]"]').each( function() {
            title.push(this.value);
        });
        var amount = [];
        $('input[name="amount[]"]').each( function() {
            amount.push(this.value);
        });
        var paid_by = [];
        $('select[name="paid_by[]"]').each( function() {
            paid_by.push(this.value);
        });
        var card_number = [];
        $('input[name="card_number[]"]').each( function() {
            card_number.push(this.value);
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        });
        $.ajax({  
            url: base_url+'/addMoreMonthlyExpense', 
            type:"POST",  
            data:{date:date,title:title,amount:amount,paid_by:paid_by,card_number:card_number},
            dataType: 'json',
            success:function(response)  
            {
                if(response.error){
                    printErrorMsg(response.error);
                }else{
                    $(".print-success-msg").find("ul").html('');
                    $(".print-success-msg").css('display','block');
                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                }
            }  
        });  
    });  

    /* ---------------------------------------------------------------
        Error msg for add more monthly expenses 
        ------------------------------------------------------------- */   
    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $(".print-success-msg").css('display','none');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
});  