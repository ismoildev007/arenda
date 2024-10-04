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
                        <form action="{{ route('client_legal_register') }}" method="post" class="w-100 mt-4 pt-2 needs-validation" novalidate>
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <input type="text" class="form-control" id="inn-input" placeholder="INN" name="inn" value="{{ old('inn') }}" required>
                                    @error('inn')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Iltimos, INN kiriting.
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <input type="text" class="form-control" placeholder="OKED" name="oked" value="{{ old('oked') }}" required>
                                    @error('oked')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Iltimos, OKED kiriting.
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <input type="text" class="form-control" placeholder="Bank" name="bank" value="{{ old('bank') }}" required>
                                    @error('bank')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Iltimos, bank nomini kiriting.
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <input type="text" class="form-control" placeholder="Account" name="account" value="{{ old('account') }}" required>
                                    @error('account')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Iltimos, hisob raqamini kiriting.
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="{{ old('company_name') }}" required>
                                    @error('company_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Iltimos, kompaniya nomini kiriting.
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Iltimos, ismingizni kiriting.
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Iltimos, familiyangizni kiriting.
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Iltimos, parolni kiriting.
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                                    <div class="invalid-feedback">
                                        Iltimos, parolni tasdiqlang.
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 mb-3">
                                <button type="submit" class="btn btn-lg btn-primary w-100">Register</button>
                            </div>
                        </form>
                        <a href="{{ route('client_legal_login_form') }}" class="text-decoration-none mt-3">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // INN uchun faqat raqamlarni kiritishiga imkon beradi
        document.getElementById('inn-input').addEventListener('input', function (e) {
            this.value = this.value.replace(/\D/g, '');

            // Maksimal uzunlikni tekshiradi
            if (this.value.length > 9) {
                this.value = this.value.slice(0, 9);
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