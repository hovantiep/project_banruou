<?php

namespace banruou;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'alias', 'price', 'intro', 'content', 'image', 'keywords', 'description', 'user_id', 'cate_id'];

    public function cate(){
    	return $this->belongsTo('banruou\Cate','cate_id');
    }

    public function user(){
    	return $this->belongsTo('banruou\User','user_id');
    }

    public function productImage(){
    	return $this->hasMany('banruou\ProductImage','product_id');
    }
}
