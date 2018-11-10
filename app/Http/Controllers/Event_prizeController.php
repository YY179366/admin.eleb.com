<?php

namespace App\Http\Controllers;

use App\event;
use App\event_prize;
use Illuminate\Http\Request;

class Event_prizeController extends Controller
{
    //显示抽奖活动奖品
    public function index(){
        $event_prizes = event_prize::paginate(5);
        return view('event_prize/index',compact('event_prizes'));
    }

    //对活动奖品进行增加
    public function create(){
        //活动
        $events = event::all();
        return view('event_prize/create',compact('events'));
    }

    //对活动奖品进行保存
    public function store(Request $request){
        //数据验证
        $request->validate([
            'events_id'=>'required',
            'name'=>'required',
            'description'=>'required',
        ],[
            'events_id.required'=>'奖品所属活动必须旋选择',
            'name.required'=>'奖品名称必须填写',
            'description.required'=>'必须输入奖品详情'
        ]);

        //保存
        event_prize::create([
            'events_id'=>$request->events_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'member_id'=>0,
        ]);

        //保存成功,跳转
        return redirect()->route('event_prize.index')->with('success','添加奖品成功');
    }

    //对活动奖品进行修改--回显
    public function edit(Event_Prize $event_prize){
        $events = event::all();
        return view('event_prize/edit',['events'=>$events,'event_Prize'=>$event_prize]);
    }

    //对活动奖品进行修改--保存
    public function update(Request $request , event_prize $event_Prize){
        //数据验证
        $request->validate([
            'events_id'=>'required',
            'name'=>'required',
            'description'=>'required',
        ],[
            'events_id.required'=>'奖品所属活动必须旋选择',
            'name.required'=>'奖品名称必须填写',
            'description.required'=>'必须输入奖品详情'
        ]);

        //修改
        $event_Prize->update([
            'events_id'=>$request->events_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'member_id'=>$request->member_id,
        ]);

        //保存成功
        return redirect()->route('event_prize.index')->with('success','修改奖品成功');
    }

    //对活动奖品进行删除
    public function destroy(event_prize $event_prize){
        $event_prize->delete();
        //删除成功
        return redirect()->route('event_prize.index')->with('success','删除奖品成功');
    }
}
