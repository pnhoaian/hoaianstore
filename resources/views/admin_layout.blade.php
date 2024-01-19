<!DOCTYPE html>
<head>
<title>Administrator | Hoài An Store</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1) } </script>

<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->

<meta name="csrf-token" content="{{ csrf_token() }}">


<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>

<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

<!--CSS phân trang-->
<link href="{{asset('public/backend/css/jquery.dataTables.min.css')}}" rel="stylesheet">

<!--CSS Toast thông báo-->
<link href="{{asset('public/backend/css/toastr.min.css')}}" rel="stylesheet">

<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css')}}"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
{{-- new --}}
<link rel="stylesheet" href="{{ asset('public/backend/css/jquery-ui.css') }}" type="text/css" />

<!-- calendar -->

<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<!-- //calendar -->

<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<!-- //thư viện Phân trang -->
<script src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>


<!-- //favicon -->
<link rel="shortcut icon" href="{{asset('public/backend/images/favicon.png')}}">
</head>

<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('/dashboard')}}" class="logo">
        Admin
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row" id="top_menu">

    <!--  notification start -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        {{-- <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li> --}}
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('public/backend/images/2.png')}}">
                <span class="username">
                    <?php 
                    $name = Session::get('admin_name');
                    // $name = Auth::user->admin_name;
                    
                    if($name){
                        echo 'Xin chào, ';
                        echo $name;
                    }
                    ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Chỉnh sửa thông tin</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Cài Đặt</a></li>
                <li><a href="{{ URL::to('/logout') }}"><i class="fa fa-key"></i> Đăng Xuất</a></li>
                {{-- <li><a href="{{ URL::to('/logout-auth') }}"><i class="fa fa-key"></i> Đăng Xuất</a></li> --}}
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->

<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-bar-chart-o"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="active">
                    <a href="javascript:">
                        <i class="fa fa-picture-o"></i>
                        <span>Banner</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-slider')}}">Thêm Slide - Banner</a></li>
                        <li><a href="{{URL::to('/manage-banner')}}">Danh Sách Slide - Banner</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:">
                        <i class="fa fa-book"></i>
                        <span>Danh Mục</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-product')}}">Thêm Danh Mục Sản Phẩm</a></li>
						<li><a href="{{URL::to('/all-category-product')}}">Tất cả Danh Mục </a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:">
                        <i class="fa fa-scribd"></i>
                        <span>Hãng - Thương hiệu</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-brand-product')}}">Thêm Hãng</a></li>
						<li><a href="{{URL::to('/all-brand-product')}}">Danh Sách Hãng</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:">
                        <i class="fa fa-list-alt "></i>
                        <span>Sản Phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-product')}}">Thêm Sản Phẩm</a></li>
						<li><a href="{{URL::to('/all-product')}}">Danh Sách Sản Phẩm</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:">
                        <i class="fa fa-truck "></i>
                        <span>Đơn Hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order')}}">Quản Lý Đơn Hàng</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:">
                        <i class="fa fa-gift"></i>
                        <span>Mã Giảm Giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/insert-coupon')}}">Thêm Coupon</a></li>
						<li><a href="{{URL::to('/list-coupon')}}">Danh Sách Coupon</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:">
                        <i class="fa fa-newspaper-o"></i>
                        <span>Danh mục Tin tức - Bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-post')}}">Thêm Danh mục bài viết</a></li>
						<li><a href="{{URL::to('/all-category-post')}}">Danh Sách Danh mục bài viết</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-post')}}">Thêm bài viết</a></li>
						<li><a href="{{URL::to('/all-post')}}">Danh sách bài viết</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:">
                        <i class="fa fa-commenting-o" aria-hidden="true"></i>
                        <span>Bình luận</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/list-comment')}}">Liệt kê bình luận</a></li>
						{{-- <li><a href="{{URL::to('/all-post')}}">Danh sách bài viết</a></li> --}}
                    </ul>
                </li>

                {{-- <li class="sub-menu">
                    <a href="javascript:">
                        <i class="fa fa-envelope"></i>
                        <span>Mail </span>
                    </a>
                    <ul class="sub">
                        <li><a href="mail.html">Inbox</a></li>
                        <li><a href="mail_compose.html">Compose Mail</a></li>
                    </ul>
                </li> --}}
                @hasrole('admin')
                <li class="sub-menu">
                    <a href="javascript:">
                        <i class="fa fa-user-secret"></i>
                        <span>Tài khoản quản trị</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-user')}}">Thêm tài khoản mới</a></li>
                        <li><a href="{{URL::to('/all-user')}}">Danh sách tài khoản</a></li>
                    </ul>
                </li>
                @endhasrole

                
                <li class="sub-menu">
                    <a href="{{URL::to('/impersonate-destroy')}}">
                        <i class="fa fa-user-secret"></i>
                        <span>Hủy trao quyền</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{URL::to('/introduce')}}">
                        <i class="fa fa-info"></i>
                        <span>Thông tin Giới thiệu</span>
                    </a>
                </li>

                <li>
                    <a href="{{URL::to('/information')}}">
                        <i class="fa fa-phone-square"></i>
                        <span>Thông tin liên hệ</span>
                    </a>
                </li>

            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->



                        <!--main content start-->
<section id="main-content">
	<section class="wrapper">
		@yield('admin_content')
</section>



 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2023 All rights reserved | Design by AnHoai</p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>

<!-- //thư viện datepicker -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
 <!--TV s/d Toast-->
<script src="{{asset('public/backend/js/toastr.min.js')}}"></script> 

<script src="{{ asset('public/backend/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('public/backend/js/morris.min.js') }}"></script>
<script src="{{ asset('public/backend/js/raphael-min.js') }}"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<!--Hiện thị thông báo-->
{!! Toastr::message() !!}



<!--kiểm tra số lượng hàng so vs tồn kho, gửi biến giá trị số lượng,thông tin sản phẩm đặt -->

<script type="text/javascript">
    $('.update_quantity_order').click(function() {
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_' + order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();
        // alert(order_product_id);
        // alert(order_qty);
        // alert(order_code);
        $.ajax({
            url: '{{ url('/update-qty') }}',

            method: 'POST',

            data: {
                _token: _token,
                order_product_id: order_product_id,
                order_qty: order_qty,
                order_code: order_code
            },
            // dataType:"JSON",
            success: function(data) {
                alert('Cập nhật số lượng thành công');
                location.reload();
            }
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

<!-- Datepicker Coupon -->
<script type="text/javascript">
    $( function() {
      $( "#datepickerkm" ).datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat:"dd/mm/yy",
        dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chúa nhật",],
        duration:"slow"
      });

      $( "#datepickerkm2" ).datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat:"dd/mm/yy",
        dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chúa nhật",],
        duration:"slow"
      });
    } );
</script>

<!-- Biểu đồ thống kế doanh số -->
<script type="text/javascript">
    $(document).ready(function() {

        // new Morris.Bar({
        //     element: 'chart',
        //     data: [
        //         { year: '2008', value: 20 },
        //         { year: '2009', value: 10 },
        //         { year: '2010', value: 5 },
        //         { year: '2011', value: 5 },
        //         { year: '2012', value: 20 }
        //     ],
        //     xkey: 'year',
        //     ykeys: ['value'],
        //     labels: ['Value']
        // });

        chart30daysorder();

        var chart = new Morris.Bar({
            element: 'chart',
            barColors: ['#37D2FF', '#5854F7'],
            lineColors: ['#819c79', '#fc8710', '#ff6541', '#a4add3', '#766b56'],
            gridTextColor: ['#000'],
            parseTime: false,
            hideHover: 'auto',
            xkey: 'period',
            ykeys: ['order', 'sales', 'profit', 'quantity'],
            labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng']
        });

        function chart30daysorder() {
            $.ajax({
                url: '{{ url('/days-order') }}',
                method: "POST",
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    chart.setData(data);
                }
            });
        }
        $('.dashboard-filter').change(function() {
            var dashboard_value = $(this).val();
            // .val() => lấy giá trị select ngày
            var _token = $('input[name="_token"]').val();
            // alert(dashboard_value);
            $.ajax({
                url: '{{ url('/dashboard-filter') }}',
                method: "POST",
                dataType: "JSON",
                data: {
                    dashboard_value: dashboard_value,
                    _token: _token
                },
                success: function(data) {
                    chart.setData(data);
                }
            });
        });

        $('#btn-dashboard-filter').click(function() {
            var _token = $('input[name="_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker2').val();
            $.ajax({
                url: '{{ url('/filter-by-date') }}',
                method: "POST",
                dataType: "JSON",
                data: {
                    from_date: from_date,
                    to_date: to_date,
                    _token: _token
                },
                success: function(data) {
                    chart.setData(data);
                }
            });
        });

    });
</script>



<!-- Reply Comment -->
<script type="text/javascript">
   $('.btn-reply-comment').click(function() {
            var comment_id = $(this).data('comment_id');
            var comment = $('.reply_comment_' + comment_id).val();

            var comment_product_id = $(this).data('product_id');
            // alert(comment);
            // alert(comment_id);
            // alert(comment_product_id);
            // var alert= 'Trả lời bình luận thành công';
            $.ajax({
                url: '{{ url('/reply-comment') }}',
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    comment: comment,
                    comment_id: comment_id,
                    comment_product_id: comment_product_id
                },
                success: function(data) {
                    $('.reply_comment_' + comment_id).val('');
                    $('#notify_comment').html(
                        '<span class="text text-alert">Trả lời bình luận thành công</span>');
                    location.reload();
                }
            });
        })


    
</script>

<!--TV s/d phân trang-->






<script type="text/javascript">
    $(document).ready(function(){
    var donut =   Morris.Donut({
        element:'donut',
        resize:true,
        colors:[
        //SP
        '#B0C4DE',
        //BV
        '#9ACD32', 
        //DH
        '#DCD800', 
        //KH
        '#FF7F50', 
    ],
    data: [
      {label: "SAN PHAM", value: <?php echo $productt ?>},
      {label: "BAI VIET", value: <?php echo $postt ?>},
      {label: "DON HANG", value: <?php echo $orderr ?>},
      {label: "KHACH HANG", value: <?php echo $customerr ?>}
    ]
  });
});
  
</script>



<script type="text/javascript">
    $('.order_details').change(function() {
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();

        //lay ra so luong
        quantity = [];
        $("input[name='product_sales_quantity']").each(function() {
            quantity.push($(this).val());
        });
        //lay ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function() {
            order_product_id.push($(this).val());
        });
        j = 0;
        for (i = 0; i < order_product_id.length; i++) {
            //so luong khach dat
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            //so luong ton kho
            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

            if (parseInt(order_qty) > parseInt(order_qty_storage)) {
                j = j + 1;
                if (j == 1) {
                    alert('Số lượng bán trong kho không đủ');
                }
                $('.color_qty_' + order_product_id[i]).css('background', 'rgba(208, 2, 27, 0.22)');
            }
        }
        if (j == 0) {
            if (confirm('Xác nhận thay đổi trạng thái đơn hàng?')) {
            $.ajax({
                url: '{{ url('/update-order-qty') }}',
                method: 'POST',
                data: {
                    _token: _token,
                    order_status: order_status,
                    order_id: order_id,
                    quantity: quantity,
                    order_product_id: order_product_id
                },
                success: function(data) {
                    alert('Thay đổi tình trạng đơn hàng thành công');
                    location.reload();
                }
            });
        }

        }

    });
</script>



<!-- Datepicker Thống kê -->
<script type="text/javascript">
    $( function() {
      $( "#datepicker" ).datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chúa nhật",],
        duration:"slow"
      });

      $( "#datepicker2" ).datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chúa nhật",],
        duration:"slow"
      });
    } );
</script>



<!--TV s/d Ckeditor-->
<script>
    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditor1');
    CKEDITOR.replace('ckeditor2');
    CKEDITOR.replace('ckeditor3');
</script>




<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="js/monthly.js"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
