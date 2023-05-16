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
<body>

    <div style="width: 100%; height: 200px;">
        <div style="width: 70%;">
            <h2 style="padding:20px; float:left;"><img src="{{ url('') }}/assets/img/logo_polindra.png" width="60px" alt="" > Politeknik Negeri Indramayu</h2>
        </div>
        <div style="width: 30%; float:right;" class="kiri">
            <p style="padding: 20px;">Jl. Raya Lohbener Lama, Kecamatan Lohbener, Kabupaten Indramayu, Jawa Barat 45252
                (0234) 5746464

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
        </div>
        <div>
            <table class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>jenis pembayaran</th>
                        <th>tanggal bayar</th>
                        <th>jumlah</th>
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
                        <p>tanggal</p>
                    </div>
                    <div class="ttd" style="height:100px; border-bottom: 1px solid #212121;">
                        <p>(_______________________)</p>
                    </div>
                </div>
            </div>
        </center>
    </div>

    
</body>
</html>