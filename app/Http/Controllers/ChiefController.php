<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\FacultyMember;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ChiefController extends Controller
{
    public function ChiefProfile($id)//get the data of the chief id passed parimeter
    {
        $info=DB::table('facultymember')
      ->where('userId', $id)
      ->get();
        return view('chief.profile', ['chief'=>$info]);
        
    }
    public function UpdateInfo(Request $req)//function to update the chief info
    {
        $rules = [
            'Fname' => 'required|',
            'Mname' => 'required|',
            'Lname' => 'required|',
            'phone' => 'required|digits:8',
            'dob' => 'required|',
            'Gender' => 'required|',
            'email' => 'required|email|unique:facultymember',
            'Grade' => 'required|',
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                        return redirect("chief/profile/$req->UserID")//return to the page
                        ->withInput()
                        ->withErrors($validator);//send errors
                    }
                    
        $affected = DB::table('facultymember')
          ->where('UserId', $req->UserID)
          ->update([
              'Fname' => $req->Fname,
              'Mname' => $req->Mname,
              'Lname' => $req->Lname,
              'phone' => $req->phone,
              'dob' => $req->dob,
              'gender' => $req->Gender,
              'email' => $req->email,
              'Grade' => $req->Grade,
          ]);

        if ($affected !== null) {
            return redirect("chief/profile/$req->UserID")->with(
                'status',
                "Profile Updated"
            );
        } else {
            return redirect("chief/profile/$req->UserID")->with(
                'error',
                "Profile Updated failed"
            );
        }
    }
    
    public function getInfo()//function to get all courses and instrcutors(fill in dropwdown to assign inst to course)
    {
        $inst=FacultyMember::all();//gett all the instructors
        $course=Course::all();//get all the courses
        return view('chief.assign', ['instructors'=>$inst],['courses'=>$course]);
    }

    public function assign(Request $req)//assign instr to course by add to table teaches courseid instid
    {
        $rules = [
            'instructor' => 'required|',
            'course' => 'required|',
            
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                        return redirect('/chief/AssignInstructor')//return to the page
                        ->withInput()
                        ->withErrors($validator);//send errors
                    }
                    
        $inst=DB::table('teaches')
        ->where('IdFacultyMember',$req->instructor)
        ->get();
        $course=DB::table('teaches')
        ->where('Code',$req->course)
        ->count();
         
        if ($course>0) {
            return redirect('chief/AssignInstructor')->with(
                'error',
                "This course is already assigned"
            );
        }else {
            DB::table('teaches')->insert([
                'IdFacultyMember' => $req->instructor,
                'Code' => $req->course
                 ]);
               return redirect('chief/AssignInstructor')->with(
                   'success',
                   "Instructor Assigned Successfully"
               );
        }

      
    }
    public function GetExam()//get exam page with info
    {
        $courses=Course::all();
       return view('chief.exam',["courses"=>$courses]);
    }
    public function AssignExam(Request $req)//assign the exam
    {
         
        $rules = [
            'course_code' => 'required|',
            'exam_type' => 'required|',
            'exam_date' => 'required|',
            'exam_time' => 'required|',
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                        return redirect('chief/exams')//return to the page
                        ->withInput()
                        ->withErrors($validator);//send errors
                    }
                    DB::table('exam')->insert([//insert exam type in table exam
                        'TypeExam' => $req->exam_type,
                       
                    ]);
                    $examid = DB::getPdo()->lastInsertId();//get the id of the exam inserted

                    $students=DB::table('enroll')//get students enrolled in the assigned exam subject
                    ->select("StudentId")
                    ->where('Code',$req->course_code)
                    ->get();
                    foreach ($students as $key) {//foreach student insert into table doexam
                        DB::table('doexam')->insert([//insert exam type in table exam
                            'IdExam' =>  $examid,
                            'IdStudent' => $key->StudentId,
                            'CodeCourse' => $req->course_code,
                            'Date' =>"$req->exam_date $req->exam_time",
                            //grade is null when grade is generated update the grade
                           
                        ]);
                    }
                    return  redirect('/chief/exams');
    
    } 
}
