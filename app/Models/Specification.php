<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $fillable = [
        'cpu', 'gpu', 'ram',
    ];
    
    use HasFactory;

    public function products(){
        return $this->hasMany(Product::class);
    }
}
