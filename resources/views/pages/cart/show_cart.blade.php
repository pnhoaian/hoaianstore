@extends('welcome')
@section('content')

{{-- @section('footer')
	@include("pages.include.footer")
@endsection() --}}

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Home</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
        </div>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif
        <div class="table-responsive cart_info">
            <form action="{{URL::to('/update-cart')}}" method="POST">
                @csrf
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh sản phẩm</td>
                        <td class="description" style="padding-left: 100px;width:750px">Tên Sản phẩm</td>
                        <td class="price" style="width:250px; padding-left: 30px">Giá tiền</td>
                        <td class="quantity" style="width:80px;padding-left: 35px">Số lượng</td>
                        <td class="total" style="width:200px;padding-left: 30px">Thành tiền</td>
                        <td class="tools" style="width:100px;padding-right: 10px">Tác vụ</td>
                    </tr>
                </thead>
                <tbody>
                    @if(Session::get('cart'))
                        @php
                            $total = 0;
                        @endphp
                    @foreach (Session::get('cart') as $key => $cart)
                        @php
 
                            $subtotal = $cart['product_price_sale']*$cart['product_qty'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td class="cart_product" style="width:250px;padding-left:15px">
                                <img src="{{asset('public/upload/product/'.$cart['product_image'])}}" width="150px" height="110px" alt="{{$cart['product_image']}}">

                            </td>
                            <td class="cart_description">
                                <h4 style=" text-align:center"><a href="{{URL::to('/chi-tiet-san-pham/'.$cart['product_id'])}}">{{ $cart['product_name']}}</a></h4>
                            </td>
                            <td class="cart_price">
                                <p>{{ number_format($cart['product_price_sale'],0,',','.' )}} VNĐ</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                        <input style="margin-bottom: 12px; width:60px;margin-left: 35px" class="cart_quantity" type="number" name="cart_qty[{{ $cart['session_id'] }}]" min="1" value="{{ $cart['product_qty'] }}">
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price" style="width:160px">{{ number_format($subtotal,0,',','.' )}} VNĐ</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{URL::to('/del-product/'.$cart['session_id'])}}" style="background: #0213B0;">
                                    Xóa</a>
                            </td>
                        </tr>        

                    @endforeach
                    <tr>

                        <td><input type="submit" value="Cập Nhật giỏ hàng" name="update-qty" class="check_out btn btn-default btn-sm"></td>
                        <td>
                            <a class="btn btn-default check_out" href="{{URL::to('/del-all-product')}}">Xóa tất cả</a>
                        </td>

                        <td>
                            @if (Session::get('coupon'))
                            <a class="btn btn-default check_out" href="{{URL::to('/unset-coupon')}}">Xóa mã Coupon</a>
                            @endif
                        </td>

                        <td class="bill" style="width:350px;padding-left:60px">
                            <li>Tổng thành tiền: <span>{{ number_format($total ,0,',','.' )}} VNĐ</span></li>
                            {{-- <li>Thuế: <span></span></li> --}}
                            

                            
                                @if (Session::get('coupon'))
                                @foreach (Session::get('coupon') as $key => $cou)
                                            @if ($cou['coupon_condition'] == 1)
                                            <li>Mã giảm giá : - {{ $cou['coupon_number'] }}%
                                                @php
                                                    $total_coupon = ($total * $cou['coupon_number']) / 100;
                                                @endphp
                                            </li>
                                            <li>
                                                @php
                                                    $total_after_coupon = $total - $total_coupon; 
                                                @endphp
                                                Tổng giảm: -{{ number_format($total_coupon, 0, ',', '.') }} VNĐ
                                            </li>
                                                
                                            
                                            @elseif($cou['coupon_condition'] == 2)
                                            <li>Mã giảm giá:
                                                {{ number_format($cou['coupon_number'], 0, ',', '.') }} VNĐ
                                                @php
                                                    $total_coupon = $total - $cou['coupon_number'];
                                                    
                                                @endphp
                                            </li>
                                            <li>
                                                @php
                                                    $total_after_coupon = $total_coupon;
                                                @endphp
                                                Tiết kiệm được:
                                                {{ number_format($cou['coupon_number'], 0, ',', '.') }} VNĐ
                                            </li>
                                        @endif
                                        @endforeach

                                </li>
                        
                        @endif

                        @php
                        if ( Session::get('coupon')) {

                            $total_after = $total_after_coupon;
                           
                        } elseif ( !Session::get('coupon')) {
                            $total_after = $total;
                        }
                    @endphp
{{-- || $data['shipping_method_receive'] =='0' --}}

                    {{-- <li>Phí vận chuyển: 
                        @if ( $total_after > 500000 )
                            0đ
                            @php                          
                                 $fee = 0;                                                   
                             @endphp
                        @else
                             20.000 VNĐ 
                             <p style="color: #0213B0; font-style: italic">* 0đ nếu nhận trực tiếp tại cửa hàng</p>
                             @php
                                $fee = 20000;                     
                              @endphp
                        @endif
                    </li> --}}

                        <li style="color: #D0021B;">Tổng thanh toán:
                            @php
                                if ( Session::get('coupon')) {
                                    $total_after = $total_after_coupon;
                                    // $total_after = $total_after + $fee;
                                    $total_after = $total_after;
                                    if($total_after < 0){
                                        $total_after = 0;
                                    }
                                    echo number_format($total_after, 0, ',', '.') . ' VNĐ';
                                } elseif ( !Session::get('coupon')) {
                                    $total_after = $total;
                                    echo number_format($total_after, 0, ',', '.') . ' VNĐ';
                                    // echo number_format($total_after + $fee, 0, ',', '.') . ' VNĐ';
                                }

                            @endphp
                        </li>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="5" style="text-align: right">
                            @if (Session::get('customer_id'))
                            <a class="btn btn-default check_out " href="{{ url('/checkout') }}">Kiểm tra thông tin nhận hàng</a>
                            @else
                            <a class="btn btn-default check_out " href="{{ url('/login') }}">Thanh Toán</a>
                            @endif
                        </td>
                    </tr>
                    @else
                        <tr>
                            <td colspan="5" style="text-align: center">
                                @php
                                    echo'Không có sản phẩm trong giỏ hàng';
                                @endphp
                            </td>
                        </tr>
                    @endif
                </tbody>
            </form>
                {{-- Kiểm tra tồn tại sản phẩm trong giỏ hàng mới xuất hiện khung giảm giá --}}
                @if (Session::get('cart') && Session::get('coupon'))
                @elseif(Session::get('cart'))
                <tr>
                    <td>
                        <form method="POST" action="{{URL::to('/check-coupon')}}">
                            @csrf
                            <input type="text" class="form-control" name="coupon" placeholder="Nhập mã khuyến mãi">
                            <br>
                            <input type="submit" class="btn btn-default check_coupon" value="Áp dụng Coupon" name="check_coupon">
                        </form>
                    </td>
                </tr>
            @endif
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

@endsection