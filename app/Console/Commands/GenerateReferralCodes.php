<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Str;

class GenerateReferralCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-referral-codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate referral codes for existing users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info(User::whereNull('referral_code')->count().' users without referral codes found.');
        User::whereNull('referral_code')
            ->chunk(500, function ($users) {
                foreach ($users as $user) {
                    do {
                        $code = Str::upper(Str::random(8));
                    } while (
                        User::where('referral_code', $code)->exists()
                    );

                    $user->referral_code = $code;
                    $user->save();
                }
            });

        $this->info('Referral codes generated.');
    }
}
