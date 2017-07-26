<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable =   ['position_id','name','link','code','start_time','end_time','enable'];

    public function getAll()
    {
        return Ad::jion('Position','Ad.Position_id','Position.id')->get();
    }
}
