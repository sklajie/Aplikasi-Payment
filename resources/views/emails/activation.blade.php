<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pembayaran UKT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        h2 {
            color: #333;
        }
        p {
            margin-bottom: 10px;
        }
        .logo {
            max-width: 200px;
        }
    </style>
</head>
<body>
    <h2>Pembayaran UKT</h2>
    <img src="{{ url('') }}assets/img/logo_polindra.png" alt="Logo Polindra" class="logo">
    <p>Dear Mahasiswa,</p>
    <p>Dengan Nama : {{ $nama }}</p>
    <p>Berikut adalah detail pembayaran Anda:</p>
    <ul>
        <li><strong>Nomor Virtual Account (VA):</strong> {{ $va }}</li>
        <li><strong>Tanggal Aktif:</strong> {{ $activeDate }}</li>
        <li><strong>Tanggal Nonaktif:</strong> {{ $inactiveDate }}</li>
    </ul>
    <p>Mohon lakukan pembayaran sebelum tanggal nonaktif untuk memastikan pembayaran Anda diproses dengan sukses.</p>
    <p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, jangan ragu untuk menghubungi tim dukungan kami.</p>
    <p>Terima kasih telah menggunakan layanan kami.</p>
    <p>Salam kami,</p>
    <p>Tim Gateway Pembayaran</p>
</body>
</html>
