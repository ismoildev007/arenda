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
                            <!-- Region Select -->
                            <div class="form-group mb-4">
                                <select class="form-control max-select" id="regionSelect" name="region_id" required>
                                    <option value="" disabled selected>Viloyatni tanlang</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Iltimos, viloyatni tanlang.
                                </div>
                            </div>
                            <!-- District Select -->
                            <div class="form-group mb-4" id="districtSelectBox" style="display: none;">
                                <select class="form-control max-select" id="districtSelect" name="district_id" required>
                                    <option value="" disabled selected>Tumanni tanlang</option>
                                </select>
                                <div class="invalid-feedback">
                                    Iltimos, tumanni tanlang.
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

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for all select elements
            $('.max-select').select2({
                theme: 'classic', // Change theme if 'bootstrap-5' doesn't work
                placeholder: 'Tanlang...',
                allowClear: true
            });

            // Handle region change event
            $('#regionSelect').change(function() {
                var regionId = $(this).val();
                if (regionId) {
                    var url = '{{ route("getDistricts", ":region_id") }}';
                    url = url.replace(':region_id', regionId); // Dinamik almashtirish

                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#districtSelect').empty().append('<option value="" disabled selected>Tumanni tanlang</option>');
                            $.each(data, function(key, district) {
                                $('#districtSelect').append('<option value="'+ district.id +'">'+ district.name +'</option>');
                            });
                            $('#districtSelectBox').show(); // Tumanni tanlash oynasini ko'rsatish
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("AJAX Error: " + textStatus, errorThrown);
                            alert("Tumanni olishda xatolik yuz berdi.");
                        }
                    });
                } else {
                    $('#districtSelect').empty().append('<option value="" disabled selected>Tumanni tanlang</option>');
                    $('#districtSelectBox').hide(); // Hide district select box if no region is selected
                }
            });
            // PINFL input validation (only numbers)
            $('#pinfl-input').on('input', function () {
                this.value = this.value.replace(/\D/g, ''); // Remove non-numeric characters
                if (this.value.length > 14) {
                    this.value = this.value.slice(0, 14); // Limit to 14 digits
                }
            });
            // Form validation
            (function () {
                'use strict';
                var forms = document.querySelectorAll('.needs-validation');
                Array.prototype.slice.call(forms)
                    .forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
            })();
        });
    </script>
@endsection
