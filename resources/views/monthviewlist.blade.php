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
             <ul class="list-group">
  <li class="list-group-item">January</li>
  <li class="list-group-item">February</li>
  <li class="list-group-item">March</li>

  <li class="list-group-item">April</li>
  <li class="list-group-item">May</li>
  <li class="list-group-item">June</li>

  <li class="list-group-item">July</li>
  <li class="list-group-item">August</li>
  <li class="list-group-item">September</li>

  <li class="list-group-item">October</li>
  <li class="list-group-item">November</li>
  <li class="list-group-item">December</li>
</ul> 
   
          </div>
        </div>
@endsection

