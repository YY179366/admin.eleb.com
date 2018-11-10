@extends('layout.default')

@section('contents')
    <h1 style="text-align: center">抽奖活动管理</h1>
    <table class="table table-striped">
        <tr>
            <th>抽奖活动编号</th>
            <th>主题名称</th>
            <th>详情</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖日期</th>
            <th>报名人数限制</th>
            <th>是否已开奖</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
        <tr>
            <td>{{$event->id}}</td>
            <td>{{$event->title}}</td>
            <td>{{$event->content}}</td>
            <td>{{date('Y-m-d H:i:s',$event->signup_start)}}</td>
            <td>{{date('Y-m-d H:i:s',$event->signup_end)}}</td>
            <td>{{$event->prize_date}}</td>
            <td>{{$event->signup_num}}</td>
            <td>@if($event->is_prize ==0){{'未开奖'}} @else{{'已开奖'}} @endif</td>
            <td>
                {{--修改--}}
                <a href="{{route('event.edit',[$event])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                {{--删除--}}
                <form action="{{route('event.destroy',[$event])}}" method="post">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    <button class="btn btn-danger btn-xs">删除</button>
                </form>
                {{--开始抽奖--}}
                @if(time()>= strtotime($event->prize_date) && $event->is_prize ==0)<a href="{{route('start',[$event])}}"><button class="btn btn-danger btn-sm"><span>开始抽奖</span></button></a>@elseif($event->is_prize ==1)<button class="btn btn-danger btn-sm" disabled><span>开始抽奖</span></button>@else @endif
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="9" style="text-align: center">
                <a href="{{route('event.create')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></td>
        </tr>
    </table>

    @stop
