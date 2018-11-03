@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <form method="post" action="{{ route('shop_catagory.saveadd') }}"  style="width: 50%" enctype="multipart/form-data">
        <h3><label>添加商家分类</label></h3>
        <div class="form-group">
            <label>分类名称</label>
            <input type="text" name="name" class="form-control" placeholder="分类名称">
        </div>
        <div class="form-group">
            <label>分类图片</label>
            <input type="file" name="img" >
        </div>
        <div class="form-group">
            <label>状态</label>
            <input type="text" name="status" class="form-control" placeholder="状态">
        </div>

        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">发布</button>
    </form>
@endsection
@section('javascript')
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            //swf: BASE_URL + '/js/Uploader.swf',
            // 文件接收服务端。
            server: '{{ route('upload') }}',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData:{
                _token:"{{ csrf_token() }}"
            }
        });
        uploader.on( 'uploadSuccess', function( file,response ) {
            //$( '#'+file.id ).addClass('upload-state-done');
            //console.log(response.path);图片地址
            //将上传成功的图片显示
            $("#pic").attr('src',response.path);
            //将图片地址写入输入框
            $("#goods_img").val(response.path);
        });
    </script>
@stop