<?php

namespace App\Http\Controllers\Api;

use App\Ad;
use App\Goods;
use App\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * index API
     */
    public function index()
    {
        $data['lbt'] = $this->getAd(1);
        $data['new']  =  Goods::where('show',1)->orderBy('created_at','desc')->limit(10)->get(['name','sale','imgs']);
        $data['type']   =   $this->getType();

        return response()->json($data);
    }

    /**
     * 通过position_id获取相应广告
     * @param $position
     * @return mixed
     */
    public function getAd($position){
        $ad =   Ad::where('position_id',$position)->where('enable',1)->get(['name','link','code']);
        return $this->adApi($ad);

    }

    /**
     * 替换链接和图片地址
     * @param $data
     * @return mixed
     */
    protected function adApi($data){
        foreach ($data as $key => $d){
            $data[$key]['link'] =  str_replace(env('APP_URL'),'',$d->link);
            $data[$key]['code'] = asset($d->code);
        }

        return $data;
    }

    protected function getGoods()
    {
        $type    =   Type::where('pid',0)->where('show',1)->get(['id','name']);
        return $type;
    }

    protected function getType(){
        $goods  =   Goods::where('type','15')->get();
        return $goods;
    }
}
