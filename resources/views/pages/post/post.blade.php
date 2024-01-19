@extends('welcome')
@section('content')


    <div class="row" style="overflow: hidden ">
        <div class="col-sm-12">
            <div class="features_items" style="font-family: -apple-system, system-ui, BlinkMacSystemFont;">
                <!--features_items-->

                <h2 class="title text-center"
                    style="text-align:left;margin-top:40px; font-size: 22px;margin-left:70px;">
                    {{ $meta_title }}</h2>


                <div class="product-image-wrapper" style="height:auto;max-height:none;border:none ">
                    @foreach ($post as $key => $p)
                    <p style="text-align: right"><b>Số lượt xem: </b> {{ $p->post_view }} </p>

                        <div class="single-products" style="margin-top:-5px">
                            {!! $p->post_content !!}
                        </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    <!--features_items-->
    <h2 class="title text-center"
        style="    font-size: 22px;
    /* margin-left: 280px; */
    color: #333;
    margin-bottom: 10px;">Bài viết liên quan</h2>
    <ul class="post_relate" style="padding-left: 200px;
    margin-right:25px;
    display: flex;">
        @foreach ($related as $key => $post_relate)
            <li style="margin-top:10px; max-width:250px; margin-right:5px">
                <div> <a href="{{ URL::to('/bai-viet/' . $post_relate->post_id) }}"><img
                            style="width:250px; height:155px;border: 1px solid rgba(0,0,0,.05);"
                            src="{{ URL::to('public/upload/post/' . $post_relate->post_image) }}" alt="" /></a>
                </div>
                <a style="padding:5px;float:left; color: #222; font-family: -apple-system, system-ui, BlinkMacSystemFont;"
                    href="{{ URL::to('/bai-viet/' . $post_relate->post_id) }}">{{ $post_relate->post_title }}</a>
            </li>
        @endforeach
    </ul>
    </div>
    </div>

</div>
@endsection
