@extends ('layouts.admin')
@section('styles')
 <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
        type="text/css" /> @endsection
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
<div class="alert alert-success" style="display:none"></div>
<div class="table-responsive">
    <table class='table ' id='mytable'>
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
        @foreach($flats as $key => $row)    
        <tr>
            <form method="POST" action=""  class="form-horizontal ">   
                <td><input type="text" id="flat_num_{{$row->flat_number}}" value='{{$row->flat_number}}' name="flat_type" placeholder='' disabled/></td>
                <td><input type="text" name="tenent" id="" placeholder="enter tenent name" value='{{$row->tenant_name}}' required disabled></td>
                <td><input type="text" name="owner" id="" placeholder="" value='{{$row->owner_name}}' required disabled></td>
                <td><input type="text" id="amount_{{$row->flat_number}}" name="amount" id="" placeholder="" required ></td>
                <td><input type="text" id="pending_amount_{{$row->flat_number}}" name="pending_amount" id="" placeholder="" required></td>
                <td><input type="text" id="rPendingAmout_{{$row->flat_number}}" name="rPendingAmout" id="" placeholder="" required></td>
                <td><input type="text" id="extra_amount_{{$row->flat_number}}" name="extra_amount" id="" placeholder="" required></td>
                <td><input type="text" id="extra_rAmount_{{$row->flat_number}}" name="extra_rAmount" id="" placeholder="" required></td>
                <td><input type="text" id="date_{{$row->flat_number}}" class="date"></td>
                <td><button type="button" class="btn btn-primary" onClick="payMaintence({{$row->flat_number}})">Paid</button></td>
            </form>
        </tr>
        @endforeach 
    </table>
</div>  
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
    function payMaintence(flatNumber){
        var flatNumber=$("#flat_num_"+flatNumber).val();
        var amount=$("#amount_"+flatNumber).val();
        var pendingAmount=$("#pending_amount_"+flatNumber).val();
        var reasonPendingAmount=$("#rPendingAmout_"+flatNumber).val();
        var extraAmount=$("#extra_amount_"+flatNumber).val();
        var reasonExtraAmount=$("#extra_rAmount_"+flatNumber).val();
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
</script>

@endsection