@extends('admin.main')


@section('content')
<form  method="post" action="/admin/additem">
@csrf

<div class="container">

<h1 class="text-center">Add Items</h1>
<br>

@if(session('failed'))

			<div class="alert alert-danger col-lg-12  text-center" role="alert">
{{ session('failed') }}
</div>
@endif
<div class="form-row justify-content-center">

<div class="form-group col-lg-6">
<input type="text" class="form-control" name="name" value="{{old('name')}}"  placeholder="Enter the name of material">
@error('name'){{$message}}@enderror
</div>

</div>

<div class="form-row justify-content-center">
<div class="form-group col-lg-6">
<input type="text" class="form-control" name="MaterialQuantity" value="{{old('MaterialQuantity')}}"  placeholder="Enter the Quantity of material">
@error('MaterialQuantity'){{$message}}@enderror
</div>
</div>

<div class="form-row justify-content-center">
  <div class="col-lg-6">
  <button class="btn btn-primary btn-block">Add</button>
  </div>
</div>


</div>

</form>

@stop
