@extends('layout.default')

@section('contents')
    <h1>添加奖品</h1>
    <br>
    <form action="{{ route('event_prize.store') }}" method="post">
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
            <input type="text" name="name" class="form-control"  value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>奖品详情</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>

@endsection
