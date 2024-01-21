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

    
    <div style="margin-top: 30px">
        <img src="{{asset('public/frontend/images/momo.png')}}" style="width: 150px; height: 150px; margin-right: 50px;margin-left: 380px">
        <img src="{{asset('public/frontend/images/vnpay.png')}}" style="width: 150px; height: 150px;">
    </div>
</div>


    <form method="POST" action="{{URL::to('/vnpay-payment')}}" method="POST">
        @csrf
        {{-- <a href="{{URL::to('trang-chu')}}"><img src="{{asset('public/frontend/images/logo-no-background.png')}}" alt="" 
            style="margin-top: 0px;
            margin-left: -60px;
            width: 70%;
            height: 85%;"/></a> --}}
        
        <input type="hidden" name="total-vnpay"  value={{ $total_after }}>
        <button type="submit" class="btn btn-default check_out" name="redirect" style="margin-right:425px;border-radius: 10px">
        Thanh toán VNPAY
    </button>
    </form>

    <form method="POST" action="{{URL::to('/momo-payment')}}" method="POST">
        @csrf
        <input type="hidden" name="total-momo" value={{ $total_after }}>
        <button type="submit" class="btn btn-default check_out" name="payUrl" style="margin-right:35px;border-radius: 10px">
        Thanh toán MOMO
    </button>
    </form>

    </div>
@endsection