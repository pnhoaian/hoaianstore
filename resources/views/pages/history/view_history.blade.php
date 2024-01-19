@extends('welcome')
@section('content')

@section('footer')
	@include("pages.include.footer")
@endsection()
<div class="table-agile-info">
    <div class="panel panel-default">
        <h3 style="text-align: center">Thông tin đơn hàng đã đặt: {{ $order_code }}</h3>
        <div class="panel-heading">
            Thông tin khách hàng
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light"
                style="font-family: -apple-system, system-ui, BlinkMacSystemFont;">
                <thead>
                    <tr>
                        <th style="text-align: center">Mã khách hàng</th>
                        <th style="text-align: center">Tên khách hàng</th>
                        <th style="text-align: center">Số điện thoại</th>
                        <th style="text-align: center">Email</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td style="text-align: center">{{ $customer->customer_id }}</td>
                        <td style="text-align: center">{{ $customer->customer_name }}</td>
                        <td style="text-align: center">{{ $customer->customer_phone }}</td>
                        <td style="text-align: center">{{ $customer->customer_email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-------------------*********************************************** Table 2 **********************************************--------------------}}
<br>

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin vận chuyển
        </div>
        <div class="table-responsive">
            <?php
            $message = Session::get('message2');
            if ($message) {
                echo $message;
                Session::put('message2', null);
            }
            ?>
            <table class="table table-striped b-t b-light"
                style="font-family: -apple-system, system-ui, BlinkMacSystemFont;">
                <thead>
                    <tr>
                        <th style="width:160px; line-height:30px">Tên người nhận</th>
                        <th style="width:250px; line-height:30px; text-align: center">Địa chỉ nhận hàng</th>
                        <th style="width:120px; line-height:30px">Số điện thoại</th>
                        <th style="width:200px; line-height:30px; text-align: center">Email</th>
                        <th style="line-height:30px; text-align: center" >Phương thức thanh toán</th>
                        {{-- // --}}
                        <th style="line-height:30px; text-align: center" >Phương thức nhận hàng</th>
                        {{-- // --}}
                        <th style="width:180px; line-height:30px">Ghi chú</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td style="text-align: center" >{{ $shipping->shipping_name }}</td>
                        <td>{{ $shipping->shipping_address }}</td>
                        <td>{{ $shipping->shipping_phone }}</td>
                        <td>{{ $shipping->shipping_email }}</td>

                        <td style="text-align: center">
                            @if ($shipping->shipping_method_pay == 0)
                            Tiền mặt
                        @else
                            Chuyển khoản
                        @endif
                        </td>
                        {{-- // --}}
                        <td style="text-align: center">
                            @if ($shipping->shipping_method_receive == 0)
                                Nhận tại cửa hàng
                            @else
                                Giao hàng tận nơi
                            @endif
                        </td>
                        {{-- // --}}
                        <td>{{ $shipping->shipping_note }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


{{-------------------*********************************************** Table 3 **********************************************--------------------}}
<br>

<div class="table-agile-info">
        
    <div class="panel panel-default">
        <div class="panel-heading">
            Chi tiết đơn hàng: 
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light"
                style="font-family: -apple-system, system-ui, BlinkMacSystemFont;">
                <thead>
                    
                    
                    <tr>
                        <th style="width:160px; line-height:30px">STT</th>
                        <th style="width:160px; line-height:30px">Tên sản phẩm</th>
                        <th style="width:250px; line-height:30px;">Số lượng</th>
                        <th style="width:120px; line-height:30px">Giá</th>
                        <th style="width:200px; line-height:30px;">Tổng tiền</th>
                    </tr>
                    
                </thead>
                <tbody>
                    @php
                        $i=0;
                        $total = 0;
                    @endphp
                    @foreach ($order_details as $details)
                        @php
                            $i++;
                            $subtotal = $details->Product_price * $details->Product_sales_quantity;
                            $total+=$subtotal;
                        @endphp

                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $details->Product_name }}</td>
                    <td>{{ $details->Product_sales_quantity }}</td>
                    <td>{{ number_format($details->Product_price, 0, ',', '.') . ' ' . '₫'  }}</td> 
                <td>{{  number_format($subtotal, 0, ',', '.') . ' ' . '₫' }} </td>   
                

                </tr>
                @endforeach
                <tr>
                    @php
                        $total_coupon = 0;
                    @endphp
                    @if ($coupon_condition==0)
                    @php
                    //Phần trăm sau giảm
                        $total_after_coupon = ($total * $coupon_number)/100;
                        //Tổng tiền thanh toán
                        $total_coupon = $total - $total_after_coupon + $details->product_feeship;
                        
                    @endphp                       
                    @else
                        @php
                            $total_coupon = $total - $coupon_number + $details->product_feeship;
                        @endphp
                    @endif 

                    <td>     
                        @php
                                    if ($coupon_condition == 1) {
                                        $coupon_echo = $coupon_number . '%';
                                    } elseif ($coupon_condition == 2) {
                                        $coupon_echo = number_format($coupon_number, 0, ',', '.') . 'đ';
                                    }
                                @endphp

                                Tổng tiền hàng: {{ number_format($total, 0, ',', '.') }}đ <br>
                                @if ($details->product_coupon != 'no')
                                    {{ $details->product_coupon }}  Giá trị giảm: {{ $coupon_echo }} </p>
                                @else
                                    Không có -
                                @endif
                                @php
                                    $total_coupon = 0;
                                @endphp
                                @if ($coupon_condition == 1)
                                    @php
                                        
                                        $total_after_coupon = ($total * $coupon_number) / 100;
                                        echo 'Tổng giảm: ' . number_format($total_after_coupon, 0, ',', '.') . 'đ' . '</br>';
                                        $total_coupon = $total + $details->product_feeship - $total_after_coupon;
                                    @endphp
                                @else
                                    @php
                                        echo 'Tổng giảm: ' . number_format($coupon_number, 0, ',', '.') . 'đ' . '</br>';
                                        $total_coupon = $total + $details->product_feeship - $coupon_number;
                                        
                                    @endphp
                                @endif                            
                            </td>

                    <td>
                        Phí ship: 

                        @if ( $total > 500000 || $shipping->shipping_method_receive == '0')
                        0đ
                        @php                          
                            $fee = 0;                                                   
                        @endphp
                    @else
                        20.000 VNĐ
                        @php
                            $fee = 20000;                     
                        @endphp
                    @endif



                    </td>

                    <td>                        
                        Tổng thanh toán:                   
                        {{ number_format($total_coupon + $fee, 0, ',', '.') . ' ' . '₫' }} 
                    </td>
                </tr>
                </tbody>
            </table>

            <span>
                
            </span>
{{-- 
            @foreach ($order as $detail)  
                <form role="form" action="{{URL::to('/update-order/'.$detail->order_code)}}" method="POST" >
                    {{ csrf_field() }}
                    <div class="form-group">

                        <label for="exampleInputPassword1">Tình trạng đơn hàng</label>
                    
                            @if ($detail->order_status ==1)
                                <select name="order_status" class="form-control m-bot15">
                                    <option  value="1" selected disabled>Chưa xử lý</option>
                                    <option  value="0" >Đã xử lý</option>
                                    <option  value="2" >Khách đã hủy đơn</option>
                                </select>
                                @elseif($detail->order_status ==0)
                                <select name="order_status" class="form-control m-bot15">
                                    <option  value="1" disabled>Chưa xử lý</option>
                                    <option  value="0" selected disabled>Đã xử lý</option>
                                    <option  value="2">Khách đã hủy đơn</option>
                                </select>
                                @else
                                <span name="order_status" class="form-control m-bot15">

                                    Khách đã hủy đơn
                                </span>
                        
                            @endif
                        </select>
                        
                    </div>
                    @if ($detail->order_status !=2)
                        <div class="form-group">
                        <button type="submit" name="edit" class="btn btn-info">Hủy đơn</button>
                    @endif
                        </div>

                </form>            
                @endforeach --}}

        </div>
    </div>
</div>





@endsection