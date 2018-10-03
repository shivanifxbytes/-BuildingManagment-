@extends ('layouts.admin')
@section('content')       
<div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>{{ __('messages.maintenance_transaction') }}<a class="btn btn-primary pull-right" href=" {{ url('/') }}/addMaintenanceTransaction"> {{__('messages.add_flat')}} </a>
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
<form method="POST" action=""  class="form-horizontal">   
  <table class="table" id="mytable">    
     <tr>    
     <th>Flat Number</th>    
     <th>Tenant Name</th>
     <th>Owner Name</th>
     <th>Amount</th>       
     <th>Pending Amount</th>
     <th>Reason Panding Amount</th> 
     <th>Extra Amount</th>
     <th>Reason Extra Amount</th>  
     <th>Action</th>     
     </tr> 
      @foreach($flats as $key => $row) 
    <tr>
      <td><input type="text" value="{{$row->flat_number}}" name="flat_type" placeholder=""/></td>
      <td><input type="text" value="{{$row->tenant_name}}" name="tenent" placeholder="enter tenent name" required></td>
      <td><input type="text" value="{{$row->owner_name}}" name="owner" placeholder="" required></td>
      <td><input type="text" value="{{$row->amount}}" name="amount" placeholder="" required></td>
      <td><input type="text" value="{{$row->pending_amount}}" name="pending_amount" placeholder="" required></td>
      <td><input type="text" value="{{$row->reason_pending_amount}}" name="rPendingAmout" placeholder="" required></td>
      <td><input type="text" value="{{$row->extra_amount}}" name="extra_amount" placeholder="" required></td>
      <td><input type="text" value="{{$row->reason_extra_amount}}" name="extra_rAmount" placeholder="" required></td>
      <td><button type="button" class="btn btn-primary">Edit</button>
      &nbsp;&nbsp;&nbsp;
      <button type="button" class="btn btn-primary">Delete</button>
      </td>
      </tr>
       @endforeach  
     </table>
  </form>
   </section>
          </div>
        </div>
@endsection

