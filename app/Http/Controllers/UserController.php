<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function update(Request $request)
    {
        $data = $this->requestUserData($request);
        
        return response()->json([
            'status' => 'success',
        ]);
    }

    private function requestUserData($request)
    {
        return [
            'name'          => $request->name,
            'profile'       => uniqid() . 'user_profile' . $request->profile,
            'address'       => $request->address,
            'email'         => $request->email,
            'phone_number'  => $request->phone_number,
            'date_of_birth' => $request->date_of_birth,
        ];
    }
}
