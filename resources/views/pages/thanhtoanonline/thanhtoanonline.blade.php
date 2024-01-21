@extends('welcome')
@section('content')

<div class="features_items">

   
   @if(Session::get('cart'))
   @php
       $total = 0;
   @endphp
   @foreach (Session::get('cart') as $key => $cart)
   @php

       $subtotal = $cart['product_price_sale']*$cart['product_qty'];
       $total += $subtotal;
   @endphp
            

@endforeach
   <tr>
               @if (Session::get('coupon'))
               @foreach (Session::get('coupon') as $key => $cou)
                           @if ($cou['coupon_condition'] == 1)
                               @php
                                   $total_coupon = ($total * $cou['coupon_number']) / 100;
                               @endphp
                               @php
                                   $total_after_coupon = $total - $total_coupon;
                               @endphp
                               
                           
                           @elseif($cou['coupon_condition'] == 2)
                               @php
                                   $total_coupon = $total - $cou['coupon_number'];
                                   
                               @endphp
                               @php
                                   $total_after_coupon = $total_coupon;
                               @endphp
                       @endif
                       @endforeach
       
       @endif

       @php
       if ( Session::get('coupon')) {
           $total_after = $total_after_coupon;
           $total_after = $total_after + Session::get('fee');
       } elseif ( !Session::get('coupon')) {
           $total_after = $total;
       }
       
   @endphp

       
           <p></p>
           @php
               if ( Session::get('coupon')) {
                   $total_after = $total_after_coupon;
                   // $total_after = $total_after + $fee;
                   $total_after = $total_after ;
                   if($total_after < 0){
                       $total_after = 0;
                   }
                  
               } elseif ( !Session::get('coupon')) {
                   $total_after = $total;
                   
                   
                   // echo number_format($total_after + $fee, 0, ',', '.') . ' VNĐ';
               }

           @endphp

   </tr>
  
</tbody>
</form>
@else

@endif


<div class="coupon">

    <div class="container">
        <h3 style="text-align: center">Lựa chọn phương thức thanh toán</a></h3>
    </div>

    <div class="container" style="background-color: white;padding: 2px 16px;background-color: #f1f1f1;">
        {{-- <h2 style="text-align: center;font-size: large;text-decoration: underline;"><b><i>Giảm 10% cho hóa đơn mua hàng trên 2 triệu</i></b></h2> --}}
        <p>Khách hàng có thể lựa chọn 2 phương thức mà Hoài An Store hỗ trợ thanh toán </p>
    </div>
    {{-- <div class="container">
        <p style="text-align: center;font-size: 20px;">MÃ KHUYẾN MÃI: <span style="background: #ccc;padding: 3px;">KHTH10</span></p>
        <p style="text-align: center;color: red;">Ngày hết hạn: 31/01/2024</span></p>
    </div> --}}
    <img src="{{asset('public/frontend/images/momo.png')}}" style="width: 150px; height: 150px; margin-right: 50px;margin-left: 380px">
    <img src="{{asset('public/frontend/images/vnpay.png')}}" style="width: 150px; height: 150px;">
</div>


    <form method="POST" action="{{URL::to('/vnpay-payment')}}" method="POST">
        @csrf
        {{-- <a href="{{URL::to('trang-chu')}}"><img src="{{asset('public/frontend/images/logo-no-background.png')}}" alt="" 
            style="margin-top: 0px;
            margin-left: -60px;
            width: 70%;
            height: 85%;"/></a> --}}
        
        <input type="hidden" name="total-vnpay"  value={{ $total_after }}>
        <button type="submit" class="btn btn-default check_out" name="redirect" style="margin-right:425px">
        Thanh toán VNPAY
    </button>
    </form>

    <form method="POST" action="{{URL::to('/momo-payment')}}" method="POST">
        @csrf
        <input type="hidden" name="total-momo" value={{ $total_after }}>
        <button type="submit" class="btn btn-default check_out" name="payUrl" style="margin-right:35px">
        Thanh toán MOMO
    </button>
    </form>

    </div>
@endsection