$students = DB::table('users')//select from users
->where('type', 'Student')
 ->whereNotIn('Id', function ($q) {//userid is not registered
$q->select('userid')->from('students');//id is not found in table students(not registered)
 })->get();
@extends('staff.main')


@section('content')

<div class="container">
  <h1 class="text-center">Students Registration</h1>
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

 <form class="" action="AddStudentReg" method="post">
@csrf

@if($students->isEmpty())
<h3 class="text-center alert alert-danger">No User To register.Kindly contact the Admin!!</h3>
@endif

@foreach($students as $st)

<div class="form-row justify-content-center ">
  <div class="form-group col-lg-6">
    <label for="Firstname" class="font-weight-bold">StudentID:</label>
<input type="text" name="stid" readonly value="{{$st->id}}"  class="form-control">
  </div>
  <div class="form-group col-lg-6">
    <label for="password" class="font-weight-bold">Password:</label>
<input type="text" name="password" readonly   value="{{$st->password}}" placeholder="Password" class="form-control">
<small class="alert text-danger font-weight-bold">@error('password'){{$message}}@enderror</small>
  </div>

</div>

<div class="form-row justify-content-center ">
  <div class="form-group col-lg-4">
    <label for="Firstname" class="font-weight-bold">Firstname:</label>
<input type="text" name="Firstname"  value="{{old('Firstname')}}"  placeholder="Firstname" class="form-control">
<small class="alert text-danger font-weight-bold">@error('Firstname'){{$message}}@enderror</small>
  </div>
  <div class="form-group col-lg-4">
    <label for="MiddleName"  class="font-weight-bold">MiddleName:</label>
<input type="text" name="MiddleName" value="{{old('MiddleName')}}"  placeholder="MiddleName" class="form-control">
<small class="alert text-danger font-weight-bold">@error('MiddleName'){{$message}}@enderror</small>
  </div>
  <div class="form-group col-lg-4">
    <label for="LastName" class="font-weight-bold">LastName:</label>
<input type="text" name="LastName" value="{{old('LastName')}}" placeholder="LastName"    class="form-control">
<small class="alert text-danger font-weight-bold">@error('LastName'){{$message}}@enderror</small>
  </div>
</div>

<div class="form-row justify-content-center ">
  <div class="form-group col-lg-4">
    <label for="phone" class="font-weight-bold">Phone:</label>
<input type="text" name="phone" value="{{old('phone')}}"  placeholder="Phone" class="form-control">
<small class="alert text-danger font-weight-bold">@error('phone'){{$message}}@enderror</small>
  </div>
  <div class="form-group col-lg-4">
    <label for="dob" class="font-weight-bold">Dob(mm/dd/yyyy):</label>
<input type="date"  name="dob" value="{{old('dob')}}" placeholder="Dob" class="form-control">
<small class="alert text-danger font-weight-bold">@error('dob'){{$message}}@enderror</small>
  </div>

  <div class="form-group col-lg-4">
    <label for="gender" class="font-weight-bold">Gender:</label>
    <select class="custom-select" name="gender" >
      <option value="" disabled selected>
        @if(old('gender'))
        {{old('gender')}}
        @elseif(!old('gender'))
           Student Gender
          @endif
          </option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>

<small class="alert text-danger font-weight-bold">@error('gender'){{$message}}@enderror</small>
  </div>

</div>
<div class="form-row justify-content-center ">
  <div class="form-group col-lg-4">
    <label for="email" class="font-weight-bold">Email:</label>
<input type="text" name="email" value="{{old('email')}}"  placeholder="Email" class="form-control">
<small class="alert text-danger font-weight-bold">@error('email'){{$message}}@enderror</small>
  </div>
  <div class="form-group col-lg-4">
    <label for="ssn" class="font-weight-bold">SSN:</label>
<input type="text" name="ssn" value="{{old('ssn')}}" placeholder="SSN" class="form-control">
<small class="alert text-danger font-weight-bold">@error('ssn'){{$message}}@enderror</small>
  </div>
  <div class="form-group col-lg-4">
    <label for="language" class="font-weight-bold">Language:</label>
<input type="text" name="language" value="{{old('language')}}" placeholder="Language"    class="form-control">
<small class="alert text-danger font-weight-bold">@error('language'){{$message}}@enderror</small>
  </div>
</div>

<div class="form-row justify-content-center ">
<div class="form-group col-lg-12">
  <div class="custom-file">
      <input class="custom-file-input" value="{{old('profile')}}" type=file name=profile  >
      <label  for="profile" class="custom-file-label">
        @if(old('profile'))
        {{old('profile')}}
        @elseif(!old('profile'))
         Choose file:
          @endif
      </label>
      <small class="alert text-danger font-weight-bold">@error('profile'){{$message}}@enderror</small>
  </div>
</div>
</div>
<div class="form-row justify-content-center">
  <div class="form-group col-lg-6">
  <button type="submit" class="btn btn-primary btn-block">Save</button>
  </div>
</div>
  @break
@endforeach

</form>
</div>
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
var fileName = $(this).val().split("\\").pop();
$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
@stoppublic function AddStudentReg(Request $request)
{
    $rules = [
          'password' => 'required',
          'Firstname' => 'required',
          'MiddleName' => 'required',
          'LastName' => 'required',
          'phone' => 'required|numeric|digits:8',
          'dob' => 'required|date',
          'gender' => 'required',
          'email' => 'required|email|unique:students',//unique email
          'ssn' => 'required|numeric',
          'language' => 'required',
          'profile' => 'required',
          ];
    $validator = Validator::make($request->all(), $rules);//check if all rule are true
          if ($validator->fails()) {//if rules are false
                return redirect('staff/studentreg')//return to the page
                ->withInput()
                ->withErrors($validator);//send errors
          } else {
              $data = $request->input();//get values from form
              try {
                  $student = new Student;//new Model
                  $student->Fname    = $data['Firstname'];
                  $student->Mname    = $data['MiddleName'];//set values
                  $student->Lname    = $data['LastName'];
                  $student->phone    = $data['phone'];
                  $student->dob      = $data['dob'];
                  $student->gender   = $data['gender'];
                  $student->email    = $data['email'];
                  $student->image    = $data['profile'];
                  $student->ssn      = $data['ssn'];
                  $student->userid   = $data['stid'];
                  $student->language = $data['language'];
                  $student->save();//insert values
            return redirect('staff/studentreg')->with('status', "Student Inserted successfully");//redirect with success message
              } catch (Exception $e) {
                  return redirect('staff/studentreg')->with('failed', "Operation Failed ".$e);//fail if error
              }
          }
}
