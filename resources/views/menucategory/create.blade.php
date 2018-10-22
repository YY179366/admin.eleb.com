@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form action="{{route('menucategory.store')}}" method="post" enctype="multipart/form-data" style="width: 300px">
        <div class="form-group">
            <label>分类名:</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}">
        </div>
        <div class="col-sm-10">
            <label>所属商家:</label>
            <select class="form-control" name="shop_id">
                <option value="0">请选择</option>
                @foreach($shops as $shop)
                    <option  {{$shop->id==old('shop_id')?'selected':''}}  value="{{$shop->id}}">{{$shop->shop_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>描述:</label>
            <input type="text" class="form-control" name="description" value="{{old('description')}}">
        </div>
        <div class="form-group">
            <label>是否为默认分类:</label>
            <label><input type="radio" name="is_selected" value="1">是</label>&emsp;
            <label><input type="radio" name="is_selected" checked value="0">否</label>
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary"> 确认添加</button>
@endsection
