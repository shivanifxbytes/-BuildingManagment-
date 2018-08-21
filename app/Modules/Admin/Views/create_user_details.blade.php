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
    @if($errors)
    <div class="alert alert-danger">
      <ul style="list-style: none;">
        <li>{{ $errors->first('owner') }}</li>
        <li>{{ $errors->first('tenant') }}</li>
        <li>{{ $errors->first('flat_number') }}</li>
        <li>{{ $errors->first('carpet_area') }}</li>
        <li>{{ $errors->first('super_built_up_area') }}</li>
      </ul>
    </div>
    @endif

    <!--  -->
    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="owner">Owner</label>
            <input type="text" name="owner" id="owner" class="form-control"  />
            <span id="product_name" class="text-danger">
            </span>
          </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="tenant">Tenant</label>
            <input type="text" name="tenant" id="tenant" class="form-control"  />
            <span id="product_description   " class="text-danger"> 
            </span>
        </div>  

        <div class="form-group">
           <label for="flat number">flat number</label>
           <input type="text" name="flat_number" id="flat_number" class="form-control"  />
           <span id="product_price" class="text-danger">
           </span>
        </div>

        <div class="form-group">
          <label for="carpet area">carpet area</label>
          <input type="text" name="carpet_area" id="carpet_area" class="form-control"  />
          <span id="carpet_area" class="text-danger">
          </span>
        </div>

        <div class="form-group">
         <label for="super_built_up_area">super built up area</label>
         <input type="text" name="super_built_up_area" id="super_built_up_area" class="form-control"  />
         <div class="col-xs-12 col-sm-12 col-md-12 text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>

      </div>




    </form>

    @endsection



