@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <div class="container">
        <h1 style="text-align: center">添加商户账号</h1>
        <form action="{{route('shop.store')}}" method="post" enctype="multipart/form-data">
            <label>
                商家账号名称:
            </label>
            <input type="text" class="form-control" placeholder="商家账号名称" name="name" ></br>
            <label for="">
                邮箱:
            </label>
            <input type="email" name="email" class="form-control" placeholder="邮箱"><br>
            <label for="">
                密码:
            </label>
            <input type="password" name="password" class="form-control" placeholder="输入注册密码"><br>
            <br>

        <hr>
        <h1 style="text-align: center">添加店铺信息</h1>

                <div class="form-group">
                    <label for="inputPassword5" class="col-sm-2 control-label">商家分类</label>
                    <div class="col-sm-10">

                        <select class="form-control" name="shop_category_id">
                            <option value="0">请选择</option>
                            @foreach($shops as $shop)
                                <option  {{$shop->id==old('shop_category_id')?'selected':''}}  value="{{$shop->id}}">{{$shop->name}}</option>
                            @endforeach
                        </select>

                    </div>

                </div></br>

            <label for="">
                店铺名称
            </label>
            <input type="text" name="shop_name" class="form-control" placeholder="分类名称"></br>

            <label for="">
                起送金额
            </label>
            <input type="text" name="start_send" class="form-control" placeholder="起送金额"></br>

            <label for="">
                配送费
            </label>
            <input type="text" name="send_cost" class="form-control" placeholder="配送费"></br>

            <label for="">
                店公告
            </label>
            <input type="text" name="notice" class="form-control" placeholder="店公告"></br>

            <label for="">
                优惠信息
            </label>
            <input type="text" name="discount" class="form-control" placeholder="优惠信息"></br>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">店铺图片</label>
                <input  type="file" name="shop_img">

            </div>

            <label for="">
                评分
            </label>
            <input type="text" name="shop_rating" value="0" readonly class="form-control"><br>

            <label for="">
                是否是品牌&emsp;&emsp;&emsp;
            </label>
            <label>
                是:<input type="radio" name="brand" value="1">
            </label>
            &emsp;&emsp;&emsp;
            <label>
                否:<input type="radio" name="brand" value="0">
            </label></br>

            <label for="">
                是否准时送达&emsp;&emsp;
            </label>
            <label>
                是:<input type="radio" name="on_time" value="1">
            </label>
            &emsp;&emsp;&emsp;
            <label>
                否:<input type="radio" name="on_time" value="0">
            </label></br>

            <label for="">
                是否蜂鸟配送&emsp;&emsp;
            </label>
            <label>
                是:<input type="radio" name="fengniao" value="1">
            </label>
            &emsp;&emsp;&emsp;
            <label>
                否:<input type="radio" name="fengniao" value="0">
            </label></br>

            <label for="">
                是否保标记&emsp;&emsp;&emsp;
            </label>
            <label>
                是:<input type="radio" name="bao" value="1">
            </label>
            &emsp;&emsp;&emsp;
            <label>
                否:<input type="radio" name="bao" value="0">
            </label></br>

            <label for="">
                是否票标记&emsp;&emsp;&emsp;
            </label>
            <label>
                是:<input type="radio" name="piao" value="1">
            </label>
            &emsp;&emsp;&emsp;
            <label>
                否:<input type="radio" name="piao" value="0">
            </label></br>

            <label for="">
                是否准标记&emsp;&emsp;&emsp;
            </label>
            <label>
                是:<input type="radio" name="zhun" value="1">
            </label>
            &emsp;&emsp;&emsp;
            <label>
                否:<input type="radio" name="zhun" value="0">
            </label></br>

            <br>


            <input type="hidden" name="status" value="0"><br><br><br>

            {{csrf_field()}}
            <span style="float: right"><button class="btn btn-default" type="submit">确认</button></span>
            <br><br><br>
        </form>
    </div>
@endsection

