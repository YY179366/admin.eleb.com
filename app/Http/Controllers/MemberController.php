<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function show(){

    }
    //显示会员信息
    public function index(){
        $user = $_GET['username']??'';
        if ($user){
            $members = Member::where('username','like',"%$user%")->paginate(5);
            return view('member/index',['members'=>$members,'user'=>$user]);
        }else{
            $user = '';
            $members = Member::paginate(5);
            return view('member/index',['members'=>$members,'user'=>$user]);
        }
    }
    //新增会员用户
    public function create(){
        return view('member/create');
    }
    //保存新增用户数据
    public function store(Request $request){
        //数据验证
        $request->validate([
            'username'=>'required|max:20',
            'password'=>'required|max:16|min:6',
            'tel'=>[
                'required',
                'regex:/^1\d{10}$/',
            ],
            'captcha' => 'required|captcha',

        ],[
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
            'username.required'=>'必须输入用户名',
            'username.max'=>'用户名最大字符为20',
            'password.required'=>'密码必须设置',
            'password.max'=>'密码长度最大不能超过16位',
            'password.min'=>'密码长度最少不能少于6个字符',
            'tel.required'=>'电话号码必须输入',
            'tel.regex'=>'电话号码最长不超过11位,并且为数字',

        ]);

        //保存数据
        Member::create([
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'tel'=>$request->tel,

        ]);
        //保存成功,跳转
        return redirect()->route('member.index')->with('success','添加会员成功');
    }
    //修改---回显
    public function edit(Member $member){
        return view('member/edit',compact('member'));
    }
    //修改--保存
    public function update(Member $member , Request $request){
        //验证提交保存的数据
        //数据验证
        $request->validate([
            'username'=>'required|max:20',
            'tel'=>[
                'required',
                'regex:/^1\d{10}$/',
            ],
            'captcha' => 'required|captcha',
        ],[
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
            'username.required'=>'必须输入用户名',
            'username.max'=>'用户名最大字符为20',
            'tel.required'=>'电话号码必须输入',
            'tel.regex'=>'电话号码最长不超过11位,并且为数字',
        ]);

        //保存数据
        $member->update([
            'username'=>$request->username,
            'tel'=>$request->tel,

        ]);
        //修改成功,跳转
        return redirect()->route('member.index')->with('success','修改会员信息成功');
    }
    //删除会员账户
    public function destroy(Member $member){
        $member->delete();
        //删除成功,跳转
        return redirect()->route('member.index')->with('success','删除会员信息成功');
    }
    //禁止登陆
    public function status(Member $member){
        $member->update([
            'status'=>0,
        ]);
        //修改成功,跳转
        return redirect()->route('member.index')->with('success','修改会员登陆状态成功');
    }

}
