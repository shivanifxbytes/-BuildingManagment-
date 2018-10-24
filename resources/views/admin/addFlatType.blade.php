@extends ('layouts.admin')
@section('content')       
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-table"></i>{{ __('messages.flat_type') }}</h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard"> {{ __('messages.home')}}</a></li>
      <li><i class="fa fa-file-text-o"></i>{{ __('messages.flat_type') }}</li>
    </ol>
  </div>
</div>      
<form role="form" name="Registration_Form" method="post" action="">
  <div class="row"><div class="col-lg-3"></div>
  <div class="col-lg-6">
    <section class="panel">
      <header class="panel-heading">{{ __('messages.flat_type') }}</header>
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
            <label for="flat_type">Flat Number</label>
           <input type="text" name="flat_number" id="flat_number" class="form-control" >       
          </div> 
          <div class="form-group">            
            <label for="flat_type">Flat Type</label>
           <select name="flat_type" id="flat_type" class="form-control" >
              <option value="" selected="selected">Flat</option>
              <option value="1BHK">1BHK</option>
              <option value="2BHK">2BHK</option>
              <option value="3BHK">3BHK</option>
             <option value="Pant House">Pant House</option>
            </select>         
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