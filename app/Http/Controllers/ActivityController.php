<?php

namespace App\Http\Controllers;

use App\activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(){

        $keyword = $_GET['keyword']??'all';
        //dd($keyword);
        if($keyword == 'all'){
            $activities = activity::paginate(5  );
            return view('activity/index',['activities'=>$activities,'keyword'=>$keyword]);
        }elseif ($keyword == 'n_start'){
            $time = date('Y-m-d H:i:s',time());
            $activities = activity::where('start_time','>',$time)->paginate(5);
            return view('activity/index',['activities'=>$activities,'keyword'=>$keyword]);
        }elseif ($keyword == 'start'){
            $time = date('Y-m-d H:i:s',time());
            $activities = activity::where('start_time','<=',$time)->where('end_time','>',$time)->paginate(5);
            return view('activity/index',['activities'=>$activities,'keyword'=>$keyword]);
        }elseif ($keyword == 'end'){
            $time = date('Y-m-d H:i:s',time());
            $activities = activity::where('end_time','<',$time)->paginate(5);
            return view('activity/index',['activities'=>$activities,'keyword'=>$keyword]);
        }
    }


    public function create()
    {
        return view('activity/create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:30',
            'content'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ],[
            'title.required'=>'请输入活动标题',
            'title.max'=>'活动标题长度不能超过30个字符',
            'content.required'=>'请输入活动内容',
            'start_time.required'=>'请选择活动开始时间',
            'end_time.required'=>'请选择活动结束时间',
        ]);
        $time = time();
        $start_time = strtotime($request->start_time);
        if($time > $start_time){
            return redirect()->route('activity.create')->with('danger','开始日期不能早于当前日期');
        }else {
            //保存
            activity::create([
                'title' => $request->title,
                'content' => $request->input('content'),
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);
            return redirect()->route('activity.index')->with('success', '活动添加成功');
        }
    }
    public function show(activity $activity,Request $request)
    {
        return view('activity/show',compact('activity'));
    }

    public function edit(activity $activity)
    {
        return view('activity/edit',compact('activity'));
    }
    public function update(activity $activity,Request $request)
    {
        $request->validate([
            'title'=>'required|max:30',
            'content'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ],[
            'title.required'=>'请输入活动标题',
            'title.max'=>'活动标题长度不能超过30个字符',
            'content.required'=>'请输入活动内容',
            'start_time.required'=>'请选择活动开始时间',
            'end_time.required'=>'请选择活动结束时间',
        ]);
        $time = time();
        $start_time = strtotime($request->start_time);
        if($time > $start_time){
            return redirect()->route('activity.edit')->with('danger','开始日期不能早于当前日期');
        }else {
            //保存
            $activity->update([
                'title' => $request->title,
                'content' => $request->input('content'),
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);
            return redirect()->route('activity.index')->with('success', '活动更新成功');
        }
    }
    public function destroy(activity $activity)
    {
        $activity->delete();
        //成功,跳转
        return redirect()->route('activity.index')->with('success','活动删除成功');
    }
}
