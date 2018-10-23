@extends ('layouts.admin')
@section('styles')

<link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
type="text/css" /> 
@endsection
@section('content')   
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-table"></i>{{ __('messages.monthly_expenses') }}
    </h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard">{{ __('messages.home') }}</a></li>
      <li><i class="fa fa-th-list"></i>{{ __('messages.flats') }}</li>
    </ol>
  </div>
</div> 
<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      @if ($errors->any())
      @foreach ($errors->all() as $error)
      <p class="error alert alert-block alert-danger fade in">
        {{ $error }}
      </p>
      @endforeach
      @endif
      @if(session()->has('message'))
      <div class="alert alert-success">
        {{ session()->get('message') }}
      </div>
      @endif      
      <div class="container">
        <form name="add_name" id="add_name"> 
          @csrf
          <div class="row clearfix">
            <div class="col-md-12">           
              <table class="table table-bordered table-hover" id="tab_logic_total">
                <tbody>
                  <strong>Date : </strong>  
                  <input type="text" class="date form-control" name="date[]" style="width: 300px;" >      
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
              <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
              </div>
              <div class="alert alert-success print-success-msg" style="display:none">
                <ul></ul>
              </div>
              <table class="table table-bordered table-hover" id="dynamic_field">
                <thead>
                  <tr>    
                    <th>Title</th>    
                    <th>Amount</th>       
                    <th>Paid By</th>
                    <th>Reference  Number</th>
                    <th>Action</th>     
                  </tr>
                </thead>
                <tbody>
                  <tr id='addr0'>
                    <td><input type="text"  value="" name="title[]" placeholder="" required/></td>
                    <td class="amount"><input type="text"  name="amount[]" placeholder="" required></td>
                    <td><select name="paid_by[]" class="paid_by" required>
                      <option value="" >Paid BY</option>
                      <option value="Cash">Cash</option>
                      <option value="Cheque">Cheque</option>
                    </select>
                  </td>
                  <td><input type="text" value="" name="card_number[]" placeholder="" required></td>
                  <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button>&nbsp;&nbsp;&nbsp;
                  </td>
                </tr>
                <tr id='addr1'></tr>
              </tbody>
            </table>
            <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-md-12">     
          </div>
        </div>
        <div class="row clearfix" style="margin-top:20px">
          <div class="col-md-12">
            <table class="table table-bordered table-hover" id="tab_logic_total">
              <tbody>
                <tr class="pull-left">
                  <th class="text-center">Total By Cash</th>
                  <td class="text-center"><input type="number" name='cash_total' placeholder='0.00' class="form-control" id="cash_total" readonly/></td>
                  <tr class="pull-right">
                    <th class="text-center">Total By Cheque</th>
                    <td class="text-center"><input type="number" name='cheque_total' id="cheque_total" placeholder='0.00' class="form-control" readonly/></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
              <table class="table table-bordered table-hover" id="tab_logic_total">
                <tbody>
                  <tr>
                    <th class="text-center " >Grand Total</th>
                    <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </form>
      </div>  
    </section>
  </div>
</div>
<?php
echo $digits = '';
function randomDigits($length){
    $numbers = range(0,9);
    shuffle($numbers);
    for($i = 0; $i < $length; $i++){
      global $digits;
        $digits .= $numbers[$i];
    }
    return $digits;
}
?>
@endsection
@section('scripts')
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script language="javascript">
  $(document).ready(function () {
    $(".date").datepicker({
      changeMonth: true,
      changeYear: true
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){      
    var postURL = "<?php echo url('addmore'); ?>";
    var i=1;  
    $('.dynamic-added').remove();
    $('#add_name')[0].reset();
    $('#add').click(function(){  
      i++;  
      $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text"  value="" name="title[]" placeholder="" required/></td><td><input type="text" value="" name="amount[]" class="amount" placeholder="" required></td><td><select name="paid_by[]" class="paid_by" id="paid_by" ><option value="" selected="selected">Paid BY</option><option value="Cash">Cash</option><option value="Cheque">Cheque</option></select></td><td><input type="text" value="" name="card_number[]" placeholder="" required></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Delete</button></td></tr>');  
    });  
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
    $(document).on('change', 'select[name="paid_by[]"]', function(){
      var cash = 0,cheque = 0;
      $('select[name="paid_by[]"]').each( function() {
        if(this.value == "Cash"){
          $(this).closest('tr').find('input[name="amount[]"]').each(function(){
            var amount = this.value;            
            cash = cash + parseFloat(amount);
          });         
        }
        else
        {
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
    });

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
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({  
        url: "{{ route('addMoreMonthlyExpense') }}", 
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
    function printErrorMsg (msg) {
      $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display','block');
      $(".print-success-msg").css('display','none');
      $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
      });
    }
  });  
</script>
@endsection