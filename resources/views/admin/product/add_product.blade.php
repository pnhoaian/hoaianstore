@extends('admin_layout')
@section('admin_content')

<td>
    <a href="{{ URL::to('/all-product') }}">
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
                style="padding-right: 5px;font-size:15px"></i>Quản lý sản phẩm</button>
    </a>
</td>

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sản phẩm
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
                        <form role="form" action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Sản phẩm</label>
                                <input type="text" name="product_name" value="{{ old('product_name') }}" class="form-control" id="exampleInputEmail1">
                            </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh Mục Sản Phẩm</label>
                            <select name="category_id" class="form-control m-bot15">
                                @foreach ($cate_product as $key =>$cate) 
                                 <option value="{{ $cate->category_id}}">{{ $cate->category_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group"></div>
                            <label for="exampleInputPassword1">Hãng - Thương hiệu</label>
                            <select name="brand_id" class="form-control m-bot15">
                                @foreach ($brand_product as $key =>$brand) 
                                 <option value="{{ $brand->brand_id}}">{{ $brand->brand_name }}</option>
                                @endforeach   
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Sản phẩm</label>
                            <textarea style="resize:none" rows="6" name="product_desc" class="form-control" id="ckeditor">{{ old('product_desc') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh Sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá Gốc</label>
                            <input type="text" name="product_price" value="{{ old('product_price') }}" class="form-control" id="exampleInputEmail1" placeholder="Nhập giá Sản phẩm">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá Nhập</label>
                            <input type="text" name="product_cost" value="{{ old('product_cost') }}" class="form-control" id="exampleInputEmail1" placeholder="Nhập giá Sản phẩm">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá Khuyến Mãi</label>
                            <input type="text" name="product_price_sale" value="{{ old('product_price_sale') }}" class="form-control" id="exampleInputEmail1" placeholder="Nhập giá Khuyến mãi">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                            <input type="text" name="product_quantity" value="{{ old('product_quantity') }}" class="form-control" placeholder="Nhập số lượng">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiện thị</label>
                            <select name="product_status" class="form-control m-bot15">
                                <option value="0">Ẩn Sản phẩm</option>
                                <option selected value="1">Hiện thị Sản phẩm</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="add_product" class="btn btn-info">Thêm</button>
                        </div>
                    </form>
                </div>

@endsection