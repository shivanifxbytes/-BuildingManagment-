  @extends ('layouts.admin')
  @section('content')
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
        <i class="fa fa-table"></i>
      @if(isset($user_maintenance[0]->user_first_name)) {{ ucfirst($user_maintenance[0]->user_first_name) }} @endif @if(isset($user_maintenance[0]->user_last_name)) {{ ucfirst($user_maintenance[0]->user_last_name) }} @endif
        <a class="btn btn-primary pull-right" href=" {{ url('/') }}/addMaintenance/0/{{Crypt::encrypt($user_id)}}"> {{__('messages.add_maintenance')}} 
        </a>
      </h3>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard">{{ __('messages.home') }}</a></li>
        <li><i class="fa fa-th-list"></i>{{ __('messages.users') }}</li>
        <a href="{{ url('/downloadExcel/xls/'.$user_maintenance[0]->user_id) }}">
          
          <button class="btn btn-success">Download Excel xls</button></a>
            <a href="{{ url('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
            <a href="{{ url('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>
      </li>
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
              <th><i class="icon_calendar"></i>{{ __('messages.pending_amount') }}</th>
              <th><i class="icon_pin_alt"></i>{{ __('messages.extra_amount') }}</th>             
              <th><i class="icon_cogs"></i> {{__('messages.action')}}</th>
            </tr>
          </thead>
          <tbody>                
            @foreach($user_maintenance as $key => $row)
            <tr>
               <th>{{ $no }}</th>
              <?php $no++; ?>
              <td>{{$row->amount }}</td>
              <td>{!! showMonth($row->month) !!}</td>
              <td>{{$row->pending_amount }}</td>
              <td> {{$row->extra_amount}}</td>              
              <td>
                <div class="btn-group">
                 <a class="btn btn-success" title="{{__('messages.edit')}}" href="{{ url('/') }}/editmaintenance/{{ Crypt::encrypt($row->id) }}" style="margin:5px;" data-toggle="tooltip">{{__('messages.edit')}}</a> &nbsp;&nbsp;&nbsp;
                 <a class="btn btn-danger deleteDetail" title="{{__('messages.delete')}}" style="margin:5px;" data-id="{{ Crypt::encrypt($row->id) }}" href="#" data-toggle="tooltip">{{__('messages.delete')}}</a>
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