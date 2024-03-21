<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'amount',
    ];
    
    use HasFactory;
}
