@extends('welcome')
@section('content')
@foreach ($product_detail as $key =>$value)
    
<div class="product-details"><!--product-details-->
    <div class="col-sm-4">
        <div class="view-product">
            <ul id="imageGallery">
                @foreach ($gallery as $key => $gal )
                    
                    <li data-thumb="{{URL::to('/public/upload/gallery/'.$gal->gallery_image)}}" data-src="{{URL::to('/public/upload/product/'.$value->product_image)}}">
                        <img src="{{URL::to('/public/upload/gallery/'.$gal->gallery_image)}}" />
                    </li>

                @endforeach
            </ul>
            {{-- <img src="{{URL::to('/public/upload/product/'.$value->product_image)}}" alt="" /> --}}
        </div>
        {{-- <div id="similar-product" class="carousel slide" data-ride="carousel">
            
              <!-- Wrapper for slides -->
                <div class="carousel-inner1">
                    <div class="item active">
                      <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                    </div>
                    <div class="item">
                      <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                    </div>
                    <div class="item">
                      <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                    </div>
                    
                </div>

              <!-- Hình ảnh chi tiết -->

              {{-- <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a> --}}
        {{-- </div> --}} 

    </div>

    <div class="col-sm-5">
        <div class="product-information" style="
        border: 1px solid #ccc;"><!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{ $value->product_name }}</h2>
            {{-- <p>ID Sản Phẩm: {{ $value->product_id }}</p> --}}
            <img src="images/product-details/rating.png" alt="" />
            <form action="{{URL::to('/save-cart')}}" method="POST">
                {{ csrf_field()}}
                <input type="hidden" value="{{ $value->product_id }}"
                            class="cart_product_id_{{ $value->product_id }}">

                        <input type="hidden" value="{{ $value->product_name }}"
                            class="cart_product_name_{{ $value->product_id }}">

                        <input type="hidden" value="{{ $value->product_image }}"
                            class="cart_product_image_{{ $value->product_id }}">

                        <input type="hidden" value="{{ $value->product_quantity }}"
                            class="cart_product_quantity_{{ $value->product_id }}">

                        <input type="hidden" value="{{ $value->product_price }}"
                            class="cart_product_price_{{ $value->product_id }}">

                         <input type="hidden" value="{{ $value->product_price }}"
                            class="cart_product_price_sale_{{ $value->product_id }}">




            </form>
            <p><b>Mã sản phẩm:</b> {{ $value->product_id }}</p>
            <p><b>Thương Hiệu - Hãng:</b> {{ $value->brand_name }}</p>
            <p><b>Danh Mục:</b> {{ $value->category_name }}</p>
            {{-- //TK --}}
            <p><b>Tồn kho: {{ $value->product_quantity }}</b></p>
            <p><b>Đánh giá:</b>
                
                <ul class="list-inline rating" title="Average Rating">
                    @for ($count = 1; $count <= 5; $count++)
                        @php
                            if ($count <= $rating) {
                                $color = 'color:#ffcc00;';
                            } else {
                                $color = 'color:#ccc;';
                            }
                        @endphp
                        <li title="star_rating" style="cursor: default; {{ $color }} font-size:22px;">
                            &#9733;
                        </li>
                    @endfor </p></ul>

            {{-- //LX --}}

            <div>
                <p style="margin-top: -20px;"><b>Giá bán:</b><span style="    font-family: Tahoma, Geneva, sans-serif;
                font-size: 20px;
                font-weight: bold;
                font-style: normal;
                text-decoration: none;
                color: #f00;" class="cart_product_price_sale_">
                {{number_format( $value->product_price_sale, 0, ',', '.') . ' ' . 'đ̲' }}</span>
                

            <!--price_update_43154--></p>

            </div>

            <span style="margin-top: -10px;">
                {{-- <button type="submit" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart" name="add-to-cart"></i>
                    Thêm vào giỏ hàng
                </button> --}}
                @if ($value->product_quantity >= 1)
                    <label>Số Lượng:</label>
                    <input name="product_qty" type="number" min="1"
                                class="cart_product_qty_{{ $value->product_id }}" value="1" />
                                
                    <input name="productid_hidden" type="hidden" value="{{ $value->product_id }}" />

                    <button type="button" class="btn btn-fefault add-to-cart" data-id_product="{{ $value->product_id }}" name="add-to-cart" 
                        style="margin-bottom: 8px;margin-left: 10px;"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                    </button>
                @else
                    <span>TẠM HẾT HÀNG</span>
                @endif

            </span>
           
        </div><!--/product-information-->
    </div>

    <div class="col-sm-3">
        <div class="block" style="margin-bottom: 10px;
        border: 1px solid #ccc;
        padding: 10px;
        clear: both;">
            <div class="phone" style="margin-bottom: 15px;">
                <strong>
                    <span  style="color: rgb(0, 0, 0);">Hồ Chí Minh</span> : 0999 1919 191</strong><br>
            </div>

            <div class="GiaoHang">
                <i class="fa fa-check" aria-hidden="true" style="margin-bottom: 10px; font-size: 15px;"> Thanh toán thẻ ATM miễn phí tại cửa hàng<span style="color: rgb(238, 236, 225);"></span></i>
                <i class="fa fa-check" aria-hidden="true" style="margin-bottom: 10px; font-size: 15px;"> Giao hàng nhanh chóng tiện lợi</span></i> 
            </div>
        </div>

        <div class="block" style="margin-bottom: 10px;
        border: 1px solid #ccc;
        padding: 10px;
        clear: both;">
            <div class="pr-top" style="    border: 1px solid #e0e0e0;
            border-radius: 4px;
            margin-bottom: 10px;
            background-color: #f6f6f6;">
                {{-- <h4 class="pr-txtb" style="margin-left: 5px; text-align: center"> Khuyến Mãi</h4> --}}
                <i class="pr-txt" style="margin-left: 5px;font-style: normal; font-style: italic"> Đặt hàng ngay và áp dụng khuyến mãi để được hưởng nhiều ưu đãi hấp dẫn.</i>
            </div>
            <div class="pr-content">
                <div class="pr-item">
                    <div class="divb t5" data-promotion="2039089" data-group="WebNote" data-discount="0" data-productcode="" data-tovalue="20">
                        <div class="divb-right">
                            {{-- <p>Nhập mã UUDAI20K giảm ngay 20K cho đơn hàng khi mua sắm tại HAS </a></p> --}}
                            <p style="text-align: center"><span class="note"></span> Mã khuyến mãi có thể sử dụng </p>

                            {{-- <ul>
                                
                                    <li>{{ $couponKM->coupon_name }} | {{ $couponKM->coupon_code }} | {{ $couponKM->coupon_times }}  </li>                             
                                
                            </ul> --}}
                            <table>
                                <tr>
                                  <th width="100px">Tên CTKM</th>
                                  <th>Code</th>
                                  <th >Số lượng</th>
                                </tr>
                                @foreach ( $show_coupon as $key => $couponKM)
                                    <tr>
                                    <td>{{ $couponKM->coupon_name }}</td>
                                    <td >{{ $couponKM->coupon_code }}</td>
                                    <td style="text-align: center">{{ $couponKM->coupon_times }}</td>
                                    </tr>
                                @endforeach
                              </table>               
                        </div>
                    </div>
                </div>
                
                <div class="pr-item text" style="margin-top: 10px">
                    <p><span class="note">(*)</span> Lưu ý: </p>
                    <ul style="padding-left: 0px;">
                        <li>- Mỗi coupon chỉ áp dụng một lần cho một khách hàng</li>
                        <li>- Số lượng coupon có hạn, nhanh tay đặt hàng ngay</li>
                    </ul>
                    {{-- <p><span class="note">(*)</span>Lưu ý: </p>
                    <p><span class="note">(*)</span>Lưu ý: </p> --}}
                </div>
 
            </div>
        </div>
    </div>

</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>

            <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details" >
            <p>{!!$value->product_desc!!}</p>
        </div>
        
        <div class="tab-pane fade" id="companyprofile" >
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery1.jpg" alt="" />
                            <h2>{{number_format( $value->product_price_sale, 0, ',', '.') . ' ' . 'đ̲' }}</h2>
                            <p>{{ $value->product_name }}</p>
                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tab-pane fade" id="reviews">
            {{-- Bình luận sản phẩm --}}
            <div class="col-sm-12">
                <style type="text/css">
                    .style_comment{
                        border: 1px solid #ddd;
                         border-radius: 10px;
                         background: #707070"
                    }
                </style>
                    <form>
                    @csrf
                    <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{ $value->product_id }}">
                    <div id="comment_show"></div>
                    

                        
                    </form>

                {{-- Rating 5 Sao --}}
                <form>
                    @csrf
                    <input type="hidden" name="comment_product_id" class="comment_product_id"
                        value="{{ $value->product_id }}">
                    <div id="comment_show">
                    </div>
                </form>

                    <?php 
                        $customer_id = Session::get('customer_id');
                        if($customer_id!=NULL){
                    ?>
                <p style="margin-top: 20px;margin-left:24px"><b>Viết đánh giá:</b></p>
                <ul style="margin-left:24px" class="list-inline rating" title="Average Rating">
                    @for ($count = 1; $count <= 5; $count++)
                        @php
                            if ($count <= $rating) {
                                $color = 'color:#ffcc00;';
                            } else {
                                $color = 'color:#ccc;';
                            }
                        @endphp

                        <li title="star_rating" id="{{ $value->product_id }}-{{ $count }}"
                            data-index="{{ $count }}" data-product_id="{{ $value->product_id }}"
                            data-rating="{{ $rating }}" class="rating"
                            style="cursor: pointer; {{ $color }} font-size:30px;">&#9733;
                        </li>
                    @endfor
                </ul>
                <form action="#">
                    <span>
                        <input
                            style="background: #a2c5de;width: 21%;margin-left: 24px;color: #000;"
                            type="text" class="comment_name" placeholder="Tên khách hàng"  value="{{ $customer1->customer_name }}" disabled/>
                    </span>
                    <textarea name="comment" style="width: 93%;background: #a2c5de;margin-left: 24px;color: #000; font-size: 20px"
                        class="comment_content" placeholder="Nội dung"></textarea>
                    <div id="notify_comment" style="color: #f00"></div>

                    <button type="button" class="button-them pull-right send-comment">
                        Gửi
                    </button>

                </form>
                <?php 
                            } else{
                        ?>
                        <p>Vui lòng đăng nhập để đánh giá sản phẩm</p>
                <a class="btn btn-primary check_out"style="color: #fff;margin-left: 26px;height: 34px;}"
                    href="{{ URL::to('/login') }}">Đăng nhập ngay</a>
                <?php
                            }
                ?>

            </div>
        </div>

    </div>
</div>
<!--/category-tab-->
@endforeach
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach ( $related_pro as $key => $SPLQ)
                    
                <div class="col-sm-2" style="width: 20%;padding-right: 0">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                                <div class="productinfo text-center">
                                    <form style="height: 370px;">
                                        @csrf
                                        <input type="hidden" value="{{$SPLQ->product_id}}" class="cart_product_id_{{$SPLQ->product_id}}">
                                        <input type="hidden" value="{{$SPLQ->product_name}}" class="cart_product_name_{{$SPLQ->product_id}}">
                                        <input type="hidden" value="{{$SPLQ->product_image}}" class="cart_product_image_{{$SPLQ->product_id}}">
                                        <input type="hidden" value="{{$SPLQ->product_price}}" class="cart_product_price_{{$SPLQ->product_id}}">
                                        <input type="hidden" value="{{$SPLQ->product_price_sale}}" class="cart_product_price_sale_{{$SPLQ->product_id}}">
                                        <input type="hidden" value="{{$SPLQ->product_quantity}}" class="cart_product_quantity_{{$SPLQ->product_id}}">
                                        <input type="hidden" value="1" class="cart_product_qty_{{$SPLQ->product_id}}">

                                        
            
                                    {{-- <input type="hidden" value="{{ $value->product_price }}"
                                        class="cart_product_price_{{ $value->product_id }}"> --}}
                            

                                        <a href="{{URL::to('/chi-tiet-san-pham/'.$SPLQ->product_id)}}">
                                            @if ($SPLQ->product_price_sale != '0')
                            <p class="giamgia" style="font-size: 15px">
                                Giảm&nbsp;
                                {{ number_format(100 - ($SPLQ->product_price_sale * 100) / $SPLQ->product_price, 0, ',', '.') . ' ' . '%' }}

                            </p>
                        @else
                        <p class="khonggiamgia" ></p>
                        @endif
                                        <img src="{{URL::to('/public/upload/product/'.$SPLQ->product_image)}}" alt="" />
                                        {{-- <h2>{{ number_format($product->product_price).' '.'VNĐ'}}</h2> --}}
                                        <h2>{{ $SPLQ->product_name }}</h2>


                                        <div class="price_sale" style="    align-items: flex-end;
                                        color: #444;
                                        font-family: sans-serif;
                                        font-weight: 700;
                                        line-height: 1.4;
                                        display: flex;">

                                            
                                        
                                            @if ($SPLQ->product_price_sale != 0)
                                            <p style="color: #d70018;
                                            display: inline-block;
                                            font-size: 18px;
                                            font-weight: 700;
                                            line-height: 1.1;" >{{ number_format($SPLQ->product_price_sale, 0, ',', '.') . ' ' . '₫' }}</p>
                                            <p style="color: #707070;
                                            display: inline-block;
                                            font-size: 14px;
                                            font-weight: 600;
                                            position: relative;
                                            -webkit-text-decoration: line-through;
                                            text-decoration: line-through;
                                            top: 2px;">{{ number_format($SPLQ->product_price, 0, ',', '.') . ' ' . '₫' }}</p>
                                   
                                </p>
                                
                            @else
                            <p style="color: #d70018;
                            display: inline-block;
                            font-size: 18px;
                            font-weight: 700;
                            text-align: center;
                            line-height: 1.1;" >{{ number_format($SPLQ->product_price, 0, ',', '.') . ' ' . '₫' }}</p>
                            @endif</div>
                                        
                                        </a>
                                        
                                        @if ($SPLQ->product_quantity >= 1)
                                            <button type="button" class="btn btn-fefault add-to-cart" data-id_product="{{ $SPLQ->product_id }}" name="add-to-cart" 
                                                style="margin-bottom: 8px;margin-left: 10px;"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                                            </button>
                                        @else
                                            <span style="color: #d70018;
                                            font-weight: 700;">TẠM HẾT HÀNG</span>
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
         {{-- <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			 --}}
    </div>
</div><!--/recommended_items-->

@endsection