<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferedLog extends Model
{
    protected $fillable = [
        'email',
        'referrer_id',
    ];
}
