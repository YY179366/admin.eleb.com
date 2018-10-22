@extends('layout.default')

@section('contents')
    @include('layout._errors')
    {{--添加--}}
    <a href="{{route('menu.create')}}" class="glyphicon glyphicon-plus btn btn-danger btn-sm">新增菜品</a>
    {{--搜索--}}
    <div style="float: right">


        <form class="navbar-form navbar-left" action="{{route('menu.index')}}" method="get">
            <div class="form-group ">
                <input type="text" class="form-control" name="keyword" placeholder="输入菜品名称搜索">
            </div>
            <div class="form-group ">
                <input type="number" class="form-control" name="min_price" placeholder="输入最低价格搜索">
            </div>--
            <div class="form-group ">
                <input type="number" class="form-control" name="max_price" placeholder="输入最高价格搜索">
            </div>
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </form>


    </div>

    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>菜品名称</th>
            <th>所属商家</th>
            <th>所属分类</th>
            <th>菜品图片</th>
            <th>价格</th>
            <th>评分</th>
            <th>描述</th>
            <th>月销量</th>
            <th>评分数量</th>
            <th>提示信息</th>
            <th>满意度数量</th>
            <th>满意度评分</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->goods_name}}</td>
                <td>{{$menu->shop_id}}</td>
                <td>{{$menu->category_id}}</td>

                <td>@if($menu->goods_img) <img class="img-circle"src="{{ \Illuminate\Support\Facades\Storage::url($menu->goods_img) }}" width="50px"/> @endif</td>
                </td>
                <td>{{$menu->goods_price}}</td>
                <td>{{$menu->rating}}</td>
                <td>{{$menu->description}}</td>
                <td>{{$menu->month_sales}}</td>
                <td>{{$menu->rating_count}}</td>
                <td>{{$menu->tips}}</td>
                <td>{{$menu->satisfy_count}}</td>
                <td>
                {{$menu->satisfy_rate}}
                <td>
                    {{--删除--}}
                    <form method="post" action="{{route('menu.destroy',[$menu])}}" style="display:inline">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn-danger glyphicon glyphicon-trash btn-sm"></button>
                    </form>
                    {{--编辑--}}
                    <a href="{{route('menu.edit',[$menu->id])}}">
                        <button class="glyphicon glyphicon-edit btn-info btn-sm"></button>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    {{--调用分页--}}
    {{--{{ $menus->appends(['keyword'=>$keyword,'min_price'=>$min_price,'max_price'=>$max_price])->links() }}--}}
{{--    {{ $menus->appends($data)->links() }}--}}
    @endsection