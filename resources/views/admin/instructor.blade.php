@extends('admin.main')


@section('content')
<h1 class="text-center">Faculty Member List</h1>
<br><br>
<div class="container">

<div class="table-responsive">

<table class="table" id="StudentTable">
  <thead>
    <tr>
          <th>Full Name</th>
          <th>UserId</th>
          <th>Email</th>
          <th>Phone</th>
          <th>DOB</th>
          <th>Gender</th>
          <th>Image</th>
          <th>Grade</th>
          <th>isChief</th>
    </tr>
  </thead>

  <tbody>
    @foreach($instructors as $inst)
      <tr>
          <th>{{$inst->Fname}} {{$inst->Mname}} {{$inst->Lname}}</th>
          <th>{{$inst->UserId}}</th>
          <th>{{$inst->email}}</th>
          <th>{{$inst->phone}}</th>
          <th>{{$inst->dob}}</th>
          <th>{{$inst->gender}}</th>
          <th><img src="{{$inst->image}}" alt="{{$inst->image}}"> </th>
          <th>{{$inst->Grade}}</th>
          <th>@if($inst->isChief==0) Instructor @else Chief @endif </th>

      </tr>
      @endforeach
  </tbody>

</table>

</div>
</div>
@stop
