<div>


  <div class="row mb-4">
    <div class="col form-inline">
      per page: &nbsp;
      <select class="custom-select" wire:model="perpage">
        <option value="2">2</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="25">25</option>
      </select>
    </div>
    <div class="col ">
      <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Users...">
    </div>
  </div>
<div class="table-responsive">
  <table class="table data-table" id='UserTable'>
    <thead>
      <tr>

        <th style="cursor:pointer;" wire:click="sortBy('id')">UserID @include('partials.sorticon',['field'=>'id'])</th>
        <th style="cursor:pointer;" wire:click="sortBy('password')">Password @include('partials.sorticon',['field'=>'password'])</th>
        <th style="cursor:pointer;" wire:click="sortBy('type')">Type @include('partials.sorticon',['field'=>'type'])</th>
        <th>Option</th>
      </tr>
    </thead>
    <?php $i=0; ?>
@foreach ($users as $user)


    <tr>

      <td>{{$user->id}}</td>
      <td>{{ $user->password}}</td>
      <td>{{ $user->type}}</td>
      <td>
        <script type="text/javascript">
        function confirm1(id) {
          var del=confirm("Do you want to delete user?");//ask the user if want to delete
          if(del){//if yes => delete item
            let stateObj = { id: "100" };
                       window.history.replaceState(stateObj,
                                   "delete", "/admin/deleteuser/"+id);
          }
        }
        </script>

        <a onclick="confirm1('{{$user->id}}')" href=""> <i class="fas fa-trash text-danger fa-2x"></i></a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="viewuser/{{$user->id}}"> <i class="fas fa-edit fa-2x "></i> </a>
      </td>
      <!--<td><a href="/delete/{{ $user->id }}"> Delete </a></td>-->
    </tr>
@endforeach
  </table>
  </div>
  <p>showing  {{$users->firstItem()}} to {{$users->lastItem()}} out of {{$users->total()}} items</p>


          <p > {{ $users->links() }} </p>
</div>
