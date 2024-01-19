@extends('admin_layout')
@section('admin_content')
<td>
    <a href="{{ URL::to('/all-category-product') }}">
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
                style="padding-right: 5px;font-size:15px"></i>Quản lý danh mục</button>
    </a>
</td>
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Danh Mục
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
                        <form role="form" action="{{URL::to('/save-category-product')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="category_name" value="{{ old('category_name') }}" class="form-control" id="name" placeholder="Nhập tên danh mục">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize:none" rows="6" name="category_desc" class="form-control" id="ckeditor" placeholder="Thêm mô tả">{{ old('category_desc') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hiện thị</label>
                            <select name="category_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn Danh Mục</option>
                                <option selected value="1">Hiện thị Danh Mục</option>
                            </select>
                        </div>

                        <div class="form-group">
                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

@endsection