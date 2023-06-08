@extends('layouts.app')

@section('title' , 'Dashboard' , 'active')

@section('content')   

            <div class="main-panel">
				<div class="panel-header">
					<div class="page-inner">
						<div class="page-header container-fluid">
							<h4 class="page-title" style="padding-top: 10px;">Dashboard</h4>
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
								<div class="card-title">Statistik Data</div>
							</div>
                            @if (Auth::user()->level['nama_level'] == 'Super Admin')
							<div class="card-body">
                                <div class="row">
                                    <div class="chart col-md-3">
                                        <center>
                                            <canvas id="doughnut" width="150" height="150"></canvas>
                                        </center>
                                        <center>
                                            <div style="font-weight:bold; font-size:20px;">{{count($userall)}}</div>
                                        </center>
                                    </div>
                                    <div class="chart col-md-3">
                                        <center>
                                            <canvas id="doughnutpembayaran" width="150" height="150"></canvas>
                                        </center>
                                        <center>
                                            <div style="font-weight:bold; font-size:20px;">{{count($pembayaranall)}}</div>
                                        </center>
                                    </div>
                                    <div class="chart col-md-3">
                                        <center>
                                            <canvas id="doughnutlunas" width="150" height="150"></canvas>
                                        </center>
                                        <center>
                                            <div style="font-weight:bold; font-size:20px;">{{count($lunasall)}}</div>
                                        </center>
                                    </div>
                                    <div class="chart col-md-3">
                                        <center>
                                            <canvas id="doughnutbelumlunas" width="150" height="150"></canvas>
                                        </center>
                                        <center>
                                            <div style="font-weight:bold; font-size:20px;">{{count($belumlunasall)}}</div>
                                        </center>
                                    </div>
                                </div>
							</div>
                            @elseif (Auth::user()->level['nama_level'] == 'Admin Keuangan')  
                            <div class="card-body">
                                <div class="row">
                                    <div class="chart col-md-4">
                                        <center>
                                            <canvas id="doughnutpembayaran" width="150" height="150"></canvas>
                                        </center>
                                        <center>
                                            <div style="font-weight:bold; font-size:20px;">{{count($pembayaranall)}}</div>
                                        </center>
                                    </div>
                                    <div class="chart col-md-4">
                                        <center>
                                            <canvas id="doughnutlunas" width="150" height="150"></canvas>
                                        </center>
                                        <center>
                                            <div style="font-weight:bold; font-size:20px;">{{count($lunasall)}}</div>
                                        </center>
                                    </div>
                                    <div class="chart col-md-4">
                                        <center>
                                            <canvas id="doughnutbelumlunas" width="150" height="150"></canvas>
                                        </center>
                                        <center>
                                            <div style="font-weight:bold; font-size:20px;">{{count($belumlunasall)}}</div>
                                        </center>
                                    </div>
                                </div>
							</div>
                        @endif
                    </div>
                </div>

						<div class="card">
							<div class="card-header">
								<div class="card-title">Presentase Pelunasan</div>
							</div>
							<div class="card-body">
								<div class="row">
								<div class="col md-5">
									<label for="semester">Tahun Akademik</label>
									<select id="semester" class="form-control filter" onchange="applyFilter()">
										<option value="">Semua</option>
										@foreach($tahunAkademikOptions as $tahunAkademikOption)
										<option value="{{ $tahunAkademikOption }}" {{ $tahunAkademikOption == $tahunAkademik ? 'selected' : '' }}>
											{{ $tahunAkademikOption }}</option> 
										@endforeach
									</select>
								</div>

								<div class="col md-5">
									<label for="tahun_akademik">Semester</label>
									<select id="tahun_akademik" class="form-control filter" onchange="applyFilter()">
										<option value="">Semua</option>
										@foreach($semesterOptions as $semesterOption)
										<option value="{{ $semesterOption }}" {{ $semesterOption == $semester ? 'selected' : '' }}>
											{{ $semesterOption }}</option>
										@endforeach
									</select>	
								</div>
							</div>
								<div class="chart-container">
									<center>
										<canvas id="pieChart" width="400" height="400"></canvas>
									</center>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

		<script>
			function applyFilter() {
    // Ambil nilai filter tahun akademik dan semester dari elemen HTML
    let tahunAkademik = document.getElementById('tahun_akademik').value;
    let semester = document.getElementById('semester').value;

    // Kirim permintaan AJAX ke server
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Tanggapi permintaan sukses, perbarui data dan buat ulang pie chart dan bar chart
                let responseData = JSON.parse(xhr.responseText);
                updateCharts(responseData);
            } else {
                // Tanggapi permintaan gagal
                console.error('Terjadi kesalahan saat memuat data');
            }
        }
    };

    // URL endpoint untuk mengambil data dengan filter
    let url = '/chart-data?tahun_akademik=' + tahunAkademik + '&semester=' + semester;

    // Kirim permintaan GET
    xhr.open('GET', url);
    xhr.send();
}

function updateCharts(data) {
    // Hitung total jumlah data
    let totalCount = data.reduce((total, item) => total + item.count, 0);

    // Proses data dan konversi ke presentasi
    let stats = data.map(item => {
        let percentage = ((item.count / totalCount) * 100).toFixed(2);
        if (item.status === 0) {
            return "Belum Lunas (" + percentage + "%)";
        } else {
            return 'Lunas (' + percentage + "%)";
        }
    });
    let count = data.map(item => item.count);

    // Update data dan tampilkan ulang pie chart
    pieChart.data.labels = stats;
    pieChart.data.datasets[0].data = count;
    pieChart.update();

    // Update data dan tampilkan ulang bar chart
    barChart.data.datasets[0].data = count;
    barChart.update();
}

document.addEventListener("DOMContentLoaded", function(event) {
    // Ambil data dari backend melalui Laravel (contoh menggunakan JSON)
    let data = {!! json_encode($data) !!};

    // Ambil data semester dari elemen HTML
    let semesterOptions = {!! json_encode($semesterOptions) !!};

    // Hitung total jumlah data
    let totalCount = data.reduce((total, item) => total + item.count, 0);

    // Proses data dan konversi ke presentasi
    let stats = data.map(item => {
        let percentage = ((item.count / totalCount) * 100).toFixed(2);
        if (item.status === 0) {
            return "Belum Lunas (" + percentage + "%)";
        } else {
            return 'Lunas (' + percentage + "%)";
        }
    });
    let count = data.map(item => item.count);

    // Buat pie chart
    let ctxPie = document.getElementById('pieChart').getContext('2d');
    let pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: stats,
            datasets: [{
                data: count,
                backgroundColor: [
                    '#ffb2b2',
                    'rgb(179, 255, 171)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        // Ambil data dari backend melalui Laravel (contoh menggunakan JSON)
        let user = {!! json_encode($user) !!};

        let countUsers = user.map(item => item.countUser);

        // Buat pie chart
        let ctxDoughnut = document.getElementById('doughnut').getContext('2d');
        let doughnutChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Pengguna'],
                datasets: [{
                    data: countUsers,
                    backgroundColor: [
                        '#a1bcff',
                    ],
                    borderWidth: 1,

                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        // Ambil data dari backend melalui Laravel (contoh menggunakan JSON)
        let datapembayaran = {!! json_encode($pembayaran) !!};

        let countpembayaran = datapembayaran.map(item => item.countpembayaran);

        // Buat pie chart
        let ctxDoughnut = document.getElementById('doughnutpembayaran').getContext('2d');
        let doughnutChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Semua Data Pembayaran'],
                datasets: [{
                    data: countpembayaran,
                    backgroundColor: [
                        '#efbbff',
                    ],
                    borderWidth: 1,

                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        // Ambil data dari backend melalui Laravel (contoh menggunakan JSON)
        let datalunas = {!! json_encode($lunas) !!};

        let countlunas = datalunas.map(item => item.countlunas);

        // Buat pie chart
        let ctxDoughnut = document.getElementById('doughnutlunas').getContext('2d');
        let doughnutChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Pembayaran Lunas'],
                datasets: [{
                    data: countlunas,
                    backgroundColor: [
                        '#ffb2b2',
                    ],
                    borderWidth: 1,

                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        // Ambil data dari backend melalui Laravel (contoh menggunakan JSON)
        let databelumlunas = {!! json_encode($belumlunas) !!};

        let countbelumlunas = databelumlunas.map(item => item.countbelumlunas);

        // Buat pie chart
        let ctxDoughnut = document.getElementById('doughnutbelumlunas').getContext('2d');
        let doughnutChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Pembayaran Belum Lunas'],
                datasets: [{
                    data: countbelumlunas,
                    backgroundColor: [
                        'rgb(179, 255, 171)',
                    ],
                    borderWidth: 1,

                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>

	

<script src="https://code.highcharts.com/highcharts.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
