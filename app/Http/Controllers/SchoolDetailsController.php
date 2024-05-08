<?php

namespace App\Http\Controllers;

use App\Mail\password;
use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Fee;
use App\Models\Homework;
use App\Models\Notice;
use App\Models\Payment;
use App\Models\Schools;
use App\Models\Studymaterial;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Ticket;
use App\Models\Timetable;
use App\Models\Teachertimetable;
use App\Models\Exam;
use App\Models\Result;
use App\Models\Feescategory;
use Illuminate\Http\Request;
use App\Models\Feestatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class SchoolDetailsController extends Controller
{

    // public function getunasignedteachers()
    // {
    //     $school_id = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
    //     $data = Subject::where('teacher_id', null)->where('school_id', $school_id)->get();
    //     return response()->json($data);
    // }

    public function addclass(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'schoolid' => 'required',
            'class' => 'required',
            'div' => 'required',
        ]);
        if ($validatedData->passes()) {
            $classes = Classes::all();
            $previous = [];
            foreach ($classes as $class) {
                $abc = $class->school_id . $class->name . $class->div;
                array_push($previous, $abc);
            }
            $current = $request->schoolid . $request->class . $request->div;
            if (in_array($current, $previous)) {
                return response()->json(['status' => 0, 'message' => "Class Already Exist"]);
            } else {
                $class = new Classes();
                $class->school_id = $request->schoolid;
                $class->name = $request->class;
                $class->div = $request->div;
                $class->save();
                return response()->json(['status' => 1, 'message' => "Class Added Successfully"]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }

    public function getstandard()
    {
        $school = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
        $standard = Classes::select('name', 'class_id', 'div')->where('school_id', $school)->get()->toArray();
        $data = compact('school', 'standard');
        return response()->json($data);
    }



    public function getlinks()
    {
        $school_id = Teacher::where("user_id", Auth::user()->user_id)->value("school_id");
        $data = Schools::select('email', 'location', 'whatsapp', 'instagram', 'youtube')->where('school_id', $school_id)->first();
        return response()->json($data);
    }

    public function stgetlinks()
    {
        $school_id = Student::where("user_id", Auth::user()->user_id)->value("school_id");
        $data = Schools::select('email', 'location', 'whatsapp', 'instagram', 'youtube')->where('school_id', $school_id)->first();
        return response()->json($data);
    }

    public function getsubject(Request $request)
    {
        $school_id = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
        $data = Subject::where("class_id", $request->id)->where("teacher_id", null)->where("school_id", $school_id)->get()->toArray();

        if (!empty($data)) {
            return response()->json(['status' => 1, 'subjects' => $data]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function getsub(Request $request)
    {
        $school_id = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
        $data = Subject::where("class_id", $request->id)->where("school_id", $school_id)->get()->toArray();
        return response()->json($data);
    }

    public function addtimetable(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'standard' => 'required',
            'file' => 'required',
        ]);
        if ($validatedData->passes()) {
            $time = $request->file('file')->store("public/uploads");
            $timetablepdf = str_replace("public", "storage", $time);
            $schoolid = Schools::where("user_id", Auth::user()->user_id)->value("school_id");
            $timetable = Timetable::where("class_id", $request->standard)->exists();
            if ($timetable == true) {
                $files = new Timetable();
                $files->where('class_id', $request->standard)->update([
                    'file' => $timetablepdf
                ]);
                return response()->json(['status' => 1, 'message' => "Timetable Updated Sucessfully"]);
            } else {
                $timetables = new Timetable();
                $timetables->file = $timetablepdf;
                $timetables->school_id = $schoolid;
                $timetables->class_id = $request->standard;
                $timetables->save();
                return response()->json(['status' => 1, 'message' => "Timetable Added Sucessfully"]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }

    public function addteachertimetable(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'teachers' => 'required',
            'file' => 'required',
        ]);
        if ($validatedData->passes()) {
            $time = $request->file('file')->store("public/uploads");
            $timetablepdf = str_replace("public", "storage", $time);
            $schoolid = Schools::where("user_id", Auth::user()->user_id)->value("school_id");
            $timetable = Teachertimetable::where("teacher_id", $request->teachers)->exists();
            if ($timetable == true) {
                $files = new Teachertimetable();
                $files->where('teacher_id', $request->teachers)->update([
                    'file' => $timetablepdf
                ]);
                return response()->json(['status' => 1, 'message' => "Timetable Updated Sucessfully"]);
            } else {
                $timetables = new Teachertimetable();
                $timetables->file = $timetablepdf;
                $timetables->school_id = $schoolid;
                $timetables->teacher_id = $request->teachers;
                $timetables->save();
                return response()->json(['status' => 1, 'message' => "Timetable Added Sucessfully"]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }

    public function addexam(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'standard' => 'required',
            'file' => 'required',
        ]);
        if ($validatedData->passes()) {
            $time = $request->file('file')->store("public/uploads");
            $timetablepdf = str_replace("public", "storage", $time);
            $schoolid = Schools::where("user_id", Auth::user()->user_id)->value("school_id");
            $classids = Classes::whereIn("name", $request->standard)->where("school_id", $schoolid)->pluck("class_id");
            $warning = [];
            $success = [];
            foreach ($classids as $timetables) {
                $check = Exam::where("class_id", $timetables)->where("name", $request->name)->where("school_id", $schoolid)->exists();
                if ($check == true) {
                    $examid = Exam::where("class_id", $timetables)->where("name", $request->name)->where("school_id", $schoolid)->value("exam_id");
                    $exams = new Exam();
                    $exams->where("exam_id", $examid)->update(['timetable' => $timetablepdf]);
                    array_push($warning, "Exam Already Exist");
                } else {
                    $exams = new Exam();
                    $exams->name = $request->name;
                    $exams->timetable = $timetablepdf;
                    $exams->school_id = $schoolid;
                    $exams->class_id = $timetables;
                    $exams->save();
                    $classname = Classes::where("class_id", $timetables)->value("name");
                    $classdiv = Classes::where("class_id", $timetables)->value("div");
                    $notice = new Notice();
                    $notice->title = $request->name;
                    $notice->description = $classname . "-" . $classdiv . " " . $request->name . " Exam Time-table";
                    $notice->file = $timetablepdf;
                    $notice->to = 3;
                    $notice->school_id = $schoolid;
                    $notice->save();
                    // dd($exams);
                    array_push($success, "Exam Added Sucessfully");
                }
            }
            $data = compact("warning", "success");
            return response()->json($data);
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }


    public function getexams()
    {
        $schoolid = Schools::where("user_id", Auth::user()->user_id)->value("school_id");
        $data = Exam::leftJoin('classes', 'classes.class_id', '=', 'exams.class_id')->select('exams.name', 'exams.exam_id', 'exams.timetable', 'classes.name as standard', 'classes.div')->where("exams.school_id", $schoolid)->get();
        return response()->json($data);
    }


    public function getexam(Request $request)
    {
        $schoolid = Schools::where("user_id", Auth::user()->user_id)->value("school_id");
        $data = Exam::leftJoin('classes', 'classes.class_id', '=', 'exams.class_id')->select('exams.name', 'exams.exam_id')->where("exams.school_id", $schoolid)->where("exams.class_id", $request->id)->get()->toArray();
        return response()->json($data);
    }


    public function editexam(Request $request)
    {
        // dd($request->data);
        $data = Exam::leftJoin('classes', 'classes.class_id', '=', 'exams.class_id')->select('exams.name', 'exams.exam_id', 'exams.timetable', 'classes.name as standard', 'classes.div')->where("exams.exam_id", $request->data)->first();
        return response()->json($data);
    }

    public function updateexam(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'editexamid' => 'required',
            'editexamname' => 'required',
            'editexamclass' => 'required',
            'editexamdiv' => 'required',
            'file' => 'required',
        ]);
        if ($validatedData->passes()) {
            $check = Exam::where('exam_id', $request->editexamid)->value('school_id');
            $schoolid = Schools::where("user_id", Auth::user()->user_id)->value("school_id");
            if ($check == $schoolid) {
                $time = $request->file('file')->store("public/uploads");
                $timetablepdf = str_replace("public", "storage", $time);
                $exam = new Exam();
                $exam->where('exam_id', $request->editexamid)->update([
                    'timetable' => $timetablepdf
                ]);
                return response()->json(['status' => 1, 'message' => "Exam Updated Successfully!"]);
            } else {
                return response()->json(['status' => 0, 'message' => "You are not allowed to Update"]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }


    public function assignteacher(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'standard' => 'required',
            'subjects' => 'required',
            'teacher' => 'required',
        ]);
        if ($validatedData->passes()) {
            $subject = new Subject();
            $subject->where("subject_id", $request->subjects)->update([
                'teacher_id' => $request->teacher
            ]);
            return response()->json(['status' => 1, 'message' => "Teacher Assigned Successfully!"]);
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }

    public function assignclass(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'standard' => 'required',
            'teacher' => 'required',
        ]);
        if ($validatedData->passes()) {
            $teacher = new Teacher();
            $teacher->where("teacher_id", $request->teacher)->update([
                'class_id' => $request->standard,
            ]);
            return response()->json(['status' => 1, 'message' => "Class Assigned Successfully!"]);
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }


    public function subjectslist()
    {
        $schoolid = Schools::where("user_id", Auth::user()->user_id)->value("school_id");
        $data = Subject::leftjoin('teachers', 'subjects.teacher_id', '=', 'teachers.teacher_id')->leftjoin('classes', 'subjects.class_id', '=', 'classes.class_id')->select('classes.name as classname', 'classes.div as section', 'subjects.name as subject', 'teachers.name as teacher')->where('subjects.school_id', $schoolid)->get();
        return response()->json($data);
    }


    public function teacherslist()
    {
        $school_id = Schools::where("user_id", Auth::user()->user_id)->value("school_id");
        $data = Teacher::join("classes", "classes.class_id", "=", "teachers.class_id")->where("teachers.school_id", $school_id)->select("classes.name as class", "teachers.name as teacher", "classes.div")->get();
        return response()->json($data);
    }
    public function getexamclass()
    {
        $school = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
        $standard = Exam::leftjoin('classes', 'classes.class_id', '=', 'exams.class_id')->select('classes.name as name', 'classes.class_id as class_id', 'classes.div as div')->where("exams.school_id", $school)->distinct("class_id")->get()->toArray();
        $data = compact('school', 'standard');
        return response()->json($data);
    }


    public function getentrymarks(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'standard' => 'required',
            'exams' => 'required',
            'subjects' => 'required',
        ]);
        if ($validatedData->passes()) {
            $results = Result::where("exam_id", $request->exams)->where("subject_id", $request->subjects)->first();
            // dd($results);
            if (isset($results)) {
                return response()->json(['status' => 0, 'message' => "Results already exist"]);
            } else {
                $students = Student::select("student_id", "name")->where("class_id", $request->standard)->get()->toArray();
                $exams = Exam::select("exam_id", "name", "class_id")->where("exam_id", $request->exams)->first();
                $subject = Subject::select("subject_id", "name")->where("subject_id", $request->subjects)->first();
                $data = compact("students", "exams", "subject");
                return response()->json($data);
            }
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }

    public function insertresult(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'subject_id.*' => 'required',
            'marks.*' => 'required',
        ]);
        if ($validatedData->passes()) {
            $school = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
            foreach ($request->marks as $key => $mark) {
                $result = new Result;
                $result->marks = $mark;
                $result->class_id = $request->class_id;
                $result->subject_id = $request->subject_id;
                $result->school_id = $school;
                $result->exam_id = $request->exam_id;
                $result->student_id = $key;
                $result->save();
            }
            return response()->json(['status' => 1, 'message' => "Result Added Successfully"]);
        } else {
            return response()->json(['status' => 0, 'message' => "All Students marks are required"]);
        }
    }

    public function getresults(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'standard.*' => 'required',
            'exams' => 'required',
            'subjects' => 'required',
        ]);
        if ($validatedData->passes()) {
            $data = Result::join('students', 'results.student_id', '=', 'students.student_id')->select('results.*', 'students.name as student_name')->where("results.class_id", $request->standard)->where("results.exam_id", $request->exams)->where("results.subject_id", $request->subjects)->get();
            return response()->json($data);
        } else {
            return response()->json(['status' => 0, 'message' => "All Students marks are required"]);
        }
    }

    public function geteditresult(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'user_id.*' => 'required',
        ]);
        if ($validatedData->passes()) {
            $student_id = Result::select("student_id", "marks")->where("result_id", $request->id)->value("student_id");
            $name = Student::where("student_id", $student_id)->value("name");
            $marks = Result::where("result_id", $request->id)->value("marks");
            return response()->json(compact("marks", "name"));
        } else {
            return response()->json(['status' => 0, 'message' => "Somthing went wrong"]);
        }
    }

    public function updateresult(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            // 'editstudentname' => 'required',
            'marks' => 'required',
            'editresultid' => 'required',
        ]);
        if ($validatedData->passes()) {
            $edit = new Result();
            $edit->where('result_id', $request->editresultid)->update([
                "marks" => $request->marks
            ]);
            return response()->json(['status' => 1, 'message' => "Updated Successfully"]);
        } else {
            return response()->json(['status' => 0, 'message' => "Somthing went wrong"]);
        }
    }

    public function getfeecategory()
    {
        $school = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
        $data = Feescategory::select("feescategory_id", "name")->where("school_id", $school)->get()->toArray();
        return response()->json($data);
    }

    public function addfeecategory(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'category' => 'required',
            // 'editresultid' => 'required',
        ]);
        if ($validatedData->passes()) {
            $school = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
            $fees = Feescategory::where("school_id", $school)->pluck("name")->toArray();
            $category = strtolower($request->category);
            $categories = array_map('strtolower', $fees);
            if (in_array($category, $categories)) {
                return response()->json(['status' => 0, 'message' => "Fee Category Already Exist"]);
            } else {
                $fees = new Feescategory();
                $fees->name = $request->category;
                $fees->school_id = $school;
                $fees->save();
                return response()->json(['status' => 1, 'message' => "$request->category Added Successfully"]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => "Somthing went wrong"]);
        }
    }

    public function deletefeecategory(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validatedData->passes()) {
            $deleteid = $request->id;
            $data = Feescategory::find($deleteid);
            $data->delete();
            return response()->json(['status' => 1, 'message' => "Fee category removed Successfully"]);
        } else {
            return response()->json(['status' => 0, 'message' => "Somthing went wrong"]);
        }
    }

    public function managefeeamount(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'standard' => 'required',
            'category' => 'required',
            'amount' => 'required|numeric',
        ]);
        if ($validatedData->passes()) {
            DB::beginTransaction();
            try {
                $schoolid = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
                $classids = Classes::whereIn('name', $request->standard)->where("school_id", $schoolid)->pluck("class_id");
                $errors = [];
                $success = [];
                // dd($classids);
                foreach ($classids as $class_id) {
                    $check = Fee::where("feescategory_id", $request->category)->where("class_id", $class_id)->exists();
                    if ($check == true) {
                        $fees = new Fee();
                        // $fees->
                        $fees->where("feescategory_id", $request->category)->where("class_id", $class_id)->update([
                            'amount' => $request->amount
                        ]);
                        array_push($errors, "Fees Updated!");
                    } else {
                        $fees = new Fee();
                        $fees->amount = $request->amount;
                        $fees->feescategory_id = $request->category;
                        $fees->class_id = $class_id;
                        $fees->school_id = $schoolid;
                        $fees->save();
                        array_push($success, "Fees Added Successfully!");
                    }
                }
                $data = compact('errors', 'success');
                DB::commit();
                return response()->json($data);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status' => 0, 'message' => $e]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }

    public function feeslist()
    {
        $school = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
        // $data = Fee::join('feescategories', 'fees.feescategory_id', '=', 'feescategories.feescategory_id')->join('classes', 'fees.class_id', '=', 'classes.class_id')->where('fees.school_id', $school)->select('feescategories.name as category', 'classes.name as class', 'fees.amount as amount', 'fees.fee_id as fee_id')->distinct("fee_id")->get();
        // dd($data);
        $data = Fee::join('feescategories', 'fees.feescategory_id', '=', 'feescategories.feescategory_id')->join('classes', 'fees.class_id', '=', 'classes.class_id')->where('fees.school_id', $school)->select('feescategories.name as category', 'classes.name as class', 'fees.amount as amount', 'fees.fee_id as fee_id', "classes.div")->get();
        // dd($data);
        return response()->json($data);
    }

    public function geteditfee(Request $request)
    {
        // $school = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
        $data = Fee::join("feescategories", "feescategories.feescategory_id", "=", "fees.feescategory_id")->join('classes', 'fees.class_id', '=', 'classes.class_id')->select("fees.*", "feescategories.name", "classes.name as class")->where("fee_id", $request->fee_id)->first();
        return response()->json($data);
    }

    public function editfee(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'editfeeid' => 'required|numeric',
            'editfeeamount' => 'required|numeric',
        ]);
        if ($validatedData->passes()) {
            $school = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
            $fee = new Fee();
            $data = $fee->where('fee_id', $request->editfeeid)->where("school_id", $school)->update([
                'amount' => $request->editfeeamount
            ]);
            if ($data) {
                return response()->json(['status' => 1, 'message' => 'Fee Updated Successfully!']);
            } else {
                return response()->json(['status' => 0, 'message' => "Somthing went wrong"]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => "Somthing went wrong"]);
        }
    }

    //    public function getfeedatils(Request $request){
//        $fee=Feestatus::where("student_id",$request->students)->where("class_id",$request->standard);
//        return response()->json($request);
//    }

    public function sendnotice(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'title' => 'required',
            'notice' => 'required',
            'file' => 'mimes:pdf',
            'to' => 'required',
        ], ['file.required' => 'File is Required', 'file.pdf' => 'File must be pdf']);
        if ($validatedData->passes()) {
            if ($request->file) {
                $file = $request->file('file')->store("public/uploads");
                $noticefile = str_replace("public", "storage", $file);
            }
            $school = Schools::where('user_id', Auth::user()->user_id)->value("school_id");
            $to = (count($request->to) == 2) ? 3 : $request->to[0];
            $notice = new Notice();
            $notice->title = $request->title;
            $notice->description = $request->notice;
            $notice->file = $noticefile ?? null;
            $notice->to = $to;
            $notice->school_id = $school;
            $notice->save();
            return response()->json(['status' => 1, 'message' => "Notice Added Successfully"]);
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }

    public function getnotices()
    {
        if (Auth::user()->role == 2) {
            $school = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
        } elseif (Auth::user()->role == 3) {
            $school = Teacher::where('user_id', Auth::user()->user_id)->value('school_id');
        } else {
            $school = Student::where('user_id', Auth::user()->user_id)->value('school_id');
        }
        $notice = Notice::where('school_id', $school)->get()->toArray();
        return response()->json($notice);
    }

    public function deletenotice(Request $request)
    {
        $notice = Notice::find($request->notice_id);
        $data = $notice->delete();
        if ($data) {
            return response()->json(['status' => 1, 'message' => 'Notice Deleted!']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong!']);
        }
    }

    public function raiseticket(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'issue' => 'required',
        ]);
        if ($validatedData->passes()) {
            if ($request->file) {
                $attachment = $request->file('file')->store("public/uploads");
                $file = str_replace("public", "storage", $attachment);
            }
            $school = Schools::where("user_id", Auth::user()->user_id)->value("school_id");
            $ticket = new Ticket();
            $ticket->description = $request->issue;
            $ticket->attachment = $file ?? null;
            $ticket->school_id = $school;
            $ticket->save();
            return response()->json(['status' => 1, 'message' => "Ticket Raised Successfully!"]);
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }

    public function gettickets()
    {
        $role = Auth::user()->role;
        if ($role == 1) {
            $tickets = Ticket::join("schools", "schools.school_id", "tickets.school_id")->select("tickets.*", "schools.name", "schools.email", "schools.school_id", "schools.phone")->orderBy("ticket_id", "DESC")->get()->toArray();
        } else {
            $school = Schools::where("user_id", Auth::user()->user_id)->value("school_id");
            $tickets = Ticket::where("school_id", $school)->get()->toArray();
        }
        return response()->json($tickets);
    }

    public function schoolusers()
    {
        $data = Schools::join("users", "schools.user_id", "=", "users.user_id")->where("users.role", 2)->get()->toArray();
        return response()->json($data);
    }

    public function updateticketstatus(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validatedData->passes()) {
            $status = Ticket::where("ticket_id", $request->id)->value("status");
            if ($status == '0') {
                $update = '1';
            } else {
                $update = '0';
            }
            $ticket = new Ticket();
            $ticket->where("ticket_id", $request->id)->update(["status" => $update]);
            return response()->json(['status' => 1, 'message' => "Ticket Status Updated Successfully!"]);
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }


    public function verifystatus()
    {
        $status = Schools::where("user_id", Auth::user()->user_id)->value("status");
        return response()->json($status);
    }

    public function addstudymaterials(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            "subject" => "required",
            "title" => "required",
            "file" => "required",
        ], ["file.required" => "File is Required"]);
        if ($validatedData->passes()) {
            $school_id = Teacher::where("user_id", Auth::user()->user_id)->value("school_id");
            $class_id = Teacher::where("user_id", Auth::user()->user_id)->value("class_id");
            $file = $request->file('file')->store("public/uploads");
            $studyfile = str_replace("public", "storage", $file);
            $studymaterial = new Studymaterial();
            $studymaterial->name = $request->title;
            $studymaterial->file = $studyfile;
            $studymaterial->school_id = $school_id;
            $studymaterial->class_id = $class_id;
            $studymaterial->subject_id = $request->subject;
            $studymaterial->save();
            return response()->json(['status' => 1, 'message' => "Study Material added Successfully!"]);
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }


    public function studymaterial()
    {
        $class_id = Teacher::where('user_id', Auth::user()->user_id)->value('class_id');
        $data = Studymaterial::join("subjects", "studymaterials.subject_id", "=", "subjects.subject_id")->select("studymaterials.created_at as date", "studymaterials.name as title", "studymaterials.file", "subjects.name as subject", "studymaterials.studymaterial_id")->where('studymaterials.class_id', $class_id)->get()->toArray();
        return response()->json($data);
    }


    public function deletestudymaterials(Request $request)
    {
        $studymaterial = new Studymaterial();
        $delete = $studymaterial->find($request->id);
        $delete->delete();
        return response()->json(['status' => 1, 'message' => "Study Material Deleted Successfully!"]);
    }


    public function gethomework(Request $request)
    {
        $class_id = Teacher::where('user_id', Auth::user()->user_id)->value('class_id');
        $data = Homework::join("subjects", "homework.subject_id", "=", "subjects.subject_id")->join("classes", "classes.class_id", "=", "subjects.class_id")->select("classes.name as class", "classes.div", "homework.content as content", "homework.file", "subjects.name as subject", "homework.homework_id")->where('homework.class_id', $class_id)->get()->toArray();
        return response()->json($data);
    }

    public function addhomework(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            "subject" => "required",
            "homework" => "required",
            "file" => "required",
        ], ["file.required" => "File is Required"]);
        if ($validatedData->passes()) {
            $school_id = Teacher::where("user_id", Auth::user()->user_id)->value("school_id");
            $class_id = Subject::where("subject_id", $request->subject)->value("class_id");
            $attachment = $request->file('file')->store("public/uploads");
            $file = str_replace("public", "storage", $attachment);
            $homework = new Homework();
            $homework->content = $request->homework;
            $homework->file = $file;
            $homework->school_id = $school_id;
            $homework->class_id = $class_id;
            $homework->subject_id = $request->subject;
            $homework->save();
            return response()->json(['status' => 1, 'message' => "Homework Added Successfully!"]);
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }

    }

    public function deletehomework(Request $request)
    {
        $homework = new Homework();
        $delete = $homework->find($request->id);
        $delete->delete();
        return response()->json(['status' => 1, 'message' => "Study Material Deleted Successfully!"]);
    }

    public function getpayments()
    {
        $data = Payment::all()->toArray();
        return response()->json($data);
    }

    public function getfeedatils()
    {
        $school_id = Schools::where("user_id", Auth::user()->user_id)->value("school_id");
        $data = Feestatus::where("feestatuses.school_id", $school_id)->join("fees", "fees.fee_id", "=", "feestatuses.fee_id")->join("feescategories", "fees.feescategory_id", "=", "feescategories.feescategory_id")->join("students", "students.student_id", "feestatuses.student_id")->join("classes", "classes.class_id", "=", "students.class_id")->select("classes.name as class", "classes.div", "feestatuses.status", "students.user_id", "students.name as student", "feescategories.name as term", "feestatuses.feestatus_id")->get()->toArray();
        return response()->json($data);
    }

    public function getfeedetails(Request $request)
    {
        $school_id = Schools::where("user_id", Auth::user()->user_id)->value("school_id");
        $data = Feestatus::where("feestatuses.school_id", $school_id)->join("fees", "fees.fee_id", "=", "feestatuses.fee_id")->join("feescategories", "fees.feescategory_id", "=", "feescategories.feescategory_id")->join("students", "students.student_id", "feestatuses.student_id")->join("classes", "classes.class_id", "=", "students.class_id")->select("classes.name as class", "classes.div", "feestatuses.status", "students.user_id", "students.name as student", "feescategories.name as term", "feestatuses.feestatus_id")->where("feestatus_id", $request->id)->first();
        return response()->json($data);
    }


    public function updatefeestatus(Request $request)
    {
        $feestatus = new Feestatus();
        $feestatus->where("feestatus_id", $request->feesstatus_id)->update([
            "status" => "1"
        ]);
        return response()->json(["status" => 1, "message" => "Fee Collected Successfully!"]);
    }

    public function getattendance()
    {
        $school_id = Schools::where("user_id", Auth::user()->user_id)->value("school_id");
        $data = Attendance::where("attendances.school_id", $school_id)->join("classes", "attendances.class_id", "=", "classes.class_id")->join("students", "attendances.student_id", "=", "students.student_id")->select("attendances.*", "classes.name as class", "students.name as student", "classes.div", "students.rollno")->get()->toArray();
        return response()->json($data);
    }
}
