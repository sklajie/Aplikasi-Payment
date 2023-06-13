@extends('layouts.app')

@section('title', 'Invoice')

@section('content')


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="main-panel">
<div class="container-fluid">
    <div class="main-content" style="min-height: 439px;">
        <section class="section">
            <div class="section-body">
            <div class="row">
            <div class="col-12 mt-3 mb-3">      
                <a href="{{url('')}}/pembayaran/download_pdf/{{$invoice->id}}" class="btn btn-sm btn-primary" id="btn_print"><i class="fas fa-print"></i> Print Invoice</a>
            </div>
            <div class="col-12" id="area_print">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{url('')}}/assets/img/logo_polindra.png" style="width:100px;">
                            <img src="{{url('')}}/assets/img/kampus_merdeka.png" style="width:100px;">
                            <h6>Jl. Lohbener lama No.08, Legok, Kec. Lohbener, Kabupaten Indramayu, Jawa Barat, 45252</h6>
                        </div>
                        <div class="col-md-6" style="font-size:20px; text-align:right;">
                            <div class="mb-2 copy-text" >
                            {{$invoice->invoiceNumber}}
                            </div>
                            <div class="mb-2" style="font-size:20px;">Tanggal : 21agustus</div>
                            @if($invoice->status == 1)
                            <div class="mb-2" style="font-size:15px;">Status :
                                <span class="badge bg-success" style="width: 100px; height: 25px; color:white; font-size:13px;">Lunas</span>
                            </div>
                            @elseif($invoice->invoiceNumber != null && $invoice->status == 0)
                            <div class="mb-2" style="font-size:15px;">Status :
                                <span class="badge bg-warning" style="width: 155px; height: 25px; color:white; font-size:13px;">Menunggu Pembayaran</span>
                            </div>
                            @elseif($invoice->invoiceNumber == null)
                            <div class="mb-2" style="font-size:15px;">Status :
                                <span class="badge bg-dark" style="width: 155px; height: 25px; color:white; font-size:13px;">Belum Diaktivasi</span>
                            </div>
                            @endif

                        </div>
                        <br> <br><br>
                        <br> <br><br>
                        <br> <br><br>
                        <br> <br><br>

                        <div class="col-md-6">
                            <h2>Invoice To:</h2>
                            <h4>{{$invoice->nama}}</h4>
                            <h5>{{$invoice->address}}</h5>
                            <h5>{{$invoice->email}}</h5>
                        </div>
                        <div class="col-md-6" style="font-size:20px; text-align:right;">
                            <div class="mb-2 copy-text" >
                            Payment Details:
                            </div>
                            <div class="mb-2" style="font-size:15px;">Total: Rp.{{$invoice->amount}}</div>
                            <div class="mb-2" style="font-size:15px;">Bank Name: Bank Syariah Indonesia</div>
                            <div class="mb-2" style="font-size:15px;">No Virtual Acount: {{$invoice->va}}</div>
                            </div>
                        </div>
                    
                        <div class="table-responsive">
                        <table class="table table-bordered  table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 80%; font-size:20px;">Item</th>
                                    <th style="text-align: right; font-size:20px;">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                    <td style="font-size:15px;">{{$invoice->kategori_pembayaran}}</td>
                                    <td style="text-align: right; font-size:15px;">{{$invoice->amount}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold; text-align: right; font-size:15px;">Total</td>
                                    <td style="font-weight:bold; text-align: right; font-size:15px;">{{$invoice->amount}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mb-2" style="text-align:right; font-size:15px;">
                            @if($invoice->status == 0)
                                <span class="badge bg-warning" style="width: 155px; height: 25px; color:white; font-size:13px;">Menunggu Pembayaran</span> 
                            @elseif($invoice->status == 1)
                                <span class="badge bg-success" style="width: 100px; height: 25px; color:white; font-size:13px;">Lunas</span>
                            @endif
                        </div>
                        </div>
                        
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
</div>
</div>
</div>

@endsection