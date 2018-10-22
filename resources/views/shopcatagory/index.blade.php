@extends('layout.default')

@section('contents')
<table class="table table-condensed">
    <tr class="">
        <th>ID</th>
        <th>分类名称</th>
        <th>分类图片</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    @foreach ($catagorys as $catagory)
        <tr class="">
            <td>{{ $catagory->id }}</td>
            <td>{{ $catagory->name }}</td>
            <td>@if($catagory->img) <img class="img-circle"src="{{ \Illuminate\Support\Facades\Storage::url($catagory->img) }}" width="50px"/> @endif</td>
            <td>{{ $catagory->status }}</td>
            <td><a href="{{ route('shop_catagory.edit',[$catagory]) }}" class="btn btn-warning btn-xs">修改</a>
           <a href="{{route('shop_catagory.destroy',$catagory)}}">删除</a>
            </td>
        </tr>
    @endforeach
</table>
@endsection