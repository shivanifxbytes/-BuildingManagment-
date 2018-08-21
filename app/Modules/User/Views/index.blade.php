@extends('layouts.app')
@section('content')
<div class="container">
	 <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> profile </h2>
            </div>
            
        </div>
    </div>
		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ Session::get('success') }}</p>
		</div>
		@endif

		<div class="col-md-8">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>User Name</th>
						<th>User Type</th>
						<th>Flat Number</th>
						<th>Amount</th>
						
					</tr>
				</thead>
				@foreach ($users as $key)
				<tr>
					<td>{{ ucfirst($key->user_name) }} {{ ucfirst($key->flat_number)}}</td>
					<td>{{ $key->user_type }}</td>
					<td>{{ $key->flat_number }}</td>
					<td>{{ $key->amount }}</td>
					
				</tr>
				@endforeach
			</table>
		</div>
	
</div>
@endsection
