@extends ('layouts.admin')
@section('styles')
<style type="text/css">
    #showMonthlyExpenses_length {
        display: none;
    }
    select
    {
        padding: 5px 8px;
    }
    #showMonthlyExpenses_filter {
        display: none;
    }
    .dataTables_empty
    {
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
            <li><i class="fa fa-th-list"></i>Monthly Expenses List</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div style="padding: 8px 8px">
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
            </div>
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
            <table class="table table-striped table-advance table-hover" id="showMonthlyExpenses" >

                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Title</th>    
                        <th>Amount</th>       
                        <th>Paid By</th>
                    </tr>
                </thead>
                <tbody class="dynamic_field">
                </tbody>
            </table>
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">   
        </section>
    </div>
    <!-- page end-->
</div>
</div>
<!--main content end-->
@endsection
@section('scripts')
<script type="text/javascript">
    var csrf_token = "<?php echo csrf_token(); ?>";
</script>
<script src="{{ asset('public/backend/js/monthlyExpenses.js') }}" type="text/javascript"></script>

@endsection