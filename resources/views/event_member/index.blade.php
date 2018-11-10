@extends('layout.default')

@section('contents')
    <h1 style="text-align: center">报名名单管理</h1>
    <table class="table table-striped">
        <tr>
            <th>编号</th>
            <th>活动名称</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
        <tr>
            <td>{{$event->id}}</td>
            <td>
                {{$event->title}}
            </td>
            <td>
                <a href="{{route('event.show',[$event])}}"><button class="btn btn-primary btn-xs"><span>查看报名名单</span></button></a>
            </td>
        </tr>
            @endforeach
    </table>
    @stop
