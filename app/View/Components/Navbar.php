<?php

namespace App\View\Components;

use App\Actions\GetAvailableLocales;
use App\Models\Update;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Navbar extends Component
{
    public bool $canVote = false;

    public string $initials;

    public ?object $user;

    public $updates;

    public $availableLocales;

    public string $actualLocale;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->user = Auth::user();
        $this->canVote = Auth::user()->canVote();
        $this->initials = $this->makeInitials($this->user?->name);
        $this->updates = Update::active()->get();
        $this->availableLocales = GetAvailableLocales::execute();
        $this->actualLocale = app()->getLocale() == 'en' ? 'gb' : app()->getLocale();
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
