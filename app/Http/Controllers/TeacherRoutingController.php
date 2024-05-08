<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Notice;
use App\Models\Schools;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Teachertimetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;

class TeacherRoutingController extends Controller
{
    // public function __construct()
    // {
    //     $school_id = Teacher::where("user_id", Auth::user()->user_id)->value("school_id");
    //     $data = Schools::select('email', 'location', 'whatsapp', 'instagram', 'youtube')->where('school_id', $school_id)->first();
    //     // return response()->json($data);
    // }

    public function home()
    {
        $school_id = Teacher::where("user_id", Auth::user()->user_id)->value("school_id");
        $data = Schools::select('email', 'location', 'whatsapp', 'instagram', 'youtube')->where('school_id', $school_id)->first();
        $teacher_id = Teacher::where("user_id", Auth::user()->user_id)->value("teacher_id");
        $timetable = Teachertimetable::where("teacher_id", $teacher_id)->value("file");
        $class_id = Teacher::where("user_id", Auth::user()->user_id)->value("class_id");
        $students = Student::where("class_id", $class_id)->get()->toArray();
        $studentscount = count($students);
        return view('Teacher/home')->with(compact('studentscount', 'timetable', 'data'));
    }

    public function student()
    {
        return view('Teacher/student');
    }

    public function profile()
    {
        $teacher = Teacher::where("user_id", Auth::user()->user_id)->first();
        $subjects = Subject::where("teacher_id", $teacher->teacher_id)->distinct("name")->get();
        return view('Teacher/profile')->with(compact('teacher', 'subjects'));
    }
    public function login()
    {
        return view('Teacher/login');
    }

    public function studymaterials()
    {
        $class_id = Teacher::where('user_id', Auth::user()->user_id)->value('class_id');
        $subjects = Subject::where('class_id', $class_id)->get();
        return view('Teacher/studymaterials')->with(compact('subjects'));
    }

    public function homework()
    {
        $teacher_id = Teacher::where('user_id', Auth::user()->user_id)->value('teacher_id');
        $subjects = Subject::join("classes", "classes.class_id", "=", "subjects.class_id")->select("subjects.name as subject", "subjects.subject_id", "classes.div", "classes.name as class")->where('teacher_id', $teacher_id)->get();
        return view('Teacher/homework')->with(compact('subjects'));
        // return view('Teacher/homework');
    }

    // public function fee()
    // {
    //     return view('Teacher/fee');
    // }

    public function timetable()
    {
        $teacher_id = Teacher::where("user_id", Auth::user()->user_id)->value("teacher_id");
        $timetable = Teachertimetable::where("teacher_id", $teacher_id)->value("file");
        $path = env("APP_URL_DOMAIN") . "/" . $timetable;
        return Redirect::to($path);
    }

    public function studentinfo($id)
    {
        $student = Student::where("user_id", $id)->first();
        $class = Classes::where("class_id", $student->class_id)->first();
        return view('Teacher/studentinfo')->with(compact('student', 'class'));
    }
    public function studentattendence()
    {
        $class_id = Teacher::where("user_id", Auth::user()->user_id)->value("class_id");
        $check = Attendance::where('class_id', $class_id)->where("date", date('Y-m-d'))->exists();
        // dd();
        if ($check) {
            $students = null;
        } else {
            $students = Student::where("class_id", $class_id)->get();
        }
        return view('Teacher/studentattendence')->with(compact('students'));
    }
    public function noticeboard()
    {
        $school_id = Teacher::where('user_id', Auth::user()->user_id)->value('school_id');
        $notices = Notice::where('school_id', $school_id)->whereIn("to", [2, 3])->get();
        return view('Teacher/noticeboard')->with(compact('notices'));
    }
}