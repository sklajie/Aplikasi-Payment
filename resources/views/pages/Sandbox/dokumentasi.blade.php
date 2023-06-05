@extends('layouts.app4')

@section('title', 'Dokumentasi', 'active')

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
            <p>Dokumentasi ini menjelaskan cara mengakses layanan API Payment Gateway Polindra untuk akun admin apps

            </p>
        </section>
        <section id="ringkasan">
            <hr>
            <h4>Ringkasan</h4>
            <p>Method ini digunakan untuk mendapatkan data dari payment gateway POLINDRA.</p>
        </section>
        <section id="registration">
            <hr>
            <h2  style="font-weight:bold;">Invoice Registration</h2>
        </section>
        <section id="request">
            <h4>Request</h4>
            <ul class="nav nav-tabs ro-doc-tabs">
                <li><a class="btn btn-outline-primary active" data-toggle="tab" href="#request-url">URL</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#request-parameter">Post Data</a></li>
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
                                <td>POST</td>
                                <td>http://payment-gateway.polindra.ac.id/api/v1/dev/transactions</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="request-parameter">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Field</td>
                                <td>Required</td>
                                <td>Type</td>
                                <td>Description</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>amount</td>
                                <td>Yes</td>
                                <td>Double</td>
                                <td>Invoice amount</td>
                            </tr>
                            <tr>
                                <td>name</td>
                                <td>Yes</td>
                                <td>String</td>
                                <td>Customer name</td>
                            </tr>
                            <tr>
                                <td>email</td>
                                <td>Yes</td>
                                <td>String</td>
                                <td>Customer email</td>
                            </tr>
                            <tr>
                                <td>regis_number</td>
                                <td>Yes</td>
                                <td>String</td>
                                <td>Registration Virtual Account</td>
                            </tr>
                            <tr>
                                <td>token</td>
                                <td>Yes</td>
                                <td>String</td>
                                <td>User ID</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="request-example">
                    <script src="https://gist.github.com/sklajie/c57908514d2a7e600fe2fd69b4a1c6fd.js"></script>
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
                    <script src="https://gist.github.com/sklajie/c8dffb1ce25114b36dc56fafea00fadc.js"></script>
                </div>
                <div class="tab-pane fade" id="response-gagal">
                    {{-- <script src="https://gist.github.com/sklajie/0f3e8e7294a0c3beede43f9647f5d4f1.js"></script> --}}
                </div>
                <div class="tab-pane fade" id="penjelasan-request">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Field</td>
                                <td>Type</td>
                                <td>Description</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>pembayaran_lainnya_id</td>
                                <td>String</td>
                                <td>Id request customer </td>
                            </tr>
                            <tr>
                                <td>method</td>
                                <td>String</td>
                                <td>Payment ustomer</td>
                            </tr>
                            <tr>
                                <td>request_body</td>
                                <td>String</td>
                                <td>Request data customer</td>
                            </tr>
                            <tr>
                                <td>respons</td>
                                <td>String</td>
                                <td>Response BSI</td>
                            </tr>
                            <tr>
                                <td>user_id</td>
                                <td>String</td>
                                <td>Id User Apps</td>
                            </tr>
                            <tr>
                                <td>id</td>
                                <td>String</td>
                                <td>ID response</td>
                            </tr>
                            <tr>
                                <td>updated_at</td>
                                <td>Date</td>
                                <td>Update Date</td>
                            </tr>
                            <tr>
                                <td>created_at</td>
                                <td>Date</td>
                                <td>Created Date</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <br>

        <section id="update">
            <hr>
            <h2  style="font-weight:bold;">Update Invoice</h2>
        </section>
        <section id="request">
            <h4>Request</h4>
            <ul class="nav nav-tabs ro-doc-tabs">
                <li><a class="btn btn-outline-primary active" data-toggle="tab" href="#update-url">URL</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#update-parameter">Post Data</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#update-example">Contoh request</a></li>
            </ul>
            <br>
            <div class="tab-content">
                <div class="tab-pane active" id="update-url">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Method</td>
                                <td>URL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PUT</td>
                                <td>http://paymentgateway.polindra.ac.id/api/v1/dev/pembayaran_lainnya/{regis_number}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="update-parameter">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Field</td>
                                <td>Required</td>
                                <td>Type</td>
                                <td>Description</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>amount</td>
                                <td>Yes</td>
                                <td>Double</td>
                                <td>Invoice amount</td>
                            </tr>
                            <tr>
                                <td>name</td>
                                <td>Yes</td>
                                <td>String</td>
                                <td>Customer name</td>
                            </tr>
                            <tr>
                                <td>email</td>
                                <td>Yes</td>
                                <td>String</td>
                                <td>Customer email</td>
                            </tr>
                            <tr>
                                <td>regis_number</td>
                                <td>Yes</td>
                                <td>String</td>
                                <td>Registration Virtual Account</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="update-example">
                    <script src="https://gist.github.com/sklajie/b920721e88f1c2bd483e51a78c835a23.js"></script>
                </div>
            </div>
        </section>
        <br>
        <section id="response">
            <h4>Response</h4>
            <ul class="nav nav-tabs ro-doc-tabs">
                <li><a class="btn btn-outline-primary active" data-toggle="tab" href="#update-response-sukses">Response Sukses</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#update-response-gagal">Response Gagal</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#penjelasan-response-update">Penjelasan Response</a></li>
            </ul>
            <br>
            <div class="tab-content">
                <div class="tab-pane active" id="update-response-sukses">
                    <script src="https://gist.github.com/sklajie/1dba05d48d8901194a49fc10b2e69859.js"></script>
                </div>
                <div class="tab-pane fade" id="update-response-gagal">
                    {{-- <script src="https://gist.github.com/sklajie/0f3e8e7294a0c3beede43f9647f5d4f1.js"></script> --}}
                </div>
                <div class="tab-pane fade" id="penjelasan-response-update">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Field</td>
                                <td>Type</td>
                                <td>Description</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>message</td>
                                <td>String</td>
                                <td>informasi update</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <br>

        <section id="notifikasi">
            <hr>
            <h2  style="font-weight:bold;">Notifikasi</h2>
        </section>
        <section id="request">
            
            <ul class="nav nav-tabs ro-doc-tabs">
                <li><a class="btn btn-outline-primary active" data-toggle="tab" href="#notifikasi-url">URL</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#notifikasi-example">Contoh Notifikasi</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#notifikasi-message">Pesan Notifikasi</a></li>
            </ul>
            <br>
            <div class="tab-content">
                <div class="tab-pane active" id="notifikasi-url">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Method</td>
                                <td>URL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>POST</td>
                                <td>http://payment-gateway.polindra.ac.id/api/v1/dev/notification</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="notifikasi-example">
                    <script src="https://gist.github.com/sklajie/f3ca2d9913fba66d91e8b5a67ca5aec0.js"></script>
                </div>
                <div class="tab-pane fade" id="notifikasi-message">
                    <script src="https://gist.github.com/sklajie/1dba05d48d8901194a49fc10b2e69859.js"></script>
                </div>
            </div>
        </section>
        <br>


        <section id="get data mahasiswa">
            <hr>
            <h2  style="font-weight:bold;">Get Data Mahasiswa</h2>
        </section>
        <section id="request">
            <h4>Request</h4>
            <ul class="nav nav-tabs ro-doc-tabs">
                <li><a class="btn btn-outline-primary active" data-toggle="tab" href="#get-url">URL</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#get-parameter">Post Data</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#get-request">Contoh Request</a></li>
            </ul>
            <br>
            <div class="tab-content">
                <div class="tab-pane active" id="get-url">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Method</td>
                                <td>URL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>POST</td>
                                <td>http://payment-gateway.polindra.ac.id/api/v1/dev/DataTransactions</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="get-parameter">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Field</td>
                                <td>Required</td>
                                <td>Type</td>
                                <td>Description</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>token</td>
                                <td>Yes</td>
                                <td>String</td>
                                <td>User ID</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="get-request">
                    <script src="https://gist.github.com/sklajie/99ec61e6df27a42d6fe9111f8278b579.js"></script>
                </div>
            </div>
        </section>
        <br>

        <section id="response">
            <h4>Response</h4>
            <ul class="nav nav-tabs ro-doc-tabs">
                <li><a class="btn btn-outline-primary active" data-toggle="tab" href="#get-response-sukses">Response Sukses</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#get-response-gagal">Response Gagal</a></li>
            </ul>
            <br>
            <div class="tab-content">
                <div class="tab-pane active" id="get-response-sukses">
                    <script src="https://gist.github.com/sklajie/39272a77e8babd3fcc2118edfd1b519a.js"></script>
                </div>
                <div class="tab-pane fade" id="get-response-gagal">
                    {{-- <script src="https://gist.github.com/sklajie/0f3e8e7294a0c3beede43f9647f5d4f1.js"></script> --}}
                </div>
            </div>
        </section>
        <br>

        <section id="get detail data mahasiswa">
            <hr>
            <h2  style="font-weight:bold;">Get Detail Data Mahasiswa</h2>
        </section>
        <section id="request">
            <h4>Request</h4>
            <ul class="nav nav-tabs ro-doc-tabs">
                <li><a class="btn btn-outline-primary active" data-toggle="tab" href="#get-detail-url">URL</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#get-detail-parameter">Post Data</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#get-detail-request">Contoh Request</a></li>
            </ul>
            <br>
            <div class="tab-content">
                <div class="tab-pane active" id="get-detail-url">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Method</td>
                                <td>URL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>POST</td>
                                <td>http://payment-gateway.polindra.ac.id/api/v1/dev/DataDetailTransactions</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="get-detail-parameter">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Field</td>
                                <td>Required</td>
                                <td>Type</td>
                                <td>Description</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>id</td>
                                <td>Yes</td>
                                <td>String</td>
                                <td>Id Pembayaran</td>
                            </tr>
                            <tr>
                                <td>token</td>
                                <td>Yes</td>
                                <td>String</td>
                                <td>User ID</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="get-detail-request">
                    <script src="https://gist.github.com/sklajie/388ff05033030262aa7894cf522d66bc.js"></script>
                </div>
            </div>
        </section>
        <br>

        <section id="response">
            <h4>Response</h4>
            <ul class="nav nav-tabs ro-doc-tabs">
                <li><a class="btn btn-outline-primary active" data-toggle="tab" href="#get-detail-response-sukses">Response Sukses</a></li>
                <li>&nbsp;<a class="btn btn-outline-primary" data-toggle="tab" href="#get-detail-response-gagal">Response Gagal</a></li>
            </ul>
            <br>
            <div class="tab-content">
                <div class="tab-pane active" id="get-detail-response-sukses">
                    <script src="https://gist.github.com/sklajie/def9f495f4ecc1fc36cc245317b24f45.js"></script>
                </div>
                <div class="tab-pane fade" id="get-detail-response-gagal">
                    {{-- <script src="https://gist.github.com/sklajie/0f3e8e7294a0c3beede43f9647f5d4f1.js"></script> --}}
                </div>
            </div>
        </section>
        <br>
        
    </div>
<br><br><br>
        <div class="alert alert-info">
            <p>Jika ada yang ingi di konfirmasi silahkan hubungi <a data-tjr-open-modal="contact-info-modal" href="#open-info-dialog-modal">kontak support</a></p>
        </div>
    </div>
</div>

@endsection