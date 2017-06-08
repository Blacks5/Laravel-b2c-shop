<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{
    use SoftDeletes;

    public $primaryKey ='id';
    public $fillable =['name','keywords','description','price','sale','stock','saleNum','type','imgs','content','show','recommend'];
    protected $dates =['delete_at'];
    //
}
