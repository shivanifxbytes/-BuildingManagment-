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
            <li><i class="fa fa-th-list"></i>{{ __('messages.monthly_expenses') }}</li>
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
@endsection
@section('scripts')
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript">
    var csrf_token = "<?php echo csrf_token(); ?>";
</script>
<script src="{{ asset('public/backend/js/addMonthlyExpenses.js') }}" type="text/javascript"></script>
@endsection
