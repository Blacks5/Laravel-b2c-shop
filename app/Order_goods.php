<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_goods extends Model
{
    //
    protected $fillable=['uid','oid','gid','img','name','info','sale','number','total'];
}
