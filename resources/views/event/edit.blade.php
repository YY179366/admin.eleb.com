@extends('layout.default')

@section('contents')
    <h1>修改抽奖活动</h1>
    <form action="{{ route('event.update',[$event]) }}" method="post">
        <div class="form-group">
            <label>名称</label>
            <input type="text" class="form-control" name="title" value="{{ $event->title }}">
        </div>
        <div class="form-group">
            <label>详情</label>
            <textarea name="content" class="form-control">{{ $event->content }}</textarea>
        </div>
        <div class="form-group">
            <label>报名开始时间</label>
            <input type="datetime-local" class="form-control" name="signup_start" value="{{date('Y-m-d\TH:i:s',$event->signup_start)}}">
        </div>
        <div class="form-group">
            <label>报名结束时间</label>
            <input type="datetime-local" class="form-control" name="signup_end" value="{{date('Y-m-d\TH:i:s',$event->signup_end)}}">
        </div>
        <div class="form-group">
            <label>开奖时间</label>
            <input type="date" class="form-control" name="prize_date" value="{{date('Y-m-d',strtotime($event->prize_date))}}">
        </div>
        <div class="form-group">
            <label>报名人数限制</label>
            <input type="number" class="form-control" name="signup_num" value="{{ $event->signup_num }}">
        </div>
        {{ csrf_field() }}
        {{method_field('PATCH')}}
        <button class="btn btn-primary btn-block">提交</button>
    </form>

@endsection
