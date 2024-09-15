<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'products';

    public function ProductDetails(){
    	return $this->hasMany(ProductDetail::class);
    } 

    public function ProductImages(){
    	return $this->hasMany(ProductImage::class);
    } 

    public function ValueAttribute(){
    	return $this->hasMany(ValueAttribute::class);
    }

    public function SubCategory(){
    	return $this->belongsTo(SubCategory::class);
    }

    public function Variation(){
        return $this->hasMany(Variation::class);
    }

    public function Cart(){
        return $this->hasMany(Cart::class);
    }
}
