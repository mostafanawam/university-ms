<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChiefController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\RegistController;
use App\Http\Controllers\MailController;
Route::get('/', function () {
    return view('welcome');
});

//Route::get('/send-email', [MailController::class,'sendemail']);//send sendemail
/*########################################### <!--instructor--> ####################################################*/
Route::view('instructor/main', 'instructor.main');
Route::view('instructor/login', 'instructor.login');
Route::post('/instructor/attendance/submit', [InstructorController::class,'SubmitAttendance']);//submit attendance
Route::post('/instructor/attendance/create', [InstructorController::class,'CreateLecture']);//creatae lecture
Route::post('/instructor/grades/submit', [InstructorController::class,'SubmitGrades']);
Route::post('/instructor/UpdateProfile', [InstructorController::class,'UpdateInfo']);
Route::get('/instructor/profile/{id}', [InstructorController::class,'InstructorProfile']);//pass userid  to get chief data
Route::post('/instructor/main', [LoginController::class,'loginInstructor']);//if logged in redirect to main page
Route::get('/instructor/logout', [LoginController::class,'Instructorlogout']);
Route::post('/instructor/materials/upload', [InstructorController::class,'UploadMaterials']);//upload materials to students

Route::get('/instructor/attendance', [InstructorController::class,'GetAttendance']);//attendance view
Route::get('/instructor/grades', [InstructorController::class,'GetGrades']);//submit grades view view
Route::get('/instructor/materials', [InstructorController::class,'GetMaterials']);//upload materials  view
Route::view('/instructor/changepass', 'instructor.changepass');
Route::post('/instructor/change', [UsersController::class,'InstructorChangePassword']);//ChangePassword
/*########################################### <!--instructor--> ####################################################*/





/*########################################### <!--student--> ####################################################*/

Route::post('/student/application/update', [StudentController::class,'UpdateApplication']);
Route::post('/student/viewapp/login', [StudentController::class,'LoginApplication']);
Route::get('/student/materials', [InstructorController::class,'ShowMaterials']);//get the materials uploaded by the instructor
Route::get('/student/materials/download/{file}', [InstructorController::class,'DownloadFile']);//download file

Route::get('/student/viewapp', [StudentController::class,'ViewApp']);//view application to update
Route::post('/student/application/apply', [StudentController::class,'apply']);//apply new student with isstudent=0
Route::get('/student/pre-req', [CourseController::class,'CheckPrereq']);//drop courses

Route::post('/student/registration/register', [RegistController::class,'RegisterCourses']);
Route::get('/student/dropcourse/drop/{code}', [RegistController::class,'DropCourse']);//drop courses

Route::get('/student/dropcourse', [RegistController::class,'RegesteredCourses']);//get regisered courses
Route::get('/student/registration', [RegistController::class,'GetRegistration']);//get registration page
Route::post('/student/registration/getcourses', [RegistController::class,'coursesAll']);
Route::view('student/login', 'student.login');
Route::get('/student/results', [RegistController::class,'GetResults']);//get student results
Route::view('student/main', 'student.main');

Route::view('student/apply', 'student.application');//return the view of application

Route::get('/student/courses', [CourseController::class,'CoursesList']);
Route::view('/student/changepass', 'student.changepass');
Route::get('student/calendar', [FullCalenderController::class,'getcalendar']);
Route::get('/student/logout', [LoginController::class,'logoutStudent']);//logout user and return to login page
Route::get('student/schedule', [ScheduleController::class,'get_schedule']);
Route::post('/student/main', [LoginController::class,'loginStudent']);//if logged in redirect to main page
Route::post('/student/change', [UsersController::class,'StudentChangePassword']);//ChangePassword
Route::get('/student/profile/{id}', [StudentController::class,'StudentProfile']);//pass userid  to get chief data
Route::post('/student/UpdateProfile', [StudentController::class,'UpdateInfo']);
/*########################################### <!--student--> ####################################################*/


/*########################################### <!--Chief--> ####################################################*/

Route::get('/chief/exams', [ChiefController::class,'GetExam']);//return info related to exam assingment;
Route::post('/chief/exams/assign', [ChiefController::class,'AssignExam']);//return info related to exam assingment;

Route::view('chief/main', 'chief.main');
Route::view('chief/login', 'chief.login');
Route::get('chief/AssignInstructor', [ChiefController::class,'getInfo']);//return the page with courses and instructor;
Route::post('/chief/assign', [ChiefController::class,'assign']);//assign instructor

Route::view('chief/Addcourse', 'chief.addcourse');
Route::post('/chief/main', [LoginController::class,'loginChief']);//if logged in redirect to main page
Route::get('/chief/logout', [LoginController::class,'logoutChief']);//logout user and return to login page
Route::get('chief/course', [CourseController::class,'GetCourses']);//get courses list
Route::get('chief/deletecourse/{id}', [CourseController::class,'deleteCourse']);//delete course using id passed in url
Route::get('/chief/profile/{id}', [ChiefController::class,'ChiefProfile']);//pass userid  to get chief data
Route::post('/chief/UpdateProfile', [ChiefController::class,'UpdateInfo']);
Route::get('chief/viewcourse/{id}', [CourseController::class,'ViewCourse']);//view course  using id passed in url
Route::post('chief/updateCourse', [CourseController::class,'UpdateCourse']);//update course data
Route::post('chief/insertCourse', [CourseController::class,'InsertCourse']);//insert course data to table course
Route::view('/chief/changepass', 'chief.changepass');
Route::post('/chief/change', [UsersController::class,'ChiefChangePassword']);//ChangePassword

/*########################################### <!--Chief--> ####################################################*/


/*########################################### <!--Staff--> ####################################################*/
Route::view('staff/studentinfo', 'staff.studentinfo');
Route::view('staff/main', 'staff.main');
Route::get('staff/studentreg', [StudentController::class,'GetStudent']);//returns the users with type students that are not in table students(not registered yet)
Route::post('getstudent', [StudentController::class,'SearchStudent']);//search student if available and return its data
Route::post('staff/updatestudent', [StudentController::class,'UpdateStudent']);//update the student info
Route::get('/staff/studentreg/register/{id}', [StudentController::class,'AddStudentReg']);//add to student table
Route::view('staff/login', 'staff.login');//return the view of login
Route::post('/staff/main', [LoginController::class,'loginStaff']);//if logged in redirect to main page
Route::get('/staff/logout', [LoginController::class,'logoutStaff']);//logout user and return to login page
Route::get('/staff/profile/{id}', [StaffController::class,'GetProfile']);//pass userid  to get staff data
Route::post('/staff/UpdateProfile', [StaffController::class,'UpdateInfo']);
Route::view('/staff/changepass', 'staff.changepass');
Route::post('/staff/change', [UsersController::class,'StaffChangePassword']);//ChangePassword

Route::get('staff/schedule', [ScheduleController::class,'getInfo']);//get all inst and courses
Route::post('/staff/schedule/day_1', [ScheduleController::class,'set_day1']);
Route::get('/staff/schedule/delete/{id}', [ScheduleController::class,'deleteSession']);
/*########################################### <!--staff--> ####################################################*/


Route::get('fullcalender', [FullCalenderController::class, 'index']);
Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);


/*########################################### <!--Admin--> ####################################################*/
Route::get('admin/calender', [FullCalenderController::class, 'index']);
Route::post('/admin/additem', [ItemsController::class,'additem']);
Route::get('admin/item', [ItemsController::class,'itemlist']);
Route::get('admin/deleteitem/{id}', [ItemsController::class,'deleteitem']);//delete user using id passed in url
Route::view('admin/login', 'admin.login');
Route::post('/admin/user', [LoginController::class,'loginAdmin']);
Route::get('/admin/logout', [LoginController::class,'logout']);//request logout ,delete session and  return to login
Route::view('admin/main', 'admin.main');
Route::view('admin/changepass', 'admin.changepass');
Route::post('admin/change', [UsersController::class,'ChangePassword']);//ChangePassword
Route::get('admin/student', [StudentController::class,'StudentList']);//return the list of all students
Route::get('admin/staff', [StaffController::class,'StaffList']);//return the list of all staff
Route::get('admin/facultymember', [InstructorController::class,'InstructorList']); //return the list of all instructors
Route::view('admin/adduser', 'admin.adduser');
Route::view('admin/additem', 'admin.additem');
Route::get('admin/userlist', [UsersController::class,'userlist']);//get the users list
Route::post('/admin/user/adduser', [UsersController::class,'adduser']);//insert user
Route::get('/admin/deleteuser/{id}', [UsersController::class,'deleteuser']);//delete user using id passed in url
Route::get('admin/viewuser/{id}', [UsersController::class,'ViewUser']);//view user  using id passed in url
Route::post('admin/update', [UsersController::class,'UpdateUser']);//update user data
/*########################################### <!--Admin--> ####################################################*/
