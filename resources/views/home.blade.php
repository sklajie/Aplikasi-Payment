@extends('layouts.app')

@section('title' , 'Dashboard' , 'active')

@section('content')           
            <div class="main-panel">
				<div class="panel-header">
					<div class="page-inner">
						<div class="page-header container">
							<h4 class="page-title" style="padding-top: 10px;">Dahboard</h4>
						</div>
						<div>
							<ul class="breadcrumbs">
								<li class="nav-home">
									<a href="/home">
										<i class="flaticon-home"></i>
									</a>
								</li>
								<li class="separator">
									<i class="flaticon-right-arrow"></i>
								</li>

							</ul>
							</div>
							<br>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="container">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Presentase Pelunasan</div>
							</div>
							<div class="card-body">
								<div class="chart-container">
									<canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
								</div>
							</div>
						</div>
					</div>
					<div class="container">
							<div class="card full-height">
								<div class="card-body" style="height:400px;">
									<div class="card-title">Grafik Pembayaran</div>
									<div class="container" >
											<div class="chart-container">
												<canvas id="multipleBarChart"></canvas>
											</div>
										
									</div>
								</div>
							</div>
						</div>
				</div>
			
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="https://www.themekita.com">
									ThemeKita
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Help
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Licenses
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
					</div>				
				</div>
			</footer>
			
		</div>

		<script>

			var multipleBarChart = document.getElementById('multipleBarChart').getContext('2d'),
			pieChart = document.getElementById('pieChart').getContext('2d')
	
			var myMultipleBarChart = new Chart(multipleBarChart, {
				type: 'bar',
				data: {
					labels: ["Semester 1", "Semester 2", "Semester 3", "Semester 4", "Semester 5", "Semester 6", "Semester 7", "Semester 8"],
					datasets : [{
						label: "Sudah Bayar",
						backgroundColor: '#59d05d',
						borderColor: '#59d05d',
						data: '$pieChart',
					},{
						label: "Belum Bayar",
						backgroundColor: 'red',
						borderColor: '#fdaf4b',
						data: '$pieChart'
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
	
	
			var myPieChart = new Chart(pieChart, {
				type: 'pie',
				data: {
					datasets: [{
						data: [50, 35],
						backgroundColor :["#59d05d","red"],
						borderWidth: 0
					}],
					labels: ['Sudah Lunas', 'Belum Lunas'] 
				},
				options : {
					responsive: true, 
					maintainAspectRatio: false,
					legend: {
						position : 'bottom',
						labels : {
							fontColor: 'rgb(154, 154, 154)',
							fontSize: 11,
							usePointStyle : true,
							padding: 20
						}
					},
					pieceLabel: {
						render: 'percentage',
						fontColor: 'white',
						fontSize: 14,
					},
					tooltips: false,
					layout: {
						padding: {
							left: 20,
							right: 20,
							top: 20,
							bottom: 20
						}
					}
				}
			})
		</script>
@endsection
