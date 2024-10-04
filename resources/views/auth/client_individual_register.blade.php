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
                        <form action="{{ route('client_individual_register') }}" method="post" class="w-100 mt-4 pt-2 needs-validation" novalidate>
                            @csrf
                            <div class="form-group mb-4">
                                <input type="text" class="form-control mb-3" placeholder="PINFL" name="pinfl" id="pinfl-input" value="{{ old('pinfl') }}" maxlength="14" required>
                                @error('pinfl')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">
                                    Iltimos, PINFL ni kiriting.
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" class="form-control mb-3" placeholder="Ismingizni kiriting" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">
                                    Iltimos, ismingizni kiriting.
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" class="form-control mb-3" placeholder="Familiyangizni kiriting" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">
                                    Iltimos, familiyangizni kiriting.
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" class="form-control mb-3" placeholder="Password" name="password" required>
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">
                                    Iltimos, parolni kiriting.
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" class="form-control mb-3" placeholder="Confirm Password" name="password_confirmation" required>
                                <div class="invalid-feedback">
                                    Iltimos, parolni tasdiqlang.
                                </div>
                            </div>
                            <div class="mt-4 mb-3">
                                <button type="submit" class="btn btn-lg btn-primary w-100">Register</button>
                            </div>
                        </form>
                        <a href="{{ route('client_individual_login_form') }}" class="text-decoration-none mt-3">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // PINFL uchun faqat raqamlarni kiritishiga imkon beradi
        document.getElementById('pinfl-input').addEventListener('input', function (e) {
            this.value = this.value.replace(/\D/g, '');

            // Maksimal uzunlikni tekshiradi
            if (this.value.length > 14) {
                this.value = this.value.slice(0, 14);
            }
        });

        // Bootstrap form validatsiyasi
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection
