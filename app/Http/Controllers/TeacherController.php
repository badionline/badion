<?php

namespace App\Http\Controllers;

use App\Http\Middleware\School;
use App\Models\Student;
use Database\Seeders\Students;
use Illuminate\Support\Facades\Mail;
use App\Mail\password;
use App\Models\Classes;
use App\Models\Schools;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
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

    //Getting Values From Here
    // public function getstandard()
    // {
    //     $school = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
    //     $standard = Classes::select('name', 'class_id', 'div')->where('school_id', $school)->get()->toArray();
    //     //        $school=$schoolid[0];
    //     $data = compact('school', 'standard');
    //     return response()->json($data);
    // }

    public function getteachers()
    {
        if (Auth::user()->user_id != 10000001) {
            $school_id = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
            $data = Teacher::where('school_id', $school_id)->get();
        } else {
            $data = Teacher::get()->toArray();
        }
        return response()->json($data);
    }

    public function getdeleteteacher(Request $request)
    {
        $data = Teacher::select('name', 'teacher_id')->where('user_id', $request->user_id)->first();
        return response()->json($data);
    }

    public function getpastteachers()
    {
        if (Auth::user()->user_id != 10000001) {
            $school_id = Schools::where('user_id', Auth::user()->user_id)->value('school_id');
            $data = Teacher::onlyTrashed()->where('school_id', $school_id)->get();
        } else {
            $data = Teacher::onlyTrashed()->get();
        }
        return response()->json($data);
    }

    // Validations Starts Here
    public function validateaddteacher(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'schoolid' => 'required',
            'name' => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required|numeric|min_digits:10|max_digits:10',
            'graduation' => 'required',
            'salary' => 'required',
            'dob' => 'required',
            'aadhaar' => 'required',
            'profilepic' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ]);

        if ($validatedData->passes()) {
            DB::beginTransaction();
            try {

                $emails = User::where("email", $request->email)->value("email");
                if ($emails) {
                    return response()->json(['status' => 0, 'message' => 'Email Already Exist']);
                } else {
                    $password = $this->RandomString();
                    $picture = $request->file('profilepic')->store("public/uploads");
                    $profilepic = str_replace("public", "storage", $picture);
                    $user = new User();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = bcrypt($password);
                    $user->role = 3;
                    $user->save();
                    $teacher = new Teacher();
                    $teacher->name = $request->name;
                    $teacher->email = $request->email;
                    $teacher->phone = $request->phone;
                    $teacher->graduation = $request->graduation;
                    $teacher->salary = $request->salary;
                    $teacher->dob = $request->dob;
                    $teacher->aadhaar = $request->aadhaar;
                    $teacher->profilepic = $profilepic;
                    $teacher->address = $request->address;
                    $teacher->gender = $request->gender;
                    $teacher->school_id = $request->schoolid;
                    $teacher->user_id = $user->user_id;
                    $teacher->save();
                    $mailData = [
                        'name' => $request->name,
                        'id' => $user->user_id,
                        'password' => $password,
                    ];
                    Mail::to($request->email)->send(new password($mailData));
                    DB::commit();
                    return response()->json(['status' => 1, 'message' => 'Teacher Credentials Are sent to teacher']);
                }
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status' => 0, 'message' => $e]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong try again!']);
        }
    }

    public function validateeditteacher(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required|numeric|min_digits:10|max_digits:10',
            'graduation' => 'required',
            'salary' => 'required',
            'dob' => 'required',
            'aadhaar' => 'required',
            'profilepic' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ]);

        if ($validatedData->passes()) {
            DB::beginTransaction();
            try {
                $email = Teacher::where('user_id', $request->user_id)->value("email");
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
                        $teacher = new Teacher();
                        $teacher->where('user_id', $request->user_id)->update([
                            'user_id' => $request->user_id,
                            'name' => $request->name,
                            'email' => $request->email,
                            'phone' => $request->phone,
                            'graduation' => $request->graduation,
                            'salary' => $request->salary,
                            'dob' => $request->dob,
                            'aadhaar' => $request->aadhaar,
                            'profilepic' => $profilepic,
                            'address' => $request->address,
                            'gender' => $request->gender,
                        ]);
                        DB::commit();
                        return response()->json(['status' => 1, 'message' => 'Teacher Details Are Updated']);
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
                    $teacher = new Teacher();
                    $teacher->where('user_id', $request->user_id)->update([
                        'user_id' => $request->user_id,
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'graduation' => $request->graduation,
                        'salary' => $request->salary,
                        'dob' => $request->dob,
                        'aadhaar' => $request->aadhaar,
                        'profilepic' => $profilepic,
                        'address' => $request->address,
                        'gender' => $request->gender,
                    ]);
                    DB::commit();
                    return response()->json(['status' => 1, 'message' => 'Teacher Details Are Updated']);
                }
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status' => 0, 'message' => 'Something Went wrong Try Again!']);
            }
        } else {
            return response()->json(['status' => 0, 'message' => 'Something Went wrong Try Again!']);
        }
    }


    public function deleteteacher(Request $request)
    {
        DB::beginTransaction();
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            $deleteid = $request->deleteteacherid;
            $userid = Teacher::where("teacher_id", $deleteid)->value("user_id");
            Teacher::find($deleteid)->delete();
            User::find($userid)->delete();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            DB::commit();
            return response()->json(['status' => 1, 'message' => "Teacher has been removed"]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 0, 'message' => $e->getMessage()]);
        }
    }


    public function teacherchangepass(Request $request)
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
}
