<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Schools;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AdminController extends Controller
{
    public function adminhome()
    {
        $schools = Schools::join("users", "users.user_id", "=", "schools.user_id")->where("users.role", 2)->get()->toArray();
        $schoolscount = count($schools);
        $new = Schools::join("users", "users.user_id", "=", "schools.user_id")->where("users.role", 5)->get()->toArray();
        $newcount = count($new);
        $teachers = Teacher::all();
        $teacherscount = count($teachers);
        $students = Student::all();
        $studentscount = count($students);
        return response()->json(compact('schoolscount', 'newcount', 'teacherscount', 'studentscount'));
    }

    public function adminchangepass(Request $request)
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
