<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends AdminController
{
    public function login(){
        return view('session/index');
    }
    public function store(Request $request){
        //数据验证
        $request->validate([
            'name'=>'required',
            'password'=>'required',
            'captcha' => 'required|captcha',
        ],[
            'name.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);

        //判断
        if(auth::attempt(['name'=>$request->name,'password'=>$request->password],[$request->rememberMe])){
            //匹配成功
            return redirect()->route('admin.index')->with('success','登录成功');
        }else{
            //匹配失败
            return back()->with('danger','登录失败,用户名或密码错误')->withInput();
        }
    }

    //注销登录
    public function logout(){
        Auth::logout();
        //跳转
        return redirect()->route('login')->with('success','注销成功');
    }
}
