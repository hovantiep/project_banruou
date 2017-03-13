<?php

namespace project1;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'alias', 'price', 'intro', 'content', 'image', 'keywords', 'description', 'user_id', 'cate_id'];

    public function cate(){
    	return $this->belongsTo('project1\Cate','cate_id');
    }

    public function user(){
    	return $this->belongsTo('project1\User','user_id');
    }

    public function productImage(){
    	return $this->hasMany('project1\ProductImage','product_id');
    }
}
