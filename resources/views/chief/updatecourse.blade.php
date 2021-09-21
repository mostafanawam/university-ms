@extends('chief.main')


@section('content')
<div class="container">

<h1 class="text-center">Course Update</h1>
<br>

<form class="" action="/chief/updateCourse" method="post">
  @csrf
  @foreach($courses as $course)
<input type="hidden" name="code" value="{{$course->Code}}">
  <div class="form-row justify-content-center ">
    <div class="form-group col-lg-6">
      <label for="Name" class="font-weight-bold">Name:</label>
  <input type="text" name="Name" value="{{$course->Name}}"   class="form-control">
  <small class="alert text-danger font-weight-bold">@error('Name'){{$message}}@enderror</small>
    </div>
    <div class="form-group col-lg-6">
      <label for="Description" class="font-weight-bold">Description:</label>
  <input type="text" name="Description" value="{{$course->description}}"  class="form-control">
  <small class="alert text-danger font-weight-bold">@error('Description'){{$message}}@enderror</small>
    </div>

  </div>

  <div class="form-row justify-content-center ">
    <div class="form-group col-lg-6">
      <label for="Credits" class="font-weight-bold">Credits:</label>
  <input type="text" name="Credits" value="{{$course->Credits}}"   class="form-control">
  <small class="alert text-danger font-weight-bold">@error('Credits'){{$message}}@enderror</small>
    </div>

    <div class="form-group col-lg-6">
      <label for="Semester" class="font-weight-bold">Semester:</label>
      <select class="custom-select" name="Semester">

        <option value="Fall" <?php  if($course->Semester=='Fall') echo "selected";?>>Fall</option>
        <option value="Spring" <?php  if($course->Semester=='Spring') echo "selected";?>>Spring</option>
        <option value="Both" <?php  if($course->Semester=='Both') echo "selected";?>>Both</option>
  </select>

  <small class="alert text-danger font-weight-bold">@error('Semester'){{$message}}@enderror</small>
    </div>
  </div>

  <div class="form-row justify-content-center">
    <div class="form-group col-lg-6">
    <button type="submit" class="btn btn-primary btn-block">Update</button>
    </div>
  </div>
@endforeach
</form>

</div>
@stop
