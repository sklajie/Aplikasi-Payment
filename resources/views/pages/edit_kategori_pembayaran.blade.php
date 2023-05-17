@extends('layouts.app')

@section('title' , 'Edit Kategori' , 'active')

@section('content')
<br>
<div class="main-panel">
    <div class="page-inner">
        <h1 class="text-center mb-4">Edit Kategori</h1>
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
                <a href="/users">Kategori Pembayaran</a>
            </li>

            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>

            <li class="nav-item">
                <a href="/kategori_pembayaran/edit">Edit Kategori</a>
            </li>
        </ul>
        </div>
    </div>
        <br>
        <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('kategori_pembayaran.update', $kategori_pembayaran->id) }}" method="POST"  >
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="kategori_pembayaran" class="form-label">Nama Kategori</label>
                        <input id="kategori_pembayaran" type="text" class="form-control @error('kategori_pembayaran') is-invalid @enderror" value="{{$kategori_pembayaran->kategori_pembayaran}}" name="kategori_pembayaran" required autocomplete="kategori_pembayaran" autofocus>

                                @error('kategori_pembayaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                
                    <button type="submit" class="btn btn-primary float" style="width: 100px;">Edit</button>   
                    <a href="/users" class="btn btn-danger" style="width: 100px;">Kembali</a>
                </form>
                
        </div>
    </div>
</div>
</div>
@endsection