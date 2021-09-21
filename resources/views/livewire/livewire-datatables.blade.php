<div class="">

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
      <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Courses...">
    </div>
  </div>
<div class="table-responsive">


  <table class="table" >
    <thead>
      <tr>
        <th style="cursor:pointer;" wire:click="sortBy('Code')">Code @include('partials.sorticon',['field'=>'Code'])</th>

        <th style="cursor:pointer;" wire:click="sortBy('Name')">Name @include('partials.sorticon',['field'=>'Name'])</th>

        <th style="cursor:pointer;" wire:click="sortBy('description')"> Description @include('partials.sorticon',['field'=>'description'])</th>

          <th style="cursor:pointer;" wire:click="sortBy('Credits')">Credits @include('partials.sorticon',['field'=>'Credits'])</th>

          <th style="cursor:pointer;" wire:click="sortBy('Semester')">Semester @include('partials.sorticon',['field'=>'Semester'])</th>
            <th >Options</th>
      </tr>
    </thead>
    <tbody>
      @foreach($courses as $course)
        <tr>
          <td>{{$course->Code}}</td>
          <td>{{$course->Name}}</td>
          <td>{{$course->description}}</td>
          <td>{{$course->Credits}}</td>
          <td>{{$course->Semester}}</td>
          <td>

            <script type="text/javascript">
            function confirm1(id) {
            var del=confirm("Do you want to delete course?");//ask the user if want to delete
            if(del){//if yes => delete item
            let stateObj = { id: "100" };
             window.history.replaceState(stateObj,
                         "delete", "/chief/deletecourse/"+id);
            }
            }

            </script>
            <a href="" onclick="confirm1('{{$course->Code}}')" class="text-danger"> <i class="fas fa-trash fa-2x"></i></a>
            	&nbsp;&nbsp;
            <a href="viewcourse/{{$course->Code}}" class="text-primary"> <i class="fas fa-edit fa-2x"></i> </a>
           </td>
        </tr>
      @endforeach
    </tbody>

  </table>

<p>showing  {{$courses->firstItem()}} to {{$courses->lastItem()}} out of {{$courses->total()}} items</p>


        <p > {{ $courses->links() }} </p>
</div><!-- end table responsive -->

</div>
