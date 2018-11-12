@extends ('layouts.admin')
@section('content')       
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-file-text-o"></i>{{ __('messages.edit_maintainance')}}</h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard"> {{ __('messages.home')}}</a></li>
      <li><i class="fa fa-file-text-o"></i>{{ __('messages.edit_maintainance')}}</li>
    </ol>
  </div>
</div>      
<form role="form" name="Registration_Form" method="post" action="">
  <div class="row"><div class="col-lg-3"></div>
  <div class="col-lg-6">
    <section class="panel">
      <header class="panel-heading">{{ __('messages.edit_maintainance')}}        
      </header>
      <div class="panel-body">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p class="error alert alert-block alert-danger fade in">
          {{ $error }}
        </p>
        @endforeach
        @endif
        @foreach($flats as $key => $row)
        <div class="col-lg-12">
          <div class="form-group">
            <label>{{ __('messages.flat_type')}}</label>
            <input type="text" id="flat_type" class="form-control" name="flat_type" value="{{$row->flat_type }}" placeholder="{{ __('messages.flat_type')}}" disabled required>
          </div> 
          <div class="form-group">
            <label>{{ __('messages.amount')}}</label>
            <input type="text" class="form-control" name="maintenance_amount" placeholder="{{ __('messages.amount')}}" value="{{$row->maintenance_amount}}" required>
          </div>
          @endforeach
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">           
          <div class="form-group">
            <label>&nbsp;</label>
            <button type="submit" class="btn btn-primary">{{ __('messages.submit')}}</button>
          </div>
        </div>
      </section>
    </div>
  </div>
</form>
@endsection
@section('scripts')
<script src="{{ asset('public/backend/js/addMaintenanceMaster.js') }}" type="text/javascript"></script>
@endsection