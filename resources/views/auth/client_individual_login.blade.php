@extends('layouts.auth')

@section('content')
    <main class="auth-minimal-wrapper">
        <div class="auth-minimal-inner">
            <div class="minimal-card-wrapper">
                <div class="card mb-4 mt-5 mx-4 mx-sm-0 position-relative shadow-sm">
                    <div class="wd-50 bg-white p-2 rounded-circle shadow-lg position-absolute translate-middle top-0 start-50">
                        <img src="{{ asset('assets/images/logo-abbr.png') }}" alt="Logo" class="img-fluid">
                    </div>
                    <div class="card-body p-sm-5">
                        <h2 class="fs-20 fw-bolder mb-4 text-center">Client Login</h2>
                        <div class="d-flex justify-content-around mb-4">
                            <button class="btn btn-outline-primary active">Jismoniy shaxs</button>
                            <a href="{{ route('client_legal_login_form') }}" id="legal-btn" class="btn btn-outline-secondary">Yuridik shaxs</a>
                        </div>

                        <form id="individual-form" action="{{ route('client_individual_login') }}" method="post" class="w-100 mt-4 pt-2">
                            @csrf
                            <div class="mb-4">
                                <input id="pinfl-field" type="text" class="form-control" placeholder="PINFL" name="pinfl" required maxlength="14">
                            </div>
                            <div id="password-field" class="mb-3 d-none">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                            </div>

                            <div class="mt-4 mb-3">
                                <button type="submit" class="btn btn-lg btn-primary w-100" onclick="checkPINFL()">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function checkPINFL() {
            var pinfl = document.getElementById('pinfl-field').value;
            fetch(`/check-pinfl?pinfl=${pinfl}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        document.getElementById('password-field').classList.remove('d-none');
                    } else {
                        Toastify({
                            text: "PINFL topilmadi, registratsiya sahifasiga o'tkazamiz!",
                            duration: 5000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#f00",
                        }).showToast();

                        setTimeout(function() {
                            window.location.href = "{{ route('client_individual_register_form') }}";
                        }, 5000);
                    }
                });
        }
    </script>

    <style>
        .card {
            border: none;
            border-radius: 1rem;
        }
        .form-label {
            font-weight: 500;
        }
        .form-control {
            border-radius: .5rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: .5rem;
        }
        .btn-outline-primary.active {
            background-color: #007bff;
            color: #fff;
        }
        .btn-outline-secondary {
            border-radius: .5rem;
        }
    </style>
@endsection
