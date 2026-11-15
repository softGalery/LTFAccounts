<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    protected $fillable = [
        'name',
        'description',
        'amount',
        'type',
        'earning_date',
        'user_id'
    ];
}
