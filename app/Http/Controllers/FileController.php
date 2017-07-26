<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    public function upload(Request $request)
    {
        if($request->ajax()){
            $file=$request->file('images');
            $filename =date('Ymd',time()).rand(1000,9999).'.'.$file->getClientOriginalExtension();
            //$path=$file->store('public','local');
            //$file->move(public_path('upload'),$filename);
            $path =$file->storeAs('upload',$filename);
            //return
            return $msg=['s'=>1,'img'=> $path,'imgs'=>asset($path)];
        }
    }

    public function delete(Request $request)
    {
        if(!$request->has('img')){
            return $msg=['s'=>0,'text'=>'系统发生故障'];
        }
        //header("Content-Type: ".Storage::mimeType($request->input('info')));
        //return Storage::get($request->input('info'));
        if(Storage::delete($request->input('img'))){
            return $msg=['s'=>1,'text'=>'删除成功!'];
        }else{
            return $msg=['s'=>0,'text'=>'文件貌似不存在!'];
        }
    }
}
