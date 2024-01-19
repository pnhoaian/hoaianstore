@extends('admin_layout')
@section('admin_content')

<div class="row" style="background: blanchedalmond;padding: 10px;border: 1px solid #eff1f4; margin:10px; border-radius: 10px">
    <h3 style="text-align: center;color: #EE3E38; margin-bottom: 15px">THỐNG KÊ DOANH SỐ BÁN HÀNG</h3>

    <form autocomplete="off">
        @csrf
        <div class="col-md-3" style="margin-left: 12px;">
            <p style="display: flex"><label style="margin-right: 5px;
                line-height: 28px;">Từ
                    ngày:</label> <input type="text" id="datepicker" style="width:65%;border:1px solid #000"
                    class="form-control"></p>
        </div>
        <div class="col-md-3" style="margin-left:-30px">

            <p style="display: flex"><label
                    style="margin-right: 5px;
                line-height: 28px;">Đến ngày: </label> <input
                    type="text" id="datepicker2" style="width:65%;border:1px solid #000;" class="form-control">
            </p>
        </div>
        <div class="col-md-2">

            <input type="button" id="btn-dashboard-filter" class="button-chitiet"
                style="margin-left: -15px; height: 34px; background:#002795; border-radius: 10px; color: wheat  " value="Lọc kết quả">


        </div>
        <div class="col-md-3" style="margin-left: -40px;">
            <p style="display: flex">
                <label style="margin-right: 5px;
                line-height: 28px;">Lọc theo:</label>
                <select class="dashboard-filter form-control" style="width:65%;border:1px solid #000">
                    <option>--Chọn--</option>
                    <option value="7ngay">7 ngày qua</option>
                    <option value="thangnay">tháng này</option>
                    <option value="thangtruoc">tháng trước</option>
                    <option value="365ngayqua">1 năm qua</option>

                </select>
            </p>

        </div>
    </form>

    <div class="col-md-12">
        <div id="chart" style="height: 260px"></div>
    </div>

</div>



<div style="margin-top: 20px ;">
    <div class="col-md-12 col-xs-12">
        <h3 style="text-align: center;color: #EE3E38;">THỐNG KÊ TỔNG QUÁT</h3>
        <div id="donut" style="background:blanchedalmond;border-radius: 15px "></div>
    </div>
</div>
<div  style="background:#fff;display: table-row;
z-index: 999;
background: #fff;" >
    <li class="a" style="list-style-type: none;width:100%">&nbsp</li> 
 </div>

<div style="margin-top: 10px ;">
    <div class="col-md-12 col-xs-12" style="background: blanchedalmond;padding-top: 10px;padding-bottom: 10px;border-radius: 15px;">
        <table class="table">
            <h3 style="text-align: center;color: #EE3E38;">THỐNG KÊ BÀI VIẾT</h3>
            <thead class="thead-light">
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên bài viết</th>
                <th scope="col">Số lượt xem</th>
              </tr>
            </thead>
            <tbody>
                    @php
                        $i=0;
                    @endphp
                @foreach ($post_vieww as $key=>$post)
                    @php
                        $i++;  
                    @endphp
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td><a target="_blank" href="{{ URL('/bai-viet/'.$post->post_id) }}" style="color: #337ab7;">{{ $post->post_title }}</a></td>
                        <td style="text-align: center;">{{ $post->post_view }}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
    <div  style="background:#fff;display: table-row;
    z-index: 999;
    background: #fff;" >
        <li class="a" style="list-style-type: none;width:100%">&nbsp</li> 
     </div>
     


<div style="margin-top: 10px;">
    <div class="col-md-12 col-xs-12" style="background: blanchedalmond;padding-top: 10px;padding-bottom: 10px;border-radius: 15px;">
        <table class="table">
            <h3 style="text-align: center;color: #EE3E38;">THỐNG KÊ SẢN PHẨM</h3>
            <thead class="thead-light">
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Số lượt xem</th>
              </tr>
            </thead>
            <tbody>
                    @php
                        $i=0;
                    @endphp
                @foreach ($product_vieww as $key=>$pro)
                    @php
                        $i++;  
                    @endphp
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td><a target="_blank" href="{{ URL('/chi-tiet-san-pham/'.$pro->product_id) }}" style="color: #337ab7;white;">{{ $pro->product_name }}</a></td>
                        <td>{{ $pro->product_view }}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
</div>
<div  style="background:#fff;display: table-row;
z-index: 999;
background: #fff;" >
    <li class="a" style="list-style-type: none;width:100%">&nbsp</li> 
 </div>



<div style="margin-top: 10px;">
    <div class="col-md-12 col-xs-12" style="background: blanchedalmond;padding-top: 10px;padding-bottom: 10px;border-radius: 15px;">
        <table class="table">
            <h3 style="text-align: center;color: #EE3E38;">THỐNG KÊ SẢN PHẨM BÁN CHẠY </h3>
            <thead class="thead-light">
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Số lượt bán</th>
              </tr>
            </thead>
            <tbody>
                    @php
                        $i=0;
                    @endphp
                @foreach ($product_soldd as $key=>$pro)
                    @php
                        $i++;  
                    @endphp
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td><a target="_blank" href="{{ URL('/chi-tiet-san-pham/'.$pro->product_id) }}" style="color: #337ab7;white;">{{ $pro->product_name }}</a></td>
                        <td style="text-align: center;">{{ $pro->product_sold }}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
    </div>
<br>
    
</div>



@endsection