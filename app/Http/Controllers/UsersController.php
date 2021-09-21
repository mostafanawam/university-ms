<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Staff;
use App\Models\FacultyMember;
use App\Rules\MatchOldPassword;
class UsersController extends Controller
{
    //
    public function userlist()//get the list of users from DB
    {
      return view('admin.user'); //go to users page with users list
    }
    public function adduser(Request $request)//function to insert users into DB
    {
          if($request->type=="Admin"){
            $rules = [
          'userid' => 'required|digits:9',//9 digits id is accepted
          'password' => 'required|min:6|max:12',//password between 6-12
            ];
          }
          else{
            $rules = [
          'userid' => 'required|digits:9',//9 digits id is accepted
          'password' => 'required|min:6|max:12',//password between 6-12
          'firstname'=>'required',
          'middlename'=>'required',
          'lastname'=>'required',
          'type' => 'required',
          ];
          }

          $validator = Validator::make($request->all(),$rules);//check if all rule are true
          if ($validator->fails()) {//if rules are false
          			return redirect('admin/adduser')//return to the page
          			->withInput()
          			->withErrors($validator);//send errors
          		}
              else{
                    $data = $request->input();//get values from form
        			try{
        				       $user = new User;//new Model
                        $user->id = $data['userid'];//set values
                        $user->password =  $data['password'];
        				        $user->type = $data['type'];
                      	$user->save();//insert values

                        if($data['type']=='Faculty Member'){//add userid to fac_member table
                          $fm = new FacultyMember;//new Model
                         $fm->UserId=$data['userid'];
                         $fm->Fname=$data['firstname'];
                         $fm->Mname=$data['middlename'];
                         $fm->Lname=$data['lastname'];
                         $fm->isChief=0;
                            $fm->save();
                        }
                        if($data['type']=='Staff'){//add userid to fac_member table
                          $fm = new Staff;//new Model
                         $fm->UserId=$data['userid'];
                         $fm->Fname=$data['firstname'];
                         $fm->Mname=$data['middlename'];
                         $fm->Lname=$data['lastname'];
                            $fm->save();
                        }


        				return redirect('/admin/userlist')->with('status',"User Inserted successfully");//redirect to users with success message
        			}
        			catch(Exception $e){
        				return redirect('/admin/userlist')->with('failed',"Operation Failed");//fail if error
  			}
  		}
    }

    function deleteuser($id){//function to delete user
        $user = User::find($id);//find if id passed in the url exist
        if(!$user){//if user not found
          return redirect('/admin/userlist')->with('status',"User Not Found");
        }//else if found
        $user->delete(); //delete user
          return redirect('/admin/userlist')->with('status',"User Deleted successfully");//redirect with success message
    }

    function ViewUser($id){//return the user data passed through parimeter
      $users = User::find($id);
      return view('admin.viewuser',['users'=>$users]);
    }

    function UpdateUser(Request $req){//update user data
      $affected = DB::table('users')
          ->where('id', $req->UserID)
          ->update([
              'Password' => $req->Password,
              'Type' => $req->Type,
          ]);

          if ($affected !== null) {//if updated
              return redirect('admin/userlist')->with(
                  'status',
                  "User Updated"
              );
          } else {
              return redirect('admin/userlist')->with(//not updated
                  'error',
                  "User Updated failed"
              );
          }
    }

    public function ChangePassword(Request $req){//change the password of admin
      $rules = [
          'CurrentPassword' => 'required|',
          'NewPassword' => 'required|min:6|max:12',
          'new_confirm_password' => 'required|same:NewPassword',
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                  return redirect('admin/changepass')//return to the page
                  ->withInput()
                  ->withErrors($validator);//send errors
                }
                else{
                  $userid=session('admin');//take the id of the admin
                  $user=User::find($userid);//get user info
                    if($user->password==$req->CurrentPassword){//check if old password matches
                      $affected=DB::table('users')
                          ->where('id',$userid)
                          ->update([
                              'Password' => $req->NewPassword,//update password
                          ]);

                          if ($affected !== null) {//if updated
                              return redirect('admin/changepass')->with(
                                  'status',
                                  "Password updated successfully"
                              );
                          } else {
                              return redirect('admin/changepass')->with(//eror in updating
                                  'error',
                                  "Password Updating failed"
                              );
                          }
                    }
                    else{
                      return redirect('admin/changepass')->with(//password didnt match
                          'error',
                          "Old password doesnt matched"
                      );
                    }

                }
    }

    public function ChiefChangePassword(Request $req){//change the password of user

      $rules = [
          'CurrentPassword' => 'required|',
          'NewPassword' => 'required|min:6|max:12',
          'new_confirm_password' => 'required|same:NewPassword',
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                  return redirect('chief/changepass')//return to the page
                  ->withInput()
                  ->withErrors($validator);//send errors
                }
                else{
                  $userid=session('chief');//take the id of the admin
                  $user=User::find($userid);//get user info

                    if($user->password==$req->CurrentPassword){//check if old password matches
                      $affected=DB::table('users')
                          ->where('id',$userid)
                          ->update([
                              'Password' => $req->NewPassword,//update password
                          ]);

                          if ($affected !== null) {//if updated
                              return redirect('chief/changepass')->with(
                                  'status',
                                  "Password updated successfully"
                              );
                          } else {
                              return redirect('chief/changepass')->with(//eror in updating
                                  'error',
                                  "Password Updating failed"
                              );
                          }
                    }
                    else{
                      return redirect('chief/changepass')->with(//password didnt match
                          'error',
                          "Old password doesnt matched"
                      );
                    }

                }
    }


    public function StaffChangePassword(Request $req){//change the password of user
      $rules = [
          'CurrentPassword' => 'required|',
          'NewPassword' => 'required|min:6|max:12',
          'new_confirm_password' => 'required|same:NewPassword',
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                  return redirect('staff/changepass')//return to the page
                  ->withInput()
                  ->withErrors($validator);//send errors
                }
                else{
                  $userid=session('staff');//take the id of the admin
                  $user=User::find($userid);//get user info

                    if($user->password==$req->CurrentPassword){//check if old password matches
                      $affected=DB::table('users')
                          ->where('id',$userid)
                          ->update([
                              'Password' => $req->NewPassword,//update password
                          ]);
                          if ($affected !== null) {//if updated
                              return redirect('staff/changepass')->with(
                                  'status',
                                  "Password updated successfully"
                              );
                          } else {
                              return redirect('staff/changepass')->with(//eror in updating
                                  'error',
                                  "Password Updating failed"
                              );
                          }
                    }
                    else{
                      return redirect('staff/changepass')->with(//password didnt match
                          'error',
                          "Old password doesnt matched"
                      );
                    }
                }
    }
    public function StudentChangePassword(Request $req)
    {
      $rules = [
          'CurrentPassword' => 'required|',
          'NewPassword' => 'required|min:6|max:12',
          'new_confirm_password' => 'required|same:NewPassword',
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                  return redirect('student/changepass')//return to the page
                  ->withInput()
                  ->withErrors($validator);//send errors
                }
                else{
                  $userid=session('student');//take the id of the admin
                  $user=User::find($userid);//get user info

                    if($user->password==$req->CurrentPassword){//check if old password matches
                      $affected=DB::table('users')
                          ->where('id',$userid)
                          ->update([
                              'Password' => $req->NewPassword,//update password
                          ]);
                          if ($affected !== null) {//if updated
                              return redirect('student/changepass')->with(
                                  'status',
                                  "Password updated successfully"
                              );
                          } else {
                              return redirect('student/changepass')->with(//eror in updating
                                  'error',
                                  "Password Updating failed"
                              );
                          }
                    }
                    else{
                      return redirect('student/changepass')->with(//password didnt match
                          'error',
                          "Old password doesnt matched"
                      );
                    }
                }
    }
    public function InstructorChangePassword(Request $req)//change pass of instructor
    {
      $rules = [
        'CurrentPassword' => 'required|',
        'NewPassword' => 'required|min:6|max:12',
        'new_confirm_password' => 'required|same:NewPassword',
          ];
          $validator = Validator::make($req->all(),$rules);//check if all rule are true
          if ($validator->fails()) {//if rules are false
                return redirect('instructor/changepass')//return to the page
                ->withInput()
                ->withErrors($validator);//send errors
              }
              else{
                $userid=session('instructor');//take the id of the admin
                $user=User::find($userid);//get user info

                  if($user->password==$req->CurrentPassword){//check if old password matches
                    $affected=DB::table('users')
                        ->where('id',$userid)
                        ->update([
                            'Password' => $req->NewPassword,//update password
                        ]);

                        if ($affected !== null) {//if updated
                            return redirect('instructor/changepass')->with(
                                'status',
                                "Password updated successfully"
                            );
                        } else {
                            return redirect('instructor/changepass')->with(//eror in updating
                                'error',
                                "Password Updating failed"
                            );
                        }
                  }
                  else{
                    return redirect('instructor/changepass')->with(//password didnt match
                        'error',
                        "Old password doesnt matched"
                    );
                  }

              }
    }
}
