@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <div class="container">
        <h1 style="text-align: center">添加管理员账号</h1>
        <form action="{{route('admin.update',[$admin])}}" method="post">
            <label>
                管理员账号:
            </label>
            <input type="text" class="form-control" placeholder="管理员账号" name="name" value="{{$admin->name}}"></br>
            <label for="">
                管理员邮箱:
            </label>
            <input type="email" name="email" class="form-control" placeholder="邮箱" value="{{$admin->email}}"><br>
            <label for="">

            <label for="">
                验证码:
            </label>
            <input id="captcha" class="form-control" name="captcha" >
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">

            <input type="hidden" name="status" value="0"><br><br><br>

            {{csrf_field()}}
            {{method_field('PATCH')}}
            <span style="float: right"><button class="btn btn-default" type="submit">确认</button></span>
            <br><br><br>
        </form>
    </div>



@endsection
