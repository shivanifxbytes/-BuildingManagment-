@extends ('layouts.master')
@section('content')
<div class="row">
   $id=  Auth::user()->id;

    echo $id;
    die();
    <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
        <i class="fa fa-table"></i>
         <a class="btn btn-success" href="{{ url('/') }}/userrMaintenance" style="margin:5px;" data-toggle="tooltip">{{__('messages.maintenance')}}</a> &nbsp;&nbsp;&nbsp;
      </h3>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="{{ url('/') }}/dashboard">{{ __('messages.home') }}</a></li>
        <li><i class="fa fa-th-list"></i>{{ __('messages.users') }}</li>
        <li><i class="fa fa-th-list"></i>       
      </li>
      </ol>
    </div>
  </div>
    <div class="box">
        <div class="col-lg-12">
            <hr>
            <h2 class="intro-text text-center"><strong>{{ __('messages.welcome') }}</strong></h2>
            <hr>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
    </div>
</div>
@endsection