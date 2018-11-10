<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    //显示所有角色
    public function index(){
        $roles =Role::all();
        return view('role/index',compact('roles'));
    }

    //对角色进行新增
    public function create(){
        $permissions = Permission::all();
        return view('role/create',compact('permissions'));
    }

    //对角色进行保存
    public function store(Request $request){
        //验证
        $request->validate([
            'name'=>'required|unique:roles',
        ],[
            'name.required'=>'角色名称必须输入',
            'name.unique'=>'角色名称不能重复'
        ]);


        $role = Role::create([
            'name'=>$request->name,
        ]);

        $role->givePermissionTo($request->permission);

        return redirect()->route('role.index')->with('success','添加角色成功');
    }

    //对角色进行修改--回显
    public function edit(Role $role){
        $permissions = Permission::all();
        $role_permissions =$role->permissions;
        //回显
        return view('role/edit',['role'=>$role,'permissions'=>$permissions,'role_permission'=>$role_permissions]);
    }

    //对角色进行修改后保存
    public function update(Request $request,Role $role){
        //验证
        $request->validate([
            'name'=>[
                'required',
                Rule::unique('roles')->ignore($role->id)
            ]
        ],[
            'name.required'=>'角色名称必须输入',
            'name.unique'=>'权限名称不能与其他的重复'
        ]);

        //修改后保存
        $role->update([
            'name'=>$request->name,
        ]);

        //判断修改后是否存在权限
        if ($request->permission){
            //权限管理--移除该用户所有权限
            $role->revokePermissionTo($role->permissions);
            //添加该用户权限
            $role->givePermissionTo($request->permission);
        }else{
            //权限管理--移除该用户所有权限
            $role->revokePermissionTo($role->permissions);
        };


        //保存成功后跳转
        return redirect()->route('role.index')->with('success','添加角色成功');
    }

    //对权限进行删除
    public function destroy(Role $role){
        $role->delete();
        //跳转
        return redirect()->route('role.index')->with('danger','删除角色成功');
    }
    public function show(){

    }
}
