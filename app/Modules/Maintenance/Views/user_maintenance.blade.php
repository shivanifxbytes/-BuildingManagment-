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


  <div class="col-sm-4">
        @if($success)
        <div class="alert alert-success">
            <p>{{$success }}</p>
        </div>
        @endif
    </div>
    <div class="col-sm-4">
      <!--  -->
    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
         <div class="row">
           
            <div class="col-xs-12 col-sm-12 col-md-12">
                
                 
                
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
                        
                        <span id="product_discount" class="text-danger">
                        
                        </span>
                </div>
                 <div class="form-group">
                   
			<label for="amount">amount</label>
			<input type="text" name="amount" id="amount" class="form-control"  />
			            
                </div>
                 <div class="form-group">
                    
                       <label for="painding_amount">Painding Amount</label>
      <input type="text" name="painding_amount" id="painding_amount" class="form-control"  />
      
                      <span id="painding_amount   " class="text-danger">
                        
                        </span>
                    </div> 
                     <div class="form-group">
                    
                       <label for="extra_amount">Extra Amount</label>
      <input type="text" name="extra_amount" id="extra_amount" class="form-control"  />
      
                      <span id="extra_amount   " class="text-danger">
                        
                        </span>
                    </div> 


                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
               
             


    </form>

 @endsection



