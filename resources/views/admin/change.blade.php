@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <h1 style="text-align: center">修改管理员密码</h1>
    <form action="{{route('admin.change')}}" method="post">
        <label>
            当前用户:
        </label>
        <input type="text" class="form-control" name="name" value="{{auth()->user()->name}}" readonly></br>
        <label>
            旧密码:
        </label>
        <input type="password" class="form-control" placeholder="请输入旧密码" name="old_password"></br>
        <label>
            新密码:
        </label>
        <input type="password" class="form-control" placeholder="请输入新密码" name="password"></br>
        <label>
            再次输入新密码:
        </label>
        <input type="password" class="form-control" placeholder="再次输入新密码" name="password_confirmation"></br>
        {{csrf_field()}}

        <span style="float: right"><button class="btn btn-default" type="submit">确认</button></span>
        <br><br><br>
    </form>
@endsection
