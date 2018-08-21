@extends('layouts.app')
@section('content')
<div class="container">
	 <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> USERS </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('maintenance.create') }}"> Create User Maintenance</a>
            </div>
        </div>
    </div>
		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ Session::get('success') }}</p>
		</div>
		@endif

		<div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>User Name</th>
						<th>User Type</th>
						<th>Flat Number</th>
						<th>Amount</th>
						<th width="280px">Action</th>
					</tr>
				</thead>
				@foreach ($users as $key)
				<tr>
					<td>{{ ucfirst($key->user_name) }} {{ ucfirst($key->flat_number)}}</td>
					<td>{{ $key->user_type }}</td>
					<td>{{ $key->flat_number }}</td>
					<td>{{ $key->amount }}</td>
					 <td>
                <form action="{{ route('admin.destroy',$key->id) }}" method="POST">
                	<div class="col-md-12">
                    <a class="btn btn-info"  href="{{ route('admin.index',$key->id) }}">Show User</a>
                    <a class="btn btn-primary" href="">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
                </form>
            </td>
				</tr>
				@endforeach
			</table>
		</div>
	
</div>
@endsection
