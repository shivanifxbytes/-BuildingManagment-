@extends ('layouts.admin')
@section('content')       
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-file-text-o"></i> {{ __('messages.edit_user')}}</h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard"> {{ __('messages.home')}}</a></li>
      <li><i class="fa fa-file-text-o"></i> {{ __('messages.edit_user')}}</li>
    </ol>
  </div>
</div>
<form role="form" name="Registration_Form" method="post" action="">
  <div class="row"><div class="col-lg-3"></div>
  <div class="col-lg-6">
    <section class="panel">
      <header class="panel-heading">        
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
            <input type="text" class="form-control" name="amount" value="{{ $user['maintenance_amount']}}" placeholder="{{ __('messages.amount')}}" required>
          </div>
          <div class="form-group">
            <label for="flat_type">Flat Type</label>
            <select name="flat_type" id="flat_type" class="form-control" >
              @switch($user['flat_type'])
              @case(1)
              <option value="{{$user['flat_type']}}" selected="selected">1BHK</option>
              @break
              @case(2)
              <option value="{{$user['flat_type']}}" selected="selected">2BHK</option>
              @break
              @case(3)
              <option value="{{$user['flat_type']}}" selected="selected">3BHK</option>
              @break
               @case(3)
              <option value="{{$user['flat_type']}}" selected="selected">Pant House</option>
              @break
              @default
              <option value="" selected="selected">Not Assigned Yet Contact Your Owner</option>
              @endswitch
            </select>
            <span id="product_discount" class="text-danger">              
            </span>
          </div> 
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