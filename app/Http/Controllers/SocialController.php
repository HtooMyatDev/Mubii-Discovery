<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        if ($authUser) {
            // User with this email already exists
            // Link the social account if it's not already links
            if (! $authUser->provider || $authUser->provider === $provider) {
                $authUser->update([
                    'provider'       => $provider,
                    'provider_id'    => $user->id,
                    'provider_token' => $user->token,
                ]);
            } else {
                $error = 'This email is already associated with another social login.';

                return Redirect::to('http://localhost:5173/social-login-failure?error=' . $error);
            }

        } else {
            $authUser = User::create([
                'name'           => $user->name,
                'nickname'       => $user->nickname,
                'email'          => $user->email,
                'provider'       => $provider,
                'provider_id'    => $user->id,
                'provider_token' => $user->token,
            ]);
        }
        Auth::login($authUser);
        $token = $authUser->createToken('authToken')->plainTextToken;
        return Redirect::to('http://localhost:5173/social-login-success?token=' . $token . '&data=' . $authUser);
    }
}
