<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        logger($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
        ]);
        // Validate the request
    }
}
