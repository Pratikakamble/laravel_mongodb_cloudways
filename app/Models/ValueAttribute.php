<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class ValueAttribute extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'value_attribute';
    protected $fillable = ['_id', 'product_id', 'attribute_id', 'price', 'value', 'image'];

    public function Attribute(){
    	return $this->belongsTo(Attribute::class);
    }
}
