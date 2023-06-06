@php
    setlocale(LC_TIME, 'id_ID');
@endphp


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
</head>
<body style="width: 210mm; height: 297mm">

    <div style="width: 100%; height: 200px;">
        <div style="width: 70%;">
            <h4 style="padding:20px; float:left;"><img src="{{ url('') }}/assets/img/logo_polindra.png" width="40px" alt="" > Politeknik Negeri Indramayu</h4>
        </div>
        <div style="width: 30%; float:right;" class="kiri">
            <p style="padding: 20px;">Jl. Raya Lohbener Lama, Kecamatan Lohbener, Kabupaten Indramayu, Jawa Barat 45252 <br>
                (0234) 5746464 <br>

                www.polindra.ac.id</p>
        </div>
	</div>
    <br>
    <div class="container-fluid">
        <div>
            <table class="full mt-1 mb-1" style="margin-top: 50px;">
                <tr>
                    <th width="100">Nama : </th>
                    <td>{{$pembayaran->nama}}</td>
                </tr>
                <tr>
                    <th>NIM :</th>
                    <td>{{$pembayaran->nim}}</td>
                </tr>
                <tr>
                    <th>Prodi :</th>
                    <td>{{$pembayaran->prodi}}</td>
                </tr>
                <tr>
                    <th>Semester :</th>
                    <td>{{$pembayaran->semester}}</td>
                </tr>
                <tr>
                    <th>Email :</th>
                    <td>{{$pembayaran->email}}</td>
                </tr>
                <tr>
                    <th>Telepon :</th>
                    <td>{{$pembayaran->phone}}</td>
                </tr>
            </table>
            <br>
        </div>
        <div>
            <table class="display table table-striped table-hover">
                <thead style="background-color: aquamarine">
                    <tr>
                        <th>jenis pembayaran</th>
                        <th>tanggal bayar</th>
                        <th>Tagihan</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $pembayaran->nama_kategori }}</td>
                        <td>{{ $pembayaran->date }}</td>
                        <td>{{ $pembayaran->amount }}</td>
                        <td>{{ $pembayaran->status }}</td>
                    </tr>
                </tbody>

            </table>

        </div>
        <div style="height:200px"></div>
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

    
</body>


</html>