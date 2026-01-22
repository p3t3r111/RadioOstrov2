<?php

namespace App\Http\Controllers;

use App\Models\User;

class ReferralController extends Controller
{
    public function store(string $code)
    {
        $referrer = User::where('referral_code', $code)->firstOrFail();

        cookie()->queue(
            cookie('referrer_id', $referrer->id, 60 * 24 * 30)
        );

        return redirect()->route('index');
    }
}
