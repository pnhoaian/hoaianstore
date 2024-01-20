@extends('welcome')
@section('content')

@section('footer')
	@include("pages.include.footer");
@endsection()

<section id="cart_items">
    <div class="container">
        {{-- <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Home</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
        </div> --}}

        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif
        <h2 style="color: green"> Thanh toán thành công </h2>
        <div>
          <h2>Lựa chọn phương thức thanh toán</h2>
          <form method="POST" action="{{URL::to('/vnpay-payment')}}" method="POST">
            @csrf
            <input type="hidden" name="total-vnpay" value={{ $total_after }}>
            <button type="submit" class="btn btn-default check_out" name="redirect" style="margin-left:30px">
            Thanh toán VNPAY
        </button>
        </form>

        <form method="POST" action="{{URL::to('/momo-payment')}}" method="POST">
            @csrf
            <input type="hidden" name="total-momo" value={{ $total_after }}>
            <button type="submit" class="btn btn-default check_out" name="payUrl" style="margin-left:30px">
            Thanh toán MOMO
        </button>
        </form>
        </div>

        
 @endsection