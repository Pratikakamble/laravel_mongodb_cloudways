<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'attributes';

    public function Category(){
    	return $this->belongsTo(Category::class);
    }

    public function SubCategory(){
    	return $this->belongsTo(SubCategory::class);
    }

	public function ValueAttribute(){
		return $this->hasMany(ValueAttribute::class);
	}   

	
}
