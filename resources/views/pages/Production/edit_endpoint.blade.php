@extends('layouts.app3')

@section('title' , 'Tambah Endpoint' , 'active')

@section('content')
<br>
<div class="main-panel">
    <div class="page-inner">
        <h1 class="text-center mb-4">Tambahkan Data Endpoint</h1>
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
                <a href="/api">Data Endpoint</a>
            </li>

            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>

            <li class="nav-item">
                <a href="/production/editEndpoint">Tambahkan Endpoint</a>
            </li>
        </ul>
        </div>
    </div>
        <br>
        <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{route('production.update',$user->id)}}" method="POST"  >
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="endpoint" class="form-label">Endpoint</label>
                        <input id="endpoint" type="text" class="form-control @error('endpoint') is-invalid @enderror" value="{{$user->endpoint}}" name="endpoint" required autocomplete="endpoint" autofocus>

                                @error('endpoint')
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