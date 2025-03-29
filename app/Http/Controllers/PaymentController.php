<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index()
    {
        $data = Payment::get();
        return view("admin.payments.index", compact('data'));
    }

    public function create(Request $request)
    {
        $this->checkValidation($request);
        $data = $this->getData($request);
        Payment::create($data);

        return to_route('payment#list')->with('success', 'Done!e');
    }

    private function getData($request)
    {
        return [
            'payment_name'   => $request->paymentName,
            'payment_number' => $request->paymentNumber,
            'payment_type'   => $request->paymentMethod,
        ];
    }
    private function checkValidation($request)
    {
        $validatioRules = [
            'paymentName'   => 'required',
            'paymentNumber' => 'required',
            'paymentMethod' => 'required',
        ];

        $request->validate($validatioRules);
    }
}
