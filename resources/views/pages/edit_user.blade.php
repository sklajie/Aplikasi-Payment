@extends('layouts.app')

@section('title' , 'Edit User' , 'active')

@section('content')
<div class="main-panel">
    <div class="container">
        <h1 class="text-center mb-4">Edit Data</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST"  >
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" name="name" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email" disabled>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Status</label>
                        <select id="role" class="form-control" name="role_id">
                            <option value="{{$user->level_id}}" hidden>{{$user->level}}</option>
                            @foreach ($level as $levels)
                                <option value="{{$levels->id}}">{{$levels->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-md-end">Password</label>
                        <input type="text" class="form-control" name="password" id="password" disabled  >
                    </div>
                    <button type="submit" class="btn btn-primary float" style="width: 100px;">Edit</button>   
                    <a href="/user" class="btn btn-danger" style="width: 100px;">Kembali</a>
                </form>
                
        </div>
    </div>
</div>
</div>
@endsection