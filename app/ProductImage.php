<?php

namespace banruou;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = ['id', 'image', 'product_id'];

    public function product(){
    	return $this->belongsTo('banruou\Product','product_id');
    }
}
