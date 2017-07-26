<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    public function parentType()
    {
        return $this->belongsTo('App\Type','pid','id');
    }

    public function childrenType(){
        return $this->hasMany('App\Type','pid','id');
    }
}
