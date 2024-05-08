<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\otp;
use App\Mail\password;

class MailController extends Controller
{
    public function index()
    {
        // $name=array("Bharath"=>"rakhinani124@gmail.com", "Rahul"=>"chintalarahulraju@gmail.com", "Rakesh"=>"rakeshkamuni03@gmail.com","Bharat"=>"bharatguda581@gmail.com","Sowmith"=>"sowmithkota67@gmail.com","Sairam"=>"maddurisai24@gmail.com","Uday"=>"udaymekala08@gmail.com","Srinath"=>"mittakolasrinath1234@gmail.com","Ganesh"=>"margamganesh634@gmail.com","Rohit"=>"rohitmittakola@gmail.com","Karthik"=>"kartikshamanthula@gmail.com");
        $name = array("Rahul" => "chintalarahulraju@gmail.com");
        foreach ($name as $nm => $em) {
            $name = $nm;
            $otp = rand(111111, 999999);
            $mailData = [
                'name' => $name,
                'otp' => $otp,
            ];

            Mail::to($em)->send(new otp($mailData));
            // }
            dd('Email Send Successfully');
        }
    }


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


    public function password()
    {
        // $name=array("Bharath"=>"rakhinani124@gmail.com", "Rahul"=>"chintalarahulraju@gmail.com", "Rakesh"=>"rakeshkamuni03@gmail.com","Bharat"=>"bharatguda581@gmail.com","Sowmith"=>"sowmithkota67@gmail.com","Sairam"=>"maddurisai24@gmail.com","Uday"=>"udaymekala08@gmail.com","Srinath"=>"mittakolasrinath1234@gmail.com","Ganesh"=>"margamganesh634@gmail.com","Rohit"=>"rohitmittakola@gmail.com","Karthik"=>"kartikshamanthula@gmail.com");
        $name = array("Rahul" => "chintalarahulraju@gmail.com");
        foreach ($name as $nm => $em) {
            $name = $nm;
            $password = $this->RandomString();
            $mailData = [
                'name' => $name,
                'password' => $password,
            ];

            Mail::to($em)->send(new password($mailData));
            // }
            dd('Email Send Successfully');
        }
    }
    public function phone()
    {
        return view('email/phone');
    }
}
