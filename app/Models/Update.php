<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Route;

class Update extends Model
{
    protected $fillable = [
        'text',
        'action',
        'end_date',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where(function ($q) {
            $q->whereNull('end_date')
                ->orWhere('end_date', '>=', now());
        });
    }

    public function getActionUrlAttribute(): ?string
    {
        if (! $this->action) {
            return null;
        }

        // externá alebo interná URL
        if (filter_var($this->action, FILTER_VALIDATE_URL)) {
            return $this->action;
        }

        // route name
        if (Route::has($this->action)) {
            return route($this->action);
        }

        return null;
    }
}
