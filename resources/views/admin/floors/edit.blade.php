@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Qavatni tahrirlash</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('floors.index') }}">Qavatlar</a></li>
                        <li class="breadcrumb-item">Qavatni tahrirlash</li>
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
                                <a href="javascript:void(0);" class="nav-link text-start">Qavat ma'lumotlarini tahrirlang :</a>
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
                                <form action="{{ route('floors.update', $floor->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <!-- Building Select -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="building_id" class="fw-semibold">Building :</label>
                                        </div>
                                        <div class="col-lg-8 mb-4">
                                            <select name="building_id" id="building_id" class="form-select max-select" required>
                                                <option value="" disabled selected>Building tanlang</option>
                                                @foreach($buildings as $building)
                                                    <option value="{{ $building->id }}" {{ $building->id == $floor->building_id ? 'selected' : '' }}>{{ $building->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-12" id="sectionSelectBox" style="display: {{ $floor->section_id ? 'block' : 'none' }};">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="section_id" class="fw-semibold">Bo'lim</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select name="section_id" id="section_id" class="form-select max-select" required>
                                                        <option value="" disabled selected>Bo'limni tanlang</option>
                                                        @foreach($sections as $section)
                                                            <option value="{{ $section->id }}" {{ $section->id == $floor->section_id ? 'selected' : '' }}>{{ $section->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="room_of_number" class="fw-semibold">Xona soni :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="date" class="form-control" id="room_of_number" name="room_of_number" value="{{ old('room_of_number', $building->room_of_number) }}">
                                        </div>
                                    </div>
                                    <!-- Floor Number (loaded dynamically) -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="number" class="fw-semibold">Qavat tanglang:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="number" id="number" class="form-select max-select" required>
                                                <option value="" disabled selected>Qavatni tanlang</option>
                                                @for($i = 1; $i <= $maxFloor; $i++)
                                                    <option value="{{ $i }}" {{ $i == $floor->number ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
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
                                            @if ($floor->images)
                                                <div class="mt-2">
                                                    @foreach ($floor->images as $image)
                                                        <img src="{{ asset('storage/' . $image) }}" alt="Floor Image" width="100" class="img-thumbnail me-2">
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Yangilash</button>
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
                            $('#section_id').empty().append('<option value="" disabled selected>Bo\'limni tanlang</option>');
                            $('#number').empty().append('<option value="" disabled selected>Qavatni tanlang</option>');

                            $.each(data.sections, function(key, value) {
                                $('#section_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });

                            // Get the maximum floor from the sections
                            let maxFloor = Math.max(...data.sections.map(section => section.floor));

                            // Populate the floor select with options from 1 to maxFloor
                            for (let i = 1; i <= maxFloor; i++) {
                                $('#number').append('<option value="' + i + '">' + i + '</option>');
                            }

                            $('#sectionSelectBox').show();
                        }
                    });
                }
            });

            // Trigger change event if building is already selected
            if ($('#building_id').val()) {
                $('#building_id').trigger('change');
            }
        });
    </script>
@endsection
