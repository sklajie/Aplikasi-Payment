@extends('layouts.app')

@section('title' , 'Access Key' , 'active')

@section('content')
<br>
<div class="main-panel">
    <div class="page-inner">
        <h1 class="text-center mb-4">Access Key</h1>
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
    <div class="card">
<table class="table borderless no-bg">
<tbody><tr>
<td class="bold">ID Merchant</td>
<td>
<input class="config-info-input" interaction="click-select" readonly="" type="text" value="G351147367">
</td>
</tr>
<tr>
<td class="bold">Client Key</td>
<td>
<input class="config-info-input" interaction="click-select" readonly="" type="text" value="Mid-client-UuW6WUx2LBKoFbl3">
</td>
</tr>
<tr>
    <td class="bold">
        Server Key
    </td>

    <td>
        <input class="config-info-input" interaction="click-select" readonly="" type="text" value="Mid-server-4fDJsQVMqfeNHR2Ax1lmjajI">
    </td>
</tr>
</tbody></table>
</div>
    <div class="alert alert-info">
        <p>Key ini di-generate otomatis oleh sistem. Apabila anda perlu mengganti key anda karena alasan tertentu silahkan hubungi <a data-tjr-open-modal="contact-info-modal" href="#open-info-dialog-modal">kontak support</a></p>
    </div>
</div>
</div>
@endsection