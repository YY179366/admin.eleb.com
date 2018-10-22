@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <h1 style="text-align: center">商家账户页面</h1>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>商家账号</th>
        <th>所属商家店铺</th>
        <th>所属商家店铺状态</th>
        <th>商家邮箱账号</th>
        <th>操作</th>
    </tr>
    @foreach($users as $shop_user)
    <tr>
        <td>{{$shop_user->id}}</td>
        <td>{{$shop_user->name}}</td>
        <td>{{$shop_user->shop_id}}</td>
        <td>{{$shop_user->status?'正常':'待审核'}}</td>
        <td>{{$shop_user->email}}</td>

        <td><a href="{{route('shop_user.status',[$shop_user])}}"class="btn btn-danger">{{$shop_user->status?'启用':'禁用'}}</a>
            <a href="{{ route('user.edit',[$shop_user]) }}" class="btn btn-warning col-xs-4">修改</a>
            <form method="post" action="{{ route('user.destroy',[$shop_user]) }}" class="col-xs-4">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-danger">删除</button>
            </form>
        </td>
    </tr>
        @endforeach

</table>
@endsection
