<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\VerifyEmailJob;
use App\Models\User;
use App\Notifications\VerifyEmail as NotificationsVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'first_name' => ['required', 'string', 'max:255'],
                'second_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class, 'regex:/^[a-zA-Z0-9._%+-]+@ostrovskeho\.com$/'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'ochrana-osobnych-udajov' => ['required']
            ],
            // Vlastné chybové hlášky
            [
                'name.required' => 'Zadajte meno',
                'second_name.required' => 'Zadajte priezvisko',
                'email.required' => 'Zadajte email',
                'email.email' => 'Email musí byť platná e-mailová adresa',
                'email.lowercase' => 'Email musí byť v malých písmenách',
                'email.unique' => 'Email je zabraný',
                'email.regex' => 'Email musí obsahovať @ostrovskeho.com',
                'password.required' => 'Zadajte heslo',
                'password.confirmed' => 'Heslá sa nezhodujú',
                'ochrana-osobnych-udajov.required' => 'Je nutné zaškrtnúť políčko'
            ]
        );

        $user = User::create([
            'name' => ucwords($request->first_name . " " . $request->second_name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        VerifyEmailJob::dispatch($user);

        Auth::login($user);

        return redirect('/');
    }
}
