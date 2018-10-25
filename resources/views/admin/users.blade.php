@extends ('layouts.admin')
@section('content')
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>{{ __('messages.flats') }}<a class="btn btn-primary pull-right" href=" {{ url('/') }}/addUser"> {{__('messages.add_flat')}} </a>
          </h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard">{{ __('messages.home') }}</a></li>
              <li><i class="fa fa-th-list"></i>{{ __('messages.flats') }}</li>
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
                    <th><i class="icon_mail_alt"></i>{{ __('messages.flat_number') }}</th>                    
                    <th><i class="icon_mail_alt"></i>{{ __('messages.owner') }}</th>
                    <th><i class="icon_mail_alt"></i>{{ __('messages.owner_mobile_no') }}</th>
                    <th><i class="icon_mail_alt"></i>{{ __('messages.flat_type') }}</th>                   
                    <th><i class="icon_mail_alt"></i>{{ __('messages.carpet_area') }}</th>
                    <th><i class="icon_mail_alt"></i>{{ __('messages.email') }}</th>
                    <th><i class="icon_pin_alt"></i>{{ __('messages.status') }}</th>
                    <th><i class="icon_cogs"></i> {{__('messages.action')}}</th>
                  </tr>
                </thead>
                <tbody>               
                  @foreach($users as $key => $row)
                  <tr>
                    <td>{{$row->flat_number}}</td>                                    
                    <td>{{$row->name}}</td>
                    <td>{{$row->mobile_number}}</td>
                    <td>{{$row->flat_type}}</td>                    
                    <td>{{$row->carpet_area}} sq.ft</td>
                    <td>{{$row->email}}</td>
                    <td> {!! showStatus($row->user_status) !!}</td>
                   <td>
                      <div class="btn-group">
                        <a class="btn btn-success" title="{{__('messages.edit')}}" href="{{ url('/') }}/addUser/{{ Crypt::encrypt($row->id) }}" style="margin:5px;" data-toggle="tooltip">{{__('messages.edit')}}</a> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-danger deleteDetail" title="{{__('messages.delete')}}" data-id="{{ Crypt::encrypt($row->id) }}" style="margin:5px;" href="#" data-toggle="tooltip">{{__('messages.delete')}}</a>
                      </div>
                    </td>
                   </tr>
                  @endforeach                 
                </tbody>
              </table>
              <form class="form-horizontal pull-right"  method="post" style="margin-top: 15px;padding: 10px;" action="{{ url('importExcel') }}"   enctype="multipart/form-data">
                @csrf
                @if (Session::has('import_success'))
                <div class="alert alert-success">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                  <p>{{ Session::get('import_success') }}</p>
                </div>
                @endif
                @if ($message = Session::get('error_array'))
                <div class="alert alert-danger">
                  <ul>
                    @foreach(Session::get('error_array') as $key)
                    <li>
                      {{ $key }}  
                    </li>
                    <hr />
                    @endforeach
                  </ul>
                </div>
                @endif
                @if (Session::has('import_error'))
                <div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                  <p>{{ Session::get('import_error') }}</p>
                </div>
                @endif
                <div class="pull-right"><input  type="file"  name="import_file" /></div>
                <div class="clearfix"></div>
                <div class="pull-right" style="padding: 10px;">
                <button class="btn btn-primary">Import File</button>
                </div>
              </form>
            </section>
          </div>
        </div>
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
@endsection