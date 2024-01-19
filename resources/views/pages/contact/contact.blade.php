@extends('welcome')
@section('content')

<div class="features_items">
    <h2 class="title text-center">Liên Hệ Với Chúng Tôi</h2>
    @foreach ($contact as $key =>$cont)
        
    
        <div class="grid__item md-pd-left15 large--one-third medium--one-half small--one-whole" style="box-sizing: border-box;
        float: left;
        min-height: 1px;
        padding-left: 25px;
        vertical-align: top;">
        <h4 class="info" style="color: #EE3E38;">Thông tin liên hệ</h4>
                <div class="contact-wrapper text-center" 
                style="padding: 10px;
                background: #f9f9f9;
                margin-bottom: 30px;">

                    <div class="contact-title" style="color: #002795;">
                        <h4>Địa chỉ cửa hàng</h4>
                    </div>
                    <div class="contact-info">
                        {!! $cont->info_address !!} 
                    </div>
                </div>

                <div class="contact-wrapper text-center" 
                style="padding: 10px;
                background: #f9f9f9;
                margin-bottom: 30px;">
                
                    <div class="contact-title" style="color: #002795;">
                        <h4>Hotline tư vấn (24/7):</h4>
                    </div>
                    <div class="contact-info">
                        {!! $cont->info_number !!} 
                    </div>
                </div>

                <div class="contact-wrapper text-center" 
                style="padding: 10px;
                background: #f9f9f9;
                margin-bottom: 30px;">
                
                    <div class="contact-title" style="color: #002795;">
                        <h4>Email hỗ trợ tư vấn & Góp ý</h4>
                    </div>
                    <div class="contact-info">
                        {!! $cont->info_email !!} 
                    </div>
                </div> 
        </div>

        <div class="md-pd-left15 large--one-third medium--one-whole small--one-whole" style="box-sizing: border-box;
        float: left;
        min-height: 1px;
        padding-left: 20px;
        vertical-align: top;">
        <h4 class="info" style="color: #EE3E38;">Fanpage</h4>
        {!! $cont->info_fanpage !!} 
        </div>

        <div class="grid__item md-pd-left15 large--one-third medium--one-half small--one-whole float-right" style="box-sizing: border-box;
        float: right;
        min-height: 1px;
        padding-left: 20px;
        vertical-align: top;">

            <h4 class="info" style="color: #EE3E38;">Vị trị cửa hàng</h4>
            {!! $cont->info_map !!} 
        </div>

        @endforeach
    </div>
@endsection