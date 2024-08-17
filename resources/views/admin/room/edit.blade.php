@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Xona Tahrirlash</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('rooms.index') }}">Xonalar</a></li>
                        <li class="breadcrumb-item">Xona tahrirlash</li>
                    </ul>
                </div>
            </div>

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="card border-top-0">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item flex-fill border-top" role="presentation">
                                <a href="javascript:void(0);" class="nav-link text-start">Xona ma'lumotlarini tahrirlang:</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                            <div class="card-body personal-info">
                                <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="numberInput" class="fw-semibold">Xona raqami:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="numberInput" name="number" placeholder="Xona raqamini kiriting" value="{{ old('number', $room->number) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="branchSelect" class="fw-semibold">Filial:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="branch_id" id="branchSelect" class="form-control max-select">
                                                @foreach($branches as $branch)
                                                    <option value="{{ $branch->id }}" {{ old('branch_id', $room->branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="sizeInput" class="fw-semibold">O'lcham:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" class="form-control" id="sizeInput" name="size" placeholder="O'lchamni kiriting" value="{{ old('size', $room->size) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="priceInput" class="fw-semibold">Kvadrat metr narxi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" step="0.01" class="form-control" id="priceInput" name="price_per_sqm" placeholder="Kvadrat metr narxini kiriting" value="{{ old('price_per_sqm', $room->price_per_sqm) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="statusSelect" class="fw-semibold">Holat:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="status" id="statusSelect" class="form-control max-select">
                                                <option value="noactive" {{ old('status', $room->status) === 'noactive' ? 'selected' : '' }}>Noactive</option>
                                                <option value="active" {{ old('status', $room->status) === 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="bron" {{ old('status', $room->status) === 'bron' ? 'selected' : '' }}>Bron</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="typeSelect" class="fw-semibold">Tur:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="type" id="typeSelect" class="form-control max-select">
                                                <option value="business" {{ old('type', $room->type) === 'business' ? 'selected' : '' }}>Business</option>
                                                <option value="standard" {{ old('type', $room->type) === 'standard' ? 'selected' : '' }}>Standard</option>
                                            </select>
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
            // Initialize Select2 for all select elements
            $('.max-select').select2({
                theme: 'bootstrap-5',
                placeholder: 'Tanlang...',
                allowClear: true
            });
        });
    </script>
@endsection
