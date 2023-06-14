<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Aktivasi VA Berhasil</title>
</head>
<body>
    <h2>Selamat, VA Anda telah diaktivasi!</h2>
    <p>Berikut adalah detail VA Anda:</p>
    <ul>
        <li>Nomor VA: {{ $va }}</li>
        <li>Tanggal Aktivasi: {{ $activeDate }}</li>
        <li>Tanggal Nonaktif: {{ $inactiveDate }}</li>
    </ul>
    <p>Terima kasih telah menggunakan layanan kami.</p>
</body>
</html>
