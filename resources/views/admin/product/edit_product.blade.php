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
                style="padding-right: 5px;font-size:15px"></i>Quản lý thương hiệu sản phẩm</button>
    </a>
</td>

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Sản phẩm
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

                                    <div class="position-center">
                                        @foreach ($edit_product as $key => $pro)
                                        
                                        <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}"
                                         method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tên Sản phẩm</label>
                                            <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{ $pro->product_name}}">
                                        </div>
                
                                        <div class="form-group">
                                            <label for="">Danh mục sản phẩm</label>
                                            <select name="category_id" class="form-control input-sm m-bot15">
                                                @foreach ($cate_product as $key => $cate)
                                                    <option {{ $cate->category_id == $pro->category_id ? 'selected' : ' ' }}
                                                        value="{{ $cate->category_id }}">
                                                        {{ $cate->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
        
                                        </div>
                
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Hãng - Thương hiệu</label>
                                            <select name="brand_id" class="form-control m-bot15">
                                                @foreach ($brand_product as $key => $brand)
                                            @if ($brand->brand_id == $pro->brand_id)
                                                <option selected value="{{ $brand->brand_id }}">{{ $brand->brand_name }}
                                                </option>
                                            @else
                                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                            @endif
                                        @endforeach> 
                                            </select>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Mô tả Sản phẩm</label>
                                            <textarea style="resize:none" rows="6" name="product_desc" class="form-control" id="ckeditor" >{{ $pro->product_desc}}"</textarea>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Hình ảnh Sản phẩm</label>
                                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                            <img src="{{ URL::to('public/upload/product/'.$pro->product_image)}}" height="200px" width="200px">
                                        </div>
                
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Giá Sản phẩm</label>
                                            <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value="{{ $pro->product_price}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Giá Nhập</label>
                                            <input type="text" name="product_cost" value="{{$pro->product_cost}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập giá Sản phẩm">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Giá Khuyến Mãi</label>
                                            <input type="text" name="product_price_sale" class="form-control" id="exampleInputEmail1" value="{{ $pro->product_price_sale}}">
                                        </div>
                
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                            <input type="text" name="product_quantity" class="form-control" placeholder="Nhập số lượng" value="{{ $pro->product_quantity}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Hiện thị</label>
                                            <select name="product_status" class="form-control m-bot15">
                                                <option {{ $pro->product_status == 0 ? 'selected' : ' ' }} value="0">Ẩn Sản phẩm</option>
                                                <option {{ $pro->product_status == 1 ? 'selected' : ' ' }} value="1">Hiện thị Sản phẩm</option>
                                            </select>
                                        </div>
                        <div class="form-group">
                        <button type="submit" name="edit" class="btn btn-info">Cập nhật</button>
                    </form>
                    @endforeach
                    </div>        
@endsection