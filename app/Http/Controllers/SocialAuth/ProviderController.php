<?php

namespace App\Http\Controllers\SocialAuth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $social_user = Socialite::driver($provider)->user();
            // dd($social_user);
            $email = $social_user->getEmail();
            $username = $social_user->getNickname(); // assuming the provider supports this

            // Check if the email or username already exists
            $user_exists = User::where('email', $email)
                ->first();

            if ($user_exists) {
                return redirect('/login')->withErrors([
                    'message' => 'An account with this email or username already exists.',
                ]);
            }

            $user = User::where([
                'provider' => $provider,
                'provider_id' => $social_user->id,
            ])->first();

            if (!$user) {
                $user = User::updateOrCreate([
                    'provider_id' => $social_user->id,
                ], [
                    'name' => $social_user->getName(),
                    'username' => User::generateUsername($social_user->getNickname()),
                    'email' => $social_user->getEmail(),
                    'email_verified_at' => Carbon::now(),
                    'photo' => $social_user->getAvatar() ?? null,
                    'provider' => $provider,
                    'provider_id' => $social_user->getId(),
                    'provider_token' => $social_user->token,
                ]);
            }
            $user->last_login_at = Carbon::now();
            $user->save();
            Auth::login($user);
            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login');
        }
    }
}
