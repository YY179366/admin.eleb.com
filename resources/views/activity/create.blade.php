
@extends('layout.default')

@section('contents')

    @include('vendor.ueditor.assets')
<form action="{{route('activity.index')}}" method="post" class="">
    <div class="form-group">
        <label for="exampleInput1">活动名称</label>
        <input type="text" name="title"  value="{{ old('title') }}" class="form-control" id="exampleInput1" placeholder="title">
    </div>
    <div class="form-group">
        <label for="exampleInput1">活动开始时间</label>
        <input type="date" name="start_time" class="form-control" id="exampleInput1">
    </div>
    <div class="form-group">
        <label for="exampleInput1">活动结束时间</label>
        <input type="date" name="end_time" class="form-control" id="exampleInput1">
    </div>
@include('vendor.ueditor.assets')
<!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
    <!-- 编辑器容器 -->
    <script id="container" name="content" type="text/plain"></script>
    <div class="form-group">
        <label>验证码</label>
        <input id="captcha" class="form-control" name="captcha" >
        <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
    </div>
    {{ csrf_field() }}
    <button class="btn btn-primary btn-block">提交</button>
</form>
@endsection