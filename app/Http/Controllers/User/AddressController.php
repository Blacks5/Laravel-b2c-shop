<?php

namespace App\Http\Controllers\User;

use App\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    //

    public function create(Request $request){
        if($request->ajax()){
            $data=$request->all();
            $data['uid']=Auth::id();
            if(Address::create($data)){
                return $msg=['s'=>1,'text'=>'增加成功!'];
            }else{
                return $msg=['s'=>0,'text'=>'增加失败!'];
            }
        }
        return view('user.address_create');
    }
}
