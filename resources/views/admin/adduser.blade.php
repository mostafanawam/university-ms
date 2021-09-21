
@extends('admin.main')

@section('content')

<script type="text/javascript">
function get() {
  var selected=$( "#type" ).val();
  if(selected=="Admin"){
    $( "#fn" ).remove();
    $( "#mn" ).remove();
    $( "#ln" ).remove();
  }
  else{
    var inp1="<input type='text' name='firstname' placeholder='firstname' id='fn' class='form-control'>";
    var inp2="<input type='text' name='middlename' placeholder='middlename' id='mn' class='form-control'>";
    var inp3="<input type='text' name='lastname' placeholder='lastname'  id='ln' class='form-control'>";
    $( "#inp1" ).html(inp1);
    $( "#inp2" ).html(inp2);
    $( "#inp3" ).html(inp3);
  }
}


</script>

<div class="container">


<h1 class="text-center">Add User</h1>
<br>
<form class="" action="/admin/user/adduser" method="post">
@csrf

  <div class="form-row justify-content-center">

    <div class="form-group col-md-6 col-lg-6">
      <?php
  $id=floor(time()-999999999);
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomString = '';
for ($i = 0; $i < 6; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
}

?>
<label for="">User ID:</label>
      <input type="text" class="form-control" readonly id=userid name="userid" value="{{$id}}" placeholder="User ID">
@error('userid'){{$message}}@enderror

      </div>

    </div>
    <div class="form-row justify-content-center">

      <div class="form-group col-md-6 col-lg-6">
        <label for="">Password:</label>
        <input type="text" class="form-control" name="password" value="{{$randomString}}" placeholder="User Password">
@error('password'){{$message}}@enderror

        </div>
      </div>

      <div class="form-row justify-content-center">
        <div class="form-group col-md-6 col-lg-6 ">
          <label for="">Type:</label>

          <select class="custom-select" name='type' id='type' onchange="get()" >
            <option value="" disabled selected>Select User Type</option>
            <option value="Faculty Member">Faculty Member</option>
            <option value="Staff">Staff</option>
            <option value="Admin">Admin</option>
          </select>
@error('type'){{$message}}@enderror

          <!--<div class="invalid-feedback">Example invalid custom select feedback</div>-->
        </div>
      </div>
<div class="form-row justify-content-center">
  <div class="form-group col-lg-2 " id="inp1">
    <input type="text" name="firstname" placeholder="firstname" id='fn' class="form-control">
    @error('firstname'){{$message}}@enderror
  </div>
  <div class="form-group col-lg-2 " id="inp2">
    <input type='text' name='middlename' placeholder='middlename' id='mn' class='form-control'>
    @error('middlename'){{$message}}@enderror
  </div>
  <div class="form-group col-lg-2 " id="inp3">
    <input type='text' name='lastname' placeholder='lastname'  id='ln' class='form-control'>
    @error('lastname'){{$message}}@enderror
  </div>

</div>

      <div class="form-row justify-content-center">
        <div class="col-lg-6">
          <input type="submit"  value="Insert" class="btn btn-primary btn-block">
        </div>
      </div>



    </form>
</div>
@stop
