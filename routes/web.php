<?php


use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolRoutingController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminRoutingController;
use App\Http\Controllers\StudentRoutingController;
use App\Http\Controllers\TeacherRoutingController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SchoolDetailsController;
use App\Http\Controllers\RazorpayPaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(["middleware" => "guest:web"], function () {
    Route::get('/register', [AuthController::class, 'register']);
    Route::get('/', [AuthController::class, 'home']);
    Route::get('/home', [AuthController::class, 'home']);
    Route::get('login', [AuthController::class, 'login'])->name("login");
    Route::post('logincheck', [AuthController::class, 'loginCheck']);
    Route::get('/googleLogin', [GoogleController::class, 'googleLogin'])->name("googleLogin");
    Route::get('/auth/google/callback', [GoogleController::class, 'googleHandle']);
    Route::get('/otp', [MailController::class, 'index']);
    // Route::get('/', [GoogleController::class, 'login']);
    Route::get('password', [MailController::class, 'password']);
    Route::post('addschool', [SchoolController::class, 'addschool'])->name("addschool");
    // Route::get('sms', [SmsControlle::class, 'sms'])->name("sms");
});

Route::get('logout', [AuthController::class, 'logout']);
Route::get('/pending', function () {
    return view("pending");
});

Route::group(["prefix" => "Admin", "middleware" => ["auth:web", "isAdmin"]], function () {
    Route::get('home', [AdminRoutingController::class, 'home'])->name("ahome");
    Route::get('profile', [AdminRoutingController::class, 'profile'])->name("aprofile");
    Route::get('schools', [AdminRoutingController::class, 'schools'])->name("schools");
    Route::get('addschool', [AdminRoutingController::class, 'addschool'])->name("aaddschool");
    Route::post('addschoolvalidations', [AdminRoutingController::class, 'addschoolvalidations'])->name("addschoolvalidations");
    Route::get('editschool/{id}', [AdminRoutingController::class, 'editschool'])->name("editschool");
    Route::get('registrations', [AdminRoutingController::class, 'registrations'])->name("registrations");
    Route::get('school/{id}', [AdminRoutingController::class, 'school'])->name("school");
    Route::get('students', [AdminRoutingController::class, 'students'])->name("astudents");
    Route::get('addstudent', [AdminRoutingController::class, 'addstudent'])->name("aaddstudent");
    Route::get('editstudent/{id}', [AdminRoutingController::class, 'editstudent'])->name("aeditstudent");
    Route::get('student/{id}', [AdminRoutingController::class, 'student'])->name("astudent");
    Route::get('teachers', [AdminRoutingController::class, 'teachers'])->name("ateachers");
    Route::get('addteacher', [AdminRoutingController::class, 'addteacher'])->name("aaddteacher");
    Route::get('pastteachers', [AdminRoutingController::class, 'pastteachers'])->name("apastteachers");
    Route::get('editteacher/{id}', [AdminRoutingController::class, 'editteacher'])->name("aeditteacher");
    Route::get('teacher/{id}', [AdminRoutingController::class, 'teacher']);
    Route::get('plans', [AdminRoutingController::class, 'plans'])->name("plans");
    Route::get('editplan', [AdminRoutingController::class, 'editplan'])->name("editplan");
    Route::get('payments', [AdminRoutingController::class, 'payments'])->name("payments");
    Route::get('ticket', [AdminRoutingController::class, 'ticket'])->name("ticket");
    Route::get('settings', [AdminRoutingController::class, 'settings'])->name("settings");
    Route::get('logout', [AuthController::class, 'logout'])->name("alogout");
    Route::get('theme', [ThemeController::class, 'theme'])->name("atheme");
    Route::get('adminhome', [AdminController::class, 'adminhome'])->name("adminhome");


    //    School
    Route::post('adminchangepass', [AdminController::class, 'adminchangepass'])->name("adminchangepass");
    Route::get('getteachers', [TeacherController::class, 'getteachers'])->name("agetteachers");
    Route::get('getnonregistered', [SchoolController::class, 'getnonregistered'])->name("getnonregistered");
    Route::post('approveschool', [SchoolController::class, 'approveschool'])->name("approveschool");
    Route::get('schoolusers', [SchoolDetailsController::class, 'schoolusers'])->name("schoolusers");
    Route::post('updatestatus', [SchoolController::class, 'updatestatus'])->name("updatestatus");
    Route::post('addschool', [SchoolController::class, 'addschool'])->name("aaaddschool");
    Route::post('getdeleteteacher', [TeacherController::class, 'getdeleteteacher'])->name("agetdeleteteacher");
    Route::post('deleteteacher', [TeacherController::class, 'deleteteacher'])->name("adeleteteacher");
    Route::get('getpastteachers', [TeacherController::class, 'getpastteachers'])->name("agetpastteachers");
    Route::post('validateeditteacher', [TeacherController::class, 'validateeditteacher'])->name("avalidateeditteacher");
    Route::get('getstudents', [StudentController::class, 'getstudents'])->name("agetstudents");
    Route::get('getstandard', [SchoolDetailsController::class, 'getstandard'])->name("agetstandard");
    Route::post('validateeditstudent', [StudentController::class, 'validateeditstudent'])->name("avalidateeditstudent");
    Route::post('getdeletestudent', [StudentController::class, 'getdeletestudent'])->name("agetdeletestudent");
    Route::post('deletestudent', [StudentController::class, 'deletestudent'])->name("adeletestudent");
    Route::get('paststudents', [AdminRoutingController::class, 'paststudents'])->name("apaststudents");
    Route::get('getpaststudents', [StudentController::class, 'getpaststudents'])->name("agetpaststudents");
    Route::get('gettickets', [SchoolDetailsController::class, 'gettickets'])->name("agettickets");
    Route::post('updateticketstatus', [SchoolDetailsController::class, 'updateticketstatus'])->name("updateticketstatus");
    Route::post('validateeditschool', [SchoolController::class, 'validateeditschool'])->name("validateeditschool");
    Route::get('getpayments', [SchoolDetailsController::class, 'getpayments'])->name("getpayments");

    //    Exports
    Route::get('exportschools', [ExportController::class, 'exportschools'])->name("exportschools");
    Route::get('exportstudents', [ExportController::class, 'exportstudents'])->name("aexportstudents");
    Route::get('exportpaststudents', [ExportController::class, 'exportpaststudents'])->name("aexportpaststudents");
    Route::get('exportteachers', [ExportController::class, 'exportteachers'])->name("aexportteachers");
    Route::get('exportpastteachers', [ExportController::class, 'exportpastteachers'])->name("aexportpastteachers");
    Route::get('exportfees', [ExportController::class, 'exportfees'])->name("aexportfees");

});


Route::group(["prefix" => "School", "middleware" => ["auth:web", "isSchool"]], function () {
    Route::get('disabled', [SchoolRoutingController::class, 'disabled'])->name("disabled");
    Route::get('home', [SchoolRoutingController::class, 'home'])->name("shome");
    Route::get('profile', [SchoolRoutingController::class, 'profile'])->name("sprofile");
    Route::get('students', [SchoolRoutingController::class, 'students'])->name("sstudents");
    Route::get('editstudent/{id}', [SchoolRoutingController::class, 'editstudent'])->name("seditstudent");
    Route::get('student/{id}', [SchoolRoutingController::class, 'student'])->name("sstudent");
    Route::get('addstudent', [SchoolRoutingController::class, 'addstudent'])->name("saddstudent");
    Route::get('paststudents', [SchoolRoutingController::class, 'paststudents'])->name("paststudents");
    Route::get('teachers', [SchoolRoutingController::class, 'teachers'])->name("steachers");
    Route::get('editteacher/{id}', [SchoolRoutingController::class, 'editteacher'])->name("seditteacher");
    Route::get('teacher/{id}', [SchoolRoutingController::class, 'teacher'])->name("teacher");
    Route::get('addteacher', [SchoolRoutingController::class, 'addteacher'])->name("saddteacher");
    Route::get('pastteachers', [SchoolRoutingController::class, 'pastteachers'])->name("pastteachers");
    Route::get('attendance', [SchoolRoutingController::class, 'attendance'])->name("aattendance");
    Route::get('manageclass', [SchoolRoutingController::class, 'manageclass'])->name("manageclass");
    Route::get('managesubjects', [SchoolRoutingController::class, 'managesubjects'])->name("managesubjects");
    Route::get('manageteachers', [SchoolRoutingController::class, 'manageteachers'])->name("manageteachers");
    Route::get('timetable', [SchoolRoutingController::class, 'timetable'])->name("stimetable");
    Route::get('manageexams', [SchoolRoutingController::class, 'manageexams'])->name("manageexams");
    Route::get('managemarks', [SchoolRoutingController::class, 'managemarks'])->name("managemarks");
    Route::get('marks', [SchoolRoutingController::class, 'marks'])->name("marks");
    Route::get('managefees', [SchoolRoutingController::class, 'managefees'])->name("managefees");
    Route::get('feepayments', [SchoolRoutingController::class, 'feepayments'])->name("feepayments");
    Route::get('salary', [SchoolRoutingController::class, 'salary'])->name("salary");
    Route::get('notice', [SchoolRoutingController::class, 'notice'])->name("notice");
    Route::get('support', [SchoolRoutingController::class, 'support'])->name("support");
    Route::get('homedetails', [SchoolRoutingController::class, 'homedetails'])->name("homedetails");
    Route::post('addsubject', [SchoolRoutingController::class, 'addsubject'])->name("addsubject");
    Route::post('addclass', [SchoolDetailsController::class, 'addclass'])->name("addclass");
    Route::get('logout', [AuthController::class, 'logout'])->name("slogout");
    Route::get('theme', [ThemeController::class, 'theme'])->name("stheme");
    Route::get('getstandard', [SchoolDetailsController::class, 'getstandard'])->name("getstandard");
    Route::post('getsubject', [SchoolDetailsController::class, 'getsubject'])->name("getsubject");
    Route::post('getsub', [SchoolDetailsController::class, 'getsub'])->name("getsub");
    // Route::get('getunasignedteachers', [SchoolDetailsController::class, 'getunasignedteachers'])->name("getunasignedteachers");
    Route::post('addtimetable', [SchoolDetailsController::class, 'addtimetable'])->name("addtimetable");
    Route::post('addteachertimetable', [SchoolDetailsController::class, 'addteachertimetable'])->name("addteachertimetable");
    Route::post('addexam', [SchoolDetailsController::class, 'addexam'])->name("addexam");
    Route::get('getexams', [SchoolDetailsController::class, 'getexams'])->name("getexams");
    Route::post('getexam', [SchoolDetailsController::class, 'getexam'])->name("getexam");
    Route::post('editexam', [SchoolDetailsController::class, 'editexam'])->name("editexam");
    Route::post('updateexam', [SchoolDetailsController::class, 'updateexam'])->name("updateexam");
    Route::post('assignteacher', [SchoolDetailsController::class, 'assignteacher'])->name("assignteacher");
    Route::post('assignclass', [SchoolDetailsController::class, 'assignclass'])->name("assignclass");
    Route::get('subjectslist', [SchoolDetailsController::class, 'subjectslist'])->name("subjectslist");
    Route::get('teacherslist', [SchoolDetailsController::class, 'teacherslist'])->name("teacherslist");
    Route::get('getexamclass', [SchoolDetailsController::class, 'getexamclass'])->name("getexamclass");
    Route::post('getentrymarks', [SchoolDetailsController::class, 'getentrymarks'])->name("getentrymarks");
    Route::post('insertresult', [SchoolDetailsController::class, 'insertresult'])->name("insertresult");
    Route::post('getresults', [SchoolDetailsController::class, 'getresults'])->name("getresults");
    Route::post('geteditresult', [SchoolDetailsController::class, 'geteditresult'])->name("geteditresult");
    Route::post('updateresult', [SchoolDetailsController::class, 'updateresult'])->name("updateresult");
    Route::get('getfeecategory', [SchoolDetailsController::class, 'getfeecategory'])->name("getfeecategory");
    Route::post('addfeecategory', [SchoolDetailsController::class, 'addfeecategory'])->name("addfeecategory");
    Route::post('deletefeecategory', [SchoolDetailsController::class, 'deletefeecategory'])->name("deletefeecategory");
    Route::post('managefeeamount', [SchoolDetailsController::class, 'managefeeamount'])->name("managefeeamount");
    Route::get('feeslist', [SchoolDetailsController::class, 'feeslist'])->name("feeslist");
    Route::post('geteditfee', [SchoolDetailsController::class, 'geteditfee'])->name("geteditfee");
    Route::post('editfee', [SchoolDetailsController::class, 'editfee'])->name("editfee");
    Route::get('getfeedatils', [SchoolDetailsController::class, 'getfeedatils'])->name("getfeedatils");
    Route::post('sendnotice', [SchoolDetailsController::class, 'sendnotice'])->name("sendnotice");
    Route::get('getnotices', [SchoolDetailsController::class, 'getnotices'])->name("getnotices");
    Route::post('deletenotice', [SchoolDetailsController::class, 'deletenotice'])->name("deletenotice");
    Route::post('raiseticket', [SchoolDetailsController::class, 'raiseticket'])->name("raiseticket");
    Route::get('gettickets', [SchoolDetailsController::class, 'gettickets'])->name("gettickets");
    Route::get('verifystatus', [SchoolDetailsController::class, 'verifystatus'])->name("verifystatus");
    Route::post('updateticketstatus', [SchoolDetailsController::class, 'updateticketstatus'])->name("supdateticketstatus");
    Route::post('getfeedetails', [SchoolDetailsController::class, 'getfeedetails'])->name("getfeedetails");
    Route::post('updatefeestatus', [SchoolDetailsController::class, 'updatefeestatus'])->name("updatefeestatus");
    Route::get('getattendance', [SchoolDetailsController::class, 'getattendance'])->name("getattendance");

    // StudentController
    Route::get('getstudent', [StudentController::class, 'getstudent'])->name("getstudent");
    Route::get('getstudents', [StudentController::class, 'getstudents'])->name("getstudents");
    Route::get('getpaststudents', [StudentController::class, 'getpaststudents'])->name("getpaststudents");
    Route::post('validateaddstudent', [StudentController::class, 'validateaddstudent'])->name("validateaddstudent");
    Route::post('validateeditstudent', [StudentController::class, 'validateeditstudent'])->name("validateeditstudent");
    Route::post('getdeletestudent', [StudentController::class, 'getdeletestudent'])->name("getdeletestudent");
    Route::post('deletestudent', [StudentController::class, 'deletestudent'])->name("deletestudent");

    // TeacherController
    Route::get('getteachers', [TeacherController::class, 'getteachers'])->name("getteachers");
    Route::get('getpastteachers', [TeacherController::class, 'getpastteachers'])->name("getpastteachers");
    Route::post('validateaddteacher', [TeacherController::class, 'validateaddteacher'])->name("validateaddteacher");
    Route::post('validateeditteacher', [TeacherController::class, 'validateeditteacher'])->name("validateeditteacher");
    Route::post('getdeleteteacher', [TeacherController::class, 'getdeleteteacher'])->name("getdeleteteacher");
    Route::post('deleteteacher', [TeacherController::class, 'deleteteacher'])->name("deleteteacher");

    // SchoolController
    Route::post('updateschoolsocial', [SchoolController::class, 'updateschoolsocial'])->name("updateschoolsocial");
    Route::post('schoolchangepass', [SchoolController::class, 'schoolchangepass'])->name("schoolchangepass");

    //    Exports
    Route::get('exportstudents', [ExportController::class, 'exportstudents'])->name("exportstudents");
    Route::get('exportpaststudents', [ExportController::class, 'exportpaststudents'])->name("exportpaststudents");
    Route::get('exportteachers', [ExportController::class, 'exportteachers'])->name("exportteachers");
    Route::get('exportpastteachers', [ExportController::class, 'exportpastteachers'])->name("exportpastteachers");
    Route::get('exportattendance', [ExportController::class, 'exportattendance'])->name("exportattendance");
    Route::get('exportresults', [ExportController::class, 'exportresults'])->name("exportresults");
    Route::get('exportfees', [ExportController::class, 'exportfees'])->name("exportfees");
});


Route::group(["prefix" => "Teacher", "middleware" => ["auth:web", "isTeacher"]], function () {
    Route::get('getlinks', [SchoolDetailsController::class, 'getlinks'])->name("getlinks");
    Route::get('home', [TeacherRoutingController::class, 'home'])->name("thome");
    Route::get('student', [TeacherRoutingController::class, 'student'])->name("tstudent");
    Route::get('profile', [TeacherRoutingController::class, 'profile'])->name("tprofile");
    Route::post('teacherchangepass', [TeacherController::class, 'teacherchangepass'])->name("teacherchangepass");
    Route::get('studymaterials', [TeacherRoutingController::class, 'studymaterials'])->name("tstudymaterials");
    Route::get('homework', [TeacherRoutingController::class, 'homework'])->name("thomework");
    // Route::get('fee', [TeacherRoutingController::class,'fee'])->name("fee");
    Route::get('timetable', [TeacherRoutingController::class, 'timetable'])->name("ttimetable");
    Route::get('studentinfo/{id}', [TeacherRoutingController::class, 'studentinfo'])->name("studentinfo");
    Route::get('studentattendence', [TeacherRoutingController::class, 'studentattendence'])->name("studentattendence");
    Route::get('noticeboard', [TeacherRoutingController::class, 'noticeboard'])->name("tnoticeboard");
    Route::get('logout', [AuthController::class, 'logout'])->name("tlogout");
    Route::get('theme', [ThemeController::class, 'theme'])->name("ttheme");
    Route::get('getstudents', [StudentController::class, 'tgetstudents'])->name("tgetstudents");
    //    Route::get('class_students', [StudentController::class, 'class_students'])->name("class_students");
    Route::post('insertattendance', [StudentController::class, 'insertattendance'])->name("insertattendance");
    Route::post('addstudymaterials', [SchoolDetailsController::class, 'addstudymaterials'])->name("addstudymaterials");
    Route::get('studymaterial', [SchoolDetailsController::class, 'studymaterial'])->name("studymaterial");
    Route::post('deletestudymaterials', [SchoolDetailsController::class, 'deletestudymaterials'])->name("deletestudymaterials");
    Route::get('gethomework', [SchoolDetailsController::class, 'gethomework'])->name("gethomework");
    Route::post('addhomework', [SchoolDetailsController::class, 'addhomework'])->name("addhomework");
    Route::post('deletehomework', [SchoolDetailsController::class, 'deletehomework'])->name("deletehomework");
});


Route::group(["prefix" => "Student", "middleware" => ["auth:web", "isStudent"]], function () {
    Route::get('getlinks', [SchoolDetailsController::class, 'stgetlinks'])->name("stgetlinks");
    Route::get('home', [StudentRoutingController::class, 'home'])->name("sthome");
    Route::get('studymaterials', [StudentRoutingController::class, 'studymaterials'])->name("sstudymaterials");
    Route::get('teachers', [StudentRoutingController::class, 'teachers'])->name("stteachers");
    Route::get('homework', [StudentRoutingController::class, 'homework'])->name("sthomework");
    Route::get('timetable', [StudentRoutingController::class, 'timetable'])->name("sttimetable");
    Route::get('attendance', [StudentRoutingController::class, 'attendance'])->name("attendance");
    Route::get('fees', [StudentRoutingController::class, 'fees'])->name("fees");
    Route::get('result', [StudentRoutingController::class, 'result'])->name("result");
    Route::get('noticeboard', [StudentRoutingController::class, 'noticeboard'])->name("stnoticeboard");
    Route::get('profile', [StudentRoutingController::class, 'profile'])->name("stprofile");
    Route::get('logout', [AuthController::class, 'logout'])->name("stlogout");
    Route::get('theme', [ThemeController::class, 'theme'])->name("sttheme");
    // Route::get('studentfee', [StudentController::class, 'studentfee'])->name("studentfee");
    Route::post('studentchangepass', [StudentController::class, 'studentchangepass'])->name("studentchangepass");

    // Fee
    Route::post('payfee', [RazorpayPaymentController::class, 'store'])->name("payfee");
    Route::get('feesreview/{id}', [StudentRoutingController::class, 'feesreview']);
});