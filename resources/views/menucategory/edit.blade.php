@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form action="{{route('menucategory.update',[$menucategory])}}" method="post" enctype="multipart/form-data" style="width: 300px">
        <div class="form-group">
            <label>分类名:</label>
            <input type="text" class="form-control" name="name" value="{{$menucategory->name}}">
        </div>

        <div class="form-group">
            <label>描述:</label>
            <input type="text" class="form-control" name="description" value="{{$menucategory->description}}">
        </div>
        <div class="form-group">
            <label>是否为默认分类:</label>
            <label><input type="radio" name="is_selected" {{$menucategory->is_selected==1?'checked':''}} value="1">是</label>&emsp;
            <label><input type="radio" name="is_selected"  value="0" {{$menucategory->is_selected==0?'checked':''}}>否</label>
        </div>
        {{csrf_field()}}
        {{method_field('PATCH')}}
        <button type="submit" class="btn btn-primary"> 确认添加</button>
    </form>
@endsection
