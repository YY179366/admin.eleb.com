<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Shop_catagory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class ShopController extends Controller
{
    //显示商家信息
    public function index(){
        $shops = Shop::all();
        return view('shop/index',compact('shops'));
    }

    //新增商家信息
    public function create(){
        $shops =Shop_catagory::all();
        return view('shop/create',compact('shops'));
    }
    public function show(){

    }

    //修改数据--回显
    public function edit(Shop $shop){
        $shop_categories = shop_catagory::all();
        return view('shop/edit',['shop'=>$shop,'shop_categories'=>$shop_categories]);
    }

    //修改数据--保存
    public function update(Request $request , Shop $shop){
        //数据验证
        $request->validate([
            'shop_category_id'=>'required',
            'shop_name'=>'required',
            'brand'=>'required',
            'on_time'=>'required',
            'fengniao'=>'required',
            'bao'=>'required',
            'piao'=>'required',
            'zhun'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'notice'=>'required',
            'discount'=>'required',
        ],[
            'shop_category_id.required'=>'店铺所属类型必选',
            'shop_name.required'=>'店铺名称必填',
            'shop_name.max'=>'店铺名称',
            'shop_name.unique'=>'店铺名称不能重复',
            'brand.required'=>'是否是品牌店必选',
            'on_time.required'=>'是否准时送达必选',
            'fengniao.required'=>'是否蜂鸟配送必选',
            'bao.required'=>'是否保标记必选',
            'piao.required'=>'是否票标记必选',
            'zhun.required'=>'是否准标记必选',
            'start_send.required'=>'起送金额必填',
            'start_send.numeric'=>'起送金额必须为数字',
            'send_cost.numeric'=>'配送金额必须为数字',
            'send_cost.required'=>'配送费必须填写',
            'notice.required'=>'店公告必须填写',
        ]);

        $path = $request->file('shop_img')->store('public/shop');
        //修改保存数据
        $shop->update([
            'shop_category_id' =>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$path,
            'shop_rating'=>$request->shop_rating,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'status'=>$request->status,
        ]);

        //保存成功后,跳转
        return redirect()->route('shop.index')->with('success','修改店铺信息成功,等待审核');
    }
    public function destroy(Shop $shop){
        $shop->delete();
        //保存成功后,跳转
        return redirect()->route('shop.index')->with('success','删除店铺信息成功,等待审核');
    }
}
