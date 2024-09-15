<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function Product(){
    	return $this->belongsTo(Product::class);
    }

    public function Variation(){
    	return $this->belongsTo(Variation::class);
    }

    public function User(){
    	return $this->belongsTo(User::class);
    }
}
