@extends('layouts.auth')

@section('content')
    <main class="auth-minimal-wrapper">
        <div class="auth-minimal-inner">
            <div class="minimal-card-wrapper">
                <div class="card mb-4 mt-5 mx-4 mx-sm-0 position-relative">
                    <div class="wd-50 bg-white p-2 rounded-circle shadow-lg position-absolute translate-middle top-0 start-50">
                        <img src="{{ asset('assets/images/logo-abbr.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="card-body p-sm-5">
                        <h2 class="fs-20 fw-bolder mb-4">Client Registration</h2>
                        <form action="{{ url('/client-register') }}" method="post" class="w-100 mt-4 pt-2">
                            @csrf
                            <div class="form-group mb-4">
                                <input type="text" class="form-control mb-3" placeholder="PINFL" name="pinfl" value="{{ old('pinfl') }}">
                                @error('pinfl')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" class="form-control mb-3" placeholder="INN" name="inn" value="{{ old('inn') }}">
                                @error('inn')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" class="form-control mb-3" placeholder="Password" name="password" required>
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" class="form-control mb-3" placeholder="Confirm Password" name="password_confirmation" required>
                            </div>
                            <div class="mt-4 mb-3">
                                <button type="submit" class="btn btn-lg btn-primary w-100">Register</button>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('client.login') }}" class="btn btn-link">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
