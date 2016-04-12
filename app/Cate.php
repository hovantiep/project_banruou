<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table = 'cates';

    protected $fillable = ['name', 'alias', 'order', 'parent_id', 'keywords', 'description'];

    public function product(){
    	return $this->hasMany('App\Product','cate_id');
    }
}
