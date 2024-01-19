@extends('welcome')

@section('slider')
	@include("pages.include.slider")
@endsection()

{{-- @section('footer')
	@include("pages.include.footer")
@endsection() --}}

@section('content')

 					<div style="margin-top: 30px"> 
                        <!--       features_items            -->

						<h2 class="title text-center">Sản phẩm mới</h2>
						@foreach ($all_product as $key => $product)		
							<div class="col-sm-2" style="padding-right: 0px;width:20%">
								<div class="product-image-wrapper" style="height: 390px;min-height: 390px;max-height: 390px;">
									<div class="single-products">
											<div class="productinfo text-center">
												<form style="height: 386px;">
													@csrf
													<input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
													<input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
													<input type="hidden" value="{{$product->product_quantity }}"class="cart_product_quantity_{{$product->product_id }}">
													<input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
													<input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
													<input type="hidden" value="{{$product->product_price_sale}}" class="cart_product_price_sale_{{$product->product_id}}">
												
													<input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
													<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
														@if ($product->product_price_sale != '0')
                                        <p class="giamgia" style="font-size: 15px">
                                            Giảm&nbsp;
                                            {{ number_format(100 - ($product->product_price_sale * 100) / $product->product_price, 0, ',', '.') . ' ' . '%' }}
                                        </p>
                                    @else
										<p class="khonggiamgia" ></p>
                                    @endif
													<img src="{{URL::to('/public/upload/product/'.$product->product_image)}}" alt="" />
													{{-- <h2>{{ number_format($product->product_price).' '.'VNĐ'}}</h2> --}}
													<h2>{{ $product->product_name }}</h2>


													<div class="price_sale" style=" align-items: flex-end;color: #444;font-family: sans-serif;font-weight: 700;line-height: 1.4;display: flex;">												
														@if ($product->product_price_sale != 0)
														<p style="color: #d70018;display: inline-block;font-size: 18px;font-weight: 700;line-height: 1.1;" >
															{{ number_format($product->product_price_sale, 0, ',', '.') . ' ' . '₫' }}
														</p>
														<p style="color: #707070;display: inline-block;font-size: 14px;font-weight: 600;position: relative;-webkit-text-decoration: line-through;text-decoration: line-through;top: 2px;">
															{{ number_format($product->product_price, 0, ',', '.') . ' ' . '₫' }}
														</p>
											   
										</p>
											
										@elseif ($product->product_price_sale == 0)
										<p style="color: #d70018;display: inline-block;font-size: 18px;font-weight: 700;text-align: center;line-height: 1.1;" >
											{{ number_format($product->product_price, 0, ',', '.') . ' ' . '₫' }}</p>
										@endif</div>
													
													</a>
													
													@if ($product->product_quantity >= 1)
													<button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart" >
														Thêm vào giỏ hàng</button>
												@else
													<span style="color: #d70018;font-weight: 700;">TẠM HẾT HÀNG</span>
												@endif
											
												</form>
											</div>
									</div>

									<div class="choose">
										<ul class="nav nav-pills nav-justified">
											<li><a href="#"><i class=""></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
					

																	<!----- End Sản phẩm mới ----->
<div>
					<h2 class="title text-center">Sản phẩm được xem nhiều</h2>
						@foreach ($product_xem as $key => $product_x)		
							<div class="col-sm-2" style="padding-right: 0px;width:20%">
								<div class="product-image-wrapper" style="height: 390px;min-height: 390px;max-height: 390px;">
									<div class="single-products">
											<div class="productinfo text-center">
												<form style="height: 390px;">
													@csrf
													<input type="hidden" value="{{$product_x->product_id}}" class="cart_product_id_{{$product_x->product_id}}">
													<input type="hidden" value="{{$product_x->product_name}}" class="cart_product_name_{{$product_x->product_id}}">
													<input type="hidden" value="{{$product_x->product_quantity }}"class="cart_product_quantity_{{$product_x->product_id }}">
													<input type="hidden" value="{{$product_x->product_image}}" class="cart_product_image_{{$product_x->product_id}}">
													<input type="hidden" value="{{$product_x->product_price}}" class="cart_product_price_{{$product_x->product_id}}">
													<input type="hidden" value="{{$product_x->product_price_sale}}" class="cart_product_price_sale_{{$product_x->product_id}}">
												
													<input type="hidden" value="1" class="cart_product_qty_{{$product_x->product_id}}">
													<a href="{{URL::to('/chi-tiet-san-pham/'.$product_x->product_id)}}">
														@if ($product_x->product_price_sale != '0')
                                        <p class="giamgia" style="font-size: 15px">
                                            Giảm&nbsp;
                                            {{ number_format(100 - ($product_x->product_price_sale * 100) / $product_x->product_price, 0, ',', '.') . ' ' . '%' }}
                                        </p>
                                    @else
										<p class="khonggiamgia" ></p>
                                    @endif
													<img src="{{URL::to('/public/upload/product/'.$product_x->product_image)}}" alt="" />
													{{-- <h2>{{ number_format($product->product_price).' '.'VNĐ'}}</h2> --}}
													<h2>{{ $product_x->product_name }}</h2>


													<div class="price_sale" style=" align-items: flex-end;color: #444;font-family: sans-serif;font-weight: 700;line-height: 1.4;display: flex;">												
														@if ($product_x->product_price_sale != 0)
														<p style="color: #d70018;display: inline-block;font-size: 18px;font-weight: 700;line-height: 1.1;" >
															{{ number_format($product_x->product_price_sale, 0, ',', '.') . ' ' . '₫' }}
														</p>
														<p style="color: #707070;display: inline-block;font-size: 14px;font-weight: 600;position: relative;-webkit-text-decoration: line-through;text-decoration: line-through;top: 2px;">
															{{ number_format($product_x->product_price, 0, ',', '.') . ' ' . '₫' }}
														</p>
											   
										</p>
											
										@elseif ($product_x->product_price_sale == 0)
										<p style="color: #d70018;display: inline-block;font-size: 18px;font-weight: 700;text-align: center;line-height: 1.1;" >
											{{ number_format($product_x->product_price, 0, ',', '.') . ' ' . '₫' }}</p>
										@endif</div>
													
													</a>
													
													@if ($product_x->product_quantity >= 1)
													<button type="button" class="btn btn-default add-to-cartt" data-id_product="{{$product_x->product_id}}" name="add-to-cartă" >
														Thêm vào giỏ hàng</button>
												@else
													<span style="color: #d70018;font-weight: 700;">TẠM HẾT HÀNG</span>
												@endif
											
												</form>
											</div>
									</div>

									{{-- <div class="choose">
										<ul class="nav nav-pills nav-justified">
											<li><a href="#"><i class=""></i></a></li>
										</ul>
									</div> --}}
								</div>
							</div>
						@endforeach
					</div>
				
																			<!----- End Sản phẩm xem nhiều ----->
					
																			

					
					

@endsection