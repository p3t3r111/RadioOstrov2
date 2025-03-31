<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\ResetPassEmailJob;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@ostrovskeho\.com$/'],
        ]);

        $email = $request->only('email')['email'];

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('status', __('Email neexistuje, zadajte platný email alebo sa zaregistrujte.'));
        }

        $token = Password::broker()->createToken($user);

        $resetUrl = url(route('password.reset', [
            'token' => $token,
            'email' => $email,
        ], false));

        ResetPassEmailJob::dispatch($email, $resetUrl);

        return back()->with('status', __('E-mail s obnovením hesla bol úspešne odoslaný.'));
    }
}
