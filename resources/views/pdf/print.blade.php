

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ url('') }}/assets/css/bootstrap.min.css">
    <style type="text/css">
        .kiri h2{
            text-align: left;
                    }
	</style>
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

<div style="padding:15px; width:668px;height:999px;  border:solid 1px grey">
    <div style="padding:15px;;">
        <div class="row">
            <div style="width:100%; height:150px;">
                <div style="float:left; width:50%;">
                    <img src="{{ url('') }}/assets/img/logo_polindra.png" style="width:100px;">
                    <img src="{{ url('') }}/assets/img/kampus_merdeka.png" style="width:100px;">
                    <p>Jl. Lohbener lama No.08, Legok, Kec. Lohbener, Kabupaten Indramayu, Jawa Barat, 45252</h6>
                </div>
                <div style="width:50%; font-size:20px; float:right; text-align:right;">
                    <div class="mb-2 copy-text" >
                    {{$invoice->invoiceNumber}}
                    </div>
                    <div class="mb-2" style="font-size:20px;">Tanggal : {{$invoice->date}}</div>
                    @if($invoice->status == 'dibayar')
                    <div class="mb-2" style="font-size:15px;">Status :
                        <span class="badge bg-success" style="width: 170px; height: 15px; color:white; font-size:13px; padding-top:5px;">Dibayar</span>
                    </div>
                    @elseif($invoice->status == 'menunggu_pembayaran')
                    <div class="mb-2" style="font-size:15px;">Status :
                        <span class="badge bg-warning" style="width: 170px; height: 15px; color:white; font-size:13px; padding-top:5px;">Menunggu Pembayaran</span>
                    </div>
                    @elseif($invoice->status == 'va_nonaktif')
                    <div class="mb-1" style="font-size:15px;">Status :
                        <span class="badge bg-dark" style="width: 170px; height: 15px; color:white; font-size:13px; padding-top:5px;">Belum Dibayar</span>
                    </div>
                    @endif
                </div>
            </div>
            <br> <br><br>
            <div style="width:100%; height:90px;">
                <div style="float:left; width:50%; font-size:20px;">
                    <div class="mb-1 copy-text" >
                    Invoice to:
                    </div>
                    <div style="font-size:15px;">{{$invoice->nama}}</div>
                    <div style="font-size:15px;">{{$invoice->address}}</div>
                    <div style="font-size:15px;">{{$invoice->email}}</div>
                </div>
                <div style="width:50%; font-size:20px; float:right; text-align:right;">
                    <div class="mb-1 copy-text" >
                    Payment Details:
                    </div>
                    <div style="font-size:15px;">Total: Rp.{{$invoice->amount}}</div>
                    <div style="font-size:15px;">Bank Name: Bank Syariah Indonesia</div>
                    <div style="font-size:15px;">No Virtual Acount: {{$invoice->va}}</div>
                </div>
            </div>
            <br>
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
            </div>
            <div class="mb-1" style="text-align:right; font-size:15px;">
                @if($invoice->status == 'dibayar')
                        <span class="badge bg-success" style="width: 170px; height: 15px; color:white; font-size:13px; padding-top:5px;">Dibayar</span>
                    @elseif($invoice->status == 'menunggu_pembayaran')
                        <span class="badge bg-warning" style="width: 170px; height: 15px; color:white; font-size:13px; padding-top:5px;">Menunggu Pembayaran</span>
                    @elseif($invoice->status == 'va_nonaktif')
                        <span class="badge bg-dark" style="width: 170px; height: 15px; color:white; font-size:13px; padding-top:5px;">Belum Dibayar</span>
                    @endif
                <br><br><br>
                <br><br><br>
            </div>
            <center>
                <div class="validasi">
                    <div style="width: 70%; float:left;" >
                    </div>
                    <div style="width: 30%; float:right;">
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

</body>
</html>