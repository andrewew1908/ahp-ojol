@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('proses-login')}}" method="post">
                        @csrf
                        @error('message')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
