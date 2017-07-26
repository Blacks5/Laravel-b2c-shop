<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    //

    /*
     * 根据商品id查找评论
     * */
    public function findComment($gid)
    {
        $comment    =   Comment::where('gid',$gid)->where('show',1)->get();
        foreach ($comment as $key =>$c){
            $comment[$key]['order'] =   Order_goods::findOrFail($c->oid);
            $comment[$key]['user']  =   User::findOrFail($c->uid);
        }

        return $comment;
    }

    /*
     * 根据用户查找评论
     */
    public function userComment($uid)
    {
        $comment    =   Comment::where('uid',$uid)->where('show',1)->get();
        foreach ($comment   as $key => $c){
            $comment[$key]['order'] =   Order_goods::findOrFail($c->oid);
        }
        return $comment;
    }
}
