<?php

namespace App\Http\Controllers;


use App\Models\Attendance;
use App\Models\Fee;
use App\Models\Feestatus;
use App\Models\Result;
use App\Models\Schools;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PhpParser\Node\Expr\Print_;

class ExportController extends Controller
{
    public function exportstudents()
    {
        if (Auth::user()->user_id == "10000001") {
            $students = Student::join("classes", "classes.class_id", "=", "students.class_id")->select("students.*", "classes.name as class", "classes.div", "students.school_id")->get();
        } else {
            $school_id = Schools::where("user_id", Auth::user()->user_id)->value('school_id');
            $students = Student::join("classes", "classes.class_id", "=", "students.class_id")->select("students.*", "classes.name as class", "classes.div", "students.school_id")->where('students.school_id', $school_id)->get();
        }
        $csvFileName = 'students.csv';
        $headers = [
            'Content-Type' => 'text/xlsx',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['School Id', 'Addmission No', 'Class', 'Div', 'Roll No', 'Name', 'Email', 'Phone', 'Address', 'Gender', 'DOB', 'Aadhaar', 'Parent Name', 'Parent Email', 'Parent Phone']); // Add more headers as needed

        foreach ($students as $student) {
            if ($student->gender == "M") {
                $gender = "Male";
            } else {
                $gender = "Female";
            }
            fputcsv($handle, [$student->school_id, $student->addmissionno, $student->class, $student->div, $student->rollno, $student->name, $student->email, $student->phone, $student->address, $gender, $student->dob, $student->aadhaar, $student->pname, $student->pemail, $student->pphone]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }

    public function exportpaststudents()
    {
        if (Auth::user()->user_id == "10000001") {
            $students = Student::onlyTrashed()->join("classes", "classes.class_id", "=", "students.class_id")->select("students.*", "classes.name as class", "classes.div", "students.school_id")->get();
        } else {

            $school_id = Schools::where("user_id", Auth::user()->user_id)->value('school_id');
            $students = Student::onlyTrashed()->join("classes", "classes.class_id", "=", "students.class_id")->select("students.*", "classes.name as class", "classes.div", "students.school_id")->where('students.school_id', $school_id)->get();
        }
        $csvFileName = 'past_students.csv';
        $headers = [
            'Content-Type' => 'text/xlsx',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['School Id', 'Addmission No', 'Class', 'Div', 'Roll No', 'Name', 'Email', 'Phone', 'Address', 'Gender', 'DOB', 'Aadhaar', 'Parent Name', 'Parent Email', 'Parent Phone']); // Add more headers as needed

        foreach ($students as $student) {
            if ($student->gender == "M") {
                $gender = "Male";
            } else {
                $gender = "Female";
            }
            fputcsv($handle, [$student->$school_id, $student->addmissionno, $student->class, $student->div, $student->rollno, $student->name, $student->email, $student->phone, $student->address, $gender, $student->dob, $student->aadhaar, $student->pname, $student->pemail, $student->pphone]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }


    public function exportteachers()
    {
        if (Auth::user()->user_id == "10000001") {
            $teachers = Teacher::Leftjoin("classes", "classes.class_id", "=", "teachers.class_id")->select("teachers.*", "classes.name as class", "classes.div", "teachers.school_id")->get();
        } else {
            $school_id = Schools::where("user_id", Auth::user()->user_id)->value('school_id');
            $teachers = Teacher::Leftjoin("classes", "classes.class_id", "=", "teachers.class_id")->select("teachers.*", "classes.name as class", "classes.div", "teachers.school_id")->where('teachers.school_id', $school_id)->get();
        }
        $csvFileName = 'teachers.csv';
        $headers = [
            'Content-Type' => 'text/xlsx',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['School Id', 'Class', 'Div', 'Name', 'Email', 'Phone', 'Address', 'Gender', 'DOB', 'Aadhaar', 'Graduation', 'Salary']); // Add more headers as needed

        foreach ($teachers as $teacher) {
            if ($teacher->gender == "M") {
                $gender = "Male";
            } else {
                $gender = "Female";
            }
            fputcsv($handle, [$teacher->school_id, $teacher->class, $teacher->div, $teacher->name, $teacher->email, $teacher->phone, $teacher->address, $gender, $teacher->dob, $teacher->aadhaar, $teacher->graduation, $teacher->salary]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }

    public function exportpastteachers()
    {
        if (Auth::user()->user_id == "10000001") {
            $teachers = Teacher::onlyTrashed()->Leftjoin("classes", "classes.class_id", "=", "teachers.class_id")->select("teachers.*", "classes.name as class", "classes.div", "teachers.school_id")->get();
        } else {
            $school_id = Schools::where("user_id", Auth::user()->user_id)->value('school_id');
            $teachers = Teacher::onlyTrashed()->Leftjoin("classes", "classes.class_id", "=", "teachers.class_id")->select("teachers.*", "classes.name as class", "classes.div", "teachers.school_id")->where('teachers.school_id', $school_id)->get();
        }
        //        die();
        $csvFileName = 'past_teachers.csv';
        $headers = [
            'Content-Type' => 'text/xlsx',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['School Id', 'Class', 'Div', 'Name', 'Email', 'Phone', 'Address', 'Gender', 'DOB', 'Aadhaar', 'Graduation', 'Salary']); // Add more headers as needed

        foreach ($teachers as $teacher) {
            if ($teacher->gender == "M") {
                $gender = "Male";
            } else {
                $gender = "Female";
            }
            fputcsv($handle, [$teacher->$school_id, $teacher->class, $teacher->div, $teacher->name, $teacher->email, $teacher->phone, $teacher->address, $gender, $teacher->dob, $teacher->aadhaar, $teacher->graduation, $teacher->salary]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }
    public function exportattendance()
    {
        $school_id = Schools::where("user_id", Auth::user()->user_id)->value('school_id');
        $attendances = Attendance::join("classes", "classes.class_id", "attendances.class_id")->join("students", "students.student_id", "attendances.student_id")->select("attendances.*", "students.name as student", "classes.name as class", "classes.div")->where("attendances.school_id", $school_id)->get();
        $csvFileName = 'attendance.csv';
        $headers = [
            'Content-Type' => 'text/xlsx',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Date', 'Class', 'Div', 'Name', 'Status']); // Add more headers as needed

        foreach ($attendances as $attendanc) {
            fputcsv($handle, [$attendanc->date, $attendanc->class, $attendanc->div, $attendanc->student, $attendanc->status]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }

    public function exportresults()
    {
        $school_id = Schools::where("user_id", Auth::user()->user_id)->value('school_id');
        $results = Result::join("subjects", "results.subject_id", "subjects.subject_id")->join("classes", "classes.class_id", "results.class_id")->join("exams", "exams.exam_id", "results.exam_id")->join("students", "students.student_id", "results.student_id")->select("results.*", "students.name as student", "classes.name as class", "classes.div", "subjects.name as subject", "exams.name as exam")->where("results.school_id", $school_id)->get();
        $csvFileName = 'results.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Exam', 'Class', 'Div', 'Name', 'Subject', 'Marks']); // Add more headers as needed

        foreach ($results as $result) {
            fputcsv($handle, [$result->exam, $result->class, $result->div, $result->student, $result->subject, $result->marks]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }

    public function exportfees()
    {
        if (Auth::user()->user_id == "10000001") {
            $fees = Feestatus::join("students", "students.student_id", "=", "feestatuses.student_id")->join("classes", "students.class_id", "=", "classes.class_id")->join("fees", "fees.fee_id", "feestatuses.fee_id")->join("feescategories", "feescategories.feescategory_id", "=", "fees.fee_id")->select("feescategories.name as term", "fees.amount", "students.name as student", "students.rollno", "classes.name as class", "classes.div", "feestatuses.status")->get();
        } else {
            $school_id = Schools::where("user_id", Auth::user()->user_id)->value('school_id');
            $fees = Feestatus::join("students", "students.student_id", "=", "feestatuses.student_id")->join("classes", "students.class_id", "=", "classes.class_id")->join("fees", "fees.fee_id", "feestatuses.fee_id")->join("feescategories", "feescategories.feescategory_id", "=", "fees.fee_id")->select("feescategories.name as term", "fees.amount", "students.name as student", "students.rollno", "classes.name as class", "classes.div", "feestatuses.status")->where("feestatuses.school_id", $school_id)->get();
        }
        $csvFileName = 'fees.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Term', 'Class', 'Div', 'Name', "amount", 'Status']); // Add more headers as needed

        foreach ($fees as $fee) {
            if ($fee->status == "1") {
                $status = "Paid";
            } else {
                $status = "Pending";
            }
            fputcsv($handle, [$fee->term, $fee->class, $fee->div, $fee->rollno, $fee->student, $fee->amount, $status]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }


    public function exportschools()
    {
        $schools = Schools::get();
        $csvFileName = 'schools.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Name', 'Address', 'Phone', 'Email', "Whatsapp", 'Location', 'Instagram', 'Youtube', 'Pan', 'Pan File', 'Registration Number', 'Adhaar', 'Adhaar Front', 'Adhaar Back', 'Status']); // Add more headers as needed

        foreach ($schools as $school) {
            if ($school->status == 0) {
                $status = "Disabled";
            } else {
                $status = "Enabled";
            }
            fputcsv($handle, [$school->name, $school->address, $school->phone, $school->email, $school->whatsapp, $school->location, $school->instagram, $school->youtube, $school->pan, asset($school->panfile), $school->registernumber, $school->adhaar, asset($school->adhaarfront), asset($school->adhaarback), $status]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }
}
