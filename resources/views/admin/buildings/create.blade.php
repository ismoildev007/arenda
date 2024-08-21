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
                                <form action="{{ route('buildings.store') }}" method="POST">
                                    @csrf
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="nameInput" class="fw-semibold">Obyekt nomi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="nameInput" name="name" placeholder="Filial nomini kiriting">
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="regionSelect" class="fw-semibold">Manzil :</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control max-select" id="regionSelect" name="region_id" placeholder="Viloyatni tanlang">
                                                <option class="selected" disabled selected>Viloyatni tanlang</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4" id="districtSelectBox" style="display: none;">
                                            <select class="form-control max-select" id="districtSelect" name="district_id">
                                                <option value="" disabled selected> Tumanni tanlang </option>
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
                if(regionId) {
                    $.ajax({
                        url: '{{ url("/get-districts/") }}' + '/' + regionId,
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
                    $('#districtSelect').empty().append('<option value="" disabled selected>Select a district</option>');
                    document.getElementById('districtSelectBox').style.display = 'none';
                }
            });
        });
    </script>
@endsection
