<?php

namespace App\Http\Controllers;

use App\shop_catagory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Shop_catagoryController extends Controller
{
    public function add(){
        return view('shopcatagory.add');
    }
    public function index(){
        $catagorys= shop_catagory::all();
        return view('shopcatagory.index',compact('catagorys'));
    }
    public function saveadd(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'img'=>'required|file',
    ]);
        if ($request->status==null){
            $request->status=0;
        }
        $path = $request->file('img')->store('public/catagory');
        shop_catagory::create([
            'name'=>$request->name,
            'img'=>$path,
             'status'=>$request->status,
        ]);
//        return redirect('/member/index');
        return redirect()->route('shopcatagory.index')->with('success','添加分类成功');

    }
    public function destroy(shop_catagory $catagory)
    {
        $catagory->delete();
        session()->flash('success','删除成功');

        return redirect()->route('shopcatagory.index');
    }

    public function edit(shop_catagory $catagory)
    {
//        $id = $_GET['id'];
////        $admin = Admin::find($id);

        return view('shopcatagory.edit',compact('catagory'));
    }

    public function update(shop_catagory $catagory,Request $request)
    {
        $this->validate($request, [
//
            'name'=>'required',
            'img'=>'required|file',
        ],
            [//自定义错误提示
                'name.required'=>'用户名不能为空',

            ]);
        if ($request->status==null){
            $request->status=0;
        }
        $path = $request->file('img')->store('public/catagory');
        $catagory->update([
            'name'=>$request->name,
            'status'=>$request->status,
            'img'=>$path,
        ]);

        session()->flash('success','用户修改成功');

        return redirect()->route('shopcatagory.index');
    }


}
