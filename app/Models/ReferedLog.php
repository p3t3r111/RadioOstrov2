<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferedLog extends Model
{
    private $fillable = [
        'email',
        'referrer_id',
    ];
}
