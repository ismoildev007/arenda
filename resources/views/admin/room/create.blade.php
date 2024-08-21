@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Xona yaratish</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('rooms.index') }}">Xonalar</a></li>
                        <li class="breadcrumb-item">Xona yaratish</li>
                    </ul>
                </div>
            </div>

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="card border-top-0">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item flex-fill border-top" role="presentation">
                                <a href="javascript:void(0);" class="nav-link text-start">Xona ma'lumotlarini kiriting :</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                            <div class="card-body personal-info">
                                <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" id="roomForm">
                                    @csrf
                                    <!-- Building Select -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="building_id" class="fw-semibold">Building :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="building_id" id="building_id" class="form-select max-select" required>
                                                <option value="" disabled selected>Building tanlang</option>
                                                @foreach($buildings as $building)
                                                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Section Select -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="section_id" class="fw-semibold">Seksiya :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="section_id" id="section_id" class="form-select max-select" required>
                                                <option value="" disabled selected>Seksiya tanlang</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Floor Select -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="floor_id" class="fw-semibold">Qavat :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="floor_id" id="floor_id" class="form-select max-select" required>
                                                <option value="" disabled selected>Qavatni tanlang</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Room Number -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="number" class="fw-semibold">Xona raqami :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="number" id="number" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Size -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="size" class="fw-semibold">O'lchami :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" name="size" id="size" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Price Per Sqm -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="price_per_sqm" class="fw-semibold">Kvadrat metriga narx :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" name="price_per_sqm" id="price_per_sqm" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="status" class="fw-semibold">Holat :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="status" id="status" class="form-select max-select" required>
                                                <option value="" disabled selected>Holatni tanlang</option>
                                                <option value="noactive">Faol emas</option>
                                                <option value="active">Faol</option>
                                                <option value="bron">Bronlangan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Type -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="type" class="fw-semibold">Turi :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="type" id="type" class="form-select max-select" required>
                                                <option value="" disabled selected>Turlarni tanlang</option>
                                                <option value="business">Biznes</option>
                                                <option value="standard">Standart</option>
                                            </select>
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

                                    <button type="submit" class="btn btn-primary">Yaratish</button>
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
                            console.log(data); // Kelayotgan ma'lumotni ko'rsatish
                            $('#section_id').empty().append('<option value="" disabled selected>Seksiya tanlang</option>');
                            $('#floor_id').empty().append('<option value="" disabled selected>Qavatni tanlang</option>');

                            $.each(data.sections, function(key, value) {
                                $('#section_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });

            // Load floors based on selected section
            $('#section_id').on('change', function() {
                let sectionId = $(this).val();
                if (sectionId) {
                    $.ajax({
                        url: "{{ route('getFloors', '') }}/" + sectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data); // Kelayotgan ma'lumotni ko'rsatish
                            $('#floor_id').empty().append('<option value="" disabled selected>Qavatni tanlang</option>');
                            $.each(data.floors, function(key, value) {
                                $('#floor_id').append('<option value="' + value.id + '">' + value.number + '</option>');
                            });
                        }
                    });
                }
            });


            // Form submit event
            $('#roomForm').on('submit', function(e) {
                let floorValue = $('#floor_id').val();
                if (!floorValue) {
                    e.preventDefault();
                    alert('Iltimos, qavatni tanlang!');
                }
            });
        });
    </script>
@endsection
