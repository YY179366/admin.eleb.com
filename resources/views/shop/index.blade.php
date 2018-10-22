@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <h1 style="text-align: center">商家信息页面</h1>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>店铺类型</th>
        <th>店铺名称</th>
        <th>店铺图片</th>
        <th>店铺评分</th>
        <th>是否是品牌</th>
        <th>是否准时送达</th>
        <th>是否蜂鸟配送</th>
        <th>是否保标记</th>
        <th>是否票标记</th>
        <th>是否准标记</th>
        <th>起送金额</th>
        <th>配送费</th>
        <th>店公告</th>
        <th>优惠信息</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    @foreach($shops as $shop)
    <tr>
        <td>{{$shop->id}}</td>
        <td>{{$shop->Shop_category->name }}</td>
        <td>{{$shop->shop_name}}</td>
        <td>@if($shop->shop_img) <img class="img-circle"src="{{ \Illuminate\Support\Facades\Storage::url($shop->shop_img) }}" width="50px"/> @endif</td>
        <td>{{$shop->shop_rating}}</td>
        <td>{{$shop->brand?'是':'否'}}</td>
        <td>{{$shop->on_time?'是':'否'}}</td>
        <td>{{$shop->fengniao?'是':'否'}}</td>
        <td>{{$shop->bao?'是':'否'}}</td>
        <td>{{$shop->piao?'是':'否'}}</td>
        <td>{{$shop->zhun?'是':'否'}}</td>
        <td>{{$shop->start_send}}</td>
        <td>{{$shop->send_cost}}</td>
        <td>{{$shop->notice}}</td>
        <td>{{$shop->discount}}</td>
        <td>{{$shop->status?'正常':'待审核'}}</td>
        <td>
            <a href="{{ route('shop.edit',[$shop]) }}" class="btn btn-warning">修改</a>
            <form method="post" action="{{ route('shop.destroy',[$shop]) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-danger">删除</button>
            </form>
        </td>
    </tr>
        @endforeach
    {{--添加--}}
    @can('shop_create')
    <tr>
        <td colspan="17" style="text-align: center">
            <a href="{{route('shop.create')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
        </td>
    </tr>
        @endcan
</table>
@endsection
