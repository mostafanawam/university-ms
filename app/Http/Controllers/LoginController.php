<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;

class LoginController extends Controller
{
    public function loginAdmin(Request $request)
    {
        $request->validate([
            'UserId' => 'required|digits:9', //only 9 digits id
            'password' => 'required|min:6',
        ]);
        $user = DB::table('users')
            ->where('id', $request->input('UserId')) //get user matcing with userid
            ->where('type', 'admin ') //get user matching with userid
            ->first();
        if ($user) {
            //if email username exists
            if ($user->password == $request->input('password')) {
                //  if(Hash::check($request->input('password'),$user->password)){//check hashed password matching

                $request->session()->put('admin', $request->input('UserId')); //add useerid to session
                return redirect('admin/main'); //go to home if correct
            } else {
                return redirect('admin/login')->with(
                    'error',
                    "Wrong Information"
                ); //wrong password return to login
            }
        } else {
            return redirect('admin/login')->with('error', "Wrong Information"); //wrong userid return to login
        }
    }

    function loginChief(Request $request)
    {
        $request->validate([
            'UserId' => 'required|digits:9', //only 9 digits id
            'password' => 'required|min:6',
        ]);
        $user = DB::table('users')
            ->join('facultymember', 'users.id', '=', 'facultymember.UserId') //join table usres with facultymember
            ->where('users.id', $request->input('UserId')) //get user matcing with userid
            ->where('users.type', 'Faculty Member') //get the type of user
            ->where('facultymember.isChief', 1) //check if facultymember is chief
            ->select('facultymember.*', 'users.*')
            ->first();

        if ($user) {
            //if UserID  exists
            if ($user->password == $request->input('password')) {
                //check if equal passwords
                $chief = DB::table('facultymember')
                    ->where('userId', $request->UserId)
                    ->get(); //get  information of chief

                foreach ($chief as $ch) {
                    $name = $ch->Fname . " " . $ch->Lname;
                   // $photo = $ch->image;
                }
                $request->session()->put('namechief', $name); //put data in sessions
                //$request->session()->put('image', $photo);
                $request->session()->put('chief', $request->UserId); //add useerid to session
                return redirect('chief/main');
            } else {
                return redirect('chief/login')->with(
                    'error',
                    "Wrong Information"
                );
            } //wrong password return to login;
            //end if password
        } else {
            return redirect('chief/login')->with('error', "Wrong Information");
        } //wrong password return to login;
        //end if $user
    }

    function loginStudent(Request $request)
    {
        $request->validate([
            'UserId' => 'required|digits:9', //only 9 digits id
            'password' => 'required|min:6',
        ]);
        $user = DB::table('users')
            ->join('students', 'users.id', '=', 'students.userid')
            ->where('users.id', $request->input('UserId')) //get user matcing with userid
            ->where('users.type', 'Student') //get user matching with userid
            ->where('students.isStudent', 1) //get user matching with userid
            ->first(); //nned to join to table and check if isstudent =1
        if ($user) {
            //if email username exists
            if ($user->password == $request->input('password')) {
                //  if(Hash::check($request->input('password'),$user->password)){//check hashed password matching
                //   $getuser=
                $student = DB::table('students')
                    ->where('userId', $request->UserId)
                    ->get();

                foreach ($student as $st) {
                    $namest = $st->Fname . " " . $st->Lname; //set the name of staff
                   // $photost = $st->image; //set the image of $staff
                }
                $request->session()->put('namestudent', $namest); //put staff name in session
               // $request->session()->put('image', $photost);
                $request->session()->put('student', $request->input('UserId')); //add useerid to session
                return redirect('student/main');
            } else {
                return redirect('student/login')->with(
                    'error',
                    "Wrong Information"
                ); //wrong password return to login
            }
        } else {
            return redirect('student/login')->with(
                'error',
                "Wrong Information"
            ); //wrong userid return to login
        }
    }

    function loginStaff(Request $request)
    {
        //function to login staff
        $request->validate([
            'UserId' => 'required|digits:9', //only 9 digits id
            'password' => 'required|min:6',
        ]);
        $user = DB::table('users')
            ->where('id', $request->input('UserId')) //get user matcing with userid
            ->where('type', 'Staff') //get user matching with userid
            ->first();
        if ($user) {
            //if email username exists
            if ($user->password == $request->input('password')) {
                //  if(Hash::check($request->input('password'),$user->password)){//check hashed password matching
                //   $getuser=
                $staff = DB::table('staff')
                    ->where('userId', $request->UserId)
                    ->get();

                foreach ($staff as $st) {
                    $namest = $st->Fname . " " . $st->Lname; //set the name of staff
                    //$photost = $st->image; //set the image of $staff
                }
                $request->session()->put('namestaff', $namest); //put staff name in session
                //$request->session()->put('image', $photost);
                $request->session()->put('staff', $request->input('UserId')); //add useerid to session
                return redirect('staff/main');
            } else {
                return redirect('staff/login')->with(
                    'error',
                    "Wrong Information"
                ); //wrong password return to login
            }
        } else {
            return redirect('staff/login')->with('error', "Wrong Information"); //wrong userid return to login
        }
    }
    function loginInstructor(Request $request)
    {
        $request->validate([
            'UserId' => 'required|digits:9', //only 9 digits id
            'password' => 'required|min:6',
        ]);
        $user = DB::table('users')
            ->join('facultymember', 'users.id', '=', 'facultymember.UserId') //join table usres with facultymember
            ->where('users.id', $request->input('UserId')) //get user matcing with userid
            ->where('users.type', 'Faculty Member') //get the type of user
            ->where('facultymember.isChief', 0) //check if facultymember is chief
            ->select('facultymember.*', 'users.*')
            ->first();

        if ($user) {
            //if UserID  exists
            if ($user->password == $request->input('password')) {
                //check if equal passwords
                $instr = DB::table('facultymember')
                    ->where('userId', $request->UserId)
                    ->get(); //get  information of chief

                foreach ($instr as $ch) {
                    $name = $ch->Fname . " " . $ch->Lname;
                   // $photo = $ch->image;
                }
                $request->session()->put('nameinstructor', $name); //put data in sessions
                //$request->session()->put('image', $photo);
                $request->session()->put('instructor', $request->UserId); //add useerid to session
                return redirect('instructor/main');
            } else {
                return redirect('instructor/login')->with(
                    'error',
                    "Wrong Information"
                );
            } //wrong password return to login;
            //end if password
        } else {
            return redirect('instructor/login')->with('error', "Wrong Information");
        } //wrong password return to login;
        //end if $user
    }

    function logout()
    {
        //delete session('admin') when logout
        if (session()->has('admin')) {
            session()->pull('admin');
        }
        return redirect('admin/login');
    }
    function logoutStaff()
    {
        //delete session('staff') when logout
        if (session()->has('staff')) {
            session()->pull('staff');
        }
        return redirect('staff/login');
    }
    function logoutChief()
    {
        //delete session('staff') when logout
        if (session()->has('chief')) {
            session()->pull('chief');
        }
        return redirect('chief/login');
    }
    function logoutStudent()
    {
        //delete session('staff') when logout
        if (session()->has('student')) {
            session()->pull('student');
        }
        return redirect('student/login');
    }
    public function Instructorlogout()
    {
       //delete session('staff') when logout
        if (session()->has('instructor')) {
            session()->pull('instructor');
        }
        return redirect('instructor/login');
    }
    
}
