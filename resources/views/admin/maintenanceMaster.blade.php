@extends ('layouts.admin')
@section('content')
<div class="row">
  <div class="col-lg-12">

    <h3 class="page-header"><i class="fa fa-table"></i>{{ __('messages.maintenance_master') }}<a class="btn btn-primary pull-right" href=" {{ url('/') }}/addMaintenanceMaster"> {{__('messages.add_maintenance')}} </a>
    </h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard">{{ __('messages.home') }}</a></li>
      <li><i class="fa fa-th-list"></i>{{ __('messages.users') }}</li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      @if ($errors->any())
      @foreach ($errors->all() as $error)
      <p class="error alert alert-block alert-danger fade in">
        {{ $error }}
      </p>
      @endforeach
      @endif
      @if(session()->has('message'))
      <div class="alert alert-success">
        {{ session()->get('message') }}
      </div>
      @endif
      <table class="table table-striped table-advance table-hover" id="data-table">
        <thead>
          <tr>
            <th>{{ __('messages.sno') }}</th>
            <th><i class="icon_mail_alt"></i>{{ __('messages.flat_type') }}</th>
            <th><i class="icon_profile"></i>{{ __('messages.maintenance_amount') }}</th>         <th><i class="icon_calendar"></i>{{ __('messages.joining') }}</th>    
            <th><i class="icon_cogs"></i> {{__('messages.action')}}</th>
          </tr>
        </thead>
        <tbody>
         <?php $no = 1; ?>
         @foreach($users as $key => $row)
         <tr>
          <th>{{ $no }}</th>
          <?php $no++; ?>
          <td>{{$row->flat_type}}</td>
          <td>{{$row->maintenance_amount}}</td>    
          <td>{{$row->created_at}}</td>   
          <td>
            <div class="btn-group">
              <a class="btn btn-success" title="{{__('messages.edit')}}" href="{{ url('/') }}/addMaintenanceMaster/{{ Crypt::encrypt($row->id) }}" style="margin:5px;" data-toggle="tooltip">{{__('messages.edit')}}</a> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;
              <a class="btn btn-danger" title="{{__('messages.delete')}}" style="margin:5px;" href="{{ url('/') }}/deleteMastere/{{ Crypt::encrypt($row->id) }}"   data-toggle="tooltip">{{__('messages.delete')}}</a>
            </div>
          </td>
        </tr>
        @endforeach                 
      </tbody>
    </table>
    
  </section>
</div>
</div>
<!-- page end-->
</section>
</section>
<!--main content end-->

@endsection