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
                                <input type="text" id="inn" name="inn" class="form-control" required maxlength="14" placeholder="INN ni kiriting">
                                <div class="invalid-feedback">
                                    INN 14 raqamdan iborat bo'lishi kerak.
                                </div>
                            </div>
                            <div id="passwordField" class="mb-3" style="display: none;">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Parolni kiriting">
                            </div>
                            <button type="button" id="loginBtn" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('loginBtn').addEventListener('click', function() {
            const inn = document.getElementById('inn').value;

            if (inn.length === 9) {
                fetch('{{ route("checkInn") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ inn: inn })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            document.getElementById('passwordField').style.display = 'block';
                            const password = document.getElementById('password').value;

                            if (password) {
                                document.getElementById('legalForm').submit();
                            } else {
                                Toastify({
                                    text: "Parolni kiriting!",
                                    duration: 5000,
                                    gravity: "top",
                                    position: "right",
                                    backgroundColor: "#f00",
                                }).showToast();
                            }
                        } else {
                            Toastify({
                                text: "Bunaqa INN topilmadi!",
                                duration: 5000,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#f00",
                            }).showToast();

                            setTimeout(function() {
                                window.location.href = "{{ route('client_legal_register_form') }}";
                            }, 5000);
                        }
                    });
            } else {
                document.getElementById('passwordField').style.display = 'none';
                Toastify({
                    text: "INN noto'g'ri kiritilgan!",
                    duration: 5000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#f00",
                }).showToast();
            }
        });

        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
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
