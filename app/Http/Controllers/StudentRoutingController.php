<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Exam;
use App\Models\Fee;
use App\Models\Feestatus;
use App\Models\Homework;
use App\Models\Notice;
use App\Models\Result;
use App\Models\Student;
use App\Models\Studymaterial;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Teachertimetable;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class StudentRoutingController extends Controller
{
    public function home()
    {
        $class_id = Student::where("user_id", Auth::user()->user_id)->value("class_id");
        $timetable = Timetable::where("class_id", $class_id)->value("file");
        $student_id = Student::where("user_id", Auth::user()->user_id)->value("student_id");
        $present = Attendance::where("student_id", $student_id)->where("status", "P")->get();
        $absent = Attendance::where("student_id", $student_id)->where("status", "A")->get();
        $leave = Attendance::where("student_id", $student_id)->where("status", "L")->get();
        $leavecount = count($leave);
        $presentcount = count($present);
        $absentcount = count($absent);
        $total = $leavecount + $presentcount + $absentcount;
        $attendence = 0;
        if ($total) {
            $attendence = ($presentcount / $total) * 100;
        }
        return view('Student/home')->with(compact('timetable', 'attendence'));
    }

    public function studymaterials()
    {
        $class_id = Student::where("user_id", Auth::user()->user_id)->value("class_id");
        $studymaterials = Studymaterial::join("subjects", "subjects.subject_id", "=", "studymaterials.subject_id")->where("studymaterials.class_id", $class_id)->select("subjects.name as subject", "studymaterials.name as title", "studymaterials.file")->get();
        return view('Student/studymaterials')->with(compact("studymaterials"));
    }

    public function teachers()
    {
        $class_id = Student::where("user_id", Auth::user()->user_id)->value("class_id");
        $teachers = Subject::join("teachers", "subjects.teacher_id", "=", "teachers.teacher_id")->select("teachers.name as teacher", "subjects.name as subject")->where("subjects.class_id", $class_id)->get();
        return view('Student/teachers')->with(compact("teachers"));
    }

    public function homework()
    {
        $class_id = Student::where("user_id", Auth::user()->user_id)->value("class_id");
        $homework = Homework::join("subjects", "subjects.subject_id", "homework.subject_id")->where("homework.class_id", $class_id)->select("subjects.name as subject", "homework.content", "homework.file")->get();
        return view('Student/homework')->with(compact("homework"));
    }

    public function timetable()
    {
        $class_id = Student::where("user_id", Auth::user()->user_id)->value("class_id");
        $timetable = Timetable::where("class_id", $class_id)->value("file");
        $path = env("APP_URL_DOMAIN") . "/" . $timetable;
        return Redirect::to($path);
    }

    public function attendance()
    {
        $student_id = Student::where("user_id", Auth::user()->user_id)->value("student_id");
        $present = Attendance::where("student_id", $student_id)->where("status", "P")->get();
        $absent = Attendance::where("student_id", $student_id)->where("status", "A")->get();
        $leave = Attendance::where("student_id", $student_id)->where("status", "L")->get();
        $leavecount = count($leave);
        $presentcount = count($present);
        $absentcount = count($absent);
        $total = $leavecount + $presentcount + $absentcount;
        $attendence = 0;
        if ($total) {
            $attendence = ($presentcount / $total) * 100;
        }
        return view('Student/attendance')->with(compact('attendence', 'presentcount', 'absentcount', 'leavecount', 'total'));
    }

    public function fees()
    {

        $school = Student::where("user_id", Auth::user()->user_id)->value("school_id");
        $class = Student::where("user_id", Auth::user()->user_id)->value("class_id");
        $student = Student::where("user_id", Auth::user()->user_id)->value("student_id");
        // $data = Fee::join("feescategories", "feescategories.feescategory_id", "=", "fees.feescategory_id")->join("feestatuses", "fees.fee_id", "=", "feestatuses.fee_id")->select("feescategories.name as name", "fees.amount as amount", "feestatuses.feestatus_id", "feestatuses.status")->where("fees.school_id", $school)->where("fees.class_id", $class)->get();
        $data = Feestatus::join("fees", "fees.fee_id", "=", "feestatuses.fee_id")->join("feescategories", "feescategories.feescategory_id", "=", "fees.feescategory_id")->select("feescategories.name as name", "fees.amount as amount", "feestatuses.feestatus_id", "feestatuses.status")->where("feestatuses.student_id", $student)->get();
        return view('Student/fees')->with(compact("data"));
    }

    public function result()
    {
        $student_id = Student::where("user_id", Auth::user()->user_id)->value("student_id");
        $data = Result::join("exams", "exams.exam_id", "results.exam_id")
            ->join("subjects", "subjects.subject_id", "=", "results.subject_id")
            ->join("classes", "classes.class_id", "=", "results.class_id")
            ->select("results.student_id", "exams.exam_id", "exams.name as exam", "subjects.name as subject", "classes.name as class", "results.marks")//DB::raw('SUM(results.marks) as marks')
            ->where("student_id", $student_id)->get();
        $results = array();
        foreach ($data as $item) {
            $exam = $item['exam'];
            unset($item['exam']); // Remove exam_id from the item as it's used as the key
            $results[$exam][] = $item;
        }

        return view('Student/result')->with(compact("results"));
    }

    public function noticeboard()
    {
        $school_id = Student::where('user_id', Auth::user()->user_id)->value('school_id');
        $notices = Notice::where('school_id', $school_id)->whereIn("to", [1, 3])->get();
        return view('Student/noticeboard')->with(compact('notices'));
    }

    public function profile()
    {
        $student = Student::join("classes", "classes.class_id", "=", "students.class_id")->select("students.*", "classes.name as class", "classes.div")->where("user_id", Auth::user()->user_id)->first();
        return view('Student/profile')->with(compact('student'));
    }

    public function login()
    {
        return view('Student/login');
    }

    public function feesreview($id)
    {
        $data = Feestatus::join("fees", "fees.fee_id", "=", "feestatuses.fee_id")->join("feescategories", "feescategories.feescategory_id", "=", "fees.feescategory_id")->join("students", "students.student_id", "feestatuses.student_id")->join("classes", "students.class_id", "=", "classes.class_id")->select("classes.name as class", "classes.div", "students.addmissionno", "students.email", "students.name as student", "students.rollno", "feescategories.name as name", "fees.amount as amount", "feestatuses.feestatus_id", "feestatuses.status", "students.phone")->where("feestatuses.feestatus_id", $id)->first();


        // ->where("feestatuses.student_id", $id)->first();
        return view('Student/feesreview')->with(compact("data"));
    }
}
