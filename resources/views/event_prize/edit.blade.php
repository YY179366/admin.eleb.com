@extends('layout.default')

@section('contents')
    <h1>添加奖品</h1>
    <br>
    <form action="{{ route('event_prize.update',[$event_Prize]) }}" method="post">
        <div class="form-group">
            <label>所属活动</label>
            <select name="events_id" id="">
                @foreach($events as $event)
                    <option value="{{$event->id}}">{{$event->title}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>奖品名称</label>
            <input type="text" name="name" class="form-control"  value="{{ $event_Prize->name }}">
        </div>
        <div class="form-group">
            <label>奖品详情</label>
            <textarea name="description" class="form-control">{{ $event_Prize->description }}</textarea>
        </div>
        <input type="hidden" value="{{$event_Prize->member_id}}" name="member_id">
        {{ csrf_field() }}
        {{method_field('PATCH')}}
        <button class="btn btn-primary btn-block">提交</button>
    </form>

@endsection
