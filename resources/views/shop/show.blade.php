@extends('default')
@section('contents')
    <h1 style="color: red">店名:{{$shop->shop_name}}</h1>
    <h5>所属用户: <span style="color: red">{{$shop->shop_user->name}}</span> </h5>
    优惠信息: <p>{{$shop->discount}}</p>
    <table class="table table-bordered table-responsive">
        <tr>
            <td>是否是品牌</td>
            <td>是否准时送达</td>
            <td>是否蜂鸟配送</td>
            <td>是否保标记</td>
            <td>是否票标记</td>
            <td>是否准标记</td>
            <td>起送金额</td>
            <td>配送费</td>
            <td>当前状态</td>
        </tr>
        <tr>
            <td>{{$shop->brand?'是':"不是"}}</td>
            <td>{{$shop->on_time?'支持':"不支持"}}</td>
            <td>{{$shop->fengniao?'支持':"不支持"}}</td>
            <td>{{$shop->bao?'支持':"不支持"}}</td>
            <td>{{$shop->piao?'支持':"不支持"}}</td>
            <td>{{$shop->zhun?'支持':"不支持"}}</td>
            <td>{{$shop->start_send}}</td>
            <td>{{$shop->send_cost}}</td>
            <td>{{$shop->status?'正常':'待审核'}}</td>


        </tr>




    </table>
    店公告: <div style=" border: solid;width: 100%;height: 100px">
        <p>{{$shop->notice}}</p>
    </div>
    <br>
    <br>



    <a href="{{route('shop.status',[$shop])}}"><button class="btn btn-warning btn-xs"><span>商家审核</span></button></a>


@endsection
