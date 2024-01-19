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
                    Cập Nhật Hãng - Thương hiệu
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
                    {{-- @foreach ($edit_brand_product as $key => $edit_value )
                        <div class="position-center">
                            <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                <label for="exampleInputEmail1">Tên Hãng - Thương hiệu</label>
                                <input type="text" value="{{ $edit_value->brand_name }}" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên Hãng - Thương hiệu">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả Hãng - Thương hiệu</label>
                                <textarea style="resize:none" rows="6" name="brand_product_desc" class="form-control" id="ckeditor" placeholder="Thêm mô tả">{{ $edit_value->brand_desc }}</textarea>
                            </div>
                            <div class="form-group">
                            <button type="submit" name="edit" class="btn btn-info">Cập nhật</button>
                        </form>
                        </div>
                    @endforeach --}}

                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-brand-product/'.$edit_brand_product->brand_id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên Hãng - Thương hiệu</label>
                            <input type="text" value="{{ $edit_brand_product->brand_name }}" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên Hãng - Thương hiệu">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh Sản phẩm</label>
                            <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1">
                            <img src="{{ URL::to('public/upload/brand/'.$edit_brand_product->brand_image)}}" height="200px" width="200px">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Hãng - Thương hiệu</label>
                            <textarea style="resize:none" rows="6" name="brand_desc" class="form-control" id="ckeditor" placeholder="Thêm mô tả">{{ $edit_brand_product->brand_desc }}</textarea>
                        </div>
                        <div class="form-group">
                        <button type="submit" name="edit" class="btn btn-info">Cập nhật</button>
                    </form>
                    </div>
@endsection