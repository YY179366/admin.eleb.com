<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理员 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('admin.index')}}">管理员首页</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('admin.create')}}">添加管理员</a></li>
                        <li role="separator" class="divider"></li>

                    </ul>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家详情表 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('shop.index')}}">商家类首页</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('shop.create')}}">添加商家分类</a></li>
                        <li role="separator" class="divider"></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家注册表 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('user.index')}}">商家类首页</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('user.create')}}">添加商家分类</a></li>
                        <li role="separator" class="divider"></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">分类管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('shopcatagory.index')}}">商家类首页</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('catagory')}}">添加商家分类</a></li>
                        <li role="separator" class="divider"></li>

                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{route('login')}}">登录</a></li>
                <li><a href="{{route('admin.create')}}">注册</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span>{{ auth()->user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">个人中心</a></li>
                        <li><a href="{{route('admin.change')}}">修改密码</a></li>
                        <li role="separator" class="divider"></li>
                        <form action="{{route('logout')}}" method="post">
                            {{csrf_field()}}{{method_field('DELETE')}}
                            <button class="btn btn-link">注销</button>
                        </form>
                    </ul>
                </li>
                    @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>