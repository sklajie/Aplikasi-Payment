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
                                <td>http://localhost:8000/api/v1/transactions</td>
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
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="request-example">
                  <script src="https://gist.github.com/sklajie/8b6e8baffb2d44aebf18bd5904eac4a3.js"></script>
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
                    <script src="https://gist.github.com/sklajie/5988180675ac8b4fe5b9389324aca954.js"></script>
                </div>
                <div class="tab-pane fade" id="response-gagal">
                    <script src="https://gist.github.com/sklajie/0f3e8e7294a0c3beede43f9647f5d4f1.js"></script>
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
    </div>
<br><br><br>
        <div class="alert alert-info">
            <p>Jika ada yang ingi di konfirmasi silahkan hubungi <a data-tjr-open-modal="contact-info-modal" href="#open-info-dialog-modal">kontak support</a></p>
        </div>
    </div>
</div>

@endsection