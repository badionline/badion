<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Schools;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;

class AdminRoutingController extends Controller
{

    public function login()
    {
        return view('Admin/login');
    }
    public function home()
    {
        return view('Admin/home');
    }
    public function profile()
    {
        $user = Admin::first();
        return view('Admin/profile')->with(compact('user'));
    }
    public function schools()
    {
        return view('Admin/schools');
    }
    public function addschool()
    {
        return view('Admin/addschool');
    }
    public function editschool($id)
    {
        $school = Schools::where("user_id", $id)->first();
        return view('Admin/editschool')->with(compact('school'));
    }
    public function school($id)
    {
        $school = Schools::where("user_id", $id)->first();
        $school_id = Schools::where("user_id", $id)->value("school_id");
        $teachers = Teacher::where("school_id", $school_id)->get()->toArray();
        $students = Student::where("school_id", $school_id)->get()->toArray();
        $teacherscount = count($teachers);
        $studentscount = count($students);
        return view('Admin/school')->with(compact('school', 'teacherscount', 'studentscount'));
    }
    public function registrations()
    {
        return view('Admin/registrations');
    }
    public function students()
    {
        return view('Admin/students');
    }
    public function addstudent()
    {
        return view('Admin/addstudent');
    }
    public function editstudent($id)
    {
        $student = Student::where('user_id', $id)->first();
        return view('Admin/editstudent', compact('student'));
    }
    public function student($id)
    {
        $studentschoolid = Student::where('user_id', $id)->withTrashed()->value('school_id');
        $student = Student::where('user_id', $id)->withTrashed()->first();
        $class = Classes::where('class_id', $student->class_id)->first();
        return view('Admin/student', compact('student', 'class'));
    }
    public function paststudents()
    {
        return view('Admin/paststudents');
    }
    public function teachers()
    {
        return view('Admin/teachers');
    }
    public function pastteachers()
    {
        return view('Admin/pastteachers');
    }
    public function addteacher()
    {
        return view('Admin/addteacher');
    }
    public function editteacher($id)
    {
        $teacher = Teacher::where('user_id', $id)->first();
        return view('Admin/editteacher', compact('teacher'));
    }
    public function teacher($id)
    {
        $teacher = Teacher::where('user_id', $id)->withTrashed()->first();
        $subject = Subject::join('classes', 'classes.class_id', '=', 'subjects.class_id')->select("subjects.name as subject", "classes.name as class", "classes.div as div")->where('subjects.teacher_id', $teacher->teacher_id)->get();
        return view('Admin/teacher', compact('teacher', 'subject'));
    }
    public function plans()
    {
        return view('Admin/plans');
    }
    public function editplan()
    {
        return view('Admin/editplan');
    }
    public function payments()
    {
        return view('Admin/payments');
    }
    public function ticket()
    {
        return view('Admin/ticket');
    }
    public function settings()
    {
        return view('Admin/settings');
    }
    public function addschoolvalidations(Request $request)
    {
        $request->validate([
            'sname' => 'required',
            'waurl' => 'required',
            'address' => 'required',
            'location' => 'required',
            'phone' => 'required|numeric|min_digits:10|max_digits:10',
            'instagram' => 'required',
            'email' => 'required|email',
            'youtube' => 'required',
            'adhaar' => 'required|numeric|min_digits:12|max_digits:12',
            'adharfile' => 'required',
            'pan' => 'required',
            'panfile' => 'required',
            'gst' => 'required',
            'gstfile' => 'required',
            'registernum' => 'required',
            'registerfile' => 'required',
        ]);
    }
}
