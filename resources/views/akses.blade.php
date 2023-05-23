<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ url('') }}/transaksi" method="POST"  >
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input id="name" type="text" class="form-control" name="name">
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">amount</label>
            <input id="amount" type="number" class="form-control" name="amount">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input id="email" type="text" class="form-control" name="email">
        </div>
        <div class="mb-3">
            <label for="regis_number" class="form-label">regis_number</label>
            <input id="regis_number" type="text" class="form-control" name="regis_number">
        </div>
        <button type="submit" class="btn btn-primary float" style="width: 100px;">Tambah</button>   
        <a href="/users" class="btn btn-danger" style="width: 100px;">Kembali</a>
    </form> 
</body>
</html>