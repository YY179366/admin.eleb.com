@extends('layout.default')

@section('contents')
    <h1 style="text-align: center">参与名单</h1>
    <table class="table table-striped">
        <tr>
            <th>编号</th>
            <th>活动名称</th>
            <th>用户账号</th>
        </tr>
        @foreach($event_members as $event_member)
        <tr>
            <td>{{$event_member->id}}</td>
            <td>{{$event_member->event->title}}</td>
            <td>{{$event_member->shop_user->name}}</td>
        </tr>
            @endforeach
    </table>
    @stop
