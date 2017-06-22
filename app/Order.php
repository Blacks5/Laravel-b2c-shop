<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $fillable =['uid','order_number','address','name','phone','total','postage','state','post_no','remake','pay_way','pay_number'];
    protected $dates=['delete_at'];
}
