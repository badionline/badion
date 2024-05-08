<?php

namespace App\Http\Controllers;

// use Mail;
//use App\Http\Middleware\Teacher;
use App\Mail\password;
use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Fee;
use App\Models\Feestatus;
use App\Models\Schools;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function RandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 8; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randstring .= $characters[$index];
        }
        return $randstring;
    }

    public function getstudents()
    {
        if (Auth::user()->user_id != 10000001) {
            $school_id = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
            $data = Student::where('school_id', $school_id)->get()->toArray();
        } else {
            $data = Student::all()->toArray();
        }
        return response()->json($data);
    }

    public function tgetstudents()
    {
        $class_id = Teacher::where('user_id', Auth::user()->user_id)->value('class_id');
        $data = Student::where('class_id', $class_id)->get()->toArray();
        return response()->json($data);
    }

    public function getdeletestudent(Request $request)
    {
        $data = Student::select('name', 'student_id')->where('user_id', $request->user_id)->first();
        return response()->json($data);
    }

    public function getpaststudents()
    {
        if (Auth::user()->user_id != 10000001) {
            $school_id = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
            $data = Student::onlyTrashed()->where('school_id', $school_id)->get();
        } else {
            $data = Student::onlyTrashed()->get()->toArray();
        }
        return response()->json($data);
    }

    // Validations Starts Here
    public function validateaddstudent(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'schoolid' => 'required',
            'name' => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required|numeric|min_digits:10|max_digits:10',
            'address' => 'required',
            'gender' => 'required',
            'addmissionno' => 'required',
            'rollno' => 'required',
            'profilepic' => 'required',
            'dob' => 'required',
            'aadhaar' => 'required|numeric|min_digits:12|max_digits:12',
            'pname' => 'required|min:2',
            'pemail' => 'required|email',
            'pphone' => 'required|numeric|min_digits:10|max_digits:10',
            'standard' => 'required',
        ]);
        if ($validatedData->passes()) {
            DB::beginTransaction();
            try {
                $emails = User::where("email", $request->email)->value("email");
                if ($emails) {
                    return response()->json(['status' => 0, 'message' => 'Email Already Exist']);
                } else {
                    $fees = Fee::where("class_id", $request->standard)->get();
                    if ($fees->isNotEmpty()) {
                        $password = $this->RandomString();
                        $picture = $request->file('profilepic')->store("public/uploads");
                        $profilepic = str_replace("public", "storage", $picture);
                        $user = new User();
                        $user->name = $request->name;
                        $user->email = $request->email;
                        $user->password = bcrypt($password);
                        $user->role = 4;
                        $user->save();
                        $student = new Student();
                        $student->name = $request->name;
                        $student->email = $request->email;
                        $student->phone = $request->phone;
                        $student->address = $request->address;
                        $student->gender = $request->gender;
                        $student->addmissionno = $request->addmissionno;
                        $student->rollno = $request->rollno;
                        $student->profilepic = $profilepic;
                        $student->dob = $request->dob;
                        $student->aadhaar = $request->aadhaar;
                        $student->pname = $request->pname;
                        $student->pemail = $request->pemail;
                        $student->pphone = $request->pphone;
                        $student->class_id = $request->standard;
                        $student->school_id = $request->schoolid;
                        $student->user_id = $user->user_id;
                        $student->save();
                        // $fees = Fee::where("class_id", $request->standard)->get();
                        foreach ($fees as $fee) {
                            $feestatus = new Feestatus();
                            $feestatus->fee_id = $fee->fee_id;
                            $feestatus->student_id = $student->student_id;
                            $feestatus->school_id = $request->schoolid;
                            $feestatus->save();
                        }
                        $mailData = [
                            'name' => $request->name,
                            'id' => $user->user_id,
                            'password' => $password,
                        ];
                        Mail::to($request->email)->send(new password($mailData));
                        DB::commit();
                        return response()->json(['status' => 1, 'message' => 'Student Credentials Are sent to Student']);
                    } else {
                        return response()->json(['status' => 0, 'message' => "Fee Details Not Added For this Class"]);
                    }
                }
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status' => 0, 'message' => $e]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }

    public function validateeditstudent(Request $request)
    {
        if (Auth::user()->user_id == 10000001) {
            $validatedData = Validator::make($request->all(), [
                'user_id' => 'required',
                'name' => 'required|min:2',
                'email' => 'required|email',
                'phone' => 'required|numeric|min_digits:10|max_digits:10',
                'address' => 'required',
                'gender' => 'required',
                'addmissionno' => 'required',
                'profilepic' => 'required',
                'dob' => 'required',
                'aadhaar' => 'required|numeric|min_digits:12|max_digits:12',
                'pname' => 'required|min:2',
                'pemail' => 'required|email',
                'pphone' => 'required|numeric|min_digits:10|max_digits:10',
            ]);
        } else {
            $validatedData = Validator::make($request->all(), [
                'user_id' => 'required',
                'name' => 'required|min:2',
                'email' => 'required|email',
                'phone' => 'required|numeric|min_digits:10|max_digits:10',
                'address' => 'required',
                'gender' => 'required',
                'addmissionno' => 'required',
                'rollno' => 'required',
                'profilepic' => 'required',
                'dob' => 'required',
                'aadhaar' => 'required|numeric|min_digits:12|max_digits:12',
                'pname' => 'required|min:2',
                'pemail' => 'required|email',
                'pphone' => 'required|numeric|min_digits:10|max_digits:10',
                'standard' => 'required',
            ]);
        }
        if ($validatedData->passes()) {
            DB::beginTransaction();
            try {
                $email = Student::where('user_id', $request->user_id)->value("email");
                $emails = User::where("email", $request->email)->value("email");
                if ($emails != $email) {
                    $user = User::where("email", $request->email)->value("email");
                    if (!$user) {
                        $picture = $request->file('profilepic')->store("public/uploads");
                        $profilepic = str_replace("public", "storage", $picture);
                        $user = new User();
                        $user->where('user_id', $request->user_id)->update([
                            'name' => $request->name,
                            'email' => $request->email,
                        ]);
                        if (Auth::user()->user_id == 10000001) {
                            $student = new Student();
                            $student->where('user_id', $request->user_id)->update([
                                'name' => $request->name,
                                'email' => $request->email,
                                'phone' => $request->phone,
                                'address' => $request->address,
                                'gender' => $request->gender,
                                'addmissionno' => $request->addmissionno,
                                'profilepic' => $profilepic,
                                'dob' => $request->dob,
                                'aadhaar' => $request->aadhaar,
                                'pname' => $request->pname,
                                'pemail' => $request->pemail,
                                'pphone' => $request->pphone,
                            ]);
                        } else {
                            $student = new Student();
                            $student->where('user_id', $request->user_id)->update([
                                'name' => $request->name,
                                'email' => $request->email,
                                'phone' => $request->phone,
                                'address' => $request->address,
                                'gender' => $request->gender,
                                'addmissionno' => $request->addmissionno,
                                'rollno' => $request->rollno,
                                'profilepic' => $profilepic,
                                'dob' => $request->dob,
                                'aadhaar' => $request->aadhaar,
                                'pname' => $request->pname,
                                'pemail' => $request->pemail,
                                'pphone' => $request->pphone,
                                'class_id' => $request->standard,
                            ]);
                        }
                        DB::commit();
                        return response()->json(['status' => 1, 'message' => 'Student Details Are Updated']);
                    } else {
                        return response()->json(['status' => 0, 'message' => 'Email Already Exist']);
                    }
                } else {
                    $picture = $request->file('profilepic')->store("public/uploads");
                    $profilepic = str_replace("public", "storage", $picture);
                    $user = new User();
                    $user->where('user_id', $request->user_id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                    ]);
                    if (Auth::user()->user_id == 10000001) {

                        $student = new Student();
                        $student->where('user_id', $request->user_id)->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'phone' => $request->phone,
                            'address' => $request->address,
                            'gender' => $request->gender,
                            'addmissionno' => $request->addmissionno,
                            'profilepic' => $profilepic,
                            'dob' => $request->dob,
                            'aadhaar' => $request->aadhaar,
                            'pname' => $request->pname,
                            'pemail' => $request->pemail,
                            'pphone' => $request->pphone,
                        ]);
                    } else {

                        $student = new Student();
                        $student->where('user_id', $request->user_id)->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'phone' => $request->phone,
                            'address' => $request->address,
                            'gender' => $request->gender,
                            'addmissionno' => $request->addmissionno,
                            'rollno' => $request->rollno,
                            'profilepic' => $profilepic,
                            'dob' => $request->dob,
                            'aadhaar' => $request->aadhaar,
                            'pname' => $request->pname,
                            'pemail' => $request->pemail,
                            'pphone' => $request->pphone,
                            'class_id' => $request->standard,
                        ]);
                    }
                    DB::commit();
                    return response()->json(['status' => 1, 'message' => 'Student Details Are Updated']);
                }
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status' => 0, 'message' => $e->getMessage()]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }


    public function deletestudent(Request $request)
    {
        DB::beginTransaction();
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            $deleteid = $request->deletestudentid;
            $userid = Student::where("student_id", $deleteid)->value("user_id");
            Student::find($deleteid)->delete();
            User::find($userid)->delete();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            DB::commit();
            return response()->json(['status' => 1, 'message' => "Student has been removed"]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 0, 'message' => $e->getMessage()]);
        }
    }


    public function studentchangepass(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'user_id' => 'required',
            'password' => 'required',
            'cpassword' => 'required|same:password',
        ]);
        if ($validatedData->passes()) {
            $user = new User();
            $user->where('user_id', $request->user_id)->update([
                'password' => bcrypt($request->password),
            ]);
            return response()->json(['status' => 1, 'message' => "Password Updated Successfully"]);
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }

    // public function studentfee()
    // {
    //     $school = Student::where("user_id", Auth::user()->user_id)->value("school_id");
    //     $class = Student::where("user_id", Auth::user()->user_id)->value("class_id");
    //     $data = Fee::join("feescategories", "feescategories.feescategory_id", "=", "fees.feescategory_id")->join("feestatuses", "fees.fee_id", "=", "feestatuses.fee_id")->select("feescategories.name as name", "fees.amount as amount", "feestatuses.feestatus_id")->where("fees.school_id", $school)->where("fees.class_id", $class)->get()->toArray();
    //     return response()->json($data);
    // }


    //    public function class_students()
//    {
//        $class_id=Teacher::where("user_id",Auth::user()->user_id)->value("class_id");
//        $students=Student::where("class_id", $class_id)->get()->toArray();
//        return response()->json($students);
//    }

    public function insertattendance(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'attendance.*' => 'required|in:P,A,L',
        ]);
        if ($validatedData->passes()) {

            $class_id = Teacher::where("user_id", Auth::user()->user_id)->value("class_id");
            $check = Attendance::where('class_id', $class_id)->where("date", date('Y-m-d'))->exists();
            if ($check) {
                return response()->json(['status' => 0, 'message' => "Attendance Already Exist!"]);
            } else {
                $school_id = Teacher::where('user_id', Auth::user()->user_id)->value('school_id');
                foreach ($request->attendance as $key => $attendance) {
                    $status = "$attendance";
                    $attendance = new Attendance();
                    $attendance->date = date(now());
                    $attendance->status = $status;
                    $attendance->student_id = $key;
                    $attendance->class_id = $class_id;
                    $attendance->school_id = $school_id;
                    $attendance->save();
                }
                return response()->json(['status' => 1, 'message' => "Attendance Added Successfully"]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => "All Students marks are required"]);
        }
    }
}
