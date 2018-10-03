@extends ('layouts.admin')
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
<div class="container">
  <div class="row clearfix">
    <div class="col-md-12">
      <table class="table table-bordered table-hover" id="tab_logic_total">
        <tbody>
          <label >Date</label>
          <input type="date" name="from_date" id="from_date" class="form-control"  />
        </tbody>
      </table>
    </div>
    <div class="col-md-12">
      <table class="table table-bordered table-hover" id="tab_logic">
        <thead>
          <tr>    
           <th>Title</th>    
           <th>Amount</th>       
           <th>Paid By</th>
           <th>Card Number</th>
           <th>Action</th>     
         </tr>
       </thead>
       <tbody>
        <tr id='addr0'>
          <td><input type="text"  value="" name="title" placeholder="" required/></td>
          <td><input type="text" value="" name="amount" placeholder="" required></td>
          <td><select name="flat_type" id="flat_type" >
            <option value="" selected="selected">Paid BY</option>
            <option value="Cash">Cash</option>
            <option value="Cheque">Cheque</option>
          </select>
        </td>
        <td><input type="text" value="" name="card_number" placeholder="" required></td>
        <td><button type="button" class="btn btn-primary">Add</button>&nbsp;&nbsp;&nbsp;
          <button type="button" class="btn btn-primary">Delete</button></td>
        </tr>
        <tr id='addr1'></tr>
      </tbody>
    </table>
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
        <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
      </tr>
      <tr class="pull-right">
        <th class="text-center">Total By Cheque</th>
        <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
      </tr>
    </tbody>
  </table>
</div>
<div class="col-md-12">
  <table class="table table-bordered table-hover" id="tab_logic_total">
    <tbody>
      <tr>
        <th class="text-center">Grand Total</th>
        <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
      </tr>
    </tbody>
  </table>
</div>
</div>
</div>        
@endsection



