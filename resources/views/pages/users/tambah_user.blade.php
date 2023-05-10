@extends('layouts.app')

@section('title' , 'Tambah Pengguna' , 'active')

@section('content')
<br>
<div class="main-panel">
    <div class="page-inner">
        <h1 class="text-center mb-4">Tambah Pengguna</h1>
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
                <a href="/users">Data Pengguna</a>
            </li>

            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>

            <li class="nav-item">
                <a href="/users/create">Tambah Pengguna</a>
            </li>
        </ul>
        </div>
    </div>
        <br>
        <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST"  >
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                    
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username">

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                    
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No Handphone</label>
                        <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp">
                    
                        @error('no_hp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="level_id" class="form-label">Status</label>
                        <select id="level_id" class="form-control" name="level_id">
                            <option value="" hidden></option>
                            @foreach ($level as $levels)
                                <option value="{{$levels->id}}">{{$levels->nama_level}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-md-end">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                    
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary float" style="width: 100px;">Tambah</button>   
                    <a href="/users" class="btn btn-danger" style="width: 100px;">Kembali</a>
                </form> 
        </div>
    </div>
</div>
</div>
@endsection