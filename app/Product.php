<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'alias', 'price', 'intro', 'content', 'image', 'keywords', 'description', 'user_id', 'cate_id'];

    public function cate(){
    	return $this->belongsTo('App\Cate','cate_id');
    }

    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }

    public function image(){
    	return $this->hasMany('App\ProductImage','product_id');
    }
}
