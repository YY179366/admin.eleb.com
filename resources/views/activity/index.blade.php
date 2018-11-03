@extends('layout.default')

@section('contents')


    <form action="{{route('activity.index')}}" method="get" class="navbar-form navbar-left" role="search">
    <label for="" style="font-size: 20px">
        搜索:
    </label>
    <select name="keyword" id="" class="form-control">
        <option value="all" selected>全部</option>
        <option value="n_start">未开始</option>
        <option value="start">进行中</option>
        <option value="end">已结束</option>
    </select>
    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
</form>
<br> <br> <br>
<h1 style="text-align: center">活动页面</h1>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>活动名称</th>
        <th>活动内容</th>
        <th>活动开始时间</th>
        <th>活动结束时间</th>

        <th>操作</th>
    </tr>
    @foreach($activities as $activity)
        <tr>
            <td>{{$activity->id}}</td>
            <td>{{$activity->title}}</td>
            <td  >{!! $activity->content !!}</td>
            <td>{{$activity->start_time}}</td>
            <td>{{$activity->end_time}}</td>
            <td>
                <a href="{{ route('activity.edit',[$activity]) }}">
                    <button class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></button>
                </a>
                <form action="{{ route('activity.destroy',[$activity]) }}" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                </form>
                <a href="{{ route('activity.show',[$activity]) }}">
                    <button class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </a>
            </td>
        </tr>
    @endforeach
    {{--添加--}}
    <tr>
        <td colspan="6" style="text-align: center">
            <a href="{{route('activity.create')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
        </td>
    </tr>
</table>
{{$activities->links()}}
@endsection