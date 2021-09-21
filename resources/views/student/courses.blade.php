@extends('student.main')


@section('content')

<style media="screen">
	table{
	width: 350px;

	}
	caption{
		caption-side: top;

	}
</style>
<div class="container">
<h1 class="text-center">Courses List</h1>
<br>
<table class="table text-center"  align="center">
	<caption class="text-center h3">Fall Semester</caption>
	<thead>
		<tr class="bg-dark text-light">
			<th>Code</th>
			<th>Subject</th>
			<th>Credits</th>
		</tr>
	</thead>
	<tbody>
		@foreach($courses as $c)
		@if($c->Semester=="Fall" || $c->Semester=="Both" )
		<tr>
			<th>{{$c->Code}}</th>
			<th>{{$c->Name}}</th>
			<th>{{$c->Credits}}</th>
		</tr>
		@endif

		@endforeach

	</tbody>

</table>
<br><br>
<table class="table text-center"  align="center">
	<caption class="text-center h3">Spring Semester</caption>
	<thead>
		<tr class="bg-dark text-light">
			<th>Code</th>
			<th>Subject</th>
			<th>Credits</th>
		</tr>
	</thead>
	<tbody>
		@foreach($courses as $c)
		
		@if($c->Semester=="Spring" || $c->Semester=="Both")
		
		<tr>
			<th>{{$c->Code}}</th>
			<th>{{$c->Name}}</th>
			<th>{{$c->Credits}}</th>
		</tr>
		@endif
	
		@endforeach

	</tbody>

</table>


</div>


@stop
