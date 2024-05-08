<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
use Carbon\Carbon;

class Payments extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment1 = new Payment();
        $payment1->bank = "Bank Of India";
        $payment1->IFSC = "12345678";
        $payment1->mode = "Rajorpay";
        $payment1->payername = "School1";
        $payment1->accountnumber = "987654321";
        $payment1->upireference = "123456789";
        $payment1->purpose = "School Registration";
        $payment1->datetime = Carbon::now();
        $payment1->user_id = 10000002;
        $payment1->school_id = 1;
        $payment1->save();

        $payment2 = new Payment();
        $payment2->bank = "Bank Of Baroda";
        $payment2->IFSC = "12345678";
        $payment2->mode = "Rajorpay";
        $payment2->payername = "School2";
        $payment2->accountnumber = "987654321";
        $payment2->upireference = "123456789";
        $payment2->purpose = "School Registration";
        $payment2->datetime = Carbon::now();
        $payment2->user_id = 10000003;
        $payment2->school_id = 2;
        $payment2->save();
    }
}
