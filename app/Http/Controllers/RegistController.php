<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\FacultyMember;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Course;
use App\Models\Schedule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class RegistController extends Controller
{
    public function GetRegistration()
    {
    $courses=DB::table('enroll')//check if student already regist
    ->where('StudentId',session('student'))
    ->count();
    if($courses>0){
        return view("student.register",["alert"=>'You are already registered']);//if registered send error to regi page
    }
        else{
            return view("student.register");
        }
      
    }
    public function GetResults()
    {
        //results of each course
        $res = DB::table("doexam")
            ->where("IdStudent", session("student"))
            ->get();
        return view("student.results", ["results" => $res]);
    }
    public function coursesAll(Request $req)
    {
        //function to return the courses according to semester passed
        $courses1 = DB::table("courses")
            ->select("*")
            ->where("Semester", $req->Semester)
            ->orwhere("Semester", "Both")
            ->whereNotIn("Code", function ($query) {
                $query->select("Code")->from("courses_passed");//get courses not passed
            })
            ->get();

        /*$courses1=Course::where('Semester',$req->Semester)
         ->orwhere('Semester','Both')->get();*/
        return response()->json([
            "row" => "$courses1",
        ]);
    }
    public function RegisterCourses(Request $req)
    {
        //function to register course
        $courses = $req->courses; //get all courses
        foreach ($courses as $key) {
            //get each course
            $current_date_time = Carbon::now()->toDateTimeString(); //get the current date
            $res = DB::table("enroll")->insert([
                //insert into table enroll
                [
                    "StudentId" => session("student"),
                    "Code" => $key,
                    "date" => $current_date_time,
                ],
            ]);
        }
        if ($res == null) {
            $good = "error";
        } else {
            $good = "success";
        }

        $courses1 = implode(",", $courses); //add , to list of courses
        return response()->json([
            "res" => "$good",
            "courses" => $courses1,
        ]);
    }
    public function RegesteredCourses()//get courss registered to drop page
    {
        //function t o get all registered courses
        $reg_courses = DB::table("enroll")
            ->where("StudentId", session("student"))
            ->get();
        return view("student.dropcourse", ["reg_courses" => $reg_courses]);
    }
    public function DropCourse($code)//drop the course
    {
        //drop course with code passed
        $drop = DB::table("enroll")
            ->where("Code", "=", $code)
            ->delete();
        if ($drop) {
            return redirect("/student/dropcourse")->with(
                "status",
                "Course is successfully dropped"
            );
        } else {
            return redirect("/student/dropcourse")->with(
                "error",
                "Error in dropping course"
            );
        }
    }
}
