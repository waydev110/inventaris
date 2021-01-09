<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<meta charset="utf-8" />
		<title>{{env('APP_TITLE')}}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
	    <link rel="apple-touch-icon" sizes="57x57" href="{{url('assets')}}/img/icon/apple-icon-57x57.png">
	    <link rel="apple-touch-icon" sizes="60x60" href="{{url('assets')}}/img/icon/apple-icon-60x60.png">
	    <link rel="apple-touch-icon" sizes="72x72" href="{{url('assets')}}/img/icon/apple-icon-72x72.png">
	    <link rel="apple-touch-icon" sizes="76x76" href="{{url('assets')}}/img/icon/apple-icon-76x76.png">
	    <link rel="apple-touch-icon" sizes="114x114" href="{{url('assets')}}/img/icon/apple-icon-114x114.png">
	    <link rel="apple-touch-icon" sizes="120x120" href="{{url('assets')}}/img/icon/apple-icon-120x120.png">
	    <link rel="apple-touch-icon" sizes="144x144" href="{{url('assets')}}/img/icon/apple-icon-144x144.png">
	    <link rel="apple-touch-icon" sizes="152x152" href="{{url('assets')}}/img/icon/apple-icon-152x152.png">
	    <link rel="apple-touch-icon" sizes="180x180" href="{{url('assets')}}/img/icon/apple-icon-180x180.png">
	    <link rel="icon" type="image/png" sizes="192x192"  href="{{url('assets')}}/img/icon/android-icon-192x192.png">
	    <link rel="icon" type="image/png" sizes="32x32" href="{{url('assets')}}/img/icon/favicon-32x32.png">
	    <link rel="icon" type="image/png" sizes="96x96" href="{{url('assets')}}/img/icon/favicon-96x96.png">
	    <link rel="icon" type="image/png" sizes="16x16" href="{{url('assets')}}/img/icon/favicon-16x16.png">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-touch-fullscreen" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="default">
		<meta content="{{env('APP_TITLE')}}" name="description" />
		<meta content="{{env('APP_TITLE')}}" name="author" />
		<link href="{{url('admin')}}/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
		<link href="{{url('admin')}}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="{{url('admin')}}/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
		<link href="{{url('admin')}}/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="{{url('admin')}}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="{{url('admin')}}/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="{{url('admin')}}/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
		<link class="main-stylesheet" href="{{url('admin')}}/pages/css/pages.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
		window.onload = function()
		{
		// fix for windows 8
		if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
			document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="{{url('admin')}}/pages/css/windows.chrome.fix.css" />'
		}
        </script>
        <style>
            .login-wrapper .bg-pic>img {
                /* height: 100%; */
                opacity: 1;
            }
        </style>
	</head>
	<body class="fixed-header ">
		<div class="login-wrapper ">
		<!-- START Login Background Pic Wrapper-->
		<div class="bg-pic">
			<!-- START Background Pic-->
			<img src="{{url('admin')}}/assets/img/bg.jpg" data-src="{{url('admin')}}/assets/img/bg.jpg" data-src-retina="{{url('admin')}}/assets/img/bg.jpg" alt="" class="lazy">
			<!-- END Background Pic-->
			<!-- START Background Caption-->
			<div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
			<p class="small">Copyright © 2021
			</p>
			</div>
			<!-- END Background Caption-->
		</div>
		<!-- END Login Background Pic Wrapper-->
		<!-- START Login Right Container-->
		<div class="login-container" style="background-color: rgb(240, 240, 240)">
			<div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
                <h4>{{env('APP_TITLE')}}</h4>
			<img src="{{url('admin')}}/assets/img/logo.png" alt="logo" data-src="{{url('admin')}}/assets/img/logo.png" data-src-retina="{{url('admin')}}/assets/img/logo.png" width="100%">

            <p class="p-t-35">Sign into your account</p>
            @error('email')
			<div class="alert alert-danger" role="alert">
				<p class="pull-left"><strong>Oops...</strong></p>
				<button class="close" data-dismiss="alert"></button>
				<div class="clearfix"></div>
				<p>{{ $message }}</p>
			</div>
			@enderror
			<!-- START Login Form -->
			<form id="form-login" class="p-t-15" role="form" method="POST"  action="{{ route('login') }}">
                @csrf
				<!-- START Form Control-->
				<div class="form-group form-group-default">
				<label>Login</label>
				<div class="controls">
					<input type="text" name="email" value="{{old('email')}}" placeholder="Email" class="form-control" required>
				</div>
				</div>
				<!-- END Form Control-->
				<!-- START Form Control-->
				<div class="form-group form-group-default">
				<label>Password</label>
				<div class="controls">
					<input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required>
				</div>
				</div>
				<!-- END Form Control-->
				<button class="btn btn-complete btn-cons m-t-10" type="submit">Sign in</button>
			</form>
			</div>
		</div>
		<!-- END Login Right Container-->
		</div>
		<!-- BEGIN VENDOR JS -->
		<script src="{{url('admin')}}/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/popper/umd/popper.min.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
		<script src="{{url('admin')}}/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
		<script type="text/javascript" src="{{url('admin')}}/assets/plugins/select2/js/select2.full.min.js"></script>
		<script type="text/javascript" src="{{url('admin')}}/assets/plugins/classie/classie.js"></script>
		<script src="{{url('admin')}}/assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
		<!-- END VENDOR JS -->
		<script src="{{url('admin')}}/pages/js/pages.js"></script>
		<script>
		$(function()
		{
		$('#form-login').validate()
		})
		</script>
	</body>
</html>
