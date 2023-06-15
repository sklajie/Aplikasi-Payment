<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>@yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	
	<link rel="stylesheet" href="{{url('')}}/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="{{url('')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{url('')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="{{url('')}}/plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{url('')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	{{-- DATATABLE --}}
	<link rel="stylesheet" href="{{url('')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="{{url('')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{url('')}}/plugins/daterangepicker/daterangepicker.css">
  
	<!-- summernote -->
	<link rel="stylesheet" href="{{url('')}}/plugins/summernote/summernote-bs4.css">
	<!-- select2 -->
	<link rel="stylesheet" type="text/css" href="{{url('')}}/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="{{url('')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{url('')}}/plugins/orgchart/css/jquery.orgchart.min.css">
	<style type="text/css">
    .divider{
		width: 100%;
		height: 1px;
		background: #BBB;
		margin: 1rem 0;
    }
    .select2-selection.select2-selection--single{
		height: 40px;
    }
	</style>
	@yield('css')

	<link rel="icon" href="{{ url('') }}/assets/img/logo_polindra.png" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ url('') }}/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ url('') }}/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ url('') }}/assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ url('') }}/assets/css/demo.css">

	<style>
		input[type='submit']{
			border: none;
			background: none;
		}

		.logo{
			font-size: 24px;
			font-family: Copperplate, Papyrus, fantasy;
		}
	</style>


</head>
<body>
<div class="app">
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" style="background-color: green">
				
				<a href="/" class="logo">
					<img src="{{ url('') }}/assets/img/logo_polindra.png" style="width:40px;">
					<p alt="navbar brand" class="navbar-brand" style="color: white">POLINDRA</p>
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			
			<nav class="navbar navbar-header navbar-expand-lg" style="background-color: rgb(3, 195, 3);">
				
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<center><i class="fas fa-user avatar-img rounded-circle" style="font-size: 24px; color:white; padding-top:8px; border:1px solid;"></i></center>
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">		
									<li>
											<!-- Authentication Links -->
										@guest

											@if (Route::has('login'))

												<li class="dropdown-item" href="{{ route('login') }}">
													<a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
												</li>

											@endif

										@else
											<li class="nav-item dropdown">

												<div class="user-box">
													<div class="avatar-lg"><center><i class="fas fa-user avatar-img rounded" style="font-size: 45px; color:rgb(0, 73, 98); padding-top:8px; border:1px solid;"></i></center></div>
													<div class="u-text">
														<h4>{{ Auth::user()->name }}</h4>
														<p class="text-muted">{{ Auth::user()->email }}</p>
														<a href="/profil" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
													</div>
												</div>
												
												<div class="dropdown-divider"></div>

												<li class="dropdown-item" href="{{ route('login') }}">
													<a class="dropdown-item" href="{{ route('logout') }}"
														onclick="event.preventDefault();
														document.getElementById('logout-form').submit();">
														{{ __('Logout') }}
													</a>
				
													<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
														@csrf
													</form>
												</li>
											</li>
										@endguest
										
									</li>

									


								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar" data-background-color="dark">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					

						@if ( Auth::user()->level['nama_level'] == 'Super Admin')
							<div class="user">
								<div class="avatar-sm float-left mr-2 mt-1">
									<center><i class="fas fa-user avatar-img rounded-circle" style="font-size: 23px; padding-top:8px; border:1px solid;"></i></center>
								</div>
								<div class="info">
									<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
										<span>
											{{ Auth::user()->name }}
											<span class="user-level">{{ Auth::user()->level['nama_level'] }}</span>
											
										</span>
									</a>
									<div class="clearfix"></div>
		
									<div class="collapse in" id="collapseExample">
										<ul class="nav">
											<li>
												<a href="/profil">
													<span class="link-collapse">My Profile</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>							
							
						<ul class="nav nav-primary">

						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Navigation</h4>
						</li>

						<li class="nav-item {{$title === "Dashboard" ? 'active' : '' }}">
							<a href="/">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>

						<li class="nav-item {{ $title === "Users" ? 'active' : '' }}">
							<a href="/users">
								<i class="fas fa-layer-group"></i>
								<p>Users</p>
								
							</a>
						</li>

						<li class="nav-item">
							<div class="nav-item">
							<a data-toggle="collapse" href="#sidebarLayouts">
								<i class="fa fa-ellipsis-h"></i>
								<p>Data Pembayaran</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="sidebarLayouts">
								<ul class="nav nav-collapse">
									<li class="nav-item  {{ $title === "Data Pembayaran - Belum Dibayar" ? 'active' : '' }}">
										<a href="/pembayaran">
											<span class="sub-item"><p>Belum dibayar</p></span>
										</a>
									</li>	
									<li class="nav-item  {{ $title === "Data Pembayaran - Dibayar" ? 'active' : '' }}">
										<a href="/pembayaran_dibayar">
											<span class="sub-item"><p>Dibayar</p></span>
										</a>
									</li>	
								</ul>
							</div>
						</div>
						</li>	

						<li class="nav-item {{ $title === "Pembayaran Lainnya" ? 'active' : '' }}">
							<a href="/pembayaran_lainnya">
								<i class="far fa-list-alt"></i>
								<p>Pembayaran Lainnya</p>
							</a>
						</li>

						<li class="nav-item {{ $title === "Histori Pembayaran" ? 'active' : '' }}">
							<a href="/pembayaran/histori_pembayaran">
								<i class="fas fa-file-invoice-dollar"></i>
								<p>Histori Pembayaran</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="/kategori_pembayaran">
								<i class="fas fa-layer-group"></i>
								<p>Kategori Pembayaran</p>
							</a>
						</li>
						
					</ul>
				@elseif ( Auth::user()->level['nama_level'] == 'Admin Keuangan')
				
				<div class="user">
					<div class="avatar-sm float-left mr-2 mt-1">
						<center><i class="fas fa-user avatar-img rounded-circle" style="font-size: 23px; padding-top:8px; border:1px solid;"></i></center>
					</div>
					<div class="info">
						<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
							<span>
								{{ Auth::user()->name }}
								<span class="user-level">{{ Auth::user()->level['nama_level'] }}</span>
								
							</span>
						</a>
						<div class="clearfix"></div>

						<div class="collapse in" id="collapseExample">
							<ul class="nav">
								<li>
									<a href="/profil">
										<span class="link-collapse">My Profile</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>	

				<ul class="nav nav-primary">

					<li class="nav-section">
						<span class="sidebar-mini-icon">
							<i class="fa fa-ellipsis-h"></i>
						</span>
						<h4 class="text-section">Navigation</h4>
					</li>

					<li class="nav-item {{$title === "Dashboard" ? 'active' : '' }}">
						<a href="/">
							<i class="fas fa-home"></i>
							<p>Dashboard</p>
						</a>
					</li>


					<li class="nav-item">
						<div class="nav-item">
						<a data-toggle="collapse" href="#sidebarLayouts">
							<i class="fa fa-ellipsis-h"></i>
							<p>Data Pembayaran</p>
							<span class="caret"></span>
						</a>
						<div class="collapse" id="sidebarLayouts">
							<ul class="nav nav-collapse">
								<li class="nav-item  {{ $title === "Data Pembayaran - Belum Dibayar" ? 'active' : '' }}">
									<a href="/pembayaran">
										<span class="sub-item"><p>Belum dibayar</p></span>
									</a>
								</li>	
								<li class="nav-item  {{ $title === "Data Pembayaran - Dibayar" ? 'active' : '' }}">
									<a href="/pembayaran_dibayar">
										<span class="sub-item"><p>Dibayar</p></span>
									</a>
								</li>	
							</ul>
						</div>
					</div>
					</li>			

					<li class="nav-item {{ $title === "Pembayaran Lainnya" ? 'active' : '' }}">
						<a href="/pembayaran_lainnya">
							<i class="far fa-list-alt"></i>
							<p>Pembayaran Lainnya</p>
						</a>
					</li>

					<li class="nav-item {{ $title === "Histori Pembayaran" ? 'active' : '' }}">
						<a href="/pembayaran/histori_pembayaran">
							<i class="fas fa-file-invoice-dollar"></i>
							<p>Histori Pembayaran</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="/kategori_pembayaran">
							<i class="fas fa-layer-group"></i>
							<p>Kategori Pembayaran</p>
						</a>
					</li>
				</ul>


				@endif
						
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    
                </div>
            </div>
        </nav>

		<div>
			@yield('content')
		</div>
		
		</div>
		
		
		<!-- Custom template | don't include it in your project! -->
		{{-- <div class="custom-template">
			<div class="title">Settings</div>
			<div class="custom-content">
				<div class="switcher">
					<div class="switch-block">
						<h4>Logo Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red"></button>
							<button type="button" class="selected changeLogoHeaderColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Navbar Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeTopBarColor" data-color="dark"></button>
							<button type="button" class="changeTopBarColor" data-color="blue"></button>
							<button type="button" class="changeTopBarColor" data-color="purple"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue"></button>
							<button type="button" class="changeTopBarColor" data-color="green"></button>
							<button type="button" class="changeTopBarColor" data-color="orange"></button>
							<button type="button" class="changeTopBarColor" data-color="red"></button>
							<button type="button" class="selected changeTopBarColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeTopBarColor" data-color="dark2"></button>
							<button type="button" class="changeTopBarColor" data-color="blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="purple2"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="green2"></button>
							<button type="button" class="changeTopBarColor" data-color="orange2"></button>
							<button type="button" class="changeTopBarColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Sidebar</h4>
						<div class="btnSwitch">
							<button type="button" class="changeSideBarColor" data-color="white"></button>
							<button type="button" class="changeSideBarColor" data-color="dark"></button>
							<button type="button" class="selected changeSideBarColor" data-color="dark2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Background</h4>
						<div class="btnSwitch">
							<button type="button" class="changeBackgroundColor" data-color="bg2"></button>
							<button type="button" class="changeBackgroundColor" data-color="bg1"></button>
							<button type="button" class="changeBackgroundColor" data-color="bg3"></button>
							<button type="button" class="changeBackgroundColor selected" data-color="dark"></button>
						</div>
					</div>
				</div>
			</div>
			<div class="custom-toggle">
				<i class="flaticon-settings"></i>
			</div>
		</div>
		<!-- End Custom template --> --}}
	</div>
</div>

<script src="{{url('')}}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{url('')}}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{url('')}}/plugins/sparklines/sparkline.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{url('')}}/plugins/moment/moment.min.js"></script>
<script src="{{url('')}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{url('')}}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{url('')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
{{-- DATATABLE --}}
<script src="{{url('')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('')}}/dist/js/adminlte.js"></script>
<script type="text/javascript" src="{{url('')}}/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="{{url('')}}/dist/js/jquery.form.min.js">
</script>
<script type="text/javascript" src="{{url('')}}/plugins/orgchart/js/html2canvas.min.js"></script>
<script type="text/javascript" src="{{url('')}}/plugins/orgchart/js/jquery.orgchart.min.js"></script>
@yield('js')


	<!--   Core JS Files   -->
	{{-- <script src="{{ url('') }}/assets/js/core/jquery.3.2.1.min.js"></script> --}}
	<script src="{{ url('') }}/assets/js/core/popper.min.js"></script>
	<script src="{{ url('') }}/assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="{{ url('') }}/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="{{ url('') }}/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ url('') }}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


	<!-- Chart JS -->
	<script src="{{ url('') }}/assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="{{ url('') }}/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	{{-- <script src="../assets/js/plugin/chart-circle/circles.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


	<!-- Datatables -->
	<script src="{{ url('') }}/assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ url('') }}/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="{{ url('') }}/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="{{ url('') }}/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Sweet Alert -->
	<script src="{{ url('') }}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="{{ url('') }}/assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{ url('') }}/assets/js/setting-demo.js"></script>
	<script src="../assets/js/demo.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	
	
	{{-- <script>

	// 	var multipleBarChart = document.getElementById('multipleBarChart').getContext('2d'),
	// 	pieChart = document.getElementById('pieChart').getContext('2d')

	// 	var myMultipleBarChart = new Chart(multipleBarChart, {
	// 		type: 'bar',
	// 		data: {
	// 			labels: ["Semester 1", "Semester 2", "Semester 3", "Semester 4", "Semester 5", "Semester 6", "Semester 7", "Semester 8"],
	// 			datasets : [{
	// 				label: "Sudah Bayar",
	// 				backgroundColor: '#59d05d',
	// 				borderColor: '#59d05d',
	// 				data: [23,34,34,54,34,344,22,12]
	// 			},{
	// 				label: "Belum Bayar",
	// 				backgroundColor: 'red',
	// 				borderColor: '#fdaf4b',
	// 				data: [23,34,34,54,34,344,22,12]
	// 			}],
	// 		},
	// 		options: {
	// 			responsive: true, 
	// 			maintainAspectRatio: false,
	// 			legend: {
	// 				position : 'bottom'
	// 			},
	// 			title: {
	// 				display: true,
	// 				text: 'Traffic Stats'
	// 			},
	// 			tooltips: {
	// 				mode: 'index',
	// 				intersect: false
	// 			},
	// 			responsive: true,
	// 			scales: {
	// 				xAxes: [{
	// 					stacked: true,
	// 				}],
	// 				yAxes: [{
	// 					stacked: true
	// 				}]
	// 			}
	// 		}
	// 	});


	// 	var myPieChart = new Chart(pieChart, {
	// 		type: 'pie',
	// 		data: {
	// 			datasets: [{
	// 				data: [20,20],
	// 				backgroundColor :["#59d05d","red"],
	// 				borderWidth: 0
	// 			}],
	// 			labels: ['Sudah Lunas', 'Belum Lunas'] 
	// 		},
	// 		options : {
	// 			responsive: true, 
	// 			maintainAspectRatio: false,
	// 			legend: {
	// 				position : 'bottom',
	// 				labels : {
	// 					fontColor: 'rgb(154, 154, 154)',
	// 					fontSize: 11,
	// 					usePointStyle : true,
	// 					padding: 20
	// 				}
	// 			},
	// 			pieceLabel: {
	// 				render: 'percentage',
	// 				fontColor: 'white',
	// 				fontSize: 14,
	// 			},
	// 			tooltips: false,
	// 			layout: {
	// 				padding: {
	// 					left: 20,
	// 					right: 20,
	// 					top: 20,
	// 					bottom: 20
	// 				}
	// 			}
	// 		}
	// 	})
	// </script> --}}

</body>

</html>