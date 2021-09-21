@extends('staff.main')


@section('content')
<div class="container">
  <h1 class="text-center">Students Registration</h1>
  <br>
  <table class="table">
    <thead>
      <tr>
        <th>Full Name</th>
        <th>StudentID</th>
        <th>Options</th>
      </tr>
    </thead>
    @foreach($students as $st)
    <tr>
      <th>{{$st->Fname}}  {{$st->Mname}}  {{$st->Lname}} </th>
      <th>{{$st->userid}}</th>
      <th><a href="/staff/studentreg/register/{{{$st->Id}}}" class="btn btn-primary">Register</a></th>

      </tr>
      @endforeach
  </table>

</div>
@stop
