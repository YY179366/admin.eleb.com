@extends('layout.default')

@section('contents')
    @include('layout._errors')
    {{--添加--}}
    <a href="{{route('menucategory.create')}}" class="glyphicon glyphicon-plus btn btn-danger btn-xs">新增分类</a>
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>分类名</th>
            <th>描述</th>
            <th>所属商家</th>
            <th>是否为默认</th>
            <th>操作</th>
        </tr>
        @foreach($menucategorys as $menucategory)
            <tr>
                <td>{{$menucategory->id}}</td>
                <td>{{$menucategory->name}}</td>
                <td>{{$menucategory->description}}</td>
                <td>{{$menucategory->shop_id}}</td>
                <td>{{$menucategory->is_selected==1?'是':'否'}}</td>
                <td>
                    {{--删除--}}
                    <form method="post" action="{{route('menucategory.destroy',[$menucategory])}}" style="display:inline">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn-danger glyphicon glyphicon-trash btn-xs"></button>
                    </form>

                    {{--编辑--}}
                    <a href="{{route('menucategory.edit',[$menucategory->id])}}"
                       class="glyphicon glyphicon-edit btn-info btn-xs"></a>
                </td>
            </tr>
        @endforeach
    </table>
    {{--调用分页--}}
    {{--{{ $articles->links() }}--}}
@endsection
