@extends('layout.default')

@section('contents')
<div class="container">
    <h1 style="text-align: center">添加导航菜单</h1>
    <form action="{{route('nav.store')}}" method="post">
        <label>
            菜单名称:
        </label>
        <input type="text" class="form-control" placeholder="菜单名" name="name" ></br>
        <label for="">
            菜单路径:
        </label>
        <input type="text" name="url" class="form-control" placeholder="菜单路劲"><br>
        <label for="">
            菜单权限:
        </label>
        <div class="radio">
            @foreach($permissions as $permission)
            &emsp;&emsp;<input type="radio" name="permission" value="{{$permission->id}}" >{{$permission->name}}&emsp;&emsp;
            @endforeach
        </div>
        <br>
        <label for="">
            上级菜单:
        </label>
        <select name="pid" id="">
            <option value="0">----顶级菜单</option>
            @foreach($navs as $nav)
                <option value="{{$nav->id}}">--{{$nav->name}}</option>
            @endforeach
        </select>
        <br>
        <br>

        {{csrf_field()}}
        <span style="float: right"><button class="btn btn-default" type="submit">确认</button></span>
        <br><br><br>
    </form>
</div>



@endsection
