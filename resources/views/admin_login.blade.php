
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
 <h2>Đăng Nhập Admin</h2> 

	
	{{--
		php
		$message = Session::get('message');
	if($message){
		echo '<span class="text-alert">'.$message.'</span>';
		Session::put('message', null);
	} 
	php--}}
	

		<form action="{{URL::to('/admin-dashboard')}}" method="post">
			{{ csrf_field() }}
			<input type="text" class="ggg" name="admin_user" placeholder="Nhập Username" required="">
			<input type="password" class="ggg" name="admin_password" placeholder="Nhập Password" required="">

			{{-- <div class="sub-w3l">
				<h6>
					<a href="{{URL::to('/register-admin')}}">Đăng ký tài khoản QTV</a>
				</h6>
			</div> --}}
				<input type="submit" value="Sign In" name="login">
		</form>
		
</div>
</div>
<div style="text-align: center ;color:#002795">
	<p>&copy; 2023 All rights reserved | Design by <a href="#">Hoài An Store</a></p>
</div>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{asset('public/backend/js/flot-chart/excanvas.min.js')}}"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
</body>
</html>
