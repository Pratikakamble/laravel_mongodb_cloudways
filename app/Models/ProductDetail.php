<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'product_details';

    public function Product(){
    	return $this->belongsTo(Product::classs);
    }
}
