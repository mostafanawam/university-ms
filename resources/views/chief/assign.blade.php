@extends('chief.main')


@section('content')
<div class="container">

<h1 class="text-center">Course Assignment</h1>
@if (session('success'))
			<div class="alert alert-success text-center" role="alert">
{{ session('success') }}
</div>
@endif

@if (session('error'))
			<div class="alert alert-danger text-center" role="alert">
{{ session('error') }}
</div>
@endif
<br>
<form  action="assign"  method="post">
@csrf
<div class="form-row justify-content-center">
    <div class=" form-group  col-lg-8 ">
      <label for="">Instructor Name:</label>
      <select class="custom-select" name="instructor">
        <option value="" disabled selected>Choose Instructor Name</option>
        @foreach($instructors as $ins) <!-- fill dropwdown by the name of instructors-->
        <option value="{{$ins->UserId}}">{{$ins->Fname}} {{$ins->Lname}}</option>
        @endforeach
      </select>
      @error('instructor')
      <small class="text-danger font-weight-bold">{{$message}}</small>
      @enderror
  </div>
  </div>

  <div class="form-row justify-content-center">
    <div class=" form-group  col-lg-8 ">
      <label for="">Course Code:</label>
      <select class="custom-select" name="course">
        <option value="" disabled selected>Choose Course Code</option>
        @foreach($courses as $c)
        <option value="{{$c->Code}}">{{$c->Code}}</option><!-- fill dropwdown by the name of courses-->
        @endforeach
      </select>
      @error('course')
      <small class="text-danger font-weight-bold">{{$message}}</small>
      @enderror
  </div>
  </div>

  <div class="form-row justify-content-center">
    <div class="col-lg-6 text-center">
      <button type="submit" class="btn btn-primary btn-block">Assign</button>
    </div>
  </div>


</form>



</div>

@stop
