@extends('admin_layout')
@section('admin_content')

<td>
  <a href="{{ URL::to('/add-product') }}">
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
              style="padding-right: 5px;font-size:15px"></i>Thêm sản phẩm</button>
  </a>
</td>

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh Sách Sản phẩm
      </div>
      
      <div class="table-responsive">

        <table class="table table-striped b-t b-light" id="myTable">
          <thead>
            <tr>
              {{-- <th></th> --}}
              <th>Hình ảnh</th>
              <th>Tên Sản phẩm</th>
              <th style="width: 90px;">Thư viện ảnh</th>
              <th>Giá gốc</th>
              <th style="width: 115px;">Giá khuyến mãi</th>
              <th style="width: 80px;">Số lượng</th>
              <th>Danh Mục</th>
              <th style="width: 95px;">Thương Hiệu</th>
              <th>Trạng thái</th>
              {{-- <th>Ngày thêm</th> --}}
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_product as $key => $pro)
              
            <tr>
              {{-- <td></td> --}}
              <td><img src=" public/upload/product/{{ $pro->product_image }}" height="100px" width="100px"></td>
              <td>{{ $pro->product_name }}</td>
              <th style="width: 100px;"><a href="{{URL::to('/add-gallery/'.$pro->product_id)}}">Thêm hình ảnh</a></th>
              <td>{{ $pro->product_price }}</td>
              <td> <?php
                if($pro->product_price_sale == 0){
                ?>
                   <span >không có</span>
                   {{-- echo'Ẩn'; --}}
                <?php
                }else{
            ?>
                  <span>{{ $pro->product_price_sale}}</span>
                  {{--  echo'Hiện Thị'; --}}
                <?php 
                }
                ?>
              </span></td>
              <td>{{ $pro->product_quantity }}</td>
              <td>{{ $pro->category_name }}</td>
              <td>{{ $pro->brand_name }}</td>

              {{---- status  ----}}
              <td><span class="text-ellipsis">
                <?php
                if($pro->product_status == 0){
                ?>
                   <a href="{{URL::to('/active-product/'.$pro->product_id)}}">
                    {{-- <span class="fa-thump-styling-down fa fa-thumbs-down"></span> --}}
                    <button style="
                    width: 110px;
                    padding: 0.5em 1em;text-align: center;float: inherit;
                    margin: 0em auto;
                    color: #ffffff;
                    background: #00000026;
                    border-radius:5px;
                    background: 	#CC0033 !important;
                    margin-bottom: 10px;
                    font-family: -apple-system, system-ui, BlinkMacSystemFont;
                    font-weight: 700;" class="button-chuyen" role="button">Đang ẩn</button>

                  </a>
                   {{-- echo'Ẩn'; --}}
                <?php
                }else{
            ?>
                  <a href="{{URL::to('/inactive-product/'.$pro->product_id)}}">
                    {{-- <span class="fa-thump-styling fa fa-thumbs-up"></span> --}}
                    <button style="
                    width: 110px;
                    padding: 0.5em 1em;text-align: center;float: inherit;
                    margin: 0em auto;
                    color: #ffffff;
                    background: #00000026;
                    border-radius:5px;
                    background: 		#33CC33 !important;
                    margin-bottom: 10px;
                    font-family: -apple-system, system-ui, BlinkMacSystemFont;
                    font-weight: 700;" class="button-chuyen" role="button">Hiển thị</button>

                  </a>
                  {{--  echo'Hiện Thị'; --}}
                <?php 
                }
                ?>
              </span></td>

              <td>
                <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i>
                  
                <a onclick="return confirm('Xác nhận xóa Sản phẩm này?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling" ui-toggle-class=""> 
                  <i class="fa fa-trash"></i></a>
              </td>
            </tr>

            @endforeach

          </tbody>
        </table>
      </div>
    
    </div>
  </div>

@endsection