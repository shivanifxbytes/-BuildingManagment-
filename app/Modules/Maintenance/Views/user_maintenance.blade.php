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
                <a class="btn btn-primary" href="{{ route('maintenance.index') }}"> Back</a>
            </div>
        </div>

    </div>


  <div class="col-sm-4">
     @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
  </div>
    <div class="col-sm-4">
       @if($errors)
    <div class="alert alert-danger">
      <ul style="list-style: none;">
         <li>{{ $errors->first('month') }}</li>
        <li>{{ $errors->first('amount') }}</li>
        <li>{{ $errors->first('painding_amount') }}</li>
        <li>{{ $errors->first('extra_amount') }}</li>
         
      </ul>
    </div>
    @endif
      <!--  -->
    <form action="{{ route('maintenance.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
         <div class="row">
           
            <div class="col-xs-12 col-sm-12 col-md-12">
                
                 
                
                 <div class="form-group">
                   <label for="month">month</label>
				<select name="month" id="month" class="form-control" >
					<option value="" selected="selected">month</option>
					<option value="jan">jan</option>
					<option value="feb">feb</option>
					<option value="march">march</option>
					<option value="april">april</option>
					<option value="may">may</option>
					<option value="june">june</option>
					<option value="july">july</option>
					<option value="aug">aug</option>
					<option value="sep">sep</option>
					<option value="oct">oct</option>
					<option value="nov">nov</option>
					<option value="dec">dec</option>
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



