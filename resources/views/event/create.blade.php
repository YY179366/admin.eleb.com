@extends('layout.default')

@section('contents')

    <h1>添加活动</h1>
    <form action="{{ route('event.store') }}" method="post">
        <div class="form-group">
            <label>名称</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label>详情</label>
            <textarea name="content" class="form-control">{{ old('content') }}</textarea>
        </div>
        <div class="form-group">
            <label>报名开始时间</label>
            <input type="date" class="form-control" name="signup_start" value="{{ old('signup_start') }}">
        </div>
        <div class="form-group">
            <label>报名结束时间</label>
            <input type="date" class="form-control" name="signup_end" value="{{ old('signup_end') }}">
        </div>
        <div class="form-group">
            <label>开奖时间</label>
            <input type="date" class="form-control" name="prize_date" value="{{ old('prize_date') }}">
        </div>
        <div class="form-group">
            <label>报名人数限制</label>
            <input type="number" class="form-control" name="signup_num" value="{{ old('signup_num') }}">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>

@endsection
