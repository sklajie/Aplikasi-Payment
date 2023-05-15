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
            text-align: left
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
            <ul>
                <li>nama</li>
                <li>nim</li>
                <li>va</li>
                <li>prodi</li>
                <li>Semster</li>
            </ul>
        </div>
        <div>
            <table class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>jenis pembayaran</th>
                        <th>jumlah</th>
                        <th>tanggal bayar</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>UKT</td>
                        <td>Rp 5.000.000</td>
                        <td>-</td>
                        <td>Belum Lunas</td>
                    </tr>
                </tbody>

            </table>

        </div>
        <div style="height:200px"></div>
        <div class="validasi">
            <div style="width: 80%; float:left;" >
            </div>
            <div style="width: 20%; float:right;">
                <p>27 januari 2023</p>
            </div>
        </div>
    </div>

    
</body>
</html>