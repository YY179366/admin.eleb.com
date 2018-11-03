<?php

namespace App\Http\Controllers;
use App\shop;
use App\Shop_catagory;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    //显示商家账号表
    public function index()
    {
        $shop_categories = shop_catagory::all();
        $users = User::all();
        return view('user/index', ['shop_categories' => $shop_categories, 'users' => $users]);
    }

    //修改账号

    public function reset(User $user)
    {
        //dd($user);
        return view('user/reset', compact('user'));
    }

    //重置密码后保存
    public function reset_save(User $user, Request $request)
    {
        //数据验证
        $request->validate([
            'password' => 'required',
        ], [
            'password.required' => '密码必须输入'
        ]);

        $password = bcrypt($request->password);
        //修改保存
        DB::table('users')
            ->where('id', $request->id)
            ->update([
                'password' => $password,
            ]);

        //修改成功,跳转
        return redirect()->route('user.index')->with('success', '重置密码成功');
    }

    public function create()
    {
        $shop_categories = shop_catagory::all();
        return view('user/create', compact('shop_categories'));
    }



//修改商家账号
    public function edit(User $shops)
    {
        $shop = User::all();
        return view('user/edit', compact('shops'));
    }

    //修改后保存
    public function update(Request $request, User $shops)
    {
        //数据验证
        $request->validate([
            'name' => 'required',

        ], [
            'name.required' => '必须填用户名',
            'email.required' => '必须输入邮箱账号',

        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'status' => 1,
        ];

        if ($request->password) {
            $data['password'] = $request->password;
        }

        //保存数据
        $shops->update($data);

        //成功后,跳转
        return redirect()->route('user.index')->with('success', '修改账号成功');
    }

    //删除商家账号
    public function destroy(User $user)
    {
        $user->delete();
        //跳转
        return redirect()->route( 'user.index')->with('success', '删除成功');
    }
    public function status( User $shop_user)
    {
        $status = $shop_user->status;
        if ($status == 0) {
            $shop_user->update([
                'status' => 1,
            ]);


        } else {
            $shop_user->update([
                'status' => 0,
            ]);

            //修改后,跳转
            return redirect()->route('user.index')->with('success', '店铺状态修改成功');
        }
    }
}