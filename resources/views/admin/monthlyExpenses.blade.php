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
            <li><i class="fa fa-th-list"></i>{{ __('messages.month_list') }}</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <p>Retrieve Record By Specifying The Year And Month </p>
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
            <table class="table table-striped table-advance table-hover" id="data-table" >
                <thead>
                    <tr>
                       <th>Title</th>    
                       <th>Amount</th>       
                       <th>Paid By</th>
                       <th>Reference  Number</th>
                       <th class="text-center">Total By Cash</th>
                       <th class="text-center">Total By Cheque</th>
                       <th class="text-center " >Grand Total</th>
                   </tr>
               </thead>
               <tbody class="dynamic_field">
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
            year = $(this).val();
            if(year!='')
            {
                jQuery('#monthlist').css({'display':'inline'});
                jQuery('#monthlist').change(function()
                {
                    month = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({  
                        url: "{{ route('showMonthlyExpenses') }}", 
                        type:"POST",  
                        data:{
                            year:year,
                            month:month
                        },
                        dataType: 'json',
                        success:function(response)  
                        {
                            $('.dynamic_field').html('');   
                            $.each(response, function (index, value) {
                                $('.dynamic_field').append('<tr id="row'+response[index]+'"><td>'+value.title+'</td><td>'+value.amount+'</td><td>'+value.paid_by+'</td><td>'+value.reference_number+'</td><td>'+value.amount+'</td><td></td><td></td><td></td></tr>');  
                            });
                        },
                        error:function(xhr)
                        {
                            console.log(xhr.responseText);
                        }  
                    });     
                });
            }
            else
            {
                jQuery('#monthlist').css({'display':'none'});
            }
        });
    });
</script>
@endsection