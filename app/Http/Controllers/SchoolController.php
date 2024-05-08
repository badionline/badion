<?php

namespace App\Http\Controllers;

use App\Mail\approve;
use App\Mail\password;
use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Schools;
use App\Models\User;

// use Validator;

class SchoolController extends Controller
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

    public function addschool(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'sname' => 'required|min:2',
            'address' => 'required|min:10',
            'phone' => 'required|digits:10',
            'email' => 'required|email',
            'location' => 'nullable|starts_with:https://maps.app.goo.gl/',
            'waurl' => 'nullable|starts_with:https://w',
            'instagram' => 'nullable|starts_with:https://www.instagram.com/',
            'youtube' => 'nullable|starts_with:https://www.youtube.com/@',
            'registernum' => 'required',
            'pan' => 'required',
            'panfile' => 'required|mimes:pdf',
            'adhaar' => 'required|digits:12',
            'adhaarfront' => 'required|mimes:pdf',
            'adhaarback' => 'required|mimes:pdf',
        ], [
            'panfile.required' => 'Pan card file is Required',
            'adhaarfront.required' => 'Adhaar card front File is Required',
            'adhaarback.required' => 'Adhaar card back File is Required',
        ]);
        if ($validatedData->passes()) {
            DB::beginTransaction();
            try {
                $user = User::where("email", $request->email)->value("email");
                if (!$user) {
                    $password = $this->RandomString();
                    $pan = $request->file('panfile')->store("public/uploads");
                    $adhaarfront = $request->file('adhaarfront')->store("public/uploads");
                    $adhaarback = $request->file('adhaarback')->store("public/uploads");
                    $panfile = str_replace("public", "storage", $pan);
                    $adhaarfrontfile = str_replace("public", "storage", $adhaarfront);
                    $adhaarbackfile = str_replace("public", "storage", $adhaarback);
                    $user = new User();
                    $user->name = $request->sname;
                    $user->email = $request->email;
                    $user->password = bcrypt($password);
                    $user->role = $request->role ?? 5;
                    $user->save();
                    $school = new Schools();
                    $school->name = $request->sname;
                    $school->address = $request->address;
                    $school->phone = $request->phone;
                    $school->email = $request->email;
                    $school->location = $request->location ?? null;
                    $school->whatsapp = $request->waurl ?? null;
                    $school->instagram = $request->instagram ?? null;
                    $school->youtube = $request->youtube ?? null;
                    $school->registernumber = $request->registernum;
                    $school->pan = $request->pan;
                    $school->panfile = $panfile;
                    $school->adhaar = $request->adhaar;
                    $school->adhaarfront = $adhaarfrontfile;
                    $school->adhaarback = $adhaarbackfile;
                    // $school->status = 0;
                    $school->user_id = $user->user_id;
                    $school->save();
                    $mailData = [
                        'name' => $request->sname,
                        'id' => $user->user_id,
                        'password' => $password,
                    ];
                    Mail::to($request->email)->send(new password($mailData));
                    DB::commit();
                } else {
                    return response()->json(['status' => 0, 'message' => [0 => "Email Already exist"]]);
                }
                return response()->json(['status' => 1, 'message' => 'School Credentials Are sent by Email']);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status' => 0, 'message' => $e]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }


    public function getnonregistered()
    {
        $schools = Schools::join("users", "users.email", "=", "schools.email")->where("users.role", 5)->get()->toArray();
        return response()->json($schools);
    }

    public function validateeditschool(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'user_id' => 'required',
            'sname' => 'required|min:2',
            'address' => 'required|min:10',
            'phone' => 'required|digits:10',
            'email' => 'required|email',
            'location' => 'nullable|starts_with:https://g.co/',
            'waurl' => 'nullable|starts_with:https://w',
            'instagram' => 'nullable|starts_with:https:/instagram.com/',
            'youtube' => 'nullable|starts_with:https://www.youtube.com/@',
            'registernum' => 'required',
            'pan' => 'required',
            'panfile' => 'required|mimes:pdf',
            'adhaar' => 'required|digits:12',
            'adhaarfront' => 'required|mimes:pdf',
            'adhaarback' => 'required|mimes:pdf',
        ], [
            'panfile.required' => 'Pan card file is Required',
            'adhaarfront.required' => 'Adhaar card front File is Required',
            'adhaarback.required' => 'Adhaar card back File is Required',
        ]);
        if ($validatedData->passes()) {
            DB::beginTransaction();
            try {
                $email = Schools::where('user_id', $request->user_id)->value("email");
                $emails = User::where("email", $request->email)->value("email");
                if ($emails != $email) {
                    $user = User::where("email", $request->email)->value("email");
                    if (!$user) {
                        $pan = $request->file('panfile')->store("public/uploads");
                        $adhaarfront = $request->file('adhaarfront')->store("public/uploads");
                        $adhaarback = $request->file('adhaarback')->store("public/uploads");
                        $panfile = str_replace("public", "storage", $pan);
                        $adhaarfrontfile = str_replace("public", "storage", $adhaarfront);
                        $adhaarbackfile = str_replace("public", "storage", $adhaarback);
                        $user = new User();
                        $user->where('user_id', $request->user_id)->update([
                            'name' => $request->sname,
                            'email' => $request->email,
                        ]);
                        $school = new Schools();
                        $school->where('user_id', $request->user_id)->update([
                            'name' => $request->sname,
                            'address' => $request->address,
                            'phone' => $request->phone,
                            'email' => $request->email,
                            'whatsapp' => $request->waurl,
                            'location' => $request->location,
                            'instagram' => $request->instagram,
                            'youtube' => $request->youtube,
                            'pan' => $request->pan,
                            'panfile' => $panfile,
                            'registernumber' => $request->registernum,
                            'adhaar' => $request->adhaar,
                            'adhaarfront' => $adhaarfrontfile,
                            'adhaarback' => $adhaarbackfile,
                        ]);
                        DB::commit();
                        return response()->json(['status' => 1, 'message' => 'School Details Are Updated']);
                    }
                    return response()->json(['status' => 0, 'message' => 'Email Already Exist!']);
                } else {
                    $pan = $request->file('panfile')->store("public/uploads");
                    $adhaarfront = $request->file('adhaarfront')->store("public/uploads");
                    $adhaarback = $request->file('adhaarback')->store("public/uploads");
                    $panfile = str_replace("public", "storage", $pan);
                    $adhaarfrontfile = str_replace("public", "storage", $adhaarfront);
                    $adhaarbackfile = str_replace("public", "storage", $adhaarback);
                    $user = new User();
                    $user->where('user_id', $request->user_id)->update([
                        'name' => $request->sname,
                        'email' => $request->email,
                    ]);
                    $school = new Schools();
                    $school->where('user_id', $request->user_id)->update([
                        'name' => $request->sname,
                        'address' => $request->address,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'whatsapp' => $request->waurl,
                        'location' => $request->location,
                        'instagram' => $request->instagram,
                        'youtube' => $request->youtube,
                        'pan' => $request->pan,
                        'panfile' => $panfile,
                        'registernumber' => $request->registernum,
                        'adhaar' => $request->adhaar,
                        'adhaarfront' => $adhaarfrontfile,
                        'adhaarback' => $adhaarbackfile,
                    ]);
                    DB::commit();
                    return response()->json(['status' => 1, 'message' => 'School Details Are Updated']);
                }
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status' => 0, 'message' => $e->getMessage()]);
            }
            //            try {
//                $user = User::where("email", $request->email)->value("email");
//                if (!$user) {
//                    $pan = $request->file('panfile')->store("public/uploads");
//                    $adhaarfront = $request->file('adhaarfront')->store("public/uploads");
//                    $adhaarback = $request->file('adhaarback')->store("public/uploads");
//                    $panfile = str_replace("public", "storage", $pan);
//                    $adhaarfrontfile = str_replace("public", "storage", $adhaarfront);
//                    $adhaarbackfile = str_replace("public", "storage", $adhaarback);
//                    $user = new User();
//                    $user->where("user_id",);
//                    $user->name = $request->sname;
//                    $user->email = $request->email;
//                    $user->password = bcrypt($password);
//                    $user->role = $request->role ?? 5;
//                    $user->save();
//                    $school = new Schools();
//                    $school->name = $request->sname;
//                    $school->address = $request->address;
//                    $school->phone = $request->phone;
//                    $school->email = $request->email;
//                    $school->location = $request->location ?? null;
//                    $school->whatsapp = $request->waurl ?? null;
//                    $school->instagram = $request->instagram ?? null;
//                    $school->youtube = $request->youtube ?? null;
//                    $school->registernumber = $request->registernum;
//                    $school->pan = $request->pan;
//                    $school->panfile = $panfile;
//                    $school->adhaar = $request->adhaar;
//                    $school->adhaarfront = $adhaarfrontfile;
//                    $school->adhaarback = $adhaarbackfile;
//                    $school->status = 0;
//                    $school->user_id = $user->user_id;
//                    $school->save();
//                    $mailData = [
//                        'name' => $request->sname,
//                        'id' => $user->user_id,
//                        'password' => $password,
//                    ];
//                    Mail::to($request->email)->send(new password($mailData));
//                    DB::commit();
//                } else {
//                    return response()->json(['status' => 0, 'message' => [0 => "Email Already exist"]]);
//                }
//                return response()->json(['status' => 1, 'message' => 'School Credentials Are sent by Email']);
//            } catch (\Exception $e) {
//                DB::rollback();
//                return response()->json(['status' => 0, 'message' => $e]);
//            }
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }

    }

    public function approveschool(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'approveschoolid' => 'required|numeric',
        ]);

        if ($validatedData->passes()) {
            DB::beginTransaction();
            try {
                $user = new User();
                $user->where('user_id', $request->approveschoolid)->update(['role' => 2]);
                $name = User::where('user_id', $request->approveschoolid)->value('name');
                $mailData = [
                    'name' => $name,
                ];
                $email = User::where('user_id', $request->approveschoolid)->value('email');
                Mail::to($email)->send(new approve($mailData));
                DB::commit();
                return response()->json(['status' => 1, 'message' => 'School has been approved']);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status' => 0, 'message' => $e]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong try again!']);
        }
    }

    public function updateschoolsocial(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'school_id' => 'required',
            'address' => 'required|min:10',
        ]);

        if ($validatedData->passes()) {
            DB::beginTransaction();
            try {
                DB::commit();
                $social = new Schools();
                $social->where('school_id', $request->school_id)->update([
                    'location' => $request->location,
                    'whatsapp' => $request->whatsapp,
                    // 'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'address' => $request->address,
                ]);
                return response()->json(['status' => 1, 'message' => 'Social Url\'s are Updated ']);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status' => 0, 'message' => $e]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong try again!']);
        }
    }

    public function schoolchangepass(Request $request)
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

    public function updatestatus(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validatedData->passes()) {
            $schoolstatus = Schools::where('school_id', $request->id)->value('status');
            if ($schoolstatus == 0) {
                $status = 1;
            } else {
                $status = 0;
            }
            $school = new Schools();
            $school->where('school_id', $request->id)->update([
                'status' => $status,
            ]);
            return response()->json(['status' => 1, 'message' => "School Status Updated"]);
        } else {
            return response()->json(['status' => 0, 'message' => $validatedData->errors()]);
        }
    }
}
