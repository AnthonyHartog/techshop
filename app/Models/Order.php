<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
    ];

    use HasFactory;

    public function amounts(){
        return $this->hasMany(Amount::class);
    } 
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
