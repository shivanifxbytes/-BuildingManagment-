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
    <?php
   /* print_r($user) ;
    die();*/
     ?>
<form role="form" name="Registration_Form" method="post" action="">
  <div class="row"><div class="col-lg-3"></div>
  <div class="col-lg-6">
    <section class="panel">
      <header class="panel-heading">
        {{ __('messages.edit_user')}}
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
            <label>{{ __('messages.owner')}}</label>
            <input type="text" class="form-control" value="{{ $user['owner']}}"  name="owner" placeholder="{{ __('messages.owner')}}" required>
          </div>  
          <div class="form-group">
            <label for="flat_type">Flat Type</label>
            <select name="flat_type" id="flat_type" class="form-control" >
              <option value="{{ $user['flat_type']}}"  selected="selected">{{ $user['flat_type']}}</option>
              <option value="">{{$user->flat_type }}</option>                               
            </select>           
          </div> 
          <div class="form-group">
            <label>{{ __('messages.flat_number')}}</label>
            <input type="text" class="form-control" value="{{ $user->flat_number }}"  name="flat_number" placeholder="{{ __('messages.flat_number')}}" required>
          </div> 
           <div class="form-group">
            <label>Enter Mobile No.</label>            
              <input id="owner_mobile_no" type="text" class="form-control" name="owner_mobile_no" value="{{ $user->owner_mobile_no }}" required>              
          </div> 
          <div class="form-group">
            <label>{{ __('messages.carpet_area')}}</label>
            <input type="text" class="form-control" value="{{ $user->carpet_area }}"  name="carpet_area" placeholder="{{ __('messages.carpet_area')}}" required>
          </div>  
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status" required>
              <option value="1" @if ($user->user_status == 1) selected @endif >{{ __('messages.publish') }}</option>
              <option value="0" @if ($user->user_status == 0) selected @endif >{{ __('messages.pending') }}</option>
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