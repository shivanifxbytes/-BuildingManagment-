@extends ('layouts.admin')
@section('content')
        <div class="row">
          <div class="col-lg-12">

            <h3 class="page-header"><i class="fa fa-table"></i>{{ __('messages.users') }}<a class="btn btn-primary pull-right" href=" {{ url('/') }}/addUser"> {{__('messages.add_user')}} </a>
          </h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard">{{ __('messages.home') }}</a></li>
              <li><i class="fa fa-th-list"></i>{{ __('messages.users') }}</li>

            <a href="{{ url('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
            <a href="{{ url('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
            <a href="{{ url('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>
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
                    <th><i class="icon_profile"></i>{{ __('messages.full_name') }}</th>
                    <th><i class="icon_mail_alt"></i>{{ __('messages.email') }}</th>
                    <th><i class="icon_mail_alt"></i>{{ __('messages.owner') }}</th>
                    <th><i class="icon_mail_alt"></i>{{ __('messages.tenant') }}</th>
                    <th><i class="icon_mail_alt"></i>{{ __('messages.flat_number') }}</th>
                    <th><i class="icon_mail_alt"></i>{{ __('messages.carpet_area') }}</th>
                    <th><i class="icon_calendar"></i>{{ __('messages.joining') }}</th>
                    <th><i class="icon_pin_alt"></i>{{ __('messages.status') }}</th>
                    <th><i class="icon_cogs"></i> {{__('messages.action')}}</th>
                  </tr>
                </thead>
                <tbody>
                 <?php $no = 1; ?>
                  @foreach($users as $key => $row)
                  <tr>
                    <th>{{ $no }}</th>
                     <?php $no++; ?>
                    <td>{{$row->user_first_name}} {{$row->user_last_name}}</td>
                    <td>{{$row->user_email}}</td>
                    <td>{{$row->owner}}</td>
                    <td>{{$row->tenant}}</td>
                    <td>{{$row->flat_number}}</td>
                    <td>{{$row->carpet_area}} sq.ft</td>
                    <td>{{$row->created_at}}</td>
                    <td> {!! showStatus($row->user_status) !!}</td>
                   <td>
                      <div class="btn-group">
                        <a class="btn btn-success" title="{{__('messages.edit')}}" href="{{ url('/') }}/addUser/{{ Crypt::encrypt($row->id) }}" style="margin:5px;" data-toggle="tooltip">{{__('messages.edit')}}</a> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                         <a class="btn btn-success" title="{{__('messages.edit')}}" href="{{ url('/') }}/showMaintenance/{{ Crypt::encrypt($row->id) }}" style="margin:5px;" data-toggle="tooltip">{{__('messages.maintenance')}}</a> &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-danger deleteDetail" title="{{__('messages.delete')}}" data-id="{{ Crypt::encrypt($row->id) }}" style="margin:5px;" href="#" data-toggle="tooltip">{{__('messages.delete')}}</a>
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