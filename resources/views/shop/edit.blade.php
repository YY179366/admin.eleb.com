@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <div class="container">
    <h1 style="text-align: center">修改店铺信息</h1>
    <form action="{{route('shop.store')}}" method="post" enctype="multipart/form-data">
        <label>店铺分类类型:
        </label>
        <select name="shop_category_id" id="">
            @foreach($shop_categories as $shop_category)
                <option value="{{$shop_category->id}}" @if($shop_category->id == $shop->shop_category_id)selected @endif>{{$shop_category->name}}</option>
            @endforeach
        </select></br>

        <label for="">
            店铺名称
        </label>
        <input type="text" name="shop_name" class="form-control"value="{{$shop->shop_name}}"></br>

        <label for="">
            起送金额
        </label>
        <input type="text" name="start_send" class="form-control" placeholder="起送金额" value="{{$shop->start_send}}"></br>

        <label for="">
            配送费
        </label>
        <input type="text" name="send_cost" class="form-control" placeholder="配送费" value="{{$shop->send_cost}}"></br>

        <label for="">
            店公告
        </label>
        <input type="text" name="notice" class="form-control" placeholder="店公告" value="{{$shop->notice}}"></br>

        <label for="">
            优惠信息
        </label>
        <input type="text" name="discount" class="form-control" placeholder="优惠信息" value="{{$shop->discount}}"></br>



        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">店铺图片</label>
            <div>
                @if($shop->shop_img)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($shop->shop_img) }}"
                         class="img-thumbnail" width="150px">
                @endif
            </div>
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
            是:<input type="radio" name="brand" value="1" @if($shop->brand==1)checked  @endif>
        </label>
        &emsp;&emsp;&emsp;
        <label>
            否:<input type="radio" name="brand" value="0" @if($shop->brand==0)checked  @endif>
        </label></br>

        <label for="">
            是否准时送达&emsp;&emsp;
        </label>
        <label>
            是:<input type="radio" name="on_time" value="1" @if($shop->on_time==1)checked  @endif>
        </label>
        &emsp;&emsp;&emsp;
        <label>
            否:<input type="radio" name="on_time" value="0" @if($shop->on_time==0)checked  @endif>
        </label></br>

        <label for="">
            是否蜂鸟配送&emsp;&emsp;
        </label>
        <label>
            是:<input type="radio" name="fengniao" value="1" @if($shop->fengniao==1)checked  @endif>
        </label>
        &emsp;&emsp;&emsp;
        <label>
            否:<input type="radio" name="fengniao" value="0" @if($shop->fengniao==0)checked  @endif>
        </label></br>

        <label for="">
            是否保标记&emsp;&emsp;&emsp;
        </label>
        <label>
            是:<input type="radio" name="bao" value="1" @if($shop->bao==1)checked  @endif>
        </label>
        &emsp;&emsp;&emsp;
        <label>
            否:<input type="radio" name="bao" value="0" @if($shop->bao==0)checked  @endif>
        </label></br>

        <label for="">
            是否票标记&emsp;&emsp;&emsp;
        </label>
        <label>
            是:<input type="radio" name="piao" value="1" @if($shop->piao==1)checked  @endif>
        </label>
        &emsp;&emsp;&emsp;
        <label>
            否:<input type="radio" name="piao" value="0" @if($shop->piao==0)checked  @endif>
        </label></br>

        <label for="">
            是否准标记&emsp;&emsp;&emsp;
        </label>
        <label>
            是:<input type="radio" name="zhun" value="1" @if($shop->zhun==1)checked  @endif>
        </label>
        &emsp;&emsp;&emsp;
        <label>
            否:<input type="radio" name="zhun" value="0" @if($shop->zhun==0)checked  @endif>
        </label></br>

        <input type="hidden" name="status" value="0"><br><br><br>

        {{ csrf_field() }}
        <span style="float: right"><button class="btn btn-default" type="submit">确认</button></span>
        <br><br><br>
    </form>
    </div>
@endsection
