@extends('layouts.app')

@section('title', 'Dokumentasi')

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

<br><br>
<div class="main-panel">
    <div class="page-inner">
        
      
      <div class="list-content">
        <section class="ro-docs" id="memulai">
            <h3>Dokumentasi API</h3>
            <hr>
            <p>Dokumentasi ini menjelaskan cara mengakses layanan API Payment Gateway Polindra untuk akun

            </p>
        </section>
        <section id="ringkasan">
            <hr>
            <h4>Ringkasan</h4>
            <p>Method ini digunakan untuk mendapatkan data dari payment gateway POLINDRA.</p>
        </section>
        <section id="request">
            <h4>Request</h4>
            <ul class="nav nav-tabs ro-doc-tabs">
                <li><a class="btn btn-outline-primary active" data-toggle="tab" href="#request-url">URL</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#request-parameter">Parameter</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#request-example">Contoh request</a></li>
            </ul>
            <br>
            <div class="tab-content">
                <div class="tab-pane active" id="request-url">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Method</td>
                                <td>URL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>GET</td>
                                <td>http://localhost:8000/api/v1/transactions</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="request-parameter">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Method</td>
                                <td>Parameter</td>
                                <td>Wajib</td>
                                <td>Tipe</td>
                                <td>Keterangan</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>GET/HEAD</td>
                                <td>key</td>
                                <td>Ya</td>
                                <td>String</td>
                                <td>API Key</td>
                            </tr>
                            <tr>
                                <td>GET/HEAD</td>
                                <td>android-key</td>
                                <td>Tidak</td>
                                <td>String</td>
                                <td>Identitas aplikasi Android</td>
                            </tr>
                            <tr>
                                <td>GET/HEAD</td>
                                <td>ios-key</td>
                                <td>Tidak</td>
                                <td>String</td>
                                <td>Identitas aplikasi iOS</td>
                            </tr>
                            <tr>
                                <td>GET</td>
                                <td>id</td>
                                <td>Tidak</td>
                                <td>String</td>
                                <td>ID propinsi</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><strong>Catatan:</strong></p>
                    <ul>
                        <li>p</li>
                        <li>P</li>
                        <li>P</li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="request-example">
                  <script src="https://gist.github.com/sklajie/0f3e8e7294a0c3beede43f9647f5d4f1.js"></script>
                </div>
            </div>
        </section>
        <br>
        <section id="request">
            <h4>Response</h4>
            <ul class="nav nav-tabs ro-doc-tabs">
                <li><a class="btn btn-outline-primary active" data-toggle="tab" href="#response-sukses">Response Sukses</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#response-gagal">Response Gagal</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#penjelasan-request">Penjelasan Response</a></li>
            </ul>
            <br>
            <div class="tab-content">
                <div class="tab-pane active" id="response-sukses">
                    <script src="https://gist.github.com/sklajie/0f3e8e7294a0c3beede43f9647f5d4f1.js"></script>
                </div>
                <div class="tab-pane fade" id="response-gagal">
                    <script src="https://gist.github.com/sklajie/0f3e8e7294a0c3beede43f9647f5d4f1.js"></script>
                </div>
                <div class="tab-pane fade" id="penjelasan-request">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Method</td>
                                <td>Parameter</td>
                                <td>Wajib</td>
                                <td>Tipe</td>
                                <td>Keterangan</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>GET/HEAD</td>
                                <td>key</td>
                                <td>Ya</td>
                                <td>String</td>
                                <td>API Key</td>
                            </tr>
                            <tr>
                                <td>GET/HEAD</td>
                                <td>android-key</td>
                                <td>Tidak</td>
                                <td>String</td>
                                <td>Identitas aplikasi Android</td>
                            </tr>
                            <tr>
                                <td>GET/HEAD</td>
                                <td>ios-key</td>
                                <td>Tidak</td>
                                <td>String</td>
                                <td>Identitas aplikasi iOS</td>
                            </tr>
                            <tr>
                                <td>GET</td>
                                <td>id</td>
                                <td>Tidak</td>
                                <td>String</td>
                                <td>ID propinsi</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><strong>Catatan:</strong></p>
                    <ul>
                        <li>p</li>
                        <li>P</li>
                        <li>P</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
<br><br><br>
        <div class="alert alert-info">
            <p>Jika ada yang ingi di konfirmasi silahkan hubungi <a data-tjr-open-modal="contact-info-modal" href="#open-info-dialog-modal">kontak support</a></p>
        </div>
    </div>
</div>

@endsection