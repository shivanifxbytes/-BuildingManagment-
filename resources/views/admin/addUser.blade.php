@extends ('layouts.admin')
@section('content')       
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-file-text-o"></i> {{ __('messages.add_flat')}}</h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard"> {{ __('messages.home')}}</a></li>
      <li><i class="fa fa-file-text-o"></i> {{ __('messages.add_flat')}}</li>
    </ol>
  </div>
</div>
<form role="form" name="Registration_Form" method="post" action="">
  @csrf
  <div class="row"><div class="col-lg-3"></div>
  <div class="col-lg-6">
    <section class="panel">
      <header class="panel-heading">
       {{ __('messages.add_flat')}}
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
          <input type="text" class="form-control" name="owner" placeholder="{{ __('messages.owner')}}" required>
        </div>           
        <div class="form-group">
          <label for="flat_number">Flat Number</label>
           <input type="text" class="form-control" name="flat_number" placeholder="{{ __('messages.flat_number')}}" required>        
        </div> 
       <div class="form-group">
                        <label for="flat_type">Flat Type</label>
                        <select name="flat_type" id="flat_type" class="form-control" >
                            <option value="" selected="selected">Select Flat Type</option>
                           
                            <option value="{{$row->id }}"></option>
                            
                        </select>           
                    </div>
        <div  id="flat_type" class="form-group">
          <label>{{ __('messages.carpet_area')}}</label>
          <input type="text" class="form-control" name="carpet_area" placeholder="{{ __('messages.carpet_area')}}" required>
        </div> 
        <div class="form-group">
          <label>Enter Mobile No.</label>          
          <input id="owner_mobile_no" type="text" class="form-control" name="owner_mobile_no" value="{{ old('owner_mobile_no') }}" required>         
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="text" class="form-control" name="email" placeholder="{{ __('messages.email') }}" required="" autofocus="" /> <br>
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