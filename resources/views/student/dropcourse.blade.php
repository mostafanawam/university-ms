@extends('student.main')


@section('content')

<div class="container">
<h1 class="text-center">Drop Courses</h1>
<br>
@if (session('status'))
<div class="form-row">
  <div class=" col-lg-12 ">
    	<div class="alert alert-success text-center" role="alert">
        {{ session('status') }}

        </div>
        </div>
        </div>
        @endif
        @if (session('error'))
        <div class="form-row">
          <div class=" col-lg-12 ">
            	<div class="alert alert-danger text-center" role="alert">
                {{ session('error') }}

                </div>
                </div>
                </div>
                @endif
<table class="table">
  <tr>
    <th>Course Code</th>
    <th>Date</th>
    <th>&nbsp</th>
  </tr>
  @foreach($reg_courses as $c)
  <tr>
    <th>{{$c->Code}}</th>
    <th>{{$c->date}}</th>
    <th> <a href=""   onclick="confirm1('{{$c->Code}}')"> <button type="button" name="button" class="btn btn-danger">Drop</button></a> </th>
  </tr>

  @endforeach
</table>

</div>
<script type="text/javascript">
  function confirm1(id) {
    var del=confirm("Do you want to drop the course?");//ask the user if want to delete
    if(del){//if yes => delete item
      let stateObj = { id: "100" };
                 window.history.replaceState(stateObj,
                             "delete", "/student/dropcourse/drop/"+id);
    }
  }
  
  </script>
@stop
