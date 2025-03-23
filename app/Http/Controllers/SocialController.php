<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'provider_id' => $socialUser->id,
        ], [
            'name'           => $socialUser->name,
            'nickname'       => $socialUser->nickname,
            'email'          => $socialUser->email,
            'provider'       => $provider,
            'provider_token' => $socialUser->token,
        ]);

        Auth::login($user);

        return to_route('user#home');
    }
}
