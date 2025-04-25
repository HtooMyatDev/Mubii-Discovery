<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Movie;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $user     = Socialite::driver($provider)->user();
        $authUser = User::where('email', $user->email)->first();
        $movie = Movie::get();

        if ($authUser && $authUser->provider != $provider) {
            // User with this email already exists
            // Link the social account if it's not already links
            $error = 'This email is already associated with another social login.';
            return Redirect::to('http://localhost:5173/social-login-failure?error=' . $error);
        } else {
            $authUser = User::updateOrCreate([
                'provider_id' => $user->id,
            ], [
                'name'           => $user->name,
                'nickname'       => $user->nickname,
                'email'          => $user->email,
                'provider'       => $provider,
                'provider_token' => $user->token,
            ]);
            $data  = User::where('id', $authUser->id)->first();
            $token = $authUser->createToken('authToken')->plainTextToken;
            return Redirect::to('http://localhost:5173/social-login-success?token=' . $token . '&data=' . $data . '&movie=' . $movie);
        }
    }
}
