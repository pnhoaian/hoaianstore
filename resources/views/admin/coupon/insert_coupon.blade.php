@extends('admin_layout')
@section('admin_content')

<td>
    <a href="{{ URL::to('/list-coupon') }}">
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
                style="padding-right: 5px;font-size:15px"></i>Danh sách mã khuyến mãi</button>
    </a>
  </td>

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Coupon mới
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
                        <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="POST">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên chương trình Giảm Giá</label>
                            <input type="text" name="coupon_name" value="{{ old('coupon_name') }}" class="form-control" id="name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Ngày bắt đầu chương trình Giảm Giá</label>
                            <input type="text" id="datepickerkm" name="coupon_date_start" value="{{ old('coupon_date_start') }}" class="form-control" id="name">
                        </div>

                            <input type="hidden"  name="coupon_status" class="form-control" id="name">
                       

                        <div class="form-group">
                            <label for="exampleInputEmail1">Ngày kết thúc chương trình Giảm Giá</label>
                            <input type="text" id="datepickerkm2" name="coupon_date_end" value="{{ old('coupon_date_end') }}" class="form-control" id="name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã Giảm Giá</label>
                            <input type="text" name="coupon_code" value="{{ old('coupon_code') }}" class="form-control" id="name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Số lượng Coupon</label>
                            <input type="text" name="coupon_times" value="{{ old('coupon_times') }}" class="form-control" id="name">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Chương trình giảm giá</label>
                            <select name="coupon_condition" class="form-control input-sm m-bot15">
                                <option value="1">Giảm theo phần trăm trên hóa đơn</option>
                                <option value="2">Giảm tiền trực tiếp trên hóa đơn</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhập số tiền hoặc % giảm giá</label>
                            <input type="text" name="coupon_number" value="{{ old('coupon_number') }}" class="form-control" id="name">
                        </div>

                        <div class="form-group">
                        <button type="submit" name="add_coupon" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

@endsection