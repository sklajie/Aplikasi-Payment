@extends('layouts.app3')

@section('title' , 'API Keys' , 'active')

@section('content')
<br>
<div class="main-panel">
    <div class="page-inner">
        <h1 class="text-center mb-4">API Keys</h1>
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

    <div class="container">
    <div class="alert alert-info">
        <center>
        <div class="" style="padding-top: 50px; padding-bottom:50px;">
            <h1 class="text-center mb-4">Access Key</h1>
            <code class="api_token" style="font-size: 20px; ">{{auth()->user()->api_token}}</code>
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
        <code class="api_token" style="font-size: 20px; ">{{auth()->user()->endpoint}}</code>
        <br>
        <br>
        <br>
        <a href="{{route('api.edit',auth()->user()->id)}}" class="btn btn-warning">Tambahkan atau Edit Endpoint Anda</a>
    </div>
    </center>
</div>

    <div class="alert alert-info">
        <p>Key ini di-generate otomatis oleh sistem. Apabila anda perlu mengganti key anda karena alasan tertentu silahkan hubungi <a data-tjr-open-modal="contact-info-modal" href="#open-info-dialog-modal">kontak support</a></p>
    </div>
</div>
</div>
@endsection