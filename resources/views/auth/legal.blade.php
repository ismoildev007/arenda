<?php
$regions = \App\Models\Region::all();
$districts = \App\Models\District::all();
$branches = \App\Models\Building::all();
?>

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
                            <a href="{{ route('client.login') }}" id="individual-btn" class="btn btn-outline-primary">Jismoniy
                                shaxs</a>
                            <button id="legal-btn" class="btn btn-outline-secondary active">Yuridik shaxs</button>
                        </div>
                        <form id="auth-form" action="{{ route('client.authenticate') }}" method="post"
                              class="w-100 mt-4 pt-2">
                            @csrf
                            <div id="login-fields" class="mb-4">
                                <div id="inn-field" class="form-group">
                                    <input id="inn" type="text" class="form-control mb-3" placeholder="INN" name="inn">
                                </div>
                                <div id="password-field" class="form-group d-none">
                                    <input id="password" type="password" class="form-control" placeholder="Password"
                                           name="password" required>
                                </div>
                            </div>
                            <div class="mt-4 mb-3">
                                <button type="button" id="btnBu" class="btn btn-lg btn-primary w-100"
                                        onclick="checkIdentifier()">Login
                                </button>
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.max-select').select2({
                theme: 'bootstrap-5',
                placeholder: 'Tanlang...',
                allowClear: true
            });

            $('#regionSelect').change(function () {
                var regionId = $(this).val();
                if (regionId) {
                    $.ajax({
                        url: '{{ url("/get-districts/") }}' + '/' + regionId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#districtSelect').empty().append('<option value="" disabled selected>Tumanni tanlang</option>');
                            $.each(data, function (key, district) {
                                $('#districtSelect').append('<option value="' + district.id + '">' + district.name + '</option>');
                            });
                        }
                    });
                    document.getElementById('districtSelectBox').style.display = 'block';
                } else {
                    $('#districtSelect').empty().append('<option value="" disabled selected>Select a district</option>');
                    document.getElementById('districtSelectBox').style.display = 'none';
                }
            });
        });

        function showFields(type) {
            if (type === 'legal') {
                document.getElementById('inn-field').classList.remove('d-none');
                document.getElementById('legal-fields').classList.remove('d-none');
                document.getElementById('password-field').classList.remove('d-none');
            } else {
                document.getElementById('login-fields').classList.remove('d-none');
            }
        }

        function checkIdentifier() {
            var inn = document.getElementById('inn').value;

            fetch(`/check-pinfl?inn=${inn}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('btnBu').type = 'submit';
                    window.localStorage.setItem('checkEmail', '1');
                    if (data.exists) {
                        document.getElementById('password-field').classList.remove('d-none');
                        document.getElementById('auth-form').submit();
                    } else {
                        var isLegal = inn.length > 0;
                        showFields(isLegal ? 'legal' : 'individual');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
