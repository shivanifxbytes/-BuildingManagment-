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
<div class="alert alert-success" style="display:none">
    
</div>
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
            <th>Paid By</th>
            <th>Date</th>
            <th>Action</th>     
        </tr>
        @foreach($flats[0] as $key => $row)
        <?php 
        $amount = isset($row['amount'])?$row['amount']:'';
        $pending_amount = isset($row['pending_amount'])?$row['pending_amount']:'';
        $reason_pending_amount = isset($row['reason_pending_amount'])?$row['reason_pending_amount']:'';
        $extra_amount = isset($row['extra_amount'])?$row['extra_amount']:'';
        $reason_extra_amount = isset($row['reason_extra_amount'])?$row['reason_extra_amount']:'';
        $paid_by = isset($row['paid_by'])?$row['paid_by']:'';
        $month = isset($row['month'])?$row['month']:'';


        ?>
        <tr>
            <form method="POST" action=""  class="form-horizontal ">   
                <td><input type="text" id="flat_num_{{$row['flat_number']}}" value='{{$row["flat_number"]}}' name="flat_type" placeholder='' disabled/></td>
                <td><input type="text" name="tenent" id="" placeholder="enter tenent name" value='{{$row["tenant_name"]}}' required disabled></td>
                <td><input type="text" name="owner" id="" placeholder="" value='{{$row["owner_name"]}}' required disabled></td>
                <td><input type="text" id="amount_{{$row['flat_number']}}"  name="amount" id="" placeholder=""

                    value="{{$amount}}" 
                    required ></td>
                    <td><input type="text" id="pending_amount_{{$row['flat_number']}}" name="pending_amount" id=""  value="{{$pending_amount}}" 
                        placeholder="" required></td>
                        <td><input type="text" id="rPendingAmout_{{$row['flat_number']}}" name="rPendingAmout" id="" value="{{$reason_pending_amount}}"  placeholder="" required></td>
                        <td><input type="text" id="extra_amount_{{$row['flat_number']}}" name="extra_amount" id="" value="{{$extra_amount}}"   placeholder="" required></td>
                        <td><input type="text" id="extra_rAmount_{{$row['flat_number']}}" name="extra_rAmount" id="" placeholder="" value="{{$reason_extra_amount}}" required></td>
                        <td><select name="paid_by" id="paid_by_{{$row['flat_number']}}" class="paid_by" required>
                            <option value="" >Paid BY</option>
                            <option value="Cash" @if($paid_by == 'Cash')  {{ 'selected' }} @endif>Cash</option>
                            <option value="Cheque" @if($paid_by == 'Cheque') {{ 'selected' }} @endif>Cheque</option>
                        </select>
                    </td>
                    <td><input type="text" id="date_{{$row['flat_number']}}" class="date" value="{{ $month }}"></td>
                    <td><button type="button" class="btn btn-primary" onClick="payMaintence({{$row['flat_number']}})">Paid</button></td> 
                </form>
            </tr>
            @endforeach 
        </table>
    </div>      
@endsection
@section('scripts')
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>    
<script src="{{ asset('public/backend/js/maintenanceTransaction.js') }}" type="text/javascript"></script>
@endsection