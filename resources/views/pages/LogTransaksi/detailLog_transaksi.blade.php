@extends('layouts.app3')

@section('title', 'Log Transaksi - Detail')

@section('content')

<style>

.gradient-custom {
/* fallback for old browsers */
background: #f6d365;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right bottom, rgb(206, 206, 206), rgb(159, 159, 159));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right bottom, rgb(212, 212, 212), rgb(157, 157, 157))
}

</style>

<br>
<div class="main-panel">
    <div class="page-inner">
      <div class="list-content">
        <section class="ro-docs" id="memulai">
            <h2>Detail Log Transaksi</h2>
            <hr>
            <h3>Data</h3>
        </section>

        <section id="ringkasan">
            <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width: 20%">ID</td>
                                <th>{{ $data->id  }}</th>
                            </tr>
                            <tr>
                                <td style="width: 20%">Nama</td>
                                <th>{{ $data->name }}</th>
                            </tr>
                            <tr>
                                <td style="width: 20%">Email</td>
                                <th>{{ $data->email  }}</th>
                            </tr>
                            <tr>
                                <td style="width: 20%">Nomor Pendaftaran</td>
                                <td>{{ $data->regis_number  }}</td>
                            </tr>
                            <tr>
                                <td style="width: 20%">Amount</td>
                                <th>{{ $data->amount  }}</th>
                            </tr>
                            <tr>
                                <td style="width: 20%">tanggal Pembayaran</td>
                                <th>{{ $data->paid_date  }}</th>
                            </tr>
                            <tr>
                                <td style="width: 20%">Status Pembayaran</td>
                                <th>{{ $data->paid  }}</th>
                            </tr>
                        </tbody>
                    </table>
        </section>
        <br>
@foreach ($histori as $item)
        <section id="request">
            <h3>Log</h3>

            <ul class="nav nav-tabs ro-doc-tabs">
                <li><a class="btn btn-outline-primary active" data-toggle="tab" href="#request-url{{ $item->id }}">URL</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#request-api{{ $item->id }}">request</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#response-api{{ $item->id }}">response</a></li>
            </ul>
            <br>
            <div class="tab-content">
                <div class="tab-pane active" id="request-url{{ $item->id }}">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>log ID</td>
                                <td>Method</td>
                                <td>URL</td>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->method }}</td>
                                <td>http://localhost:8000/api/v1/transactions</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <style>
                    .json-container {
                        padding: 10px;
                        height: 200px;
                        background-color: #f1f1f1;
                        border: 1px solid #ccc;
                        overflow-x: auto;
                        font-family: 'Courier New', Courier, monospace;
                    }
                </style>
                
                <div class="tab-pane fade" id="request-api{{ $item->id }}">
                    <div class="json-container">
                        <pre>{{ json_encode(json_decode($item->request_body))  }}</pre>
                    </div>
                </div>
                <div class="tab-pane fade" id="response-api{{ $item->id }}">
                    <div class="json-container">
                        <pre>{{ $item->respons }}</pre>
                    </div>
                </div>
                

            </div>
        </section>
        <br>
    </div>

    {{-- <script>
    // Contoh data JSON
    var jsonDataRequest = {!! $item->request !!};
    var jsonDataResponse = {!! $item->response !!};

    // Mengambil elemen kontainer di HTML
    var containerRequest = document.getElementById("request-api{{ $item->id }}");
    var containerResponse = document.getElementById("response-api{{ $item->id }}");

    // Membuat tampilan teks JSON
    var jsonTextRequest = JSON.stringify(jsonDataRequest, null, 2);
    var jsonTextResponse = JSON.stringify(jsonDataResponse, null, 2);

    // Menambahkan tampilan teks JSON ke dalam elemen kontainer
    containerRequest.innerHTML = "<pre>" + jsonTextRequest + "</pre>";
    containerResponse.innerHTML = "<pre>" + jsonTextResponse + "</pre>";

    </script> --}}
@endforeach

<br>
        <div class="alert alert-info">
            <p>Jika ada yang ingi di konfirmasi silahkan hubungi <a data-tjr-open-modal="contact-info-modal" href="#open-info-dialog-modal">kontak support</a></p>
        </div>
    </div>
</div>

@endsection