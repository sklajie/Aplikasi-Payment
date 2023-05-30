@extends('layouts.app4')

@section('title' , 'API Keys' , 'active')

@section('content')
<br>
<div class="main-panel">
    <div class="page-inner">
        <h1 class="text-center mb-4">API Keys - Sandbox</h1>
    <div>
        <ul class="breadcrumbs">

            <li class="nav-home">
                <a href="/home">
                    <i class="flaticon-home"></i>
                </a>
            </li>

            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>

            <li class="nav-item">
                <a href="/api">Access Key</a>
            </li>
        </ul>
        </div>
    </div>

    <div class="container-fluid">
    <div class="alert alert-info">
        <center>
        <div class="" style="padding-top: 50px; padding-bottom:50px;">
            <h1 class="text-center mb-4">Access Key</h1>
            <code class="api_token" style="font-size: 20px; ">{{auth()->user()->id}}</code>
            <br>
            <br>
            <p class="text-warning">
                <small>
                    <strong>Peringatan:</strong> API key Anda berfungsi layaknya username dan password. Jaga baik-baik API key Anda!
                </small>
            </p>
        </div>
        </center>
</div>

<div class="alert alert-info">
    <center>
    <div class="" style="padding-top: 50px; padding-bottom:50px;">
        <h1 class="text-center mb-4">Endpoint Anda</h1>
        <br>
        <code class="api_token" style="font-size: 20px; ">{{auth()->user()->endpoint}}</code>
        <br>
        <br>
        <br>
        <p class="text-warning" style="font-size:17px;">
            Endpoint ini adalah endpoint aplikasi anda untuk menerima notifikasi atau update response dari kami            
        </p>
    </div>
    </center>
</div>

    <div class="alert alert-info">
        <p>Key ini di-generate otomatis oleh sistem. Apabila anda perlu mengganti key anda karena alasan tertentu silahkan hubungi <a data-tjr-open-modal="contact-info-modal" href="#open-info-dialog-modal">kontak support</a></p>
    </div>
</div>
</div>
@endsection