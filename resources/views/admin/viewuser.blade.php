@extends('admin.main')

@section('content')
<div class="container">


<h1 class="text-center">Update User</h1><br>


<form class="" action="/admin/update" method="post">
  @csrf

  <div class="form-row justify-content-center ">
    <div class="form-group col-lg-6">
      <label for="User ID" class="font-weight-bold">User ID:</label>
  <input type="text" name="UserID"  readonly value="{{$users->id}}"   class="form-control">
  <small class="alert text-danger font-weight-bold">@error('Name'){{$message}}@enderror</small>
    </div></div>



  <div class="form-row justify-content-center ">
    <div class="form-group col-lg-6">
      <label for="Password" class="font-weight-bold">Password:</label>
  <input type="text" name="Password" value="{{$users->password}}"   class="form-control">
  <small class="alert text-danger font-weight-bold">@error('Name'){{$message}}@enderror</small>
    </div></div>

    <div class="form-row justify-content-center ">
    <div class="form-group col-lg-6">

      <label for="Type" class="font-weight-bold">Type:</label>

      <select class="custom-select" name='Type' >{{$users->type}}
        <option value="Faculty Member" <?php  if($users->type=='Faculty Member') echo "selected";?>>Faculty Member</option>
        <option value="Student" <?php  if($users->type=='Student') echo "selected";?>>Student</option>
        <option value="Staff" <?php  if($users->type=='Staff') echo "selected";?>>Staff</option>
        <option value="Admin" <?php  if($users->type=='Admin') echo "selected";?>>Admin</option>
      </select>

  <small class="alert text-danger font-weight-bold">@error('Description'){{$message}}@enderror</small>
    </div>

  </div>
  <div class="form-row justify-content-center">
    <div class="col-lg-6">
      <input type="submit"  value="Update" class="btn btn-primary btn-block">
    </div>
  </div>
</form>

</div>
@stop
