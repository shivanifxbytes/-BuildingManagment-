@extends ('layouts.admin')
@section('content')       
<div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>{{ __('messages.maintenance_transaction') }}
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
      <td>{{$row->flat_number}}</td>
      <td>{{$row->tenant_name}}</td>
      <td>{{$row->owner_name}}</td>
      <td>{{$row->amount}}</td>
      <td>{{$row->pending_amount}}</td>
      <td>{{$row->reason_pending_amount}}</td>
      <td>{{$row->extra_amount}}</td>
      <td>{{$row->reason_extra_amount}}</td>
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

