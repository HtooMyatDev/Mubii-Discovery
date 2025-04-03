<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            // Check if the password is correct
            if (password_verify($request->password, $user->password)) {
                // Generate a token for the user
                return response()->json([
                    'status' => "success",
                    'token'  => $user->createToken(time())->plainTextToken,
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
            ]);
        }
        // Validate the request
    }
}
