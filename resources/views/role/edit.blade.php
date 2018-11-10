
@extends('layout.default')

@section('contents')
    <div class="container">
        <h1 style="text-align: center">角色修改</h1>
        <form action="{{route('role.update',[$role])}}" method="post">
            <label>
                角色名称:
            </label>
            <input type="text" class="form-control" placeholder="权限名称" name="name" value="{{$role->name}}"></br>
            选择权限:
            </label>
            <div class="checkbox">
                @foreach($permissions as $permission)
                    <input type="checkbox" name="permission[]" value="{{$permission->id}}" @if($role_permission->contains($permission))checked @endif>{{$permission->name}}&emsp;&emsp;&emsp;&emsp;
                @endforeach
            </div>
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <span style="float: right"><button class="btn btn-default" type="submit" >确认</button></span>
            <br><br><br>
        </form>
    </div>



@endsection
