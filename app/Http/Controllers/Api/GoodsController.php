<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Goods;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function index($id)
    {
        $goods  =   $this->findComment(Goods::findOrFail($id));
        $goods->imgs  =  $this->getGoodsImg(explode(',',$goods->imgs));

        return response()->json($goods);
    }

    /**
     * 查找商品评论
     * @param $goods
     */
    protected function findComment($goods)
    {
        $goods['comment']   =   $this->Comment($goods->id);

        return $goods;
    }

    /**
     * 获取评论用户资料
     * @param $gid
     */
    protected function Comment($gid)
    {
        $comment    =   Comment::where('gid',$gid)->where('show',1)->get();
        foreach ($comment as $key => $c){
            $user   =   $this->getUser($c->uid);
            $comment[$key]['uName'] =   $user->name;
            $comment[$key]['uImg']  =   $user->img;
        }

        return $comment;
    }

    /**
     * 处理用户资料
     * @param $uid
     * @return mixed
     */
    protected function getUser($uid)
    {
        $user   =   User::findOrFail($uid);
        $user->names =   substr_replace($user->name,'***',3,-3);
        $user->img  =   env('APP_URL').'/'.$user->img;

        return $user;
    }

    /**
     * 处理商品图片
     * @param $data
     * @return mixed
     */
    protected function getGoodsImg($data)
    {
        foreach ($data as $key => $d){
            $data[$key] =   env('APP_URL').'/'.$d;
        }

        return $data;
    }
}
