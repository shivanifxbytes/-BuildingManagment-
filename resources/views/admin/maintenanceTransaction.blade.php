@extends ('layouts.admin')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
@endsection
@section('content')   
<table class="table" id="mytable">       
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
    <table class='table' id='mytable'>
     <tr>    
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
     </tr>    
    <tr>
      <td><input type="text" id="" value='' name="flat_type" placeholder=''/></td>
      <td><input type="text" name="tenent" id="" placeholder="enter tenent name" required></td>
      <td><input type="text" name="owner" id="" placeholder="" required></td>
      <td><input type="text" name="amount" id="" placeholder="" required></td>
      <td><input type="text" name="pending_amount" id="" placeholder="" required></td>
      <td><input type="text" name="rPendingAmout" id="" placeholder="" required></td>
      <td><input type="text" name="extra_amount" id="" placeholder="" required></td>
      <td><input type="text" name="extra_rAmount" id="" placeholder="" required></td>
      <td><input class="date" type="text"></td>
      <td><button type="button" class="btn btn-primary">Paid</button></td>
      </tr>
  </table>  
</table>    
</form>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>  
<script type="text/javascript"> 
  $(document).ready(function(){
    $('.date').datepicker({  
     format: 'mm-dd-yyyy'  
   });  
  })  
</script> 
@endsection