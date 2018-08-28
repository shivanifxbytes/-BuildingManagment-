  @extends ('layouts.admin')
  @section('content')
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="fa fa-table"></i>{{ __('messages.user') }}<a class="btn btn-primary pull-right" href=" {{ url('/') }}/addMaintenance/0/{{Crypt::encrypt($user_id)}}"> {{__('messages.add_maintenance')}} </a></h3>
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
              <th><i class="icon_profile"></i>{{ __('messages.amount') }}</th>
              <th><i class="icon_mail_alt"></i>{{ __('messages.month') }}</th>
              <th><i class="icon_calendar"></i>{{ __('messages.pa
              nding_amount') }}</th>
              <th><i class="icon_pin_alt"></i>{{ __('messages.extra_amount') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($user_maintenance as $key => $row)
            <tr>
              <th>{{$key}}</th>
              <td>{{$row->amount }}</td>
              <td>{!! showMonth($row->month) !!}</td>
              <td>{{$row->pending_amount }}</td>
              <td> {{$row->extra_amount}}</td>
              <td>
                <div class="btn-group">
                 <a class="btn btn-success" title="{{__('messages.edit')}}" href="{{ url('/') }}/addMaintenance/{{ Crypt::encrypt($row->id) }}" data-toggle="tooltip">{{__('messages.edit')}}</a> &nbsp;&nbsp;&nbsp;
                 <a class="btn btn-danger deleteDetail" title="{{__('messages.delete')}}" data-id="{{ Crypt::encrypt($row->id) }}" href="#" data-toggle="tooltip">{{__('messages.delete')}}</a>
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