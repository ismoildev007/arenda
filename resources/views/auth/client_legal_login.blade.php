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
                            <a href="{{ route('client_individual_login_form') }}" id="individual-btn" class="btn btn-outline-primary">Jismoniy shaxs</a>
                            <button id="legal-btn" class="btn btn-outline-secondary active">Yuridik shaxs</button>
                        </div>

                        <form id="legalForm" method="POST" action="{{ route('client_legal_login') }}" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="inn" class="form-label">INN:</label>
                                <input type="text" id="inn" name="inn" class="form-control" required maxlength="9" placeholder="INN ni kiriting">
                                <div class="invalid-feedback">
                                    INN 9 raqamdan iborat bo'lishi kerak.
                                </div>
                            </div>
                            <div id="passwordField" class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required placeholder="Parolni kiriting">
                                <div class="invalid-feedback">
                                    Parol bo'sh bo'lishi mumkin emas.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <a href="{{ route('client_legal_register_form') }}" class="text-decoration-none mt-3">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

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

    <script>
        // Bootstrap validatsiya
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })();

        // INN maydoni faqat raqam kiritilishiga ruxsat beradi
        document.getElementById('inn').addEventListener('input', function (e) {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>
@endsection
