@extends('welcome')
@section('content')

<div class="features_items">
                        <!--       Tiêu đề      -->
			@foreach ($catepost as $key => $name)
                <h2 class="title text-center" style="margin-top: 10px">{{ $name->cate_post_name }}</h2>
            @endforeach

							<!--       Bài viết      -->
            @foreach ($post as $key => $p)
                <div class="product-image-wrapper" style="min-height: 220px;
                    height: 220px;">

                    <div class="single-products">
                        <div class=" text-center" style="padding:5px; min-height:140px">
                            @csrf

                            
                            <a href="{{ URL::to('/bai-viet/' . $p->post_id) }}">
                                <img style="float:left;width:290px; height:200px;padding:5px;"
                                src="{{ URL::to('public/upload/post/' . $p->post_image) }}" />
                                <h3
                                    style="display:block;font-size:18px;font-weight:700;font-family: -apple-system, system-ui, BlinkMacSystemFont;color:#0213B0;line-height:28px;text-align:left;margin-bottom:10px;margin-top:10px;margin-left: 300px;max-height: 40px;
                                    min-height: 40px;
                                    height: 40px;">
                                    {{ $p->post_title }}
                                </h3>

                                    <p style="margin-left: 290px; height: 50px;
                                    margin-left: 290px;
                                    min-height: 50px;
                                    max-height: 50px;
                                    font-size: 13px;color:#333;text-align:left;"
                                    
                                    
                                    
                                    >{!! $p->post_desc !!}</p>
                                </a>
                                

                        </div>
                        <div><a style="
                            margin-right: 10px;
                            background: #0213B0;
                            float: right;
                            margin-top: 20px;
                        }"
                                class="btn btn-primary" href="{{ URL::to('/bai-viet/' . $p->post_id) }}">Xem chi tiết</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            @endforeach


        </div>
        <!--features_items-->
        <ul class="pagination pagination-sm m-t-none m-b-none">
            {!! $post->links() !!}
        </ul>
    </div>
@endsection
