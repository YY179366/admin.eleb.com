@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <h1 style="text-align: center">修改管理员密码</h1>
    <form action="{{route('shop_user.reset_save')}}" method="post">
        <label>
            当前用户:
        </label>
        <input type="text" class="form-control" name="name" value="{{$shop_user->name}}" readonly>
        <input type="hidden" value="{{$shop_user->id}}" name="id"></br>
        <label>
            重置密码:
        </label>
        <input type="password" class="form-control" placeholder="请输入密码" name="password"></br>
        {{csrf_field()}}
        <br>
        <span style="float: right"><button class="btn btn-default" type="submit">确认</button></span>
    </form>
@endsection
