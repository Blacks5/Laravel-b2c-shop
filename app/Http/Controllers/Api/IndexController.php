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
        $data['new']  =  $this->getGoods('created_at');
        $data['sales']   =   $this->getGoods('saleNum');
        $data['price']  =   $this->getGoods('sale');

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

    protected function getGoods($order)
    {
        $goods    =   Goods::where('show',1)->orderBy($order,'desc')->limit(10)->get(['id','name','sale','imgs','price']);;
        return $this->changeGoodsImg($goods);
    }

    protected function changeGoodsImg($data){
        foreach ($data as $key => $d){
            $img    =   explode(',',$d->imgs);
            $data[$key]['imgs'] =   env('APP_URL').'/'.$img[0];
        }
        return $data;
    }
}
