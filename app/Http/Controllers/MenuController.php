<?php

namespace App\Http\Controllers;
use App\menu;
use App\MenuCategory;

use App\shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index(Request $request)
    {


        $menus= menu::paginate(5);
        return view('menu/index', compact('menus', 'data'));
    }
    //添加菜品
    public function create()
    {
        //$shop_id = \auth()->user()->shop_id;
        $menucategorys = MenuCategory::all();
        $shops=shop::all();
        return view('menu/create', compact('menucategorys','shops'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'goods_name'=>'required',
            'description'=>'required',
            'goods_price'=>'required',
            'category_id'=>'required',
            'tips'=>'required',
            'goods_img'=>'required'
        ],[
            'goods_name.required'=>'菜品名称不能为空',
            'description.required'=>'菜品描述不能为空',
            'goods_price.required'=>'菜品价格不能为空',
            'tips.required'=>'提示信息不能为空',
            'category_id.required'=>'菜品分类不能为空',
            'goods_img.required'=>'菜品图片不能为空'
        ]);
        $path = $request->file('goods_img')->store('public/menu');
        menu::create([
            'goods_name'=>$request->goods_name,
            'description'=>$request->description,
            'goods_price'=>$request->goods_price,
            'tips'=>$request->tips,
            'status'=>$request->status,
            'rating'=>5,
            'shop_id'=>$request->shop_id,
            'category_id'=>$request->category_id,
            'month_sales'=>0,
            'rating_count'=>0,
            'satisfy_count'=>0,
            'satisfy_rate'=>0,
            'goods_img'=>$path,

        ]);
        session()->flash('success', '添加菜品成功');
        return redirect()->route('menu.index');
    }
    public function edit(menu $menu)
    {
        $menucategorys =MenuCategory::all();
        $shops=MenuCategory::all();
        return view('Menu/edit',compact('menu','menucategorys','shops'));
    }
    public function update(menu $menu,Request $request)
    {
        $this->validate($request,[
            'goods_name'=>'required',
            'description'=>'required',
            'goods_price'=>'required',
            'category_id'=>'required',
            'tips'=>'required',
        ],[
            'goods_name.required'=>'菜品名称不能为空',
            'description.required'=>'菜品描述不能为空',
            'goods_price.required'=>'菜品价格不能为空',
            'tips.required'=>'提示信息不能为空',
            'category_id.required'=>'菜品分类不能为空',
        ]);
        $img = $request->file('goods_img')->store('public/menu');
        if (empty($img)){
            $img=$menu->goods_img;
        }else{
            $img =$request->goods_img;
        }
        $menu->update([
            'goods_name'=>$request->goods_name,
            'description'=>$request->description,
            'goods_price'=>$request->goods_price,
            'tips'=>$request->tips,
            'category_id'=>$request->category_id,
            'goods_img'=>$img,
        ]);
        session()->flash('success', '修改菜品成功');
        return redirect()->route('menu.index');
    }
    public function destroy(menu $menu)
    {
        $menu->delete();
        session()->flash('success', '删除菜品成功');
        return redirect()->route('menu.index');
    }
    public function show(menu $menu)
    {
        $user = Auth::user()->name;
        return view('Menu/show',compact('menu','user'));
    }
}
