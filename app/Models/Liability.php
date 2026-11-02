<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liability extends Model
{
protected $fillable = [
    'loan_name',
    'lender_name',
    'loan_amount',
    'interest_rate',
    'start_date',
    'end_date',
    'paid',
    'total_amount',
    'outstanding_amount',
    'notes',
    'user_id',
];
}