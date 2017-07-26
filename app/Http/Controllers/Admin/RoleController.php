<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    //显示权限
    public function show(){
        $data=Role::all();
        return view('admin.role.index',compact('data'));
    }

    public function addRole(Request $request){
        if($request->ajax()){
            if($request->input('name')==""){
                return $msg=['s'=>0,'text'=>"请填写名称"];
            }else{
                $admin = new Role();
                $admin->name = $request->input('name');
                $admin->display_name = $request->input('display_name');
                $admin->description = $request->input('description');
                $admin->save();
                return $msg=['s'=>1,'text'=>'增加成功!'];
            }

        }
        return view('admin.role.add_role');
    }

    public function updateRole($id,Request $request){
        if($id==""){
            return "非法访问,请重试!";
        }
        if($request->ajax()){
            $role= Role::find($request->input('id'));
            $role->name = $request->input('name');
            $role->display_name= $request->input('display_name');
            $role->description = $request->input('description');
            $role->save();

            return $msg=['s'=>1,'text'=>'修改成功!'];
        }
        $data= Role::find($id);
        return view('admin.role.edit_role',compact('data'));
    }

    public function deleteRole($id){
        if($id==""){
            return $msg=['s'=>0,'text'=>'非法操作!'];
        }
        $role= Role::findOrFail($id);
        $role->delete();
        $role->users()->sync([]);
        $role->perms()->sync([]);
        $role->forceDelete();
        //if($role->forceDelete()){
            //return $msg=['s'=>0,'text'=>'删除失败!'];
        //}
        return $msg=['s'=>1,'text'=>'删除成功!'];
    }
}
