<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="container">

    <form action="post" method="post">
        @csrf
        <div class="mt-3">
            <label for="=rigin">Asal Kota</label>
            <select name="origin" id="origin">
                <option value="">Pilih Kota Asal</option>
            </select>
        </div>
        <div class="mt-3">
            <label for="=estination">Kota Tujuan</label>
            <select name="destination" id="destination">
                <option value="">Pilih Kota Tujuan</option>
            </select>
        </div>
        <div class="mt-3">
            <label for="=estination">Kota Tujuan</label>
            <input type="number" name="weight" id="weight" id="weight" class="form-control">
        </div>
    </div>
    <div class="mt-3">
        <label for="=ourier">Pilih Pengiriman</label>
        <select name="courier" id="courier">
            <option value="pos">POS</option>
            <option value="jne">JNE</option>
            <option value="tiki">TIKI</option>
        </select>
    </div>   
    
    <div class="mt-3">
        <input type="submit" name="cekOngkir" class="btn btn-primary">
    </div>
    </form>
</div>
</body>
</html>