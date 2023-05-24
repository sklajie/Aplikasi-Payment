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
                <div class="tab-pane fade" id="request-api{{ $item->id }}">
                  <script src="https://gist.github.com/sklajie/0f3e8e7294a0c3beede43f9647f5d4f1.js"></script>
                </div>
                <div class="tab-pane fade" id="response-api{{ $item->id }}">
                  <script src="https://gist.github.com/sklajie/0f3e8e7294a0c3beede43f9647f5d4f1.js"></script>
                </div>
            </div>
        </section>
        <br>
    </div>
@endforeach

<br>
        <div class="alert alert-info">
            <p>Jika ada yang ingi di konfirmasi silahkan hubungi <a data-tjr-open-modal="contact-info-modal" href="#open-info-dialog-modal">kontak support</a></p>
        </div>
    </div>
</div>

@endsection