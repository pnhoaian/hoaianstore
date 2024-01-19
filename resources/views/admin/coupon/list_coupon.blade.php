@extends('admin_layout')
@section('admin_content')


<td>
  <a href="{{ URL::to('/insert-coupon') }}">
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
              style="padding-right: 5px;font-size:15px;
              "></i>Thêm mã khuyến mãi</button>
  </a>
</td>

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh Sách Coupon - Mã giảm giá
      </div>

      <div>
        <p><a href="{{URL::to('/send-coupon')}}" class="btn btn-default" style="margin: 10px 10px;">Gửi mã khuyến mãi cho khách VIP</a></p>
      </div>

      <div class="table-responsive">
        <table class="table table-striped b-t b-light" id="myTable">
          <thead>
            <tr>
              <th></th>
              <th>Tên chương trình</th>
              <th>Ngày bắt đầu</th>
              <th>Ngày kết thúc</th>
              <th>Mã giảm giá</th>
              <th>Số lượng</th>
              <th>Loại khuyến mãi</th>
              <th>Giảm</th>
              <th>Tình trạng</th>
              <th>Trạng thái</th>
              <th>Tác vụ</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($coupon as $key => $cou)
              
            <tr>
              <td></td>
                <td>{{ $cou->coupon_name }}</td>
                <td>{{ $cou->coupon_date_start }}</td>
                <td>{{ $cou->coupon_date_end }}</td>
                <td>{{ $cou->coupon_code }}</td>
                <td>{{ $cou->coupon_times }}</td>
              
              <td><span class="text-ellipsis">
                <?php
                if($cou->coupon_condition == 1){
                ?>
                   Giảm theo  phần trăm
                <?php
                }else{
                ?>
                  Giảm theo tiền hóa đơn
                <?php 
                }
                ?>
              </span>
            </td>

            <td>
              <span class="text-ellipsis">
                <?php
                  if($cou->coupon_condition == 1){
                ?>
                    {{ $cou->coupon_number }} %
                <?php
                }else{
                ?>
                  {{ number_format($cou->coupon_number,0,',','.' ) }} VNĐ
                <?php 
                }
                ?>
              </span>
            </td>

            

            <td>
                  @if( $cou->coupon_status ==1 )
                    <span style="width: 110px;text-align: center;float: inherit;color: #33CC33;margin-bottom: 10px;font-family: -apple-system, system-ui, BlinkMacSystemFont;font-weight: 700;" 
                      >Còn hạn</span></a>
                  @else
                    <span style="width: 110px;text-align: center;float: inherit;color: #CC0033;margin-bottom: 10px;font-family: -apple-system, system-ui, BlinkMacSystemFont;font-weight: 700;" 
                  >Hết hạn</span></a>
                  @endif
            </td>

            <td>
              <span class="text-ellipsis">
                <?php
                  if($cou->coupon_status == 1){
                ?>
                    <span style="width: 110px;text-align: center;float: inherit;color: #33CC33;margin-bottom: 10px;font-family: -apple-system, system-ui, BlinkMacSystemFont;font-weight: 700;" 
                    >Hoạt động</span></a>
                <?php
                }else{
                ?>
                  <span style="width: 110px;text-align: center;float: inherit;color: #CC0033;margin-bottom: 10px;font-family: -apple-system, system-ui, BlinkMacSystemFont;font-weight: 700;" 
                  >Không hoạt động</span></a>
                <?php 
                }
                ?>
              </span>
            </td>

              {{-- <td><span class="text-ellipsis">10/07/2023</span></td> --}}
              <td>
                <a onclick="return confirm('Xác nhận xóa Coupon này?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling" ui-toggle-class=""> 
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