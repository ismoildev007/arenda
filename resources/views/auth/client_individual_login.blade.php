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

                        <form id="individual-form" action="{{ route('client_individual_login') }}" method="post" class="w-100 mt-4 pt-2" novalidate>
                            @csrf
                            <div class="mb-4">
                                <input id="pinfl-field" type="text" class="form-control" placeholder="PINFL" name="pinfl" required maxlength="14" minlength="14">
                                <div class="invalid-feedback">
                                    PINFL 14 ta raqamdan iborat bo'lishi kerak.
                                </div>
                            </div>
                            <div id="password-field" class="mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                                <div class="invalid-feedback">
                                    Parol maydoni to'ldirilishi shart.
                                </div>
                            </div>

                            <div class="mt-4 mb-3">
                                <button type="submit" class="btn btn-lg btn-primary w-100">Login</button>
                            </div>
                        </form>
                        <a href="{{ route('client_individual_register') }}" class="text-decoration-none mt-3">Sign up</a>
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
        (function () {
            'use strict';
            var form = document.getElementById('individual-form');
            var pinflField = document.getElementById('pinfl-field');

            // PINFL maydoniga faqat raqamlar kiritilishiga ruxsat beradi
            pinflField.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, ''); // faqat raqamlar qoldiriladi
                if (this.value.length > 14) {
                    this.value = this.value.slice(0, 14);
                }
            });

            form.addEventListener('submit', function (event) {
                if (pinflField.value.length !== 14) {
                    pinflField.classList.add('is-invalid');
                    event.preventDefault();
                } else {
                    pinflField.classList.remove('is-invalid');
                }

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        })();
    </script>
@endsection
