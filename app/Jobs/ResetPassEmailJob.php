<?php

namespace App\Jobs;

use App\Mail\ResetPass;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ResetPassEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $email;
    public $resetUrl;
    /**
     * Create a new job instance.
     */
    public function __construct($email, $resetUrl)
    {
        $this->email = $email;
        $this->resetUrl = $resetUrl;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new ResetPass($this->email, $this->resetUrl));
    }
}
