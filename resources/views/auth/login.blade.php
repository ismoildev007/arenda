@extends('layouts.auth')

@section('content')
    <main class="auth-minimal-wrapper">
        <div class="auth-minimal-inner">
            <div class="minimal-card-wrapper">
                <div class="card mb-4 mt-5 mx-4 mx-sm-0 position-relative">
                    <div class="wd-50 bg-white p-2 rounded-circle shadow-lg position-absolute translate-middle top-0 start-50">
                        <img src="assets/images/logo-abbr.png" alt="" class="img-fluid">
                    </div>
                    <div class="card-body p-sm-5">
                        <h2 class="fs-20 fw-bolder mb-4">Login</h2>
                        <form id="auth-form" action="{{ route('authenticate') }}" method="post" class="w-100 mt-4 pt-2">
                            @csrf
                            <div id="registration-fields" class="d-none">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="First name" name="first_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Last name" name="last_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Phone number" name="phone_number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Confirmation code" name="confirmation_code">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="text" hidden="hidden" name="role" value="0">
                            <div class="mb-4">
                                <input id="email-field" type="email" class="form-control" placeholder="Email" name="email" required>
                            </div>
                            <div id="password-field" class="mb-3 d-none">
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>

                            <div class="mt-4 mb-3">
                                <button type="submit" class="btn btn-lg btn-primary w-100" onclick="checkEmail()">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>

        function checkEmail() {
            var email = document.getElementById('email-field').value;
            fetch(`/check-email?email=${email}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        document.getElementById('password-field').classList.remove('d-none');
                        document.getElementById('registration-fields').classList.add('d-none');
                    } else {
                        document.getElementById('password-field').classList.remove('d-none');
                        document.getElementById('registration-fields').classList.remove('d-none');
                    }
                });
        }
    </script>
@endsection
