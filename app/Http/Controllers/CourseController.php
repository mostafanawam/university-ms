<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Course;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{

    function GetCourses(){
        return view('chief.courses');
    }
    public function CoursesList()//according to semester
    {
      $courses=Course::all();
      return view('student.courses',['courses'=>$courses]);
    }


    function deleteCourse($code){//delete course where code passed

     $course = DB::table('courses')->where('Code', $code)->delete();
      if($course===null){//if user not found
        return redirect('chief/course')->with('status',"Course Not Found");
      }//else if found

        return redirect('chief/course')->with('status',"Course Deleted successfully");//redirect with success message
    }

    function ViewCourse($code){//ssend course info according to course code passed
      $course = DB::table('courses')->where('Code', $code)->get();
      return view('chief.updatecourse',['courses'=>$course]);
    }

    function UpdateCourse(Request $req){

      $affected = DB::table('courses')
          ->where('Code', $req->code)
          ->update([

              'Name' => $req->Name,
              'description' => $req->Description,
              'Credits' => $req->Credits,
              'Semester' => $req->Semester
          ]);

          if ($affected !== null) {
              return redirect('chief/course')->with(
                  'status',
                  "Course Updated"
              );
          } else {
              return redirect('chief/course')->with(
                  'error',
                  "Course Updated failed"
              );
          }
    }

      function InsertCourse(Request $req){//insert new course

        $rules = [
          'Code' => 'required|unique:courses|',
          'Name' => 'required|',
          'Description' => 'required|',
          'Credits' => 'required|numeric|digits:1',
          'Semester' => 'required|',

          ];
          $validator = Validator::make($req->all(),$rules);//check if all rule are true
          if ($validator->fails()) {//if rules are false
          			return redirect('chief/Addcourse')//return to the page
          			->withInput()
          			->withErrors($validator);//send errors
          		}

        $course=new Course;
        $course->Code=$req->Code;
        $course->Name=$req->Name;
        $course->description=$req->Description;
        $course->Credits=$req->Credits;
        $course->Semester=$req->Semester;
        $course->save();//save course info into database

          return redirect('chief/course')->with('status',"Course Added Successfully");

      }
      public function CheckPrereq()
      {
        $course = DB::table('prerequisite')
        ->get();
       
        return view("student.pre_req",["courses"=>$course]);
      }
      
      

}
