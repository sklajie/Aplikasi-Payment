<!DOCTYPE html>
<html>
<head>
	<title>Data Karyawan</title>
	<style type="text/css">
		.center{
			text-align: center;
		}
		.full{
			width: 100%;
		}
		.wrapper{
			padding-left: 30px;
			padding-right: 30px;
		}
		.underline{
			text-decoration: underline;
		}
		.bt-1{
			border-top: 2px solid black;
		}
		.bb-1{
			border-bottom: 2px solid black;
		}
		.mt-1{
			margin-top: 5px;
		}
		.mb-1{
			margin-bottom: 5px;
		}
		table tr th,table tr td{
			text-align: left;
		}
	</style>
</head>
<body>


    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
        <div class="main-content" style="min-height: 439px;">
            <section class="section">
                <div class="section-body">
                <div class="row">
                <div class="col-12 mt-3 mb-3">
                    <button class="btn btn-sm btn-primary" id="btn_print"><i class="fas fa-print"></i> Print Invoice</button>
                </div>
                <div class="col-12" id="area_print">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h4>INVOICE</h4>
                            </div>
                            <br><br><br>
                            <div class="col-md-6 col-12">
                                <div class="mb-2 copy-text" style="font-size:20px;">
                                Kode Invoice : 
                                </div>
                                <div class="mb-2" style="font-size:20px;">Tanggal : </div>
                            </div>
                            <div class="col-md-6 col-12" style="font-size:20px;">Status :

                            </div>
                            
                        <div class="col-12 mt-2">
                            <div class="alert alert-primary alert-dismissible show fade">
                                <div class="alert-body" style="text-align: center; font-size:25px;" >
                                Pastikan ID Game sudah benar dan lakukan pembayaran dalam kurun waktu 24 Jam
                                </div>
                            </div>
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body" style="text-align: center; font-size:25px;" >
                                    Pastikan juga transfer sesuai jumlah yang sudah tertera di bawah kode QRIS untuk kelancaran pembelian.
                                </div>
                            </div>
                        </div>
                            <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Game</th>
                                        <th>Nominal</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        {{-- <td>{{$pesanan->nama_game}}</td>
                                        <td>{{$pesanan->ml['diamond']}}DM</td>
                                        <td>{{$pesanan->id_game}}|{{$pesanan->server_game}}</td> --}}
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                            
                        <div class="col-12 mb-3">
                            <center>
                            <img src="/img/qris.jpg" style="width: 400px;">
                            <h4>Pembayaran Dengan QRIS</h4>
                            </center>
                        </div>
    
                        <div class="container">
                            <table class="table table-striped">
                                <tbody>
                                    {{-- <tr>
                                        <td>Harga</td>
                                        <td>Rp.{{$pesanan->ml['harga']}} </td>
                                    </tr>
                                    <tr>
                                        <td>Fee Merchant</td>
                                        <td>Rp.{{$pesanan->fee}}</td>
                                    </tr>
                                    <tr class="text-dark font-weight-bold">
                                        <td>Total yang harus dibayar</td>
                                        <td>Rp.{{$pesanan->ml['harga'] + $pesanan->fee}}</td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    </div>
    </div>
    
</body>
</html>