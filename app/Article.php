<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable =   ['title','keywords','description','content','tid','source','enable','click','url'];
    protected $dates    =   ['delete_at'];

    public function getTidAttribute(){

    }
}
