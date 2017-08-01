<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TranslateController extends Controller
{
    protected $url   =   "https://openapi.youdao.com/api";

    public function index(){

    }

    protected function TranslateInfo(){
        $appKey =   "467139bc9c0ef35a";
        $app    =   "";
    }
}
