@extends('layout.default')

@section('contents')
    <h1 style="text-align: center">抽奖奖品管理</h1>
    <table class="table table-striped">
        <tr>
            <th>奖品编号</th>
            <th>所属活动</th>
            <th>奖品名称</th>
            <th>奖品详情</th>
            <th>中奖商家账号id</th>
            <th>操作</th>
        </tr>
        @foreach($event_prizes as $event_prize)
        <tr>
            <td>{{$event_prize->id}}</td>
            <td>{{$event_prize->Event->title}}</td>
            <td>{{$event_prize->name}}</td>
            <td>{{$event_prize->description}}</td>
            <td>@if($event_prize->member_id == 0 ){{'无'}} @else{{$event_prize->member_id}} @endif</td>
            <td>
                {{--修改--}}
                <a href="{{route('event_prize.edit',[$event_prize])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                {{--删除--}}
                <form action="{{route('event_prize.destroy',[$event_prize])}}" method="post">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    <button class="btn btn-danger btn-xs">删除</button>
                </form>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="9" style="text-align: center">
                <a href="{{route('event_prize.create')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></td>
        </tr>
    </table>
    {{$event_prizes->links()}}
    @stop
