@extends ('layouts.admin')
@section('content')       
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-table"></i>{{ __('messages.maintenance_transaction') }}<a class="btn btn-primary pull-right" href=" {{ url('/') }}/addMaintenanceTransaction"> {{__('messages.add')}} </a>
        </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard">{{ __('messages.home') }}</a></li>
            <li><i class="fa fa-th-list"></i>{{ __('messages.month_list') }}</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-offset-3">
        <?php $current_month = date("m"); 
              $current_year = date('Y')?>
        <select class="form-control"  id="sel1" name="sellist1">
            <option>Select Year</option>
            @for($i=$current_year; $i>=$current_year-20; $i--)
            <option>{{ $i }}</option>
            @endfor
        </select>
        <hr />
        <ul class="list-group">
            @for($i=1; $i<=$current_month; $i++)
            <?php  
            $dateObj   = DateTime::createFromFormat('!m', $i);
            $monthName = $dateObj->format('F'); 
            $monthCode = $dateObj->format('m');// March ?>
            <li  class="list-group-item">
                <a href="{{$monthCode}}">{{ $monthName }}</a>
            </li>
            @endfor
        </ul> 
    </div>
</div>
@endsection