@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Bo'limni tahrirlash</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('sections.index') }}">Bo'limlar</a></li>
                        <li class="breadcrumb-item">Bo'limni tahrirlash</li>
                    </ul>
                </div>
            </div>

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="card border-top-0">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item flex-fill border-top" role="presentation">
                                <a href="javascript:void(0);" class="nav-link text-start">Bo'lim malumotlarini tahrirlang :</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                            <div class="card-body personal-info">
                                <form action="{{ route('sections.update', $section->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="buildingSelect" class="fw-semibold">Bino:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="form-control max-select" id="buildingSelect" name="building_id">
                                                @foreach ($buildings as $building)
                                                    <option value="{{ $building->id }}" {{ $section->building_id == $building->id ? 'selected' : '' }}>
                                                        {{ $building->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="floor" class="fw-semibold">Necha qavat:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="floor" name="floor" value="{{ $section->floor }}" placeholder="Necha qavatligini kiriting">
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="nameInput" class="fw-semibold">Bo'lim nomi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="nameInput" name="name" value="{{ $section->name }}" placeholder="Bo'lim nomini kiriting">
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="imagesInput" class="fw-semibold">Rasmlar:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="file" class="form-control" id="imagesInput" name="images[]" multiple>
                                            @if($section->images)
                                                <div class="mt-2">
                                                    @foreach($section->images as $image)
                                                        <img src="{{ Storage::url($image) }}" alt="Image" style="width: 100px; height: auto;">
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary">Yangilash</button>
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
            $('.max-select').select2({
                theme: 'bootstrap-5',
                placeholder: 'Tanlang...',
                allowClear: true
            });
        });
    </script>
@endsection
