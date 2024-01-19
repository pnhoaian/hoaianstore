@extends('admin_layout')
@section('admin_content')

<td>
    <a href="{{ URL::to('/manage-banner') }}">
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
                style="padding-right: 5px;font-size:15px"></i>Quản lý Banner</button>
    </a>
</td>

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Slide - Banner
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
                        <form role="form" action="{{URL::to('/insert-slider')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Slide - Banner</label>
                                <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên Slide - Banner">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh</label>
                                <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" placeholder="Hình ảnh Slide - Banner">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả Slide - Banner</label>
                                <textarea style="resize:none" rows="6" name="slider_desc" class="form-control" id="exampleInputEmail1" placeholder="Thêm mô tả"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Loại Banner</label>
                                <select name="slider_type" class="form-control input-sm m-bot15">
                                    <option value="0" selected>Banner Lớn </option>
                                    <option value="1">Banner Nhỏ</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Hiện thị</label>
                                <select name="slider_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn Slide - Banner</option>
                                    <option value="1" selected>Hiện thị Slide - Banner</option>
                                </select>
                            </div>

                            <div class="form-group">
                            <button type="submit" name="add_slider" class="btn btn-info">Thêm</button>
                        </form>
                    </div>

@endsection