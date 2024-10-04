@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Qavat qo'shish</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('floors.index') }}">Qavatlar</a></li>
                        <li class="breadcrumb-item">Yangi qavat qo'shish</li>
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
                                <a href="javascript:void(0);" class="nav-link text-start">Yangi qavat malumotlarini kiriting :</a>
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                            <div class="card-body personal-info">
                                <form action="{{ route('floors.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Building Select -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="regionSelect" class="fw-semibold">Building :</label>
                                        </div>
                                        <div class="col-lg-8 mb-4">
                                            <select name="building_id" id="building_id" class="form-select max-select" required>
                                                <option value="" disabled selected>Building tanlang</option>
                                                @foreach($buildings as $building)
                                                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="regionSelect" class="fw-semibold">Section :</label>
                                        </div>
                                        <div class="col-lg-8 mb-4">
                                            <select name="building_id" id="building_id" class="form-select max-select" required>
                                                <option value="" disabled selected>section tanlang</option>
                                                @foreach($sections as $section)
                                                    <option value="{{ $building->id }}">{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Floor Number (loaded dynamically) -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="number" class="fw-semibold">Qavat tanlang:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="number" id="number" class="form-select max-select" required>

                                            </select>
                                        </div>
                                    </div>

                                    <!-- Room Count -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="room_of_number" class="fw-semibold">Xona soni :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="room_of_number" id="room_of_number" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Size -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="size" class="fw-semibold">Qavat xajmi :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="size" id="size" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Price per Square Meter -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="floor_price_per_sqm" class="fw-semibold">Kvadrat metriga narx :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" name="price_per_sqm" id="floor_price_per_sqm" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="row align-items-center mb-4">
                                        <div class="col-lg-4">
                                            <label for="images" class="fw-semibold">Rasmlar</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="file" name="images[]" id="images" class="form-control" multiple>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Saqlash</button>
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
<?php

$sections = \App\Models\Section::all();
?>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.max-select').select2({
            theme: 'bootstrap-5',
            placeholder: 'Tanlang...',
            allowClear: true
        });

        // Load sections based on selected building
        $('#building_id').on('change', function() {
            let buildingId = $(this).val();
            if (buildingId) {
                $.ajax({
                    url: "{{ route('getSections', '') }}/" + buildingId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#section_id').empty().append('<option value="" disabled selected>Bo\'limni tanlang</option>');
                        $('#number').empty().append('<option value="" disabled selected>Qavatni tanlang</option>');

                        $.each(data.sections, function(key, value) {
                            $('#section_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });

                        $('#sectionSelectBox').show();
                    }
                });
            }
        });

        // Update the floor select when a section is selected
        $('#section_id').on('change', function() {
            let selectedSectionId = $(this).val();
            let sectionData = @json($sections); // Yoki AJAX orqali olib kelingan section ma'lumotlari

            let selectedSection = sectionData.find(section => section.id == selectedSectionId);
            let floorSelect = $('#number');

            floorSelect.empty().append('<option value="" disabled selected>Qavatni tanlang</option>');

            if (selectedSection) {
                for (let i = 1; i <= selectedSection.floor; i++) {
                    floorSelect.append('<option value="' + i + '">' + i + '</option>');
                }
            }
        });
    });
</script>


@endsection
