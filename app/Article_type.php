<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article_type extends Model
{
    protected $fillable =   ['name','pid'];

    public function child(){
        return $this->hasMany('App\Article_type','pid','id');
    }
}
