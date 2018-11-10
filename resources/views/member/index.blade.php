@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <h1 style="text-align: center">会员列表</h1>
    <form action="{{route('member.index')}}" method="get" class="form-inline">
        查询:<input type="text" name="username" placeholder="根据用户名查询" class="form-control">
        <input type="submit" value="搜索">
    </form>
    <br>
    <table class="table table-striped">
        <tr>
            <th>ID编号</th>
            <th>会员账号</th>
            <th>会员号码</th>
            <th>注册时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
            <tr>
                <td>{{$member->id}}</td>
                <td>{{$member->username}}</td>
                <td>{{$member->tel}}</td>
                <td>{{$member->created_at}}</td>
                <td>@if($member->status == 0)已禁用@else正常@endif</td>
                <td>
                    {{--修改--}}
                    @can('member_update')
                        <a href="{{route("member.edit",[$member])}}"><button class="btn btn-primary btn-xs"><span>编辑</span></button></a>
                    @endcan
                    {{--删除--}}

                        <form action="{{route('member.destroy',[$member])}}" method="post">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}
                            <button class="btn btn-danger btn-xs">删除</button>
                        </form>

                    @if($member->status != 0)<a href="{{route("member.status",[$member])}}"><button class="btn btn-success btn-sm"><span>禁止登陆</span></button></a>@else  @endif
                </td>
            </tr>
        @endforeach
        {{--添加--}}
        @can('member_create')
            <tr>
                <td colspan="6" style="text-align: center">
                    <a href="{{route('member.create')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                </td>
            </tr>
        @endcan
    </table>
    {{$members->appends($user)->links()}}

@endsection