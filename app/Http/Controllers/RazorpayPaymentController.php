<?php

namespace App\Http\Controllers;

use App\Models\Feestatus;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;
use Illuminate\Support\Facades\Auth;

class RazorpayPaymentController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function index()
    // {
    //     return view('razorpayView');
    // }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $api = new Api(env("RAZOR_KEY"), env("RAZOR_SECRET"));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        // dd($payment);
        $status = intval($payment->description);
        $student = Student::where("user_id", Auth::user()->user_id)->first();
        $payments = new Payment();
        $payments->raazorpay_payment_id = $payment->id;
        $payments->amount = $payment->amount / 100;
        $payments->method = $payment->method;
        $payments->payername = $student->name;
        $payments->user_id = $student->user_id;
        $payments->school_id = $student->school_id;
        $payments->feestatus_id = $status;
        $payments->save();
        $feestastus = new Feestatus();
        $feestastus->where("feestatus_id", $status)->update([
            "status" => "1",
            "payment_id" => $payments->payment_id
        ]);

        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                // $api->paymentLink->create(array('amount' => 500, 'currency' => 'INR', 'accept_partial' => true, 'first_min_partial_amount' => 100, 'description' => 'For XYZ purpose', 'customer' => array('name' => 'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact' => '+919000090000'), 'notify' => array('sms' => true, 'email' => true), 'reminder_enable' => true, 'options' => array('checkout' => array('method' => array('netbanking' => '1', 'card' => '1', 'upi' => '0', 'wallet' => '0')))));
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                // dd($response);

            } catch (Exception $e) {
                return $e->getMessage();
                Session::flash('error', $e->getMessage());
                return redirect("Student/fees");
            }
        }

        Session::flash('success', 'Payment successful');
        return redirect("Student/fees");
    }
}
