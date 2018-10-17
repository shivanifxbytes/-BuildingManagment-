@extends ('layouts.admin')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
@endsection
@section('content')   
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-table"></i>{{ __('messages.monthly_expenses') }}
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
      <div class="container">
        <div class="row">
          <div class="col-md-12"> 
            <div class="row">
              <div class="text-center">
                <h1><strong>RECEIPT</strong></h1>
              </div>
              <table class="table table-hover">
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <p>
                      <strong><em>Date: 1st November, 2018</em></strong>
                    </p>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                      <strong><em>Receipt #: 34522677W</em></strong>
                    </p>
                  </div>
                </div>
                <tbody>
                  <tr>
                    <td class="col-md-9"><em>Flat Number</em></td>
                    <td class="col-md-1" style="text-align: center"> 101 </td>
                  </tr>
                  <tr>
                    <td class="col-md-9"><em>Month Of Payment</em></td>
                    <td class="col-md-1" style="text-align: center"> 10/28/2018 </td>
                    <tr>
                      <td class="col-md-9"><em>Paid By</em></td>
                      <td class="col-md-1" style="text-align: center"> Cash </td>
                    </tr>
                    <tr>
                      <td class="col-md-9"><em>Net Amount</em></td>
                      <td class="col-md-1" style="text-align: center"> 3000 </td>
                    </tr>
                    <tr>
                      <td class="col-md-9"><em>Comment</em></td>
                      <td class="col-md-1" style="text-align: center"> abcd </td>
                    </tr>
                    <tr>
                      <td class="text-right">
                        <p>
                          <strong>Subtotal: </strong>
                        </p>
                      </td>
                      <td class="text-center">
                        <p>
                          <strong>3000 /-</strong>
                        </p>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-right"><h4><strong>Authorised Signature: </strong></h4></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  @endsection
