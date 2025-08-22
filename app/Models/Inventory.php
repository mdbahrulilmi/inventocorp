<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Support\Str;


class Inventory extends Model
{

    protected static function booted()
    {
        static::creating(function ($inventory) {
            if (empty($inventory->code) && $inventory->category) {
                $prefix = strtoupper(substr($inventory->category->title, 0, 3));
                $random = Str::upper(Str::random(5));
                $inventory->code = $prefix . $random;
            }
            if (is_null($inventory->available_quantity)) {
                    $inventory->available_quantity = $inventory->quantity;
                }
            });
            
        static::saving(function ($inventory) {
            if ($inventory->isDirty('quantity')) {
                $inventory->available_quantity = $inventory->quantity;
            }
        });

    }

    protected $fillable = [
        'title',
        'code',
        'category_id',
        'quantity',
        'available_quantity',
        'location',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function getCategoryTitle()
    {
        return $this->category ? $this->category->title : null;
    }
}
