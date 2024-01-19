@extends('welcome')
@section('content')
@section('footer')
	@include("pages.include.footer")
@endsection()

    <section id="cart_items" style="color: #000">
        <div class="container" style="width:100%">
            <div class="breadcrumbs">
                <ol class="breadcrumb" style="margin-bottom: 0px;padding-top: 0">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li style="color:#ccc">/</li>
                    <li class="breadcrumb-item active" style="color: #000">Thông tin tài khoản</li>
                </ol>
								                    {{-- //thông báo lỗi đầu vào ở header --}}
									@if ($errors->any())
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
												<li class="fa fa-exclamation-circle" aria-hidden="true" style="color: #FFF;font-size: 18px;background: firebrick;border-radius: 10px;width: 420px;
												height: 35px;padding-top: 10px;margin:10px 10px"> {{ $error }}</li>
											@endforeach
										</ul>
									</div>
									@endif
									{{-- End --}}
            </div>
            <div class="table-responsive cart_info col-sm-9" style="width:100% ;padding-bottom:20px;margin-top: 20px">
                <div class="shopper-informations ">
                    <div class="row">
                        <div class="col-sm-12 clearfix" style="padding-left: 50px;">
                            <div class="bill-to">

                                <h2 class="title text-center"
                                    style="margin-top:20px;font-family: -apple-system, system-ui, BlinkMacSystemFont;">THÔNG
                                    TIN TÀI KHOẢN
                                </h2>
                                <div class="form-one" style="width:90%">
                                    
                                    <form id="validation"
                                        action="{{ URL::to('/update-information/' . Session::get('customer_id')) }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6" style="padding-left: 0">
                                                <label>Tên khách hàng</label>
                                                <input style="border-radius: 0;border:1px solid #ddd" type="text"
                                                    name="customer_name" value="{{ $customer1->customer_name}}"
                                                    class="shipping_name form-control">

                                                    <label>Email</label>
                                                    <input style="border-radius: 0;border:1px solid #ddd" type="text"
                                                        name="customer_email" value="{{ $customer1->customer_email }}"
                                                        class="shipping_email form-control">
                                                        
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6" style="padding-left: 0">
                                                <label>Số điện thoại</label>
                                                <input style="border-radius: 0;border:1px solid #ddd" type="text"
                                                    name="customer_phone" value="{{ $customer1->customer_phone }}"
                                                    class="shipping_phone form-control">

                                                    <label>Địa chỉ nhận hàng</label>
                                                    <input style="border-radius: 0;border:1px solid #ddd" type="text"
                                                        name="customer_address" class="shipping_address form-control"
                                                        value="{{ $customer1->customer_address }}">
                                                </div>

                                            </div>
                                        <button style="border-radius: 5px; float: right;" type="submit"
                                            class="btn btn-info">Cập nhật thông tin</button>

                                    </form>



                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--/#cart_items-->
@endsection
