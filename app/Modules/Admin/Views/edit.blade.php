@extends('layouts.app')
@section('content')

   <?php// print_r($categories);
   ?>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@foreach ($users as $users_key)
    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="owner">Owner</label>
			<input type="text" name="owner" id="owner" class="form-control"  value="{{$users_key->owner}}"  />
                        <span id="owner" class="text-danger">
                        </span>
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    
                       <label for="tenant">Tenant</label>
			<input type="text" name="tenant" id="tenant" class="form-control"  />
			
                      <span id="tenant   " class="text-danger">
                        
                        </span>
                    </div>  
                 
                 <div class="form-group">
                   <label for="flat number">flat number</label>
			<input type="text" name="flat_number" id="flat_number" class="form-control"  />
                        <span id="flat_number" class="text-danger">
                        
                        </span>
                </div>
                  @endforeach
                  @foreach ($user_maintenance as $user_maintenance_key)

                 <div class="form-group">
                   <label for="month">month</label>
				<select name="month" id="month" class="form-control" >
					<option value="" selected="selected">month</option>
					<option value="India">jan</option>
					<option value="Pakistan">feb</option>
					<option value="Bhutan">march</option>
					<option value="Bangladesh">ap</option>
					<option value="Bangladesh">may</option>
					<option value="Bangladesh">june</option>
					<option value="Bangladesh">july</option>
					<option value="Bangladesh">aug</option>
					<option value="Bangladesh">sep</option>
					<option value="Bangladesh">oct</option>
					<option value="Bangladesh">nov</option>
					<option value="Bangladesh">dec</option>
				</select>
                        
                        <span id="month" class="text-danger">
                        
                        </span>
                </div>
                 <div class="form-group">
                   
			<label for="amount">amount</label>
			<input type="text" name="amount" id="amount" class="form-control"  />
			        
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
                        
                </div>
               
             

    </form>
      @endforeach

 @endsection



