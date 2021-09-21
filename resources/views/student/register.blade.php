@extends('student.main')
@section('content')

<h1 class="text-center">Courses Register</h1>
@isset($alert)
  
@if ($alert)<!-- if student is already register show error that cant register-->
<div class="form-row justify-content-center">
  <div class=" col-lg-6 ">
    	<div class="alert alert-danger text-center" role="alert">
        {{ $alert }}
</div>
</div>
</div>
@endif
@endisset
<br>
<div class="container" id='all'>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){//function to get the selected index in the combox
  $("select.Semester").change(function(){
    $("#tbCat").html("");
    $.ajaxSetup({ //if method == post
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
//var selectedSemester = $(this).children("option:selected").val();
$.ajax ({
     url:"{{url('/student/registration/getcourses')}}",
     method:'post',
     data:{
       Semester: $(this).children("option:selected").val()//set the selected value
     },
     success:function(output){
       var parsed = $.parseJSON(output.row);//parse the json
       if(parsed != false){//if not empty
         tble.style.visibility = 'visible';
         var totalcredits=0;
         $("#fill").html('');
             $.each(parsed, function (i, jsondata) {//loop in json to get all values
           $("#tbCat").append("<tr><th>"+jsondata.Name+"</th><th>"+jsondata.Credits+"</th><th><input id='rdb_"+jsondata.Code+"' onchange='handleChange("+jsondata.Credits+",this);' type=checkbox value="+jsondata.Code+"></th></tr>");
           totalcredits+=jsondata.Credits;//get the total credits
         });
         document.getElementById('credits').innerHTML=totalcredits;//fill total credits
       }
       else{
         tble.style.visibility = 'hidden';
         $("#fill").html("<div class='alert text-danger'>No Courses Available</div>");
       }
     }
   });
  });
});
var total=0;
function handleChange(course,code) {//course=nb of credits code=code of course
  //alert(code.value);
if(code.checked){//if checked add credits
  total=total+parseInt(course);
    document.getElementById('CreditsReg').innerHTML=total;//assign the total nb of credits registered
  }
else{//if not checked subtract credits
  total=total-parseInt(course);
    document.getElementById('CreditsReg').innerHTML=total;
}
}
</script>
<form   method="post" action=''>
  @csrf
<style media="screen">
table{
  text-align: center;
  font-size: 20px;
}
input[type=checkbox] {
  border: 0px;
  width: 100%;
  height: 2em;
}
</style>
<div class="form-row justify-content-center">
  <div class="col-lg-6 ">
    <select class="custom-select Semester" name="Semester" @isset($alert)disabled  @endisset><!-- disable if student already registered-->
      <option value="" disabled selected>Choose Semester</option>
      <option value="Fall">Fall</option>
      <option value="Spring">Spring</option>
    </select>
  </div>
</div>
<br>
<div class="form-row justify-content-center" >
  <div class="" id='fill'>

  </div>



  <table  class="table" id='tble' name='tble' style="visibility:hidden;">
    <thead>
      <th>Course</th>
      <th>Credits</th>
      <th>Register</th>
    </thead>
    <tbody id='tbCat'>
    </tbody>
<tfoot>
  <tr style="background-color:lightgray;">
    <th>Total Credits</th>
    <th id='credits'></th>
    <th id="CreditsReg">&nbsp;</th>
  </tr>

  <tr>
    <script type="text/javascript">
    function register() {

      var courses = [];
            $.each($("input[type='checkbox']:checked"), function(){//get the value of all checked checkbox
                courses.push($(this).val());//fill in array
            });


var cred=document.getElementById('CreditsReg').innerHTML;
      if(cred>30){
        alert("you cant register more than 30 credits");
      }else{
        $.ajaxSetup({ //if method == post
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }

    });

    $.ajax ({
         url:"{{url('/student/registration/register')}}",
         method:'post',
         data:{
           courses:courses //send array
         },
         success:function(output){
           if(output.res=="error"){
             alert("Registrstion error");
           }
           else{
              $("#all").html("<div class='alert alert-success text-center'>Courses Registered:"+output.courses+"</div>");
           }

           }
       });//end ajax
     }
      }
    </script>
    <th colspan="3" class="text-center">
      <button type="button" onclick="register();" class="btn  btn-primary">Register</button>
    </th>
  </tr>
</tfoot>
  </table>

</div>

</form>
@stop
