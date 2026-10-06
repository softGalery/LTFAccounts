<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountsPayable extends Model
{
    protected $fillable = [
        'name',
        'invoice_number',
        'bill_date',
        'due_date',
        'description',
        'total_amount',
        'paid_amount',
        'balance_amount',
        'status',
        'note',
        'user_id',
        'balance',
        'notes'
    ];
}
