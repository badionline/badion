<?php

namespace App\Http\Controllers;

use App\Mail\password;
use App\Models\Result;
use App\Models\Schools;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

// use Redirect;

class AuthController extends Controller
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


    public function home()
    {
        return view("home");
    }

    public function register()
    {
        return view("register");
    }

    public function login()
    {
        return view("login");
    }
    public function loginCheck(Request $request)
    {
        $request->validate([
            "id" => "required",
            "password" => "required",
        ]);
        if (Auth::attempt(['user_id' => $request['id'], 'password' => $request['password']]) || Auth::attempt(['email' => $request['id'], 'password' => $request['password']])) {
            return redirect('home');
        } else {
            return Redirect::back()->withErrors(['invalid' => 'Invalid Credentials']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/home');
    }
    // public function register(){
    //     if(Auth::user()){
    //         $route=$this->redirectBadion();
    //         return redirect($route);
    //     }
    //     return view('register');
    // }

    // public function redirectBadion(){
    //     $redirect='';
    //     if(Auth::user() && Auth::user()->role==1){
    //         $redirect='/Admin/home';
    //     }else if(Auth::user() && Auth::user()->role==2){
    //         $redirect='/School/home';
    //     }else if(Auth::user() && Auth::user()->role==3){
    //         $redirect='/Teacher/home';
    //     }else if(Auth::user() && Auth::user()->role==4){
    //         $redirect='/Student/home';
    //     }else{
    //         $redirect='/';
    //     }
    //     return $redirect;
    // }

    // public function login(){
    //     if(Auth::user()){
    //         $route=$this->redirectBadion();
    //         return redirect($route);
    //     }
    //     return view('login');
    // }

    // public function validatelogin(Request $request){
    //     $request->validate([
    //         'email'=>'string|required|email',
    //         'password'=>'string|required'
    //     ]);

    //     $userCredencial=$request->only('email','password');
    //     if(Auth::attempt($userCredencial)){
    //         $route=$this->redirectBadion();
    //         return redirect($route);
    //     }else{
    //         return back()->with('error','Email or Password is Incorrect');
    //     }
    // }
}
