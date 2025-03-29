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

    public function edit($id)
    {
        $data = Payment::select('id', 'payment_number', 'payment_name', 'payment_type')
            ->where('id', $id)
            ->first();

        return view('admin.payments.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $this->checkValidation($request);
        $data = $this->getData($request);
        Payment::where('id', $request->id)->update($data);
        return to_route('payment#list');
    }
    public function delete($id)
    {
        Payment::where('id', $id)->delete();
        return to_route('payment#list');
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
