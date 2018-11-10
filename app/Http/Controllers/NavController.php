<?php

namespace App\Http\Controllers;

use App\nav;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class NavController extends Controller
{
    public function show(){

    }
    public  function index(){
        $navs= nav::paginate(5);
        return view('nav/index',compact('navs'));
    }
    //添加导航菜单
    public function create(){
        $permissions=Permission::all();
        $navs = nav::all();
        return view('nav/create',['permissions'=>$permissions,'navs'=>$navs]);
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:navs',
            'url'=>'required',
            'permission'=>'required',
            'pid'=>'required',
        ],[
            'name.required'=>'菜单名必须填写',
            'name.unique'=>'菜单名必须唯一,不能重复',
            'url.required'=>'路径名称必须填写',
            'permission.required'=>'全向必须选择',
            'pid.required'=>'父级必须选择',
        ]);

        //保存
        nav::create([
            'name'=>$request->name,
            'url'=>$request->url,
            'pid'=>$request->pid,
            'permission_id'=>$request->permission,
        ]);

        //保存成功,跳转
        return redirect()->route('nav.index')->with('success','菜单权限保存成功');
    }
    //修改回显
    public function edit(Nav $nav){
        $permissions = Permission::all();
        $navs =nav::all();

        return view('nav.edit',['nav'=>$nav,'permissions'=>$permissions,'navs'=>$navs]);
    }

    //修改保存
    public function update(Nav $nav , Request $request){
        $request->validate([
            'name'=>'required',
            'url'=>'required',
            'permission'=>'required',
            'pid'=>'required',
        ],[
            'name.required'=>'菜单名必须填写',
            'name.unique'=>'菜单名必须唯一,不能重复',
            'url.required'=>'路径名称必须填写',
            'permission.required'=>'必须选择',
            'pid.required'=>'父级必须选择',
        ]);

        $nav->update([
            'name'=>$request->name,
            'url'=>$request->url,
            'pid'=>$request->pid,
            'permission_id'=>$request->permission,
        ]);

        //修改成功,跳转
        return redirect()->route('nav.index')->with('success','修改成功');
    }

    //删除
    public function destroy(Nav $nav){
        $nav->delete();
        //删除成功,跳转
        return redirect()->route('nav.index')->with('danger','删除成功');
    }
}
