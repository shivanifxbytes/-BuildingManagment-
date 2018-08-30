@extends ('layouts.admin')
@section('content')       
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-file-text-o"></i> {{ __('messages.add_user')}}</h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard"> {{ __('messages.home')}}</a></li>
      <li><i class="fa fa-file-text-o"></i> {{ __('messages.add_user')}}</li>
    </ol>
  </div>
</div>
<form role="form" name="Registration_Form" method="post" action="">
  <div class="row"><div class="col-lg-3"></div>
  <div class="col-lg-6">
    <section class="panel">
      <header class="panel-heading">
        {{ __('messages.add_user')}}
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
            <label>{{ __('messages.user_first_name')}}</label>
            <input type="text" class="form-control" name="user_first_name" placeholder="{{ __('messages.user_first_name')}}" required>
          </div>
          <div class="form-group">
            <label>{{ __('messages.user_last_name')}}</label>
            <input type="text" class="form-control" name="user_last_name" placeholder="{{ __('messages.user_last_name')}}" required>
          </div> 
          <div class="form-group">
            <label>{{ __('messages.owner')}}</label>
            <input type="text" class="form-control" name="owner" placeholder="{{ __('messages.owner')}}" required>
          </div> 
          <div class="form-group">
            <label>{{ __('messages.tenant')}}</label>
            <input type="text" class="form-control" name="tenant" placeholder="{{ __('messages.tenant')}}" required>
          </div> 
          <div class="form-group">
            <label>{{ __('messages.flat_number')}}</label>
            <input type="text" class="form-control" name="flat_number" placeholder="{{ __('messages.flat_number')}}" required>
          </div> 
          <div class="form-group">
            <label>{{ __('messages.carpet_area')}}</label>
            <input type="text" class="form-control" name="carpet_area" placeholder="{{ __('messages.carpet_area')}}" required>
          </div> 
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="user_email" placeholder="{{ __('messages.email') }}" required="" autofocus="" /> <br>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="*****" required/> 
          </div> 
          <div class="form-group">
            <label for="user_password-confirm">{{ __('Confirm Password') }}</label>
            <input id="user_password-confirm" type="password" class="form-control" name="password_confirmation" required>           
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