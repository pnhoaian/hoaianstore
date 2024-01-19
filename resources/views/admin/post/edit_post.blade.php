@extends('admin_layout')
@section('admin_content')

<td>
    <a href="{{ URL::to('/all-post') }}">
        <button style="width: fit-content;
        padding: 0.5em 1em;text-align: center;float: inherit;
        margin: 0em auto;
        color: #ffffff;
        background: #00000026;
        border-radius:5px;
        background: 	#CC0033 !important;
        margin-bottom: 10px;
        font-family: -apple-system, system-ui, BlinkMacSystemFont;
        font-weight: 700;
        " class="button-chuyen" role="button"><i class="fa fa-long-arrow-right"
                style="padding-right: 5px;font-size:15px"></i>Quản lý bài viết</button>
    </a>
</td>

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa bài viết
                </header>
                                {{-- //thông báo lỗi đầu vào ở header --}}
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                {{-- End --}}
                <div class="panel-body">

                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-post/'.$post->post_id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" rows="3" name="post_title" value="{{ $post->post_title }}" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Nhập tiêu đề bài viết">
                        </div>

                        <div class="form-group"></div>
                            <label for="exampleInputPassword1">Danh mục</label>
                            <select name="cate_post_id" class="form-control m-bot15">
                                @foreach ($cate_post as $key =>$cate) 
                                 <option {{ $post->cate_post_id == $cate->cate_post_id ? 'selected' : ''}} value="{{$cate->cate_post_id}}">{{ $cate->cate_post_name }}</option>
                                @endforeach   
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả ngắn</label>
                            <textarea style="resize:none"  rows="5" name="post_desc" class="form-control" placeholder="Thêm mô tả">{{ $post->post_desc }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội bài viết</label>
                            <textarea style="resize:none" rows="8"  name="post_content" class="form-control" id="ckeditor" placeholder="Thêm mô tả">{{ $post->post_content }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                            <input type="file" name="post_image" class="form-control" id="exampleInputEmail1">
                            <img src="{{ URL::to('public/upload/post/'.$post->post_image)}}" height="200px" width="350px">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hiện thị</label>
                            <select name="post_status" class="form-control input-sm m-bot15">
                                @if ($post->post_status==0)
                                    <option value="0">Ẩn bài viết</option>
                                    <option selected value="1">Hiện thị bài viết</option>
                                @else
                                    <option value="0">Ẩn bài viết</option>
                                    <option selected value="1">Hiện thị bài viết</option>
                                @endif
                                
                            </select>
                        </div>

                        <div class="form-group">
                        <button type="submit" name="update_post" class="btn btn-info">Cập nhật</button>
                    </form>
                    </div>

@endsection