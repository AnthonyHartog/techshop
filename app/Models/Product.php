<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'description', 'specification_id', 'img'
    ];
    
    use HasFactory;

    public function specification(){
        return $this->belongsTo(Specification::class);
    }

    public function filters(){
        return $this->belongsToMany(Filter::class);
    }

    public function amounts(){
        return $this->hasMany(Amount::class);
    }
}
