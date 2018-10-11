@extends ('layouts.admin')
@section('content')       
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-file-text-o"></i> {{ __('messages.edit_flat')}}</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard"> {{ __('messages.home')}}</a></li>
            <li><i class="fa fa-file-text-o"></i> {{ __('messages.edit_flat')}}</li>
        </ol>    
    </div>
</div>
<form role="form" name="Registration_Form" method="post" action="">
    <div class="row"><div class="col-lg-3"></div>
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{ __('messages.edit_flat')}}
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
                        <input type="text" class="form-control" value="{{$user[0]->name}}"  name="owner" placeholder="{{ __('messages.owner')}}" required>
                    </div>   
                    <div class="form-group">
                        <label for="flat_number">Flat Number</label>
                        <select name="flat_number" id="flat_number" class="form-control" >
                            @foreach($users as $key => $row)
                            @if($row->flat_number == $user[0]->flat_number)
                            <option value="{{$user[0]->flat_number}}" selected="selected">{{$user[0]->flat_number}}</option>
                            @else
                            <option value="{{$row->flat_number }}">{{$row->flat_number }}</option>
                            @endif
                            @endforeach
                        </select>           
                    </div> 
                    <div class="form-group">
                        <label>Enter Mobile No.</label>            
                        <input id="owner_mobile_no" type="text" class="form-control" name="owner_mobile_no" value="{{ $user[0]->mobile_number }}" required>              
                    </div> 
                    <div class="form-group">
                        <label>{{ __('messages.carpet_area')}}</label>
                        <input type="text" class="form-control" value="{{ $user[0]->carpet_area }}"  name="carpet_area" placeholder="{{ __('messages.carpet_area')}}" required>
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