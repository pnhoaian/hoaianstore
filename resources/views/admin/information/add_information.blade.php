@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Thông Tin Website
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
                    <?php 
                    $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message', null);
                    }
                    ?>
                    <div class="position-center">
                        @foreach ($contact as $key =>$val)
                            
                        <form role="form" action="{{ URL::to('/update-info/' . $val->info_id) }}" method="post">
                            {{ csrf_field() }}

                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ cửa hàng</label>
                            <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên Hãng - Thương hiệu">
                        </div> --}}

                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa chỉ cửa hàng</label>
                            <textarea style="resize:none" rows="6" name="info_address" class="form-control" id="ckeditor" placeholder="Thêm địa chỉ cửa hàng">{{ $val->info_address }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Hotline tư vấn</label>
                            <input type="text" name="info_number"  class="form-control"  placeholder="Thêm số điện thoại" value="{{ $val->info_number }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Email hỗ trợ</label>
                            <textarea type="email" style="resize:none" rows="6" name="info_email" class="form-control" id="exampleInputPassword1" placeholder="Thêm Email">{{ $val->info_email }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Bản đồ</label>
                            <textarea style="resize:none" rows="6" name="info_map" class="form-control" id="exampleInputPassword1" placeholder="Thêm bản đồ">{{ $val->info_map }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Fanpage</label>
                            <textarea style="resize:none" rows="6" name="info_fanpage" class="form-control" id="exampleInputPassword1" placeholder="Thêm trang fanpge">{{ $val->info_fanpage }}</textarea>
                        </div>

                        <div class="form-group">
                        <button type="submit" name="add_info" class="btn btn-info">Cập nhật thông tin cửa hàng</button>
                    </form>
                    @endforeach
                    </div>

@endsection