<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting_dates extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
    ];

    public static function activeVotingDate()
    {
        $date = Voting_dates::where('from', '<=', today()->toDateString())
            ->where('to', '>=', today()->toDateString())
            ->first();

        return $date;
    }
}
