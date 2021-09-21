@extends('chief.main')


@section('content')


<div class="container">


<h1 class="text-center">Courses List</h1>

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

</div>
<style media="screen">
.form-input
 {
     width: 450px;
     height: 30px;
 }
</style>

<div class="container">
        <livewire:livewire-datatables/>
</div>

@stop
