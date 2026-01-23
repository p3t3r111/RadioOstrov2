<?php

namespace App\Http\Controllers;

use App\Models\ReferedLog;
use App\Models\User;
use Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleOauthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        $referrerId = request()->cookie('referrer_id');

        if ($user) {
            if (! $user->google_id) {
                $user->update([
                    'google_id' => $googleUser->id,
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                    'email_verified_at' => now(),
                ]);
            }

            Auth::login($user);
        } else {
            if ($referrerId && User::where('id', $referrerId)->exists() && ! ReferedLog::where('email', $googleUser->getEmail())->exists()) {
                $referredBy = $referrerId;
            } else {
                $referredBy = null;
            }

            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'email_verified_at' => now(),
            ]);

            if ($referredBy) {
                ReferedLog::create([
                    'email' => $user->email,
                    'referrer_id' => $referredBy,
                ]);

                $referrer = User::find($referredBy);
                $referrer->increment('invited_people');
            }

            Auth::login($user);
        }

        // po registrácii cookie zmaž
        cookie()->queue(cookie()->forget('referrer_id'));

        return redirect('/');
    }
}
