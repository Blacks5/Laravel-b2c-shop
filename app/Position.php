<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //
    protected $fillable =   ['name','width','height','type','desc','enable'];

    public function getAll(){
        return $this->hasOne('App\Ad','position_id','id');
    }
}
