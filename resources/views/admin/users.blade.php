@extends ('layouts.admin')
@section('content')
        <div class="row">
          <div class="col-lg-12">

            <h3 class="page-header"><i class="fa fa-table"></i>{{ __('messages.users') }}<a class="btn btn-primary pull-right" href=" {{ url('/') }}/addUser"> {{__('messages.add_user')}} </a>
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
                    <th><i class="icon_profile"></i>{{ __('messages.full_name') }}</th>
                    <th><i class="icon_mail_alt"></i>{{ __('messages.email') }}</th>
                    <th><i class="icon_calendar"></i>{{ __('messages.joining') }}</th>
                    <th><i class="icon_pin_alt"></i>{{ __('messages.status') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $key => $row)
                  <tr>
                    <th>{{$key}}</th>
                    <td>{{$row->user_first_name}} {{$row->user_last_name}}</td>
                    <td>{{$row->user_email}}</td>
                    <td>{{ date('d-M Y', strtotime($row->user_created_at)) }}</td>
                    <td> {!! showStatus($row->user_status) !!}</td>
                   <td>
                      <div class="btn-group">
                        <a class="btn btn-success" title="{{__('messages.edit')}}" href="{{ url('/') }}/addUser/{{ Crypt::encrypt($row->id) }}" data-toggle="tooltip">{{__('messages.edit')}}</a> &nbsp;&nbsp;&nbsp;
                         <a class="btn btn-alert" title="{{__('messages.edit')}}" href="{{ url('/') }}/showMaintenance/{{ Crypt::encrypt($row->id) }}" data-toggle="tooltip">{{__('messages.maintenance')}}</a> &nbsp;&nbsp;&nbsp;
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