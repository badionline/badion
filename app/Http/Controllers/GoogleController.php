<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleHandle()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('email', $user->email)->first();
            if (!$findUser) {
                // $findUser=new User();
                // $findUser->name=$user->name;
                // $findUser->email=$user->email;
                // $password = random_int(100000, 999999);
                // $findUser->password=$password;
                // $findUser->save();
                return redirect("login")->with("googleError", "User not exist");
            } else {
                Auth::login($findUser);
                return redirect('home');
            }
            // session()->put('id',$findUser->id);
            // session()->put('type',$findUser->type);
        } catch (Exception $e) {
            // dd($e->getMessage());
            return redirect("login")->withErrors(["validation", "Something went wrong!"]);
        }
    }
}
