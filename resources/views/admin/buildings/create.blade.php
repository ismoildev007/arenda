@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Filial qo'shish</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('buildings.index') }}">Filiallar</a></li>
                        <li class="breadcrumb-item">Yangi filial qo'shish</li>
                    </ul>
                </div>
            </div>

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="card border-top-0">
                    <div class="card-header p-0">
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item flex-fill border-top" role="presentation">
                                <a href="javascript:void(0);" class="nav-link text-start">Yangi filial malumotlarini kiriting :</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                            <div class="card-body personal-info">
                                <div class="row mb-4">
                                    <div class="col-lg-2">
                                        <button id="individualPerson" class="btn btn-outline-primary w-100">Jismoniy shaxs qo'shish</button>
                                    </div>
                                    <div class="col-lg-2">
                                        <button id="legalPerson" class="btn btn-outline-secondary w-100">Yuridik shaxs qo'shish</button>
                                    </div>
                                </div>
                                <form action="{{ route('buildings.store') }}" method="POST">
                                    @csrf
                                    <!-- Name Input -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="nameInput" class="fw-semibold">Obyekt nomi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="nameInput" name="name" placeholder="Filial nomini kiriting" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="fist_name" class="fw-semibold">Ism :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Biznes senter egasi ismi" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="last_name" class="fw-semibold">Familiya :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Biznes senter egasi familiyasi" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="size" class="fw-semibold">Umumiy hajmi :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="size" name="size" placeholder="Umumiy hajmini kiriting" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="date" class="fw-semibold">Ochilgan sanasi :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="date" class="form-control" id="ate" name="date" placeholder="Umumiy hajmini kiriting" required>
                                        </div>
                                    </div>

                                    <!-- INN Input (for legal persons) -->
                                    <div class="row mb-4 align-items-center" id="innBox">
                                        <div class="col-lg-4">
                                            <label for="innInput" class="fw-semibold">INN:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="innInput" pattern="\d{9}"  name="inn" placeholder="INN kiriting">
                                        </div>
                                    </div>

                                    <!-- PINFL Input (for individual persons) -->
                                    <div class="row mb-4 align-items-center" id="pinflBox">
                                        <div class="col-lg-4">
                                            <label for="pinflInput" class="fw-semibold">PINFL:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="pinflInput" name="pinfl"  pattern="\d{14}" placeholder="PINFL kiriting">
                                        </div>
                                    </div>

                                    <!-- OKED Input (for legal persons) -->
                                    <div class="row mb-4 align-items-center" id="okedBox">
                                        <div class="col-lg-4">
                                            <label for="okedInput" class="fw-semibold">OKED:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="okedInput" name="oked" placeholder="OKED kiriting">
                                        </div>
                                    </div>

                                    <!-- Bank Input (for legal persons) -->
                                    <div class="row mb-4 align-items-center" id="bankBox">
                                        <div class="col-lg-4">
                                            <label for="bankInput" class="fw-semibold">Bank:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="bankInput" name="bank" placeholder="Bank nomi kiriting">
                                        </div>
                                    </div>

                                    <!-- Account Input (for legal persons) -->
                                    <div class="row mb-4 align-items-center" id="accountBox">
                                        <div class="col-lg-4">
                                            <label for="accountInput" class="fw-semibold">Hisob raqami:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="accountInput" name="account" placeholder="Hisob raqamini kiriting">
                                        </div>
                                    </div>

                                    <!-- Region Select -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="regionSelect" class="fw-semibold">Viloyat:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="form-control max-select" id="regionSelect" name="region_id" placeholder="Viloyatni tanlang" required>
                                                <option value="" disabled selected>Viloyatni tanlang</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4" id="districtSelectBox" style="display: none;">
                                            <select class="form-control max-select" id="districtSelect" name="district_id">
                                                <option value="" disabled selected>Tumanni tanlang</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary">Saqlash</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Custom Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var pinflInput = document.getElementById('pinflInput');

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
        document.addEventListener('DOMContentLoaded', function() {
            const innInput = document.getElementById('innInput');

            innInput.addEventListener('input', function() {
                var value = innInput.value;

                value = value.replace(/\D/g, '').slice(0, 9);
                innInput.value = value;

                if (value.length < 9) {
                    pinflInput.classList.add('input-error');
                } else {
                    pinflInput.classList.remove('input-error');
                }
            });
        });
        $(document).ready(function() {
            // Initialize Select2 for all select elements
            $('.max-select').select2({
                theme: 'bootstrap-5',
                placeholder: 'Tanlang...',
                allowClear: true
            });

            // Handle region change event
            $('#regionSelect').change(function() {
                var regionId = $(this).val();
                if (regionId) {
                    $.ajax({
                        url: '{{ url("/get-districts/") }}/' + regionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#districtSelect').empty().append('<option value="" disabled selected>Tumanni tanlang</option>');
                            $.each(data, function(key, district) {
                                $('#districtSelect').append('<option value="'+ district.id +'">'+ district.name +'</option>');
                            });
                        }
                    });
                    document.getElementById('districtSelectBox').style.display = 'block';
                } else {
                    $('#districtSelect').empty().append('<option value="" disabled selected>Tumanni tanlang</option>');
                    document.getElementById('districtSelectBox').style.display = 'none';
                }
            });

            // Handle person type button clicks
            $('#individualPerson').click(function() {
                $('#pinflBox').show();
                $('#innBox, #okedBox, #bankBox, #accountBox').hide();
            });

            $('#legalPerson').click(function() {
                $('#pinflBox').hide();
                $('#innBox, #okedBox, #bankBox, #accountBox').show();
            });

            // Set default view
            $('#individualPerson').click(); // or $('#legalPerson').click() depending on the default view you want
        });
    </script>
@endsection
