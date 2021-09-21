
	@extends('admin.main')

@section('content')
<form class=""  method="post">
	  @csrf

<div class="container">

	<h1 class="text-center">Users List</h1>
	<br>
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


<div class="container">
				<livewire:user-data-table/>
</div>


</form>

@stop
