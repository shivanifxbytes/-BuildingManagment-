@extends ('layouts.admin')
@section('content')       
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-file-text-o"></i>
      @if(isset($user_maintenance[0]->user_first_name)) {{ ucfirst($user_maintenance[0]->user_first_name) }} @endif @if(isset($user_maintenance[0]->user_last_name)) {{ ucfirst($user_maintenance[0]->user_last_name) }} @endif
    </h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard"> {{ __('messages.home')}}</a></li>
      <li><i class="fa fa-file-text-o"></i>Edit Flat Maintainence</li>
    </ol>
  </div>
</div>      
<form role="form" name="Registration_Form" method="post" action="">
  <div class="row"><div class="col-lg-3"></div>
  <div class="col-lg-6">
    <section class="panel">
      <header class="panel-heading">Edit Flat Maintainence        
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
            <input type="text" id="flat_type" class="form-control" name="flat_type" value="{{$row->flat_number }}" placeholder="{{ __('messages.flat_type')}}" disabled required>
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
<script>
  jQuery(document).ready(function() {
    var value = attrid ='';
    jQuery('select').change(function() {
      value = $(this).val();
      console.log(value);
      jQuery.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      jQuery.ajax({
        url: "{{ route('flats/getflattype') }}",
        type: 'post',
        data: {
          id:value,
        },
        success: function(result) {
          console.log(result[0]);
          $('#flat_type').val(result[0]);
        },
        error: function(xhr) {
          console.log(xhr);
          console.log(xhr.message);
        }
      });
    });
  });
</script>
@endsection