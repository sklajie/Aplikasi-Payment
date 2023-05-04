<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{{ $title }}</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
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
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">

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
					<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							{{-- <div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div> --}}
						</form>
					</div>
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
														<a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
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
					

						{{-- @if ( Auth::user()) --}}
							<div class="user">
								<div class="avatar-sm float-left mr-2 mt-1">
									<center><i class="fas fa-user avatar-img rounded-circle" style="font-size: 23px; padding-top:8px; border:1px solid;"></i></center>
								</div>
								<div class="info">
									<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
										{{-- <span>
											{{ Auth::user()->name }}
											<span class="user-level">{{ Auth::user()->email }}</span>
											
										</span> --}}
									</a>
									<div class="clearfix"></div>
		
									<div class="collapse in" id="collapseExample">
										<ul class="nav">
											<li>
												<a href="#profile">
													<span class="link-collapse">My Profile</span>
												</a>
											</li>
											<li>
												<a href="#edit">
													<span class="link-collapse">Edit Profile</span>
												</a>
											</li>
											<li>
												<a href="#settings">
													<span class="link-collapse">Settings</span>
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

						<li class="nav-item">
							<a href="/home">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>

						{{-- <li class="nav-item {{ $title === "Data Pengguna" ? 'active' : '' }}">
							<a href="/admin/datauser">
								<i class="fas fa-layer-group"></i>
								<p>Users</p>
								
							</a>
						</li> --}}
						
						<li class="nav-item">
							<a href="#">
								<i class="fas fa-user-friends"></i>
								<p>Users</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="#">
								<i class="fas fa-file-invoice-dollar"></i>
								<p>Histori Pembayaran</p>
							</a>
						</li>

						<li class="nav-item {{ $title === "Data Pembayaran" ? 'active' : '' }} ">
							<a href="#">
								<i class="fas fa-th-list"></i>
								<p>Data Pembayaran</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="#">
								<i class="fas fa-key"></i>
								<p>API Keys</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="#">
								<i class="fas fa-swatchbook"></i>
								<p>Dokumentasi</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="#">
								<i class="far fa-list-alt"></i>
								<p>Pembayaran Lainnya</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="#">
								<i class="fas fa-layer-group"></i>
								<p>Kategori Pembayaran</p>
							</a>
						</li>
						{{-- <li class="nav-item {{ $title === "Detail Penyakit" ? 'active' : '' }}">
							<a href="/admin/detailpenyakit">
								<i class="fas fa-table"></i>
								<p>Data Detail Penyakit</p>
							</a>
						</li> --}}
					</ul>
				{{-- @else --}}
				
					{{-- <ul class="nav nav-primary">
						<li class="nav-item ">
							<a href="/home">
								<p>LOGIN</p>
							</a>
						</li>
					</ul>	
					<div class="dropdown-divider"></div>
					 --}}
				{{-- @endif --}}
						
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
	<!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


	<!-- Chart JS -->
	<script src="../assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	{{-- <script src="../assets/js/plugin/chart-circle/circles.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->
	<script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Sweet Alert -->
	<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo.js"></script>


	<script>

		var multipleBarChart = document.getElementById('multipleBarChart').getContext('2d')

		var myMultipleBarChart = new Chart(multipleBarChart, {
			type: 'bar',
			data: {
				labels: ["Semester 1", "Semester 2", "Semester 3", "Semester 4", "Semester 5", "Semester 6", "Semester 7", "Semester 8"],
				datasets : [{
					label: "Sudah Bayar",
					backgroundColor: '#59d05d',
					borderColor: '#59d05d',
					data: [95, 100, 112, 101, 144, 159, 178, 156],
				},{
					label: "Belum Bayar",
					backgroundColor: 'red',
					borderColor: '#fdaf4b',
					data: [145, 256, 244, 233, 210, 279, 287, 253],
				}],
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position : 'bottom'
				},
				title: {
					display: true,
					text: 'Traffic Stats'
				},
				tooltips: {
					mode: 'index',
					intersect: false
				},
				responsive: true,
				scales: {
					xAxes: [{
						stacked: true,
					}],
					yAxes: [{
						stacked: true
					}]
				}
			}
		});

	</script>
	
</body>

</html>