@extends('chief.main')



@section('content')
<div class="container">

<form class="" action="/chief/insertCourse" method="post">
  @csrf

<h1 class="text-center">Add Course</h1>

<div class="form-row justify-content-center ">
  <div class="form-group col-lg-8">
    <label for="Code" class="font-weight-bold">Code:</label>
<input type="text" name="Code" value="{{old('Code')}}"  class="form-control" placeholder="Enter Course Code">
<small class="alert text-danger font-weight-bold">@error('Code'){{$message}}@enderror</small>
  </div>
</div>

 <div class="form-row justify-content-center ">
      <div class="form-group col-lg-8">
        <label for="Name" class="font-weight-bold">Name:</label>
    <input type="text" name="Name" value="{{old('Name')}}"  class="form-control" placeholder="Enter Course Name">
    <small class="alert text-danger font-weight-bold">@error('Name'){{$message}}@enderror</small>
      </div>
    </div>

     <div class="form-row justify-content-center ">
          <div class="form-group col-lg-8">
            <label for="Description" class="font-weight-bold">Description:</label>
        <input type="text" name="Description" value="{{old('Description')}}"  class="form-control" placeholder="Enter Course Description">
        <small class="alert text-danger font-weight-bold">@error('Description'){{$message}}@enderror</small>
          </div>
        </div>

           <div class="form-row justify-content-center ">
              <div class="form-group col-lg-8">
                <label for="Credits" class="font-weight-bold">Credits:</label>
            <input type="text" name="Credits" value="{{old('Credits')}}"  class="form-control" placeholder="Enter Course Credits" >
            <small class="alert text-danger font-weight-bold">@error('Credits'){{$message}}@enderror</small>
              </div>
            </div>
<!--
    <div class="form-row justify-content-center ">
      <div class="form-group col-lg-8">
        <label for="Semester" class="font-weight-bold">Semester:</label>
    <input type="text" name="Semester" value="{{old('Semester')}}"  class="form-control"  placeholder="Enter Course Semester">
    <small class="alert text-danger font-weight-bold">@error('Semester'){{$message}}@enderror</small>
      </div>
    </div>-->

    <div class="form-row justify-content-center ">
      <div class="form-group col-lg-8">
        <label for="Semester" class="font-weight-bold">Semester:</label>
          <select class="custom-select" name="Semester">
            <option value="Choose Semester" selected disabled >Choose Semester</option>
            <option value="Fall">Fall</option>
            <option value="Spring">Spring</option>
            <option value="Both">Both</option>
          </select>
        <small class="alert text-danger font-weight-bold">@error('Semester'){{$message}}@enderror</small>
        </div>
      </div>

    <div class="form-row justify-content-center">
      <div class="form-group col-lg-6">
      <button type="submit" class="btn btn-primary btn-block">Add</button>
      </div>
    </div>

    </div>
    </form>
@stop
