<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Variation_Detail extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'variations_pro_details';
    protected $fillable = ['_id', 'variation_id', 'attr_name','attr_val'];

    public function Variation(){
    	return $this->belongsTo(Variation::class);
    }

}
