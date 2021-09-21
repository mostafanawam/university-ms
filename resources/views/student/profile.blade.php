@extends('student.main')


@section('content')


<div class="container">
  <h1 class="text-center">Manage Profile</h1>
  <br>
  @if (session('status'))

        <div class="alert alert-success text-center" role="alert">

  {{ session('status') }}
  </div>

  @elseif(session('failed'))

        <div class="alert alert-danger text-center" role="alert">
  {{session('failed')}}
  </div>
  @endif

<form  action="/student/UpdateProfile" method="post">
  @csrf
  @foreach($student as $info)
<div class="form-row justify-content-center ">
  <div class="form-group col-lg-4">
    <label for="UserID" class="font-weight-bold">UserID:</label>
  <input type="text" name="UserID" readonly value="{{$info->userid}}"  placeholder="UserID" class="form-control">

  </div>
  <div class="form-group col-lg-4">
    <label for="Salary" class="font-weight-bold">SSN:</label>
<input type="text" readonly name="ssn" value="{{$info->ssn}}"   class="form-control">
  </div>
  <div class="form-group col-lg-4">
    <label for="Email" class="font-weight-bold">Email:</label>
<input type="text" name="Email" value="{{$info->email}}"  placeholder="Email" class="form-control">
@error('Email')<small class="alert text-danger font-weight-bold">{{$message}}</small>@enderror
  </div>
  </div>


  <div class="form-row justify-content-center ">
    <div class="form-group col-lg-4">
      <label for="Firstname" class="font-weight-bold">Firstname:</label>
  <input type="text" name="Firstname" value="{{$info->Fname}}"  placeholder="Firstname" class="form-control">
  @error('Firstname')<small class="alert text-danger font-weight-bold">{{$message}}</small>@enderror
    </div>
    <div class="form-group col-lg-4">
      <label for="MiddleName" class="font-weight-bold">MiddleName:</label>
  <input type="text" name="MiddleName" value="{{$info->Mname}}" placeholder="MiddleName" class="form-control">
  @error('MiddleName')<small class="alert text-danger font-weight-bold">{{$message}}</small>@enderror
    </div>
    <div class="form-group col-lg-4">
      <label for="LastName" class="font-weight-bold">LastName:</label>
  <input type="text" name="LastName" value="{{$info->Lname}}" placeholder="LastName"    class="form-control">
  @error('LastName')<small class="alert text-danger font-weight-bold">{{$message}}</small>@enderror
    </div>
  </div>

  <div class="form-row justify-content-center ">
    <div class="form-group col-lg-4">
      <label for="Phone" class="font-weight-bold">Phone:</label>
  <input type="tel"  name="Phone" value="{{$info->phone}}"  placeholder="Phone" class="form-control">
  @error('Phone')<small class="alert text-danger font-weight-bold">{{$message}}</small>@enderror
    </div>
    <div class="form-group col-lg-4">
      <label for="DOB" class="font-weight-bold">DOB:</label>
  <input type="date" name="DOB" value="{{$info->dob}}" placeholder="DOB" class="form-control">
  @error('DOB')<small class="alert text-danger font-weight-bold">{{$message}}</small>@enderror
    </div>

    <div class="form-group col-lg-4">
      <label for="Gender" class="font-weight-bold">Gender:</label>
      <br>
      @if($info->gender=="male")
      <input type="radio" name="Gender" value="male" checked> male
      <input type="radio" name="Gender" value="female"> female
      @else
      <input type="radio" name="Gender" value="male"> male
      <input type="radio" name="Gender" value="female" checked> female
      @endif
      @error('Gender')<small class="alert text-danger font-weight-bold">{{$message}}</small>@enderror
    </div>

  </div>
  <div class="form-row">
    <div class="form-group col-lg-4">
      <label for="language" class="font-weight-bold">Language:</label>
      <select class="custom-select" name="language">
        @if($info->language=='En')
        <option value="En" selected>En</option>
        <option value="Fr">Fr</option>
        @else
        <option value="En" >En</option>
        <option value="Fr" selected>Fr</option>
        @endif
      </select>
      @error('language')<small class="alert text-danger font-weight-bold">{{$message}}</small>@enderror
    </div>
  </div>

  <div class="form-row justify-content-center">
    <div class="form-group col-lg-6">
    <button type="submit" class="btn btn-primary btn-block">Save</button>
    </div>
  </div>
    @endforeach
</form>
@stop
