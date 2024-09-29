<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'categories';

    public function Products(){
    	return $this->hasMany(Product::class);
    }

    public function SubCategory(){
    	return $this->hasMany(SubCategory::class);
    }
    public function Attribute(){
    	return $this->hasMany(Attribute::class);
    }

}
