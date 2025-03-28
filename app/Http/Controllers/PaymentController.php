<?php
namespace App\Http\Controllers;

class PaymentController extends Controller
{
    public function index()
    {
        return view("admin.payments.index");
    }

    public function create()
    {
        return to_route("");
    }
}
