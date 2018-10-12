@extends ('layouts.admin')
@section('styles')

<style type="text/css">
    #data-table_length {
    display: none;
}
select
{
    padding: 5px 8px;
}
#data-table_filter {
    display: none;
}
</style>
@endsection
@section('content')       
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-table"></i>{{ __('messages.maintenance_transaction') }}<a class="btn btn-primary pull-right" href=" {{ url('/') }}/addMonthlyExpense"> {{__('messages.add')}} </a>
        </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard">{{ __('messages.home') }}</a></li>
            <li><i class="fa fa-th-list"></i>{{ __('messages.month_list') }}</li>
        </ol>
    </div>
</div>
<div class="row">
<div class="col-lg-12">
        <section class="panel">
        <?php $current_month = date("m"); 
        $current_year = date('Y')?>
        <select id="yearlist" name="yearlist">
            <option value=''>Select Year</option>
            @for($i=$current_year; $i>=$current_year-20; $i--)
            <option value="{{$i}}">{{ $i }}</option>
            @endfor
        </select>
        <select id="monthlist" style="display: none">
            <option value=''>Select Month</option>
            @for($i=1; $i<=$current_month; $i++)
            <?php  
            $dateObj   = DateTime::createFromFormat('!m', $i);
            $monthName = $dateObj->format('F'); 
            $monthCode = $dateObj->format('m');// March ?>
            <option value="{{$monthCode}}">{{ $monthName }}</option>
            @endfor
        </select>
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
                    @if(isset($users))
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
                    @endif             
                </tbody>
            </table>
        </section>
    </div>
    <!-- page end-->
</div>
</div>
<!--main content end-->
@endsection
@section('scripts')
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('#yearlist').change(function() {
      value = $(this).val();
      if(value!='')
      {
        jQuery('#monthlist').css({'display':'inline'});
      }
      else
      {
        jQuery('#monthlist').css({'display':'none'});
      }
      
    });
  });
</script>
@endsection