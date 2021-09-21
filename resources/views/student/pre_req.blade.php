@extends('student.main')


@section('content')

<div class="container">
    <h1 class="text-center">Courses Pre-requisite</h1>
    <br>
    <table class="table text-center" align="center" border=1>
        <tr class="bg-dark text-light">
            <th>Course</th>
            <th>Pre-requisite</th>
        </tr>
        @foreach ($courses as $c)
            <tr>
                <th>{{$c->Code}}</th>
                <th>{{$c->CodePre}}</th>
            </tr>
        @endforeach


    </table>
</div>

@stop