<?php

namespace App\Http\Controllers;

use App\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class AdminController extends Controller
{

    public function show(){

    }
    //显示管理员账户
    public function index(){
        $admins = Admin::paginate(5);
        return view('admin/index',compact('admins'));
    }
    //添加管理员
    public function create(){
        $roles = Role::all();
        return view('admin/create',compact('roles'));
    }
    //保存管理员账号
    public function store(Request $request){
        //数据验证
        $request->validate([
            'captcha' => 'required|captcha',
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ],[
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
            'name.required'=>'用户账号必须输入',

        ]);

        //密码加密
        $password = bcrypt($request->password);
        //判断是否给与权限
        if ($request->roles){
            admin::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$password,
            ])->assignRole($request->roles);
        }else{
            admin::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$password,
            ]);
        }



        //保存成功后,显示数据,跳转
        return redirect()->route('admin.index')->with('success','添加管理员账户成功');
    }
    public function edit(admin $admin){
        $roles =Role::all();

        return view('admin/edit',['admin'=>$admin,'roles'=>$roles]);
    }

    //修改--保存
    public function update(Request $request , admin $admin){
        //数据验证
        $request->validate([
            'captcha' => 'required|captcha',
            'name'=>'required',
            'email'=>'required',

        ],[
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
            'name.required'=>'用户账号必须输入',
        ]);

        //判断是否有权限
        if ($request->roles){
            //保存数据
            $admin->syncRoles($request->roles)->update([
                'name'=>$request->name,
                'email'=>$request->email,
            ]);
        }else{
            //保存数据
            $admin->update([
                'name'=>$request->name,
                'email'=>$request->email,
            ]);
        }

        //跳转
        return redirect()->route('admin.index')->with('success','修改保存成功');
    }

    //删除管理员
    public function destroy(Admin $admin){
        $admin->delete();
        //跳转
        return redirect()->route('admin.index')->with('success','删除成功');
    }
    public function change(){

        return view('admin/change');
    }
    //修改密码
    public function change_save(Request $request){
        //数据验证
        $request->validate([
            'old_password'=>'required',
            'password'=>'required|confirmed',
        ],[
            'old_password.required'=>'必须输入旧密码',
            'password.required'=>'请设置新密码',
            'password.confirmed'=>'两次密码输入不一致,请重新输入',
        ]);


        if(Hash::check($request->old_password,auth()->user()->password)){
            //密码正确,跳转登录页面,重新登录
            //dd(6666);
            $new_password = bcrypt($request->password);
            $id = auth()->user()->id;
            Admin::where('id',$id)->update([
                'password'=>$new_password,
            ]);
            Auth::logout();
            //修改保存成功,跳转登录页面
            return redirect('login')->with('success','密码修改成功,请重新登录');
        }else{
            //旧密码输入不正确
            return redirect()->route('admin.change')->with('danger','旧密码输入错误,请重新输入');
        }
    }

}
