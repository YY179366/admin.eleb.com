
@extends('layout.default')

@section('contents')
    <table class="table table-striped table-hover">
        <tr class="success">
            <th>权限id</th>
            <th>权限名字</th>
            <th>权限创建时间</th>
            <th>操作</th>
        </tr>
        @foreach($permissions as $permission)
            <tr>
                <td>{{$permission->id}}</td>
                <td>{{$permission->name}}</td>
                <td>{{$permission->created_at}}</td>
                <td><a class="test" href="{{route('permission.edit',['permission'=>$permission->id])}}"><span
                                class="glyphicon glyphicon-edit"></span></a>
                    {{--<a class="test" href="{{route('permissions.show',['permission'=>$permission])}}"><span--}}
                    {{--class="glyphicon glyphicon-zoom-in"></span></a>--}}
                    <form action="{{route('permission.destroy',[$permission])}}" method="post">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$permissions->links()}}
@endsection

@section('js')
    <script>
        $('.table').on('click', '.delete', function () {
            var url = "permissions/" + this.id;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: "DELETE",
                dataType: "json",
                success: function (e) {
                    location.href = "";
                }
            });
        })
    </script>
@endsection