<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XÁC NHẬN ĐƠN ĐẶT HÀNG</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="background: #222;border-radius: 12px;padding:15px">
        <div class="col-md-12">

            <p style="text-align: center;color: #FFF">Đây là email tự động, Quý khách vui lòng không trả lời email này</p>
            <div class="row" style="background: #33CC33;padding: 15px"> 

                <div class="col-md-6" style="text-align: center; color: #FFF;font-weight: bold;font-size: 30px;">
                    <h4 style="margin:0"> HOÀI AN STORE </h4> 
                    <h6 style="margin:0"> PHỤ KIỆN CÁP, SẠC CHÍNH HÃNG - UY TÍN - CHẤT LƯỢNG - GIÁ THÀNH TỐT NHẤT</h6>
                </div>

                <div class="col-md-6 logo" style="color: #FFF">
                    <p>Chào bạn, <strong style="color: #FFF;text-decoration: underline">{{ $shipping_array['customer_name'] }}</strong></p>Chúng tôi đã xác nhận đơn đặt hàng và tiến hành đóng gói sản phẩm để giao đến bạn trong thời gian sớm nhất.
                </div>

                <div class="col-md-12">
                    <h3 style="color: #000;text-transform: uppercase">THÔNG TIN ĐƠN HÀNG: <strong style="color: #FFF;text-decoration: text-transform: uppercase;">{{ $code['order_code'] }}</strong></h3>               
                    <h4>THÔNG TIN NGƯỜI NHẬN</h4>
                    <p>
                        Email:
                            @if ($shipping_array['shipping_email'] == '')
                                không có
                            @else
                                <span style="color: #FFF">{{ $shipping_array['shipping_email'] }}</span>
                            @endif
                    </p>
                    <p>
                        Tên người nhận:
                            @if ($shipping_array['shipping_name'] == '')
                                không có
                            @else
                                <span style="color: #FFF">{{ $shipping_array['shipping_name'] }}</span>
                            @endif
                    </p>
                    <p>
                        Địa chỉ nhận hàng:
                            @if($shipping_array['shipping_address']=='')
                                Không có
                            @else
                                <span style="color: #FFF">{{ $shipping_array['shipping_address'] }} </span>
                            @endif
                    </p>
                    <p>
                        Số điện thoại:
                            @if($shipping_array['shipping_phone']=='')
                                Không có
                            @else
                                <span style="color: #FFF">{{ $shipping_array['shipping_phone'] }} </span>
                            @endif
                    </p>
                    <p>
                        Ghi chú:
                            @if($shipping_array['shipping_note']=='')
                                
                            @else
                                <span style="color: #FFF">{{ $shipping_array['shipping_note'] }} </span>
                            @endif
                    </p>
                    <p>
                        Hình thức thanh toán:  <strong style="color: #FFF;text-decoration: text-transform: uppercase;">
                            @if($shipping_array['shipping_method_pay']=='1')
                                Chuyển khoản / Thanh toán online
                            @else

                            <strong style="color: #FFF;text-decoration: text-transform: uppercase;">
                                Tiền mặt
                            @endif
                        </strong>
                    </p>

                    {{-- // --}}
                    <p>
                        Hình thức nhận hàng:  <strong style="color: #FFF;text-decoration: text-transform: uppercase;">
                            @if($shipping_array['shipping_method_receive']=='0')
                               Nhận trực tiếp tại cửa hàng
                            @else

                            <strong style="color: #FFF;text-decoration: text-transform: uppercase;">
                                Giao hàng tận nơi
                            @endif
                        </strong>
                    </p>
                    {{-- // --}}

                    <p style="color: #FFF">Nếu cần thay đổi thông tin nhận hàng, Quý khách vui lòng liên hệ với Hoài An Store để được đội ngũ nhân viên hỗ trợ tư vấn</p>
                    <h3 style="color: #000; text-transform: uppercase">CHI TIẾT ĐƠN HÀNG</h3>
                    <table class="table table-striped" style="border:1px">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá tiền</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                            $sub_total =0;
                            $total = 0;
                            $total_after_coupon = 0;
                            @endphp
                                @foreach ($cart_array as $cart)
                                    @php
                                        $sub_total = $cart['product_qty']*$cart['product_price_sale'];
                                        $total+=$sub_total;

                                    @endphp
                                    <tr>
                                        <td>{{ $cart['product_name'] }}</td>
                                        <td>{{ number_format($cart['product_price_sale'],0,',','.') }} VNĐ</td>
                                        <td>{{ $cart['product_qty'] }}</td>
                                        <td>{{ number_format($sub_total,0,',','.') }} VNĐ</td>
                                    </tr>
                                @endforeach
                            

                        </tbody>
                    </table>

                    <div>

                        <p>Mã khuyến mãi: <strong style="color: #FFF;text-decoration: text-transform: uppercase;">{{ $code['coupon_code'] }}</strong>
                        </p>
                        
                        <p>
                            @if (Session::get('coupon') != 'no')
                            @if ($code['coupon_condition'] == 1)
                                @php
                                    $total_after_coupon = ($total * $code['coupon_number']) / 100;
                                    echo '<p style="color:#fff">Tiết kiệm được: ' . number_format($total_after_coupon, 0, ',', '.') . 'đ' . '</br>';
                                    // $total_coupon = $total + $details->product_feeship - $total_after_coupon;
                                @endphp
                            @else
                                @php
                                    $total_after_coupon = $code['coupon_number'];
                                    echo '<p style="color:#fff">Tiết kiệm được: ' . number_format($total_after_coupon, 0, ',', '.') . 'đ' . '</>';
                                    // $total_coupon = $total + $details->product_feeship - $coupon_number;
                                @endphp
                            @endif
                        @endif
                        </p>
                        
                        
                        <p>Phí vận chuyển:  
                            @if ( $total > 500000 || $shipping_array['shipping_method_receive']=='0')
                            0 VNĐ
                            @php                          
                                $fee = 0;                                                   
                            @endphp
                        @else
                            20.000 VNĐ
                            @php
                                $fee = 20000;                     
                            @endphp
                        @endif
                        </p>
                        <p style="color: #FFF">
                            
                            
                            Tổng thanh toán:
                            {{ number_format($total + $fee - $total_after_coupon, 0, ',', '.') }}đ</td>
                        </p>
                       
                    </div>

                </div>
                {{-- <p>Lịch sử đơn hàng: </p> --}}
                <p style="color: #000"----->Mọi chi tiết, khiếu nại về sản phẩm xin vui lòng gửi phản hồi đến Hoài An Store thông qua:
                    <br> Hotline: 099 9999 999
                    <br> Fanpage: <a href="https://www.facebook.com/hoaianstorevn"> Hoài An Store</a>
                    <br> Email: hoaianstore.vn@gmail.com
            </div>
        </div>

    </div>
</body>
</html>