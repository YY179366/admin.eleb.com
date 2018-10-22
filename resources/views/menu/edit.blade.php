@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form action="{{route('menu.update',[$menu])}}" method="post" enctype="multipart/form-data" style="width: 400px">
        <div class="form-group">
            <label>菜品名称:</label>
            <input type="text" class="form-control" name="goods_name" value="{{$menu->goods_name}}">
        </div>
        <label>所属商家:</label>
        <select class="form-control" name="shop_id">
            <option value="0">请选择</option>
            @foreach($shops as $shop)
                <option  {{$shop->id==old('shop_id')?'selected':''}}  value="{{$shop->id}}">{{$shop->shop_name}}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label>菜品分类:</label>
            <select name="category_id" id="" class="form-control">
                @foreach($menucategorys as $menucategory)
                <option value="{{$menucategory->id}}" {{$menu->category_id==$menucategory->id?'selected':''}}>{{$menucategory->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>价格:</label>
            <input type="text" class="form-control" name="goods_price" value="{{$menu->goods_price}}" >
        </div>
        <div class="form-group">
            <label>描述:</label>
            <input type="text" class="form-control" name="description" value="{{$menu->description}}" >
        </div>
        <div class="form-group">
            <label>提示信息:</label>
            <input type="text" class="form-control" name="tips" value="{{$menu->tips}}">
        </div>
        <div class="form-group">
            <label>分类图片</label>
            <input type="file" name="goods_img" >
        </div>
        {{csrf_field()}}
        {{method_field('PATCH')}}
        <button type="submit" class="btn btn-primary"> 确认修改</button>
    </form>
@endsection