<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<meta name="csrf-token" content="{{csrf_token()}}">
		<meta charset="utf-8" />
		<title>{{env('APP_TITLE')}} | @yield('title')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
		<link rel="apple-touch-icon" href="{{url('admin')}}/pages/ico/60.png">
		<link rel="apple-touch-icon" sizes="76x76" href="{{url('admin')}}/pages/ico/76.png">
		<link rel="apple-touch-icon" sizes="120x120" href="{{url('admin')}}/pages/ico/120.png">
		<link rel="apple-touch-icon" sizes="152x152" href="{{url('admin')}}/pages/ico/152.png">
		<link rel="icon" type="image/x-icon" href="{{url('admin')}}/assets/img/favicon.ico" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-touch-fullscreen" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="default">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="{{url('admin')}}/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
		<link href="{{url('admin')}}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="{{url('admin')}}/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
		<link href="{{url('admin')}}/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="{{url('admin')}}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="{{url('admin')}}/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="{{url('admin')}}/assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="{{url('admin')}}/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
		<link href="{{url('admin')}}/assets/plugins/jquery-metrojs/MetroJs.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="{{url('admin')}}/assets/css/style.css" rel="stylesheet" type="text/css">
		<link href="{{url('admin')}}/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
        <link href="{{url('admin')}}/assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('admin')}}/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />

        <link href="{{url('admin')}}/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('admin')}}/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
		<link class="main-stylesheet" href="{{url('admin')}}/pages/css/pages.css" rel="stylesheet" type="text/css" />
        @stack('styles')
	</head>
	<body class="fixed-header dashboard">
		<!-- BEGIN SIDEBPANEL-->
		<nav class="page-sidebar" data-pages="sidebar">
			<!-- BEGIN SIDEBAR MENU HEADER-->
			<div class="sidebar-header">
				<img src="{{url('admin')}}/assets/img/logo_white.png" alt="logo" class="brand" data-src="{{url('admin')}}/assets/img/logo_white.png" data-src-retina="{{url('admin')}}/assets/img/logo_white_2x.png" width="78" height="22">
				<div class="sidebar-header-controls">
					<button type="button" class="btn btn-link d-lg-inline-block d-xlg-inline-block d-md-inline-block d-sm-none d-none" data-toggle-pin="sidebar"><i class="fa fs-12"></i>
					</button>
				</div>
			</div>
			<!-- END SIDEBAR MENU HEADER-->
			<!-- START SIDEBAR MENU -->@include('admin/layouts.admin-menu')
			<!-- END SIDEBAR MENU -->
		</nav>
		<!-- END SIDEBAR -->
		<!-- END SIDEBPANEL-->
		<!-- START PAGE-CONTAINER -->
		<div class="page-container ">
			<!-- START HEADER -->
			<div class="header ">
				<!-- START MOBILE SIDEBAR TOGGLE -->
				<a href="#" class="btn-link toggle-sidebar d-lg-none pg pg-menu" data-toggle="sidebar"></a>
				<!-- END MOBILE SIDEBAR TOGGLE -->
				<div class="">
					<div class="brand inline ml-5 p-0">
						{{-- <img src="{{url('admin')}}/assets/img/logo.png" alt="logo" data-src="{{url('admin')}}/assets/img/logo.png" data-src-retina="{{url('admin')}}/assets/img/logo_2x.png"> --}}
                        APLIKASI PEMINJAMAN INVENTARIS BARANG
                    </div>
				</div>
				<div class="d-flex align-items-center">
					<!-- START User Info-->
					<div class="pull-left p-r-10 fs-14 font-heading d-lg-block d-none">	<span class="semi-bold">{{Auth::user()->name}}</span>
					</div>
					<div class="dropdown pull-right d-lg-block d-none">
						<button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">	<span class="thumbnail-wrapper d32 circular inline">
						{{-- <img src="{{url('admin')}}/assets/img/profiles/avatar.jpg" alt="" data-src="{{url('admin')}}/assets/img/profiles/avatar.jpg" data-src-retina="{{url('admin')}}/assets/img/profiles/avatar.jpg" width="32" height="32"> --}}
                        <i class="fa fa-user"></i>
                    </span>
						</button>
						<div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
							<a href="{{url('administrator/user/change-password')}}" class="dropdown-item"><i class="pg-settings_small"></i> Change Password</a>
							<a href="#" class="clearfix bg-master-lighter dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">	<span class="pull-left">Logout</span>
								<span class="pull-right"><i class="pg-power"></i></span>
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
						</div>
					</div>
					<!-- END User Info-->
				</div>
			</div>
			<!-- END HEADER -->
			<!-- START PAGE CONTENT WRAPPER -->
			<div class="page-content-wrapper ">@yield('content')
				<!-- START COPYRIGHT -->
				<!-- START CONTAINER FLUID -->
				<div class=" container-fluid  container-fixed-lg footer">
					<div class="copyright sm-text-center">
						<p class="small no-margin pull-left sm-pull-reset"> <span class="hint-text">Copyright &copy; 2021 </span>
							<span class="font-montserrat">{{env('APP_TITLE')}}</span>. <span class="hint-text">All rights reserved. </span>
						</p>
						<div class="clearfix"></div>
					</div>
				</div>
				<!-- END COPYRIGHT -->
			</div>
			<!-- END PAGE CONTENT WRAPPER -->
		</div>
		<!-- END PAGE CONTAINER -->
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
		<script src="{{url('admin')}}/assets/plugins/nvd3/lib/d3.v3.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/nvd3/nv.d3.min.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/nvd3/src/utils.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/nvd3/src/tooltip.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/nvd3/src/interactiveLayer.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/nvd3/src/models/axis.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/nvd3/src/models/line.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/mapplic/js/hammer.min.js"></script>
		<script src="{{url('admin')}}/assets/plugins/mapplic/js/jquery.mousewheel.js"></script>
		<script src="{{url('admin')}}/assets/plugins/mapplic/js/mapplic.js"></script>
		<script src="{{url('admin')}}/assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/skycons/skycons.js" type="text/javascript"></script>
		<script src="{{url('admin')}}/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        @yield('scripts')
        <script>
            function notification(message, type) {
                $('.page-content-wrapper').pgNotification({
                    style: 'bar',
                    message: message,
                    position: 'top',
                    timeout: 4000,
                    type: type
                }).show();
            }
        </script>
	</body>
</html>
