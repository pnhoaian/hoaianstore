{{-- 
<!DOCTYPE html>
<head>
<title>AnHoai Motor | Admin Login</title>
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
	<h2>Đăng Nhập User</h2>
	
		<form action="{{URL::to('/user-dashboard')}}" method="post">
			{{ csrf_field() }}
			<input type="text" class="ggg" name="admin_user" placeholder="Nhập Username" required="">
			<input type="password" class="ggg" name="admin_password" placeholder="Nhập Password" required="">
			<span><input type="checkbox" />Remember Me</span>
				<div class="clearfix"></div>
				<input type="submit" value="Sign In" name="login">
		</form>
</div>
</div>


<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{asset('public/backend/js/flot-chart/excanvas.min.js')}}"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
</body>
</html> --}}

<!DOCTYPE HTML>
<html lang="en">
<head>
<title> Login | Hoài An Store </title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
<link href="{{asset('public/frontend/css/toastr.min.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css/style.css')}}" rel='stylesheet' type='text/css' media="all" /><!-- Style-CSS --> 
<link href="{{asset('public/frontend/css/font-awesome1.css')}}" rel="stylesheet"> <!-- Font-Awesome-Icons-CSS -->
<!-- //css files -->
<script src="{{asset('public/backend/js/toastr.min.js')}}"></script> 
<link rel="shortcut icon" href="{{asset('public/frontend/images/favicon.png')}}">
<!-- online-fonts -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
<!-- //online-fonts -->

</head>
<body>
	@if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif

<script src="{{asset('public/backend/js/toastr.min.js')}}"></script> 
	<link href="{{asset('public/backend/css/toastr.min.css')}}" rel="stylesheet">

<div class="center-container">
	<!--header-->
	<div class="header-w3l">
		{{-- <h1>Online Login Form</h1> --}}
	</div>
	<!--//header-->
	<div class="main-content-agile">
		<div class="sub-main-w3">	
			<div class="wthree-pro">
				<h2>Đăng nhập tài khoản</h2>
								                    {{-- //thông báo lỗi đầu vào ở header --}}
									{{-- @if ($errors->any())
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
												<li class="fa fa-exclamation-circle" aria-hidden="true" style="color: #FFF;font-size: 22px;background: firebrick;border-radius: 10px;width: 450px;
												height: 35px;padding-top: 10px;"> {{ $error }}</li>
											@endforeach
										</ul>
									</div>
									@endif --}}
									{{-- End --}}
			</div>
			{!! Toastr::message() !!}
			<form action="{{URL::to('/login-customer')}}" method="post">
				{{ csrf_field() }}
				<div class="pom-agile">
					<input name="email_account" class="user" type="email" required="">
					<span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
				</div>
				<div class="pom-agile">
					<input  name="password_account" class="pass" type="password">
					<span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
				</div>
				<div class="sub-w3l">
					<h6><a href="#">Quên mật khẩu</a></h6>
					<h6>
						<a href="{{URL::to('register')}}">Đăng ký tài khoản</a>
					</h6>
					<div class="right-w3l">
						<input type="submit" value="Login">
					</div>
				</div>
			</form>
		</div>
	</div>
	<!--//main-->
	<!--footer-->
	<div class="footer">
		<p>&copy; 2023 All rights reserved | Design by <a href="#">Hoài An Store</a></p>
	</div>
	<!--//footer-->
</div>
</body>
</html>