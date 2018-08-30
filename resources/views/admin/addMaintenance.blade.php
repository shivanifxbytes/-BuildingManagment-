@extends ('layouts.admin')
@section('content')       
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-file-text-o"></i>
     {{$userName}}
   </h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard"> {{ __('messages.home')}}</a></li>
      <li><i class="fa fa-file-text-o"></i> {{$userName}}</li>
    </ol>
  </div>
</div>
      
<form role="form" name="Registration_Form" method="post" action="">
  <div class="row"><div class="col-lg-3"></div>
  <div class="col-lg-6">
    <section class="panel">
      <header class="panel-heading">
        {{$userName}}
      </header>
      <div class="panel-body">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p class="error alert alert-block alert-danger fade in">
          {{ $error }}
        </p>
        @endforeach
        @endif
        <div class="col-lg-12">
          <div class="form-group">
            <label>{{ __('messages.amount')}}</label>
            <input type="text" class="form-control" name="amount" placeholder="{{ __('messages.amount')}}" required>
          </div>
          <div class="form-group">
            <label for="month">month</label>
            <select name="month" id="month" class="form-control" >
              <option value="" selected="selected">month</option>
              <option value="1">January</option>
              <option value="2">February</option>
              <option value="3">March</option>
              <option value="4">April</option>
              <option value="5">May</option>
              <option value="6">June</option>
              <option value="7">July</option>
              <option value="8">August</option>
              <option value="9">September</option>
              <option value="10">October</option>
              <option value="11">November</option>
              <option value="12">December</option>
            </select>
            <span id="product_discount" class="text-danger">              
            </span>
          </div> 
          <div class="form-group">
            <label>{{ __('messages.pending_amount')}}</label>
            <input type="text" class="form-control" name="pending_amount" placeholder="{{ __('messages.pending_amount')}}" required>
          </div> 
          <div class="form-group">
            <label>{{ __('messages.extra_amount')}}</label>
            <input type="text" class="form-control" name="extra_amount" placeholder="{{ __('messages.extra_amount')}}" required>
          </div> 
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                          
          <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status" required>
              <option value="1">{{ __('messages.publish')}}</option>
              <option value="0">{{ __('messages.pending')}}</option>
            </select>
          </div>
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