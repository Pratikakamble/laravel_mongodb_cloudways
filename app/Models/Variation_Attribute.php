<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Variation_Attribute extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'variations_attributes';
    protected $fillable = ['_id', 'variation_id', 'attr_id', 'attr_val', 'image'];

    public function Variation(){
    	return $this->belongsTo(Variation::class);
    }

}
