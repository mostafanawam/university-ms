@extends('student.main')


@section('content')
<div class="container">

<h1 class="text-center">Exams Results</h1>
<table class="table text-center">

  <tr>
    <th>Course Code</th>
      
      <th>Grade</th>
      <th>Result</th>
  </tr>
  @foreach($results as $res)
  <tr>
    <th>{{$res->CodeCourse}}</th>
    
    <th> 
      <!--// if($res->Date>date('Y-m-d H:i:s'))
      exam is not done
       end if-->

      @if ($res->Grade==null)
          Not Announced
          @else {{$res->Grade}}
      @endif
    </th>
    <th>
      @if($res->Grade==null) -
      @elseif ($res->Grade>=50 )
          Passed
          @elseif($res->Grade<50)
            Failed
      @endif
    </th>
  </tr>
  @endforeach
</table>
</div>
@stop
