<?php

namespace App\Http\Controllers;
use App\admin;
use App\menu;
use App\MenuCategory;

use App\shop;
use App\User;
use App\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends Controller
{
    //菜品分类列表
    public function index()
    {

        $menucategorys = MenuCategory::all();
        return view('menucategory/index', compact('menucategorys'));
    }

    //添加菜品分类
    public function create()
    {
        $shops=shop::all();
        return view('menucategory/create', compact('shops'));
    }

    //保存菜品分类
    public function store(Request $request)
    {
        //判断提交数据的合法性
        $limit = [
            'name' => 'required|max:10|unique:menu_categories',
            'description' => 'required',
        ];
        $Prompt = [
            'name.required' => '分类名不能为空',
            'name.max' => '分类名不能超过10个字',
            'name.unique' => '分类名已存在',
            'description.required' => '请填写描述'
        ];

        //判断之前有没有默认的分类
        if ($request->is_selected == 1) {//当商家添加分类选择默认时,就修改之前的默认分类
            DB::table('menu_categories')
                ->where('is_selected', '=', 1)
                ->where('shop_id', '=', Auth::user()->shop_id)
                ->update(['is_selected' => 0]);
        }
        $this->validate($request, $limit, $Prompt);
        $type_accumulation = uniqid();
        MenuCategory::create([
            'name' => $request->name,
            'shop_id' => $request->shop_id,
            'description' => $request->description,
            'is_selected' => $request->is_selected,
            'type_accumulation' => $type_accumulation
        ]);
        return redirect()->route('menucategory.index')->with('success', '添加成功');
    }

    //编辑回显
    public function edit(MenuCategory $menucategory)
    {
        return view('menucategory/edit', compact('menucategory'));
    }

    //更新
    public function update(MenuCategory $menucategory, Request $request)
    {
//判断提交数据的合法性
        $limit = [
//            'name' => 'required|max:10|unique:menu_categories',
            'description' => 'required',
        ];
        $Prompt = [
//            'name.required' => '分类名不能为空',
//            'name.max' => '分类名不能超过10个字',
//            'name.unique' => '分类名已存在',
            'description.required' => '请填写描述'
        ];
        $this->validate($request, $limit, $Prompt);
        //当商家修改分类为默认时,就修改当前商家之前默认分类的状态 0
        if ($request->is_selected == 1) {
            DB::table('menu_categories')
                ->where('is_selected', '=', 1)
                ->where('shop_id', '=', Auth::user()->shop_id)
                ->update(['is_selected' => 0]);
        }
        $menucategory->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_selected' => $request->is_selected
        ]);
        return redirect()->route('menucategory.index')->with('success', '更新成功');
    }

    //删除
    public function destroy(MenuCategory $menucategory)
    {
        $count=Menu::where('category_id', $menucategory->id)->value('goods_name');
        if($count!=null){
            return back()->with('danger', '该分类下有菜品,不能删除');
        }
        $menucategory->delete();
        return redirect()->route('menucategory.index')->with('success', '删除成功');
    }
}
