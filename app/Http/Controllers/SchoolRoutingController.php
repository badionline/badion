<?php

namespace App\Http\Controllers;


use App\Http\Middleware\School;
use App\Models\Teachertimetable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Schools;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Salary;
use App\Models\Classes;
use App\Models\Subject;
use Mail;
use App\Mail\password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SchoolRoutingController extends Controller
{
    //    public function signin()
    //    {
    //        return view('signin');
    //    }
    public function disabled()
    {
        return view('School/disabled');
    }
    public function home()
    {
        return view('School/home');
    }

    public function login()
    {
        return view('School/login');
    }

    public function profile()
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();
        $profile = Schools::where('user_id', Auth::user()->user_id)->first();
        return view('School/profile', compact('user', 'profile'));
    }

    public function students()
    {
        return view('School/students');
    }

    public function editstudent($id)
    {
        $studentschoolid = Student::where('user_id', $id)->value('school_id');
        $school_id = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
        if ($studentschoolid != $school_id) {
            return view('errors/404');
        } else {
            $student = Student::where('user_id', $id)->first();
            return view('School/editstudent', compact('student'));
        }
    }

    public function student($id)
    {
        $studentschoolid = Student::where('user_id', $id)->withTrashed()->value('school_id');
        $school_id = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
        if ($studentschoolid != $school_id) {
            return view('errors/404');
        } else {
            $student = Student::where('user_id', $id)->withTrashed()->first();
            $class = Classes::where('class_id', $student->class_id)->first();
            return view('School/student', compact('student', 'class'));
        }
    }

    public function addstudent()
    {
        return view('School/addstudent');
    }


    public function paststudents()
    {
        return view('School/paststudents');
    }

    public function teachers()
    {
        return view('School/teachers');
    }

    public function editteacher($id)
    {
        $teacherschoolid = Teacher::where('user_id', $id)->value('school_id');
        $school_id = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
        if ($teacherschoolid != $school_id) {
            return view('errors/404');
        } else {
            $teacher = Teacher::where('user_id', $id)->first();
            return view('School/editteacher', compact('teacher'));
        }
    }

    public function teacher($id)
    {
        $teacherschoolid = Teacher::where('user_id', $id)->withTrashed()->value('school_id');
        $school_id = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
        if ($teacherschoolid != $school_id) {
            return view('errors/404');
        } else {
            $teacher = Teacher::where('user_id', $id)->withTrashed()->first();
            $subject = Subject::join('classes', 'classes.class_id', '=', 'subjects.class_id')->select("subjects.name as subject", "classes.name as class", "classes.div as div")->where('subjects.teacher_id', $teacher->teacher_id)->get();
            return view('School/teacher', compact('teacher', 'subject'));
        }
    }

    public function addteacher()
    {
        return view('School/addteacher');
    }

    public function pastteachers()
    {
        return view('School/pastteachers');
    }

    public function attendance()
    {
        return view('School/attendance');
    }

    public function manageclass()
    {
        return view('School/manageclass');
    }

    public function managesubjects()
    {
        return view('School/managesubjects');
    }

    public function manageteachers()
    {
        $school_id = Schools::where("user_id", Auth::user()->user_id)->value("school_id");
        $teachers = Teacher::where("school_id", $school_id)->get();
        return view('School/manageteachers')->with(compact('teachers'));
    }

    public function managesyllabus()
    {
        return view('School/managesyllabus');
    }

    public function timetable()
    {
        return view('School/timetable');
    }

    public function manageexams()
    {
        return view('School/manageexams');
    }

    public function managemarks()
    {
        return view('School/managemarks');
    }

    public function marks()
    {
        return view('School/marks');
    }

    public function managefees()
    {
        return view('School/managefees');
    }

    public function feepayments()
    {
        return view('School/feepayments');
    }

    public function salary()
    {
        return view('School/salary');
    }

    public function notice()
    {
        return view('School/notice');
    }

    public function support()
    {
        return view('School/support');
    }


    public function homedetails()
    {
        $school_id = Schools::where('email', Auth::user()->email)->pluck('school_id');
        $student = Student::where('school_id', $school_id)->pluck('school_id');
        $teacher = Teacher::where('school_id', $school_id)->pluck('school_id');
        $data = compact('student', 'teacher');
        return response()->json($data);
    }

    public function addsubject(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'schoolid' => 'required',
            'standard' => 'required',
            'subject' => 'required',
        ]);
        if ($validatedData->passes()) {
            $schoolid = Schools::where('email', Auth::user()->email)->value('school_id');
            $classids = Classes::whereIn('name', $request->standard)->where("school_id", $schoolid)->pluck("class_id");
            $errors = [];
            $success = [];
            // dd($classids);
            foreach ($classids as $class_id) {
                $check = Subject::where("name", $request->subject)->where("class_id", $class_id)->exists();
                if ($check == true) {
                    array_push($errors, "Subject Already Exist!");
                } else {
                    $subject = new Subject();
                    $subject->name = $request->subject;
                    $subject->school_id = $schoolid;
                    $subject->class_id = $class_id;
                    $subject->save();
                    array_push($success, "Subject Added Successfully!");
                }
            }
            $data = compact('errors', 'success');
            return response()->json($data);
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }
}
