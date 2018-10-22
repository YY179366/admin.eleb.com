@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form method="post" action="{{ route('shop_catagory.update',['catagory'=>$catagory]) }} "  style="width: 50%" enctype="multipart/form-data">
        <h3><label>添加商家分类</label></h3>
        <div class="form-group">
            <label>分类名称</label>
            <input type="text" name="name" class="form-control" placeholder="分类名称" value="{{$catagory->name}}">
        </div>
        <div class="form-group">
            <label>分类图片</label>
            <div>
                @if($catagory->img)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($catagory->img) }}"
                         class="img-thumbnail" width="150px">
                @endif
            </div>
            <input type="file" name="img" >
        </div>
        <div class="form-group">
            <label>状态</label>
            <input type="text" name="status" class="form-control" value="{{$catagory->status}}">
        </div>

        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">发布</button>
    </form>
@endsection