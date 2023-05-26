@extends('layouts.app')

@section('title' , 'Dashboard' , 'active')

@section('content')   

            <div class="main-panel">
				<div class="panel-header">
					<div class="page-inner">
						<div class="page-header container-fluid">
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
					<div class="container-fluid">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Presentase Pelunasan</div>
							</div>
							<div class="card-body">
								<div class="chart-container">
									<center>
									<div id="pieChart" style="width:400px;"></div>
									</center>
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Grafik Pembayaran</div>
							</div>
							<div class="card-body">
								<div class="chart-container">
									<canvas id="MultipleChart"></canvas>
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


<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
	// Inisialisasi data pembayaran
	var pembayaran = {!! json_encode($pembayaran) !!}

	// Konfigurasi grafik
	var options = {
		chart: {
			renderTo: 'pieChart',
			plotBackgroundColor: null,
			plotBorderWidth: null,
			
			plotShadow: null,
			type: 'pie'
		},
		title: {
			text: 'Presentasi Pembayaran'
		},
		tooltip: {
			pointFormat: '{series.name} : <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b></b>: {point.percentage:.1f} %',
				},
				colors: [ 'rgba(255, 0, 0, 0.5)','rgba(0, 255, 0, 0.5)']
			}
		},
		series: [{
			name: 'Pembayaran',
			data: []
		}]
	};

	// Mengisi data pembayaran ke dalam grafik
	pembayaran.forEach(function(item) {
		options.series[0].data.push([item.status, item.count]);
	});

	// options.plotOptions.pie.showInLegend = true;
    // options.plotOptions.pie.dataLabels.enabled = false;

	// Membuat grafik pie chart
	var chart = new Highcharts.Chart(options);
</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>




var data = {
  labels: ['Kategori 1', 'Kategori 2', 'Kategori 3'],
  datasets: [
    {
      label: 'Lunas',
      data: $countlunas ,
	  backgroundColor: 'rgba(0, 255, 0, 0.5)'
    },
    {
      label: 'Belum Lunas',
      data: $countbelumlunas,
	  backgroundColor: 'rgba(255, 0, 0, 0.5)'
    }
  ]
};

  var ctx = document.getElementById('MultipleChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  

</script>

	

@endsection
