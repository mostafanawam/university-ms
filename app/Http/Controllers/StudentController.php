<?php

namespace App\Http\Controllers;
use App\Mail\Testmail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Student;
use App\Models\User;
use App\Http\Controllers\Exception;
class StudentController extends Controller
{


      public function apply(Request $request)//function to apply new student save values into table student with isstudent=0
      {
        $rules = [
              'firstname' => 'required',
              'middlename' => 'required',
              'lastname' => 'required',
              'phone' => 'required|numeric|digits:8',
              'dob' => 'required|date',
              'email' => 'required|email|unique:students',//unique email
              'language' => 'required',
              ];
        $validator = Validator::make($request->all(), $rules);//check if all rule are true
              if ($validator->fails()) {//if rules are false
                    return redirect('/student/apply')//return to the page
                    ->withInput()
                    ->withErrors($validator);//send errors
              } else {
                  $data = $request->input();//get values from form
                  try {
                      $user=new User;
                      $user->id=$data['userid'];
                      $user->password=$data['password'];
                      $user->type="Student";
                      $user->save();
                      $student = new Student;//new instance from Model Student
                      $student->Fname    = $data['firstname'];
                      $student->Mname    = $data['middlename'];//set values
                      $student->Lname    = $data['lastname'];
                      $student->phone    = $data['phone'];
                      $student->dob      = $data['dob'];
                      $student->gender   = $data['gender'];
                      $student->email    = $data['email'];
                      //$student->image    = $data['profile'];
                      //$student->ssn      = $data['ssn'];
                      $student->userid   = $data['userid'];
                      $student->language = $data['language'];
                      $student->isStudent =0;
                      $student->save();//insert values

                $details=[
                 'title' => 'Application Success',
                 'body' => "
                 Dear ".$data['firstname']." ".$data['lastname'].",Your Admission Application has been sent to us and our team will study it point by point.

                 Will reply to you within one week with the acceptance paper in the major you're capable for
                 
                 Till then, we are ready to assist you through our online chat methods.
                 
                 As always, best wishes for a reproductive and successful year
                 
                 Regards
                 "
                ];
                      Mail::to($data['email'])->send(new Testmail($details));//send email to student when apply


                return redirect('student/apply')
                ->with('id', $data['userid'])
                ->with('password', $data['password']);
                //redirect with success message
                  } catch (Exception $e) {
                      return redirect('student/apply')->with('failed', "Operation Failed ".$e);//fail if error
                  }
              }
      }
    public function SearchStudent(Request $req)
    {
        $req->validate([
           'SearchId'=>'required|digits:9',//only 9 digits id
         ]);

        $student = Student::where('userid', '=', $req->SearchId)->first();//get student info with requested id
        if ($student === null) {//check if student exist
            return redirect('staff/studentinfo')->with(
                'error',
                "Student with id:" . $req->SearchId . " does not exist"
            );
        } else {
            return redirect('staff/studentinfo')
                ->with('fname', $student->Fname)
                ->with('mname', $student->Mname)
                ->with('lname', $student->Lname)
                ->with('phone', $student->phone)
                ->with('dob', $student->dob)
                ->with('gender', $student->gender)
                ->with('email', $student->email)
                ->with('image', $student->image)
                ->with('ssn', $student->ssn)
                ->with('userid', $student->userid)
                ->with('language', $student->language);
        }
    }

    public function UpdateStudent(Request $request)//function to update student info by staff
    {
        $rules = [
            'Firstname' => 'required',
            'MiddleName' => 'required',
            'LastName' => 'required',
            'phone' => 'required|numeric|digits:8',
            'dob' => 'required|date',
            'gender' => 'required',
            'email' => 'required|email|unique:students',
            'ssn' => 'required',
            'language' => 'required' 
            ];
      $validator = Validator::make($request->all(), $rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                  return redirect('/staff/studentinfo')//return to the page
                  ->withInput()
                  ->withErrors($validator);//send errors
            }

        $fn = $request->input('Firstname');
        $mn =$request->input('MiddleName');
        $ln = $request->input('LastName');
        $phone =$request->input('phone');
        $dob =$request->input('dob');
        $gender = $request->input('gender');
        $email =$request->input('email');
        $ssn =$request->input('ssn');
        $profile = $request->input('profile');
        $language =       $request->input('language');

        $affected = DB::table('students')
            ->where('userid', $request->input('usrid'))
            ->update([
                'Fname' => $fn,
                'Mname' => $mn,
                'Lname' => $ln,
                'phone' => $phone,
                'dob' => $dob,
                'gender' => $gender,
                'email' => $email,
                'ssn' => $ssn,
                'language' => $language,
                'image' => $profile,
            ]);

        if ($affected !== null) {
            return redirect('staff/studentinfo')->with(
                'success',
                "Student Updated"
            );
        } else {
            return redirect('staff/studentinfo')->with(
                'error',
                "Student Updated failed"
            );
        }
    }

    public function GetStudent()//get all students where isstudent=0 list of all students that are not complete there reg
    {
     $students = DB::table('students')//select from users
     ->where('isStudent', 0)
      ->get();
        return view('staff.studentReg', ['students'=>$students]);
    }

    public function AddStudentReg($id)//update student make isstudnt=1 student Registered
    {
      $affected = DB::table('students')
          ->where('Id', $id)
          ->update([
            'isStudent'=>1
          ]);
          if ($affected !== null) {
              return redirect('/staff/studentreg')->with(
                  'success',
                  "Student Registered"
              );
            }

    }

    public function StudentList()//get all student where isstudent=1 registered student
    {
        $student=Student::all();
        return view('admin/student', ['students'=>$student]);
    }
    public function StudentProfile($id)
    {
      //get the data of the staff id passed parimeter
          $info=DB::table('students')
          ->where('userid', $id)
          ->get();
          return view('student.profile', ['student'=>$info]);
    }
    public function UpdateInfo(Request $req)//student update his info
    {
        $rules = [
            'Email' => 'required|email|unique:students',
            'Firstname' => 'required|',
            'MiddleName' => 'required|',
            'LastName' => 'required|',
            'Phone' => 'required|',
            'DOB' => 'required|',
            'Gender' => 'required|',
            'language' => 'required|'   
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                        return redirect("/student/profile/$req->UserID")//return to the page
                        ->withInput()
                        ->withErrors($validator);//send errors
                    }

        $affected = DB::table('students')
          ->where('userid', $req->UserID)
          ->update([
              'Fname' => $req->Firstname,
              'Mname' => $req->MiddleName,
              'Lname' => $req->LastName,
              'phone' => $req->Phone,
              'dob' => $req->DOB,
              'gender' => $req->Gender,
              'email' => $req->Email,
              'language'=>$req->language
          ]);

        if ($affected !== null) {
            return redirect("/student/profile/$req->UserID")->with(
                'status',
                "Profile Updated"
            );
        } else {
            return redirect("/student/profile/$req->UserID")->with(
                'error',
                "Profile Updated failed"
            );
        }
    }
    public function ViewApp()
    {
        return view("student.viewapp");
    }
    public function LoginApplication(Request $req)
    {
        $rules = [
            'userid' => 'required|digits:9',
            'password' => 'required|',
              
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                        return redirect("/student/viewapp")//return to the page
                        ->withInput()
                        ->withErrors($validator);//send errors
                    }

                    $user = DB::table('users')
                    ->join('students', 'users.id', '=', 'students.userid')
                    ->where('users.id', $req->userid) //get user matcing with userid
                    ->where('users.type', 'Student') //get user matching with userid
                    ->where('students.isStudent', 0) //get user matching with userid
                    ->first();
                      if ($user) { 
                    if ($user->password == $req->password){
                        return redirect('/student/viewapp')
                        ->with('fname',$user->Fname)
                        ->with('mname',$user->Mname)
                        ->with('lname',$user->Lname)
                        ->with('phone',$user->phone)
                        ->with('email',$user->email)
                        ->with('dob',$user->dob)
                        ->with('language',$user->language)
                        ->with('gender',$user->gender)
                        ->with('user',$user->userid);
                    }
                }
    }
    public function UpdateApplication(Request $req)
    {
        $rules = [
            'email' => 'required|email|unique:students',
            'firstname' => 'required|',
            'middlename' => 'required|',
            'lastname' => 'required|',
            'phone' => 'required|',
            'dob' => 'required|',
            'gender' => 'required|',
            'language' => 'required|'   
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                        return redirect("/student/viewapp")//return to the page
                        ->withInput()
                        ->withErrors($validator);//send errors
                    }

        $affected = DB::table('students')
        ->where('userid', $req->userid)
        ->update([
            'Fname' => $req->firstname,
            'Mname' => $req->middlename,
            'Lname' => $req->lastname,
            'phone' => $req->phone,
            'dob' => $req->dob,
            'gender' => $req->gender,
            'email' => $req->email,
            'language'=>$req->language
        ]);
         if ($affected !== null) {
            return redirect("/student/viewapp")->with(
                'succcess',
                "Application Updated"
            );
        } else {
            return redirect("/student/viewapp")->with(
                'error',
                "Application Update failed"
            );
        }
    }

}
