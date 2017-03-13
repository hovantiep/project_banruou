<?php

namespace project1;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = ['id', 'image', 'product_id'];

    public function product(){
    	return $this->belongsTo('project1\Product','product_id');
    }
}
