<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model
{
    protected $fillable = [
        'loan_id',
        'item_id',
        'quantity'
    ];

    public function item()
    {
        return $this->belongsTo(Inventory::class, 'item_id');
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id'); // ✅ benar
    }

    public function getItemCodeAttribute()
    {
        return $this->item ? $this->item->title : null;
    }
}
