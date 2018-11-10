<?php

namespace App\Http\Controllers;

use App\event;
use App\event_member;
use App\event_prize;
use App\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //显示活动列表
    public function index()
    {
        $events =event::paginate(5);
        return view('event/index', compact('events'));
    }

    //添加抽奖活动
    public function create()
    {
        return view('event/create');
    }

    //保存抽奖活动
    public function store(Request $request)
    {
        //验证
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'signup_start' => 'required',
            'signup_end' => 'required',
            'prize_date' => 'required',
            'signup_num' => 'required',
        ], [
            'title.required' => '名称必须输入',
            'content.required' => '内容必须输入',
            'signup_start.required' => '报名开始时间必须选择',
            'signup_end.required' => '报名结束时间必须选择',
            'prize_date.required' => '开奖日期必须选择',
            'signup_num.required' => '开奖人数必须设置',
        ]);

        //当前时间
        $time = time();
        //报名开始日期
        $signup_start = strtotime($request->signup_start);
        //报名结束日期
        $signup_end = strtotime($request->signup_end);

        //判断开始时间
        if ($signup_start < $time) {
            return redirect()->back()->withInput()->with('danger', '开始时间不能早于当前时间');
        }

        //判断结束时间
        if ($signup_end < $time) {
            return redirect()->back()->withInput()->with('danger', '结束时间不能早于当前时间');
        }

        //保存
        Event::create([
            'title' => $request->title,
            'content' => $request->input('content'),
            'signup_start' => $signup_start,
            'signup_end' => $signup_end,
            'prize_date' => $request->prize_date,
            'signup_num' => $request->signup_num,
            'is_prize' => 0,
        ]);

        //保存成功后,跳转
        return redirect()->route('event.index')->with('success', '活动添加成功');
    }
    //修改抽奖活动--回显
    public function edit(Event $event)
    {
        return view('event/edit', compact('event'));
    }

    //修改后保存
    public function update(Event $event, Request $request)
    {
        //数据验证
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'signup_start' => 'required',
            'signup_end' => 'required',
            'prize_date' => 'required',
            'signup_num' => 'required',
        ], [
            'title.required' => '名称必须输入',
            'content.required' => '内容必须输入',
            'signup_start.required' => '报名开始时间必须选择',
            'signup_end.required' => '报名结束时间必须选择',
            'prize_date.required' => '开奖日期必须选择',
            'signup_num.required' => '开奖人数必须设置',
        ]);

        //当前时间
        $time = time();
        //报名结束日期
        $signup_end = strtotime($request->signup_end);

        //判断结束时间
        if ($signup_end < $time) {
            return redirect()->back()->withInput()->with('danger', '结束时间不能早于当前时间');
        }

        $event->update([
            'title' => $request->title,
            'content' => $request->input('content'),
            'signup_start' => strtotime($request->signup_start),
            'signup_end' => $signup_end,
            'prize_date' => $request->prize_date,
            'signup_num' => $request->signup_num,
            'is_prize' => 0,
        ]);

        //修改成功后,跳转
        return redirect()->route('event.index')->with('success', '活动修改成功');

    }

    //删除抽奖活动
    public function destroy(Event $event)
    {
        $event->delete();
        //删除成功后,跳转
        return redirect()->route('event.index')->with('success', '活动删除成功');
    }
    //查看名单
    public function show(Event $event)
    {
        //dd($event);
        $event_members = event_member::where('events_id', $event->id)->get();
        //dd($event_members);
        return view('event_member/show', compact('event_members'));
    }

    public function start(Event $event)
    {

        //活动id
        $event_id = $event->id;
        //dd($event_id);

        //奖品名称
        $prize_names = event_prize::where('events_id', $event_id)->get()->toArray();
        //dd($prize_names);

        //报名
        $event_members = event_member::where('events_id', $event_id)->get(['member_id'])->toArray();

        shuffle($event_members);
        shuffle($prize_names);

        foreach ($prize_names as $prize_name) {
            $member = array_pop($event_members);
            $member_id = $member??$member[0]['member_id'];
            if (empty($member_id)){
                continue;
            }
            $event->update([
                'is_prize' => 1,
            ]);
            event_prize::find($prize_name['id'])->update(
                $member_id);

            //查找用户
             User::where('id',$member_id)->value('email');


        }
        return redirect()->route('event_prize.index')->with('success', '抽奖成功');
    }
}
