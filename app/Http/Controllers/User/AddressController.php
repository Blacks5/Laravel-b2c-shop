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

    public function update($id)
    {
        $adr=Address::findOrFail($id);
        return view('user.address_update',compact('adr'));
    }

    public function edit(Request $request)
    {
        $adr=Address::findOrFail($request->input('id'));
        if($adr->update($request->all())){
            return $msg=['s'=>1,'text'=>'更新成功!'];
        }
    }

    public function defaultAdr($id){
        $adr=Address::where('type',1)->where('uid',Auth::id())->update(['type'=>0]);
        $newAdr=Address::where('id',$id)->update(['type'=>1]);
        if($newAdr){
            return $msg=['s'=>1,'text'=>'修改成功!'];
        }
        return $msg=['s'=>0,'修改失败!'];
    }

    public function delete($id)
    {
        if(Address::destroy($id)){
            return $msg=['s'=>1,'text'=>'删除成功'];
        }
        return $msg=['s'=>0,'text'=>'系统错误!'];
    }
}
