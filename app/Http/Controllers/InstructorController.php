<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\FacultyMember;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Material;
class InstructorController extends Controller
{
    function InstructorList(){
      
    $instructor=FacultyMember::all();
    return view('admin/instructor',['instructors'=>$instructor]);
    }

    public function GetGrades()//return the view with students that enroll with the course that the instrcutor teach to submit gradess
    {    
        $list=DB::table('doexam')
        ->join('teaches','doexam.CodeCourse','=','teaches.Code')
        ->join('students','doexam.IdStudent','=','students.userid')
        ->where('IdFacultyMember',session('instructor'))
        ->select('IdStudent','Mname','Lname','Fname','Date','IdExam')
        ->get();
       
        return view("instructor.grades",["list"=>$list]);
    }
    public function GetMaterials()//get the view that make instructor upload materials
    {
        return view("instructor.materials");
    }
    public function UploadMaterials(Request $req)//upload materials to students
    {    
        $rules = [
            'file_name' => 'required|',
            'file_description' => 'required|',
            'upload_file' => 'required|mimes:pdf,docs,doc,xlx,xlxs,zip,png,jpg,txt,mp4|max:2048',//2mb 
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                        return redirect('/instructor/materials')//return to the page
                        ->withInput()
                        ->withErrors($validator);//send errors
                    }
                    $data=new Material;//new instance from class
                    $file=$req->upload_file;
                    $filename=time().'.'.$file->getClientOriginalExtension();
                    $req->upload_file->move('assets',$filename);//move file to assets

                    $data->file=$filename;
                    $data->name=$req->file_name;
                    $data->description=$req->file_description;
                    $data->save();//insert into database
                    return redirect()->back();
                    

    }
    public function ShowMaterials()//function to send all materials uploaded
    {
        $data=Material::all();
       return view("student.materials",["data"=>$data]);
    }
    public function DownloadFile($file)//function to donwload the passed file
    {
         return response()->download(public_path('assets/'.$file));//download the filepassed
    }
    public function InstructorProfile($id)//get the info of the user where id passed
    {
        $info=DB::table('facultymember')
      ->where('userId', $id)
      ->get();
        return view('instructor.profile', ['instr'=>$info]);
    }
    public function UpdateInfo(Request $req)//function to update the information of the user
    {
        
        $rules = [
            'Fname' => 'required|',
            'Mname' => 'required|',
            'Lname' => 'required|',
            'phone' => 'required|digits:8',
            'dob' => 'required|',
            'Gender' => 'required|',
            'email' => 'required|',
            'Grade' => 'required|',
            ];
         
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                        return redirect('instructor/profile/'.$req->UserID.'')//return to the page
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
              'gender' => $req->gender,
              'email' => $req->email,
              'Grade' => $req->Grade,
          ]);

        if ($affected !== null) {
            return redirect('instructor/profile/'.$req->UserID.'')->with(
                'status',
                "Profile Updated"
            );
        } else {
            return redirect('instructor/profile/'.$req->UserID.'')->with(
                'error',
                "Profile Updated failed"
            );
        }
    }
    public function SubmitGrades(Request $req)//function to submit the graddes of each student 
    {
        $affected = DB::table('doexam')
          ->where('IdStudent', $req->id)
          ->where('IdExam',$req->idexam)
          ->update([
              'Grade' => $req->grade,
          ]);
          if ($affected !== null) {
            return response()->json([
                "res" => "Grades Submitted successfuly",
            ]);
        }
    }
    public function GetAttendance()//return the student enroll in the course to taake attendance
    {
        $room=DB::table('room')->get();
        $courses=DB::table('teaches')
        ->where('IdFacultyMember',session('instructor'))
        ->get();
       
        return view("instructor.attendance",["rooms"=>$room,"courses"=>$courses]);
       
    }
    public function CreateLecture(Request $req)//insert into db values
    {
        $lectureid=DB::table('lecture')->insert([
                'TypeLecture' => $req->type_lecture,
        ]);
        $student=DB::table('enroll')//get the students enrolled with course passed
        ->join("students","enroll.StudentId","=","students.userid")
        ->where('enroll.Code',$req->code_course)
        ->get();
        $courses=DB::table('teaches')
        ->where('IdFacultyMember',session('instructor'))
        ->get();
        $room=DB::table('room')->get();
        $student->room=$req->id_room;

       
    
        return view('instructor.attendance', ['students'=>$student,"rooms"=>$room,"courses"=>$courses]);
           /* return response()->json([
                "res" =>$student->Code ,
                "row"=>
                " <tr>
                <td>$student->StudentId</td>
                <td>$student->Fname $student->Mname $student->Lname</td>
                <td><input type='checkbox' style='width:40px;height:40px;' name=''></td>
                </tr>
                "
            ]); */
        
         
       // return redirect()->back();
    }
  
    public function SubmitAttendance(Request $req)
    {
        
        $lecture=DB::table('lecture')//get the id of the latest
        ->max('Id');
        $attending=DB::table('attend')->insert([
            'IdLecture' => $lecture,
            'IdRoom' => $req->room,
            'IdFacultyMember' =>session('instructor'),
            'IdStudent' => $req->id,
        ]);
        if ($attending) {
            return response()->json([
                "res"=>"Attendance is submitted"
            ]); 
        }
        else{
            return response()->json([
                "res"=>"Error"
            ]);
        }
            
    }
    

}
