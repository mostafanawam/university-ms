@extends('staff.main')


@section('content')


<div class="container">
  <h1 class="text-center" >Student Information</h1>
  <br><br>

<script type="text/javascript">

/*$(document).ready(function(){
  $("#btnUpdate").click(function(){


alert($("#Firstname").val());
alert($("#MiddleName").val())
alert($("#LastName").val());
alert($("#phone").val());
alert($("#dob").val());
alert($("#gender").val());
alert($("#email").val());
alert($("#ssn").val());
alert($("#profile").val());
alert($("#language").val());
    $.ajax ({
   url:"route('staff.updatestudent')",
      method:'get',
      data:{
        id: $("#usrid").val(),
        Firstname:$("#Firstname").val(),
        MiddleName:$("#MiddleName").val(),
        LastName:$("#LastName").val(),
        phone:$("#phone").val(),
        dob:$("#dob").val(),
        gender:$("#gender").val(),
        email:$("#email").val(),
        ssn:$("#ssn").val(),
        profile:$("#profile").val(),
        language:$("#language").val()
      },

      success:function(out){

        alert(out.id);
      $('#studentinfo').removeClass('invisible').addClass('visible');
      $("#SearchId").val(success);
      alert(out.success);
       $("#fn").html(output.fn);
      }
    });
  });
});*/

</script>

@if(session('error'))
<div class="form-row justify-content-center">
  <div class="alert alert-danger col-lg-6 text-center alert-block" role="alert">
{{ session('error') }}
</div>
</div>
@endif

@if(session('success'))
<div class="form-row justify-content-center">
      <div class="alert alert-success col-lg-6 text-center alert-block" role="alert">
{{ session('success') }}
</div>
</div>
@endif



<form method="post" action="/getstudent">
@csrf
<div class="form-row justify-content-center">
    <div class="input-group  col-lg-6">

        <input type="text" id='SearchId' name='SearchId' value="{{old('SearchId')}}"
        class="form-control bg-dark border-0 text-light"
        placeholder="Search Student ID"
            aria-label="Search" aria-describedby="basic-addon2">


        <div class="input-group-append" class="">
            <button class="btn btn-primary" id='btnSearch' type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button >
        </div>

    </div>

  </div>
  <div class="form-row justify-content-center">
    <div class="col-lg-6 alert text-danger">
      @error('SearchId'){{$message}}@enderror
    </div>
  </div>

</form>

<br>

@if(session('userid'))
<form   method="post" action="updatestudent">
@csrf

<h1 class="text-center" >Student Information</h1>
<br>

<div class="form-row justify-content-center ">
  <div class="form-group col-lg-4">
    <label for="Firstname" class="font-weight-bold">Firstname:</label>
<input type="text" name="Firstname" id='Firstname' value="{{ session('fname') }}" placeholder="Firstname" class="form-control">
@error('Firstname')<small class="alert text-danger">{{$message}}</small>@enderror
</div>
  <div class="form-group col-lg-4">
    <label for="MiddleName" class="font-weight-bold">MiddleName:</label>
<input type="text" name="MiddleName" id='MiddleName'  value="{{ session('mname') }}" placeholder="MiddleName" class="form-control">
@error('MiddleName')<small class="alert text-danger">{{$message}}</small>@enderror
</div>
  <div class="form-group col-lg-4">
    <label for="LastName" class="font-weight-bold">LastName:</label>
<input type="text" name="LastName" id='LastName' placeholder="LastName" value="{{ session('lname') }}"   class="form-control">
@error('LastName')<small class="alert text-danger">{{$message}}</small>@enderror  
</div>
</div>

<div class="form-row justify-content-center ">
  <div class="form-group col-lg-4">
    <label for="phone" class="font-weight-bold">Phone:</label>
<input type="text" name="phone" id="phone" placeholder="phone" value="{{ session('phone') }}"  class="form-control">
@error('phone')<small class="alert text-danger">{{$message}}</small>@enderror  
</div>
  <div class="form-group col-lg-4">
    <label for="dob" class="font-weight-bold">Dob:</label>
<input type="date" name="dob" id="dob" placeholder="Dob" value="{{ session('dob') }}"  class="form-control">
@error('dob')<small class="alert text-danger">{{$message}}</small>@enderror    
</div>

  <div class="form-group col-lg-4">
    <div class="label">
      <label for="gender" class="font-weight-bold">Gender:</label>
    </div>

    <div class="form-check-inline">
      <input type="radio" class="form-check-input" name="gender" value="male" <?php if(session('gender')=="male") echo "checked"; ?>>
  <label class="form-check-label" for="inlineRadio1">male</label>
</div>
<div class="form-check-inline">
  <input type="radio" class="form-check-input" name="gender" value="female" <?php if(session('gender')=="female") echo "checked"; ?>>
  <label class="form-check-label" for="inlineRadio2">female</label>
</div>
@error('gender')<small class="alert text-danger">{{$message}}</small>@enderror
  </div>

</div>

<div class="form-row justify-content-center ">
  <div class="form-group col-lg-4">
    <label for="email" class="font-weight-bold">Email:</label>
<input type="text" name="email" id="email" placeholder="email" value="{{ session('email') }}"  class="form-control">
@error('email')<small class="alert text-danger">{{$message}}</small>@enderror 
</div>
  <div class="form-group col-lg-4">
    <label for="ssn" class="font-weight-bold">SSN:</label>
<input type="text" name="ssn" id="ssn" placeholder="ssn" value="{{ session('ssn') }}"   class="form-control">
@error('ssn')<small class="alert text-danger">{{$message}}</small>@enderror
  </div>

  <div class="form-group col-lg-4">
    <label for="language" class="font-weight-bold">Language:</label>
    <select class="custom-select" name="language" id="language">
      <option value="En" <?php if(session('language')=="En") echo "selected"; ?>>En</option>
      <option value="Fr" <?php if(session('language')=="Fr") echo "selected"; ?>>Fr</option>
    </select>

  </div>

</div>
<input type="hidden" id='usrid' name="usrid" value="{{ session('userid') }}">
<!--<div class="form-row justify-content-center ">
  <div class="form-group col-lg-4">
    <label for="" class="font-weight-bold">Profile:</label>
<img src="" class="rounded-circle"  alt="Student Profile" width="304" height="100">
</div>-->

  <!--<div class="form-group col-lg-8">
    <div class="custom-file">
        <input class="custom-file-input" type=file name=profile id=profile accept="image/png,image/gif,image/jpg">
        <label  for="txtPhoto" class="custom-file-label">Choose file:</label>
    </div>
  </div>
</div>-->


<div class="form-row justify-content-center">
  <div class="form-group col-lg-6">
  <button type="submit" class="btn btn-primary btn-block" id='btnUpdate'>Update</button>
  </div>
</div>

</form>
@endif


</div>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
@stop
