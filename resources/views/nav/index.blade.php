@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <h1 style="text-align: center">导航菜单表</h1>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>路由地址</th>
        <th>关联权限id</th>
        <th>修改日期</th>
        <th style="text-align: center">操作</th>
    </tr>
    @foreach($navs as $nav)
    <tr>
        <td>{{$nav->id}}</td>
        <td>{{$nav->name}}</td>
        <td>{{$nav->url}}</td>
        <td>{{$nav->permission_id}}</td>
        <td>{{$nav->updated_at}}</td>

        <td class="row">
            <a href="{{ route('nav.edit',[$nav]) }}" class="btn btn-warning col-xs-4">修改</a>

            <form method="post" action="{{ route('nav.destroy',[$nav]) }}" class="col-xs-4">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-danger">删除</button>
            </form>

        </td>
    @endforeach
</table>
    {{$navs->links()}}
@endsection
