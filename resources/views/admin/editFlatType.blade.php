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
            <label for="flat_type">Flat Number</label>
           <input type="text" value="{{$user[0]->flat_number}}" name="flat_number" id="flat_number" class="form-control" >       
          </div> 
          <div class="form-group">            
            <label for="flat_type">Flat Type</label>
           <input type="text" value="{{$user[0]->flat_type}}" name="flat_type" id="flat_type" class="form-control" >       
          </div> 
                       <div class="form-group">
                        <label for="flat_number">Flat Number</label>
                        <select name="flat_number" id="flat_number" class="form-control" >
                            @foreach($users as $users_key => $users_value)
                            @if($user[0]->flat_number == $users_value->flat_number)
                            <option value="{{$users_value->flat_number}}" selected="selected">{{$users_value->flat_number}}</option>
                            @else
                            <option value="{{$users_value->flat_number}}">{{$users_value->flat_number}}</option>
                            @endif
                            @endforeach
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