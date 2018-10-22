@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <h1 style="text-align: center">管理员页面</h1>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>管理员账号</th>
        <th>管理员邮箱</th>
        <th>注册日期</th>
        <th>修改日期</th>
        <th style="text-align: center">操作</th>
    </tr>
    @foreach($admins as $admin)
    <tr>
        <td>{{$admin->id}}</td>
        <td>{{$admin->name}}</td>
        <td>{{$admin->email}}</td>
        <td>{{$admin->created_at}}</td>
        <td>{{$admin->updated_at}}</td>
        <td class="row"><a href="{{ route('admin.edit',[$admin]) }}" class="btn btn-warning col-xs-4">修改</a>
            <form method="post" action="{{ route('admin.destroy',[$admin]) }}" class="col-xs-4">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-danger">删除</button>
            </form>

        </td>
    @endforeach
</table>
    {{$admins->links()}}
@endsection
