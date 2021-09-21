@extends('admin.main')


@section('content')

<h1 class="text-center">Students List</h1>
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
          <th>SSN</th>
          <th>langauge</th>
    </tr>
  </thead>

  <tbody>
    @foreach($students as $st)
      <tr>
          <th>{{$st->Fname}} {{$st->Mname}} {{$st->Lname}}</th>
          <th>{{$st->userid}}</th>
          <th>{{$st->email}}</th>
          <th>{{$st->phone}}</th>
          <th>{{$st->dob}}</th>
          <th>{{$st->gender}}</th>
          <th><img src="{{$st->image}}" alt="{{$st->image}}"> </th>
          <th>{{$st->ssn}}</th>
          <th>{{$st->language}}</th>

      </tr>
      @endforeach
  </tbody>

</table>

</div>
</div>


@stop
