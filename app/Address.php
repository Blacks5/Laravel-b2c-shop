<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $fillable =['uid','prov','city','district','info','name','zipCode','phone','email','type'];
}
