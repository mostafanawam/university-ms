<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Staff;
use App\Models\User;

class StaffController extends Controller
{
    public function GetProfile($id)
    {//get the data of the staff id passed parimeter
        $info=DB::table('staff')
        ->where('userId', $id)
        ->get();
        return view('staff.profile', ['staff'=>$info]);
    }
    public function StaffList()
    {
        $staff=Staff::all();
        return view('admin/staff', ['staffs'=>$staff]);
    }

    public function UpdateInfo(Request $req)
    {
        $rules = [
            'Firstname' => 'required|',
            'MiddleName' => 'required|',
            'LastName' => 'required|',
            'Phone' => 'required|digits:8',
            'DOB' => 'required|',
            'Gender' => 'required|',
            'Email' => 'required|',
            
            ];
         
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                        return redirect('staff/profile/'.$req->UserID.'')//return to the page
                        ->withInput()
                        ->withErrors($validator);//send errors
                    }

        $affected = DB::table('staff')
          ->where('userId', $req->UserID)
          ->update([
              'Fname' => $req->Firstname,
              'Mname' => $req->MiddleName,
              'Lname' => $req->LastName,
              'phone' => $req->Phone,
              'dob' => $req->DOB,
              'gender' => $req->Gender,
            
              'email' => $req->Email,
              'salary' => $req->Salary,
          ]);

        if ($affected !== null) {
            return redirect('staff/profile/'.$req->UserID.'')->with(
                'status',
                "Profile Updated"
            );
        } else {
            return redirect('staff/profile/'.$req->UserID.'')->with(
                'error',
                "Profile Updated failed"
            );
        }
    }
}
