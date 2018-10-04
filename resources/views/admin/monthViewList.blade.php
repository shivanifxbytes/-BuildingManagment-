@extends ('layouts.admin')
@section('content')       
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-table"></i>{{ __('messages.maintenance_transaction') }}
        </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard">{{ __('messages.home') }}</a></li>
            <li><i class="fa fa-th-list"></i>{{ __('messages.month_list') }}</li>
        </ol>
    </div>
</div>
<select class="form-control" id="sel1" name="sellist1">
    <option>Select Year</option>
    <option>2018</option>
    <option>2019</option>
    <option>2020</option>
    <option>2021</option>
    <option>2022</option>
    <option>2023</option>
    <option>2024</option>
    <option>2025</option>
    <option>2026</option>
    <option>2027</option>
    <option>2028</option>
    <option>2029</option>
    <option>2030</option>
    <option>2031</option>
    <option>2032</option>
    <option>2033</option>
    <option>2034</option>
    <option>2035</option>
    <option>2036</option>
    <option>2037</option>
    <option>2038</option>
    <option>2039</option>
</select>
<hr />
<div class="row">
    <div class="col-lg-12">
        <ul class="list-group">
            <a href="{{ url('/') }}/showMaintenanceTransactionList"><li class="list-group-item">January</li></a>
            <a href=""><li class="list-group-item">February</li></a>
            <a href=""><li class="list-group-item">March</li></a>
            <a href=""><li class="list-group-item">April</li></a>
            <a href=""><li class="list-group-item">May</li></a>
            <a href=""><li class="list-group-item">June</li></a>
            <a href=""><li class="list-group-item">July</li></a>
            <a href=""><li class="list-group-item">August</li></a>
            <a href=""><li class="list-group-item">September</li></a>
            <a href=""><li class="list-group-item">October</li></a>
            <a href=""><li class="list-group-item">November</li></a>
            <a href=""><li class="list-group-item">December</li></a>
        </ul> 
    </div>
</div>
@endsection