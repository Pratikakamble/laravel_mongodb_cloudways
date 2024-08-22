<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'sub_categories';

    public function Category(){
    	return $this->belongsTo(Category::class);
    }

    public function Product(){
    	return $this->hasMany(Product::classs);
    }
}
