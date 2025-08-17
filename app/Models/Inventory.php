<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'title',
        'code',
        'category_id',
        'quantity',
        'available_quantity',
        'location',
        'status',
    ];
}
