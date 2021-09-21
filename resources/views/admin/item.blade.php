@extends('admin.main')




@section('content')

<div class="container">
	<!-- Page Heading -->
	<h1 class="text-center">Manage Items</h1>
	<br>
		<br>
			<!--  <p class="mb-4">Chart.js is a third party plugin that is used to generate the charts in this theme.
                The charts below have been customized - for further customization options, please visit the <a
                    target="_blank" href="https://www.chartjs.org/docs/latest/">official Chart.js
                    documentation</a>.</p>-->
			<form   method="post">
				<!-- Content Row -->
				<div class="row">

              @if (session('status'))


					<div class="alert alert-success col-lg-12 text-center alert-block" role="alert">

              {{ session('status') }}
              </div>
              @endif

					<table class=" table tableItem" >
						<thead>
							<th>Name</th>
							<th>Quantity</th>
							<!--  <th>IsAvailable</th>-->
							<th>Option</th>
						</thead>

                    @foreach ($items as $item)



						<tr>
							<td data-label='Name'>{{$item->name}}</td>
							<td data-label='Quantity'>{{ $item->quantity}}</td>
							<!--	<td data-label='IsAvailable'><label class="switch">
                                  @if($item->quantity>0)
                                <input type="checkbox" checked disabled>
                                @else
                                <input type="checkbox" disabled>
                                @endif
                                <span class="slider round" ></span></label></td>-->
							<script type="text/javascript">
function confirm1(id) {
  var del=confirm("Do you want to delete item?");//ask the user if want to delete
  if(del){//if yes => delete item
    let stateObj = { id: "100" };
               window.history.replaceState(stateObj,
                           "delete", "/admin/deleteitem/"+id);
  }
}

</script>
							<td data-label='Option'>
								<a href="" onclick="confirm1('{{$item->id}}')" class="text-danger" ><!-- onclick ask if want to delete-->
									<i class="fas fa-trash fa-2x"></i></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;

								<a href="updateitem/{{$item->id}}" >
									<i class="fas fa-edit fa-2x"></i>
								</a>
							</td>
							<!--<td><a href="/delete/{{ $item->id }}"> Delete </a></td>-->
						</tr>
                    @endforeach

						<tr></tr>
					</table>
				</div>
			</form>
			<!-- /.container-fluid -->
		</div>
@stop
