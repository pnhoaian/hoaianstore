
<!DOCTYPE html>
<head>
<title>Admin Login | Hoai An Motor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="meta description" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->

<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>

<!--CSS Toast thông báo-->
<link href="{{asset('public/backend/css/toastr.min.css')}}" rel="stylesheet">

<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 

<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>

<!-- //favicon -->
<link rel="shortcut icon" href="{{asset('public/frontend/images/favicon.png')}}">
</head>


<body>
<div class="log-w3">
<div class="w3layouts-main">
 <h2>Đăng ký Quản trị viên</h2> 

	
                    {{-- //thông báo lỗi đầu vào ở header --}}
                    {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif --}}
                    {{-- End --}}
	

		<form action="{{URL::to('/register-admin-account')}}" method="post">
			{{ csrf_field() }}
			<input type="text" class="ggg" name="admin_user" value="{{ old('admin_user') }}" placeholder="Nhập Username đăng ký" required="">
			<input type="password" class="ggg" name="admin_password" value="{{ old('admin_password') }}" placeholder="Nhập Password" required="">
			<input type="text" class="ggg" name="admin_name" value="{{ old('admin_name') }}" placeholder="Nhập Họ và Tên" required="">
				<div>
					<h6 >
						<a href="{{URL::to('/login-auth')}}">Đã có tài khoản QTV</a>
					</h6>
				</div>
			<input type="submit" value="Đăng ký"  name="Đăng ký">
		</form>
</div>
</div>
<div style="text-align: center ;color:white">
	<p>&copy; 2023 All rights reserved | Design by <a href="#">Hoài An Store</a></p>
</div>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{asset('public/backend/js/flot-chart/excanvas.min.js')}}"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>

 <!--TV s/d Toast-->
 <script src="{{asset('public/backend/js/toastr.min.js')}}"></script> 

 <!--Hiện thị thông báo-->
 {!! Toastr::message() !!}
</body>
</html>