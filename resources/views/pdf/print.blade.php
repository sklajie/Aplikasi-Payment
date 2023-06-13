<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ url('') }}/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ url('') }}/assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ url('') }}/assets/css/demo.css">
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
</head>
<body>
    <br><br>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container-fluid" style="padding-left: 40px; padding-right: 40px;">
    <div class="main-content" style="min-height: 439px;">
        <section class="section">
            <div class="section-body">
            <div class="row">
            <div class="col-12" id="area_print">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{url('')}}/assets/img/logo_polindra.png" style="width:100px;">
                            <img src="{{url('')}}/assets/img/kampus_merdeka.png" style="width:100px;">
                            <h6>Jl. Lohbener lama No.08, Legok, Kec. Lohbener, Kabupaten Indramayu, Jawa Barat, 45252</h6>
                        </div>
                        <div class="col-md-6" style="font-size:20px; text-align:right;">
                            <div class="mb-2 copy-text" >
                            {{$invoice->invoiceNumber}}
                            </div>
                            <div class="mb-2" style="font-size:20px;">Tanggal : 21agustus</div>
                            @if($invoice->status == 'dibayar')
                            <div class="mb-2" style="font-size:15px;">Status :
                                <span class="badge bg-success" style="width: 100px; height: 25px; color:white; font-size:13px;">Dibayar</span>
                            </div>
                            @elseif($invoice->status == 'menunggu_pembayaran')
                            <div class="mb-2" style="font-size:15px;">Status :
                                <span class="badge bg-warning" style="width: 155px; height: 25px; color:white; font-size:13px;">Menunggu Pembayaran</span>
                            </div>
                            @elseif($invoice->status == 'belum_dibayar')
                            <div class="mb-2" style="font-size:15px;">Status :
                                <span class="badge bg-dark" style="width: 155px; height: 25px; color:white; font-size:13px;">Belum Dibayar</span>
                            </div>
                            @endif

                        </div>
                        <br> <br><br>
                        <br> <br><br>
                        <br> <br><br>

                        <div class="col-md-6">
                            <h2>Invoice To:</h2>
                            <h4>{{$invoice->nama}}</h4>
                            <h5>{{$invoice->address}}</h5>
                            <h5>{{$invoice->email}}</h5>
                        </div>
                        <div class="col-md-6" style="font-size:20px; text-align:right;">
                            <div class="mb-2 copy-text" >
                            Payment Details:
                            </div>
                            <div class="mb-2" style="font-size:15px;">Total: Rp.{{$invoice->amount}}</div>
                            <div class="mb-2" style="font-size:15px;">Bank Name: Bank Syariah Indonesia</div>
                            <div class="mb-2" style="font-size:15px;">No Virtual Acount: {{$invoice->va}}</div>
                            </div>
                        </div>
                    
                        <div class="table-responsive">
                            <table class="table table-bordered  table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 80%; font-size:15px;">Item</th>
                                        <th style="text-align: right; font-size:15px;">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        
                                        <td style="font-size:15px;">{{$invoice->kategori_pembayaran}}</td>
                                        <td style="text-align: right; font-size:15px;">{{$invoice->amount}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold; text-align: right; font-size:15px;">Total</td>
                                        <td style="font-weight:bold; text-align: right; font-size:15px;">{{$invoice->amount}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        <div class="mb-2" style="text-align:right; font-size:15px;">
                            @if($invoice->status == 'dibayar')
                            <span class="badge bg-success" style="width: 100px; height: 25px; color:white; font-size:13px;">Dibayar</span>
                        @elseif($invoice->status == 'menunggu_pembayaran')
                            <span class="badge bg-warning" style="width: 155px; height: 25px; color:white; font-size:13px;">Menunggu Pembayaran</span>
                        @elseif($invoice->status == 'belum_dibayar')
                            <span class="badge bg-dark" style="width: 155px; height: 25px; color:white; font-size:13px;">Belum Dibayar</span>
                        @endif
                        <br><br><br>
                        <br><br><br>
                        <center>
                            <div class="validasi">
                                <div style="width: 80%; float:left;" >
                                </div>
                                <div style="width: 20%; float:right;">
                                    <div>
                                        <p><span>{{ $formattedTime }}</span></p>
                                    </div>
                                    <div class="ttd" style="height:80px;">
                                        
                                    </div>
                                    <p>(_________________)</p>
                                </div>
                            </div>
                        </center>
                        </div>
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