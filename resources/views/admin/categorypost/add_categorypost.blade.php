@extends('admin_layout')
@section('admin_content')

<td>
    <a href="{{ URL::to('/all-category-post') }}">
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
                style="padding-right: 5px;font-size:15px"></i>Quản lý danh mục bài viết</button>
    </a>
</td>

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục bài viết
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
                        <form role="form" action="{{URL::to('/save-category-post')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                            <input type="text" name="cate_post_name" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Nhập tên thư mục">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục bài viết</label>
                            <textarea style="resize:none" rows="6" name="cate_post_desc" class="form-control" id="ckeditor" placeholder="Thêm mô tả"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hiện thị</label>
                            <select name="cate_post_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn danh mục bài viết</option>
                                <option selected value="1">Hiện thị danh mục bài viết</option>
                            </select>
                        </div>

                        <div class="form-group">
                        <button type="submit" name="add_post_cate" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

@endsection