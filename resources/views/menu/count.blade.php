@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <div style="float: right">
        <form class="navbar-form navbar-left" action="{{route('menuCount')}}" method="get">
            <div class="form-group ">
                <input type="datetime-local" class="form-control" name="min_time">
            </div>--
            <div class="form-group ">
                <input type="datetime-local" class="form-control" name="max_time">
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
            <th>菜品图片</th>
            <th>销量</th>
        </tr>
        @foreach($menus as $menu)
        <tr>
            <th>{{$menu->id}}</th>
            <th>{{$menu->goods_name}}</th>
            <th>
                <img src="{{$menu->goods_img}}" alt="" width="40px">
            </th>
            <th>{{$menu->amount?$menu->amount:'0'}}</th>
        </tr>
        @endforeach
    </table>
    {{--调用分页--}}
    {{--{{ $menus->appends(['keyword'=>$keyword,'min_price'=>$min_price,'max_price'=>$max_price])->links() }}--}}
    {{--{{ $menus->appends($data)->links() }}--}}
@stop