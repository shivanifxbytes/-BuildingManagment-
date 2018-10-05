@extends ('layouts.admin')
@section('content')       
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-file-text-o"></i> {{ __('messages.maintenance_transaction') }}</h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard"> {{ __('messages.home')}}</a></li>
      <li><i class="fa fa-file-text-o"></i> {{ __('messages.flats')}}</li>
    </ol>
  </div>
</div>
<form method="POST" action=""  class="form-horizontal">   
  <table class="table" id="mytable">    
    <?php
    function create_rows_column_table($rows,$start)
    {
     $html = "<table class='table' id='mytable'>";
     $html .='<tr>    
     <th>Flat Number</th>    
     <th>Tenant Name</th>
     <th>Owner Name</th>
     <th>Amount</th>       
     <th>Pending Amount</th>
     <th>Reason Panding Amount</th> 
     <th>Extra Amount</th>
     <th>Reason Extra Amount</th>
     <th>Date</th>
     <th>Action</th>     
     </tr>';
     for ($row=0;$row<$rows;$row++)
     {
      $flatno = $row+$start;
      $html .='<tr id='.$flatno.'>
      <td><input type="text" id="flat_num_'.$flatno.'" value='.$flatno.' name="flat_type" placeholder='.$flatno.'/></td>
      <td><input type="text" name="tenent" id="tenent_'.$flatno.'" placeholder="enter tenent name" required></td>
      <td><input type="text" name="owner" id="owner_'.$flatno.'" placeholder="" required></td>
      <td><input type="text" name="amount" id="amount_'.$flatno.'" placeholder="" required></td>
      <td><input type="text" name="pending_amount" id="pending_amount_'.$flatno.'" placeholder="" required></td>
      <td><input type="text" name="rPendingAmout" id="rPendingAmout_'.$flatno.'" placeholder="" required></td>
      <td><input type="text" name="extra_amount" id="extra_amount_'.$flatno.'" placeholder="" required></td>
      <td><input type="text" name="extra_rAmount" id="extra_rAmount_'.$flatno.'" placeholder="" required></td>
      <td> <input class="date" type="text"> </td>
      <td><button type="button" onClick="payMaintence('.$flatno.')" class="btn btn-primary">Paid</button></td>
      </tr>';
    }
    ?>
    <?php
    $html .= "</table>";
    return $html;
  }
 //create table of input boxes of 12 rows
  echo create_rows_column_table(12,101);
  echo create_rows_column_table(10,201);
  echo create_rows_column_table(6,301);
  echo create_rows_column_table(8,401);
  echo create_rows_column_table(4,501);
  ?> 
</table>    
</form>
@endsection
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>  
<script type="text/javascript"> 
function payMaintence(flatNumber){
var flatNumber=$("#flat_num_"+flatNumber).val();
var tenentName=$("#tenent_"+flatNumber).val();
var ownerName=$("#owner_"+flatNumber).val();
var amount=$("#amount_"+flatNumber).val();
var pendingAmount=$("#pending_amount_"+flatNumber).val();
var reasonPendingAmount=$("#rPendingAmout_"+flatNumber).val();
var extraAmount=$("#extra_amount_"+flatNumber).val();
var reasonExtraAmount=$("#extra_rAmount_"+flatNumber).val();
            $.ajax({
                url: base_url + '/paid',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                data: {
                    flatNumber:flatNumber,
                    tenentName: tenentName,
                    ownerName: ownerName,
                    amount: amount,
                    pendingAmount: pendingAmount,
                    reasonPendingAmount: reasonPendingAmount,
                    extraAmount: extraAmount,
                    reasonExtraAmount: reasonExtraAmount
                },
                success: function (response) {
                  alert(response);
                    // if (response == 1) {
                    //     swal("paid!", "Your entry has been paid.", "success");
                    // } else {
                    //     swal("error", "Something want wrong, Please try again later", "error");
                    // }
                },
                error:function(xhr)
                {
                    console.log(xhr);
                }
            });
}

</script>
 
    <script type="text/javascript"> 
    $(document).ready(function(){
      $('.date').datepicker({  
           format: 'mm-dd-yyyy'  
         });  
    })        
    </script> 