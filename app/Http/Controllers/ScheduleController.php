<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\FacultyMember;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Models\Course;
use App\Models\Schedule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ScheduleController extends Controller
{
  public function getInfo()//function to get all courses and instrcutors(fill in dropwdown to assign inst to course)
  {
      $instructors=FacultyMember::all();//gett all the instructors
      $courses=Course::all();//get all the courses
      $schedule=DB::table('schedule')
      ->orderBy('time_start', 'asc')
      ->get();
      return view('staff.schedule',compact('instructors','courses','schedule'));

  }
  public function set_day1(Request $req)//add sessions to schedule
  {
    $rules = [
      'from_1' => 'required|',
      'to_1' => 'required|',
      'instructor_1' => 'required|',
      'course_1' => 'required|',    
      ];
   
      $validator = Validator::make($req->all(),$rules);//check if all rule are true
      if ($validator->fails()) {//if rules are false
                  return redirect('/staff/schedule')//return to the page
                  ->withInput()
                  ->withErrors($validator);//send errors
              }

    $day_1=new Schedule;
    $day_1->day_nb=$req->day;
    $day_1->time_start= $req->from_1;
    $day_1->time_end=$req->to_1;
    $day_1->instructor=$req->instructor_1;
    $day_1->course=$req->course_1;
    $day_1->save();
    return redirect('staff/schedule');
  }
  public function get_schedule()//get sched and displa to students
  {
    $schedule=DB::table('schedule')
    ->orderBy('time_start', 'asc')
    ->get();
     
    return view('student.schedule',["schedule"=>$schedule]);

  }
  public function deleteSession($id)//delete session according to passed id
  {
    $session=Schedule::find($id);
    $session->delete();
    return redirect('/staff/schedule');
  }
}
