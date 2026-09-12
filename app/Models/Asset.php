<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'name',
        'description',
        'asset_image',
        'type',
        'price',
        'purchase_date',
        'estimated_lifetime',
        'location',
        'user_id'
    ];
}
