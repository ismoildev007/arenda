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
                        <h2 class="fs-20 fw-bolder mb-4">Client Login</h2>
                        <div class="d-flex justify-content-around mb-4">
                            <button class="btn btn-outline-primary active">Jismoniy shaxs</button>
                            <a href="{{ route('legal') }}" id="legal-btn" class="btn btn-outline-secondary">Yuridik shaxs</a>
                        </div>
                        <form id="auth-form" action="{{ route('clients.authenticate') }}" method="post" class="w-100 mt-4 pt-2">
                            @csrf
                            <div id="login-fields" class="mb-4">
                                <div id="pinfl-field" class="form-group">
                                    <input id="pinfl" type="text" class="form-control mb-3" placeholder="PINFL" name="pinfl" pattern="\d{14}" title="PINFL should be exactly 14 digits long" required>
                                    <div id="pinfl-error" class="text-danger d-none">PINFL 14 ta raqamdan iborat bo‘lishi kerak.</div>
                                </div>
                                <div id="password-field" class="form-group d-none">
                                    <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
                                </div>
                            </div>
                            <div class="mt-4 mb-3">
                                <button type="submit" id="btnBu" class="btn btn-lg btn-primary w-100" onclick="checkIdentifier()">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <style>
        .input-error {
            border: 2px solid red;
        }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {
            var pinflInput = document.getElementById('pinfl');

            pinflInput.addEventListener('input', function () {
                var value = pinflInput.value;

                value = value.replace(/\D/g, '').slice(0, 14);
                pinflInput.value = value;

                if (value.length < 14) {
                    pinflInput.classList.add('input-error');
                } else {
                    pinflInput.classList.remove('input-error');
                }
            });
        });

        function checkIdentifier() {
            var pinfl = document.getElementById('pinfl').value;
            var pinflField = document.getElementById('pinfl');
            var pinflError = document.getElementById('pinfl-error');

            pinflField.classList.remove('input-error');
            pinflError.classList.add('d-none');

            if (pinfl.length !== 14) {
                pinflField.classList.add('input-error');
                pinflError.classList.remove('d-none');
                return;
            }

            fetch(`/check-pinfl?pinfl=${pinfl}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('btnBu').type = 'submit';
                    if (data.exists) {
                        document.getElementById('password-field').classList.remove('d-none');
                    } else {
                        document.getElementById('password-field').classList.remove('d-none');
                    }
                })
                .catch(error => console.error('Error:', error));
        }


    </script>
@endsection
