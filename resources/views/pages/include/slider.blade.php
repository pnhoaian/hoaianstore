													<!--slider-->
                                                    <section id="slider">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-sm-8" style="width:73%;margin-left: -95px;">
                                                                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                                                                        
                                                                        <div class="carousel-inner">
                                                                            @php
                                                                                $i=0;
                                                                            @endphp
                                                                            @foreach ($slider as $key => $slide)
                                                                                @php
                                                                                    $i++;
                                                                                @endphp
                                                                            <div class="item {{ $i==1 ? 'active' : '' }}">
                                                                                <div class="">
                                                                                    <img style="height:320px;min-height:320px;max-height:320px;width:745px;min-width:745px;max-width:745px;margin-left: 40px;" alt="{{ $slide->slider_desc }}" src="{{ asset('public/upload/slider/' . $slide->slider_image) }}" class="img img-responsive">
                                                                                    {{-- <img src="{{asset('public/frontend/images/pricing.png')}}"  class="pricing" alt="" /> --}}
                                                                                </div>
                                                                            </div>
                                                
                                                                            @endforeach
                                                                        </div>
                                                                        
                                                                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                                                                            <i class="fas fa-caret-square-left"></i>
                                                                        </a>
                                                                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                                                                            <i class="fas fa-caret-square-right"></i></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                
                                                                <div class="col-sm-4" style="width:35%;height:100px">
                                                                    <div class="carousel-inner1" style="
                                                                        position: relative">
                                                
                                                                        @foreach ($slidermini as $key => $slidemini)
                                                                        <div >
                                                                            <div >
                                                                                <img style="height: 100px;margin-bottom: 10px;;width:410px;min-width:410px;max-width:410px"  alt="{{ $slidemini->slider_desc }}" src="{{ asset('public/upload/slider/' . $slidemini->slider_image) }}" class="img img-responsive">
                                                                                {{-- <img src="{{asset('public/frontend/images/pricing.png')}}"  class="pricing" alt="" /> --}}
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                
                                                        </div>
                                                    </section>
                                                                                                <!--/slider-->
                                                
                                                                                            <!--Thuong Hieu San Pham-->
                                                    <section>
                                                        <div class="brands__content" style="
                                                        margin-bottom: -25px;">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="brands__content">
                                                                        <div class="list-brand" style="margin-bottom: 20px;     padding-left: 30px;
                                                                        ">
                                                    
                                                                            @foreach ($brand as $key => $brand1)
                                                                                @if ($brand1->brand_image != '')
                                                                                    <a class="list-brand__item"
                                                                                        href="{{ URL::to('/thuong-hieu-san-pham/' . $brand1->brand_id) }}"><img
                                                                                            class="filter-brand__img"
                                                                                            src="{{ asset('public/upload/brand/' . $brand1->brand_image) }}"></a>
                                                                                @else
                                                                                @endif
                                                                            @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </section>
                                                                                            <!--Thuong Hieu San Pham-->