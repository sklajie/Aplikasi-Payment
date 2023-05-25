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
									<div id="pieChart"></div>
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

		<script type="text/javascript" src="{{ url('https://code.highcharts.com/highcharts.js')}}"></script>
	<script type="text/javascript" src="{{ url('https://code.highcharts.com/modules/exporting.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var pembayaran = <?php echo json_encode($pembayaran); ?>;
			var options = {
				chart : {
					renderTo : 'pieChart',
					plotBackgroundColor : null,
					plotBorderWidth : null,
					plotShadow : null,
				},
				title:{
					text : 'Presentasi Pembayaran'
				},
				tooltip : {
					pointFormat : '{series.name}: <b>{point.percentage}%</b>',
					PrecentageDecimals:1,
				},
				plotOptions : {
					pie:{
						allowPointSelect : true,
						cursor: 'pointer',
						dataLabels : {
							enabled : true,
							color : '#000000',
							connectColor : '#000000',
							formatter:function (){
								return '<b>' + this.point.name + '</b>: ' + this.precentage + '%';
							}
						}
					}
				},
				series : [{
					type:'pie',
					name:'Pembayaran'
				}]
			}
			myarray = [];
			$.each(pembayaran, function(index,val){
				myarray[index] = [val.status,val.count];
			});
			options.series[0].data = myarray;
			chart = new Highcharts.Chart(options);
		});
	</script>

@endsection
