<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\VerifyEmailJob;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\RateLimiter;

class EmailVerificationPromptController extends Controller
{
    public function __invoke(Request $request): RedirectResponse|View
    {
        $user = $request->user();
        $throttleKey = 'verify-email|' . $user->id;

        if (!$user->hasVerifiedEmail()) {
            if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail) {
                if (RateLimiter::tooManyAttempts($throttleKey, 1)) {
                    return view('auth.verify-email', [
                        'status' => 'Too many requests, please try again later.'
                    ]);
                } else {
                    VerifyEmailJob::dispatch($user);
                    RateLimiter::hit($throttleKey, 900);
                }
            }

            return view('auth.verify-email', ['status' => session('status')]);
        }

        return redirect()->intended(route('index', absolute: false));
    }
}
