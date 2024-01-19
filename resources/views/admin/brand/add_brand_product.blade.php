@extends('admin_layout')
@section('admin_content')

<td>
        <a href="{{ URL::to('/all-brand-product') }}">
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
                    style="padding-right: 5px;font-size:15px"></i>Quản lý thương hiệu sản phẩm</button>
        </a>
    </td>

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Hãng - Thương hiệu
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
                        <form role="form" action="{{URL::to('/save-brand-product')}}" method="POST" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên Hãng - Thương hiệu</label>
                            <input type="text" name="brand_name" value="{{ old('brand_name') }}"  class="form-control" id="exampleInputEmail1" placeholder="Nhập tên Hãng - Thương hiệu">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Hãng - Thương hiệu</label>
                            <textarea style="resize:none" rows="6" name="brand_desc" class="form-control" id="ckeditor" placeholder="Thêm mô tả">{{ old('brand_desc') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hiện thị</label>
                            <select name="brand_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn Hãng - Thương hiệu</option>
                                <option selected value="1">Hiện thị Hãng - Thương hiệu</option>
                            </select>
                        </div>

                        <div class="form-group">
                        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

@endsection