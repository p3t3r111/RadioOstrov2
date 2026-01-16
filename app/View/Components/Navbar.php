<?php

namespace App\View\Components;

use App\Actions\CheckHolidays;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Navbar extends Component
{
    public bool $canVote = false;

    public string $initials;

    public ?object $user;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->user = Auth::user();
        $this->canVote = ($this->user && $this->user->voted == 0 && ! CheckHolidays::execute());
        $this->initials = $this->makeInitials($this->user?->name);
    }

    private function makeInitials(?string $name): string
    {
        if (! $name) {
            return '';
        }

        $names = explode(' ', $name);
        $initials = '';

        foreach ($names as $n) {
            if (! empty($n)) {
                $firstChar = mb_substr($n, 0, 1, 'UTF-8');
                $initials .= mb_strtoupper($firstChar, 'UTF-8');
            }
        }

        return $initials;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
