@extends('welcome')
@section('content')
@section('footer')
	@include("pages.include.footer");
@endsection()

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Home</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
        </div>

        
 @endsection