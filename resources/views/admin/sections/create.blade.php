@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Bo'lim qo'shish</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('sections.index') }}">Bo'limlar</a></li>
                        <li class="breadcrumb-item">Yangi bo'lim qo'shish</li>
                    </ul>
                </div>
            </div>

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="card border-top-0">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item flex-fill border-top" role="presentation">
                                <a href="javascript:void(0);" class="nav-link text-start">Yangi bo'lim malumotlarini kiriting:</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                            <div class="card-body personal-info">
                                <form action="{{ route('sections.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="buildingSelect" class="fw-semibold">Bino:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="form-control max-select" id="buildingSelect" name="building_id" placeholder="Bino tanlang">
                                                <option class="selected" disabled selected>Bino tanlang</option>
                                                @foreach ($buildings as $building)
                                                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="nameInput" class="fw-semibold">Bo'lim nomi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="nameInput" name="name" placeholder="Bo'lim nomini kiriting">
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="addressInput" class="fw-semibold">Manzil:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="addressInput" name="address" placeholder="Manzilni kiriting">
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="classesInput" class="fw-semibold">Section turi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="classesInput" name="section_type" placeholder="Seksiya turini kiriting">
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="constructionInput" class="fw-semibold">Qurilish:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="constructionInput" name="construction" placeholder="Qurilish haqida">
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="sizeInput" class="fw-semibold">Hajmi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="sizeInput" name="size" placeholder="Bo'lim hajmini kiriting">
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="foundedDateInput" class="fw-semibold">Tashkil topgan sana:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="date" class="form-control" id="foundedDateInput" name="founded_date">
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="safetyInput" class="fw-semibold">Xavfsizlik:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="safetyInput" name="safety" placeholder="Xavfsizlik haqida">
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="modeOfOperationInput" class="fw-semibold">Ish rejimi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="modeOfOperationInput" name="mode_of_operation" placeholder="Ish rejimini kiriting">
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="setInput" class="fw-semibold">Jihozlar:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="setInput" name="set" placeholder="Jihozlar haqida">
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="floorInput" class="fw-semibold">Qavat:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="floorInput" name="floor" placeholder="Necha qavat">
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="numberOfRoomsInput" class="fw-semibold">Xonalar soni:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="numberOfRoomsInput" name="number_of_rooms" placeholder="Xonalar sonini kiriting">
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="liftInput" class="fw-semibold">Lift:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="liftInput" name="lift" placeholder="Lift mavjudmi?">
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="parkingInput" class="fw-semibold">Avtomobil to'xtash joyi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="parkingInput" name="parking" placeholder="Avtomobil to'xtash joyi haqida">
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="imagesInput" class="fw-semibold">Rasmlar:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="file" class="form-control" id="imagesInput" name="images[]" multiple>
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
            $('.max-select').select2({
                theme: 'bootstrap-5',
                placeholder: 'Tanlang...',
                allowClear: true
            });
        });
    </script>
@endsection
