@extends ('layouts.admin')
@section('content')       
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-file-text-o"></i>{{ __('messages.add_maintenance') }}</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard"> {{ __('messages.home')}}</a></li>
            <li><i class="fa fa-file-text-o"></i>{{ __('messages.add_maintenance') }}</li>
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
                        <input type="text" class="form-control" name="maintenance_amount" placeholder="{{ __('messages.amount')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="flat_type_id">Flat Type</label>
                        <select name="flat_type_id" id="flat_type_id" class="form-control" >
                            <option value="" selected="selected">Select Flat Type</option>
                            @foreach($users as $key => $row)
                            <option value="{{$row->id }}">{{$row->flat_type }}</option>
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
@section('scripts')
<script src="{{ asset('public/backend/js/addMaintenanceMaster.js') }}" type="text/javascript"></script>
@endsection