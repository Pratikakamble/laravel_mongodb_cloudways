<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'variations';
    protected $fillable = ['_id', 'variation_name', 'variation_image', 'mrp', 'selling_price', 'discount'];

    public function VariationAttribute(){
    	return $this->hasMany(Variation_Attribute::class);
    }

    public function VariationDetail(){
    	return $this->hasMany(Variation_Detail::class);
    }

    public function Cart(){
        return $this->hasMany(Cart::class);
    }
    
}
