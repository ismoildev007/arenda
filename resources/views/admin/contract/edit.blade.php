@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Shartnomani tahrirlash</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('contracts.index') }}">Shartnomalar</a></li>
                        <li class="breadcrumb-item">Shartnomani tahrirlash</li>
                    </ul>
                </div>
            </div>

            <div class="main-content">
                <div class="card border-top-0">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item flex-fill border-top" role="presentation">
                                <a href="javascript:void(0);" class="nav-link text-start">Shartnoma malumotlarini tahrirlang:</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                            <div class="card-body personal-info">
                                <form action="{{ route('contracts.update', $contract->id) }}" method="POST" id="contractForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label  class="fw-semibold">Contract Number:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input value="{{ $contract->contract_number }}" name="contract_number" >
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="buildingSelect" class="fw-semibold">Bino:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="building_id" id="buildingSelect" class="form-control max-select" required>
                                                <option value="">Bino tanlang</option>
                                                @foreach($buildings as $building)
                                                    <option value="{{ $building->id }}" {{ $building->id == $contract->room->floor->section->building_id ? 'selected' : '' }}>
                                                        {{ $building->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="sectionSelect" class="fw-semibold">Bo'lim:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="section_id" id="sectionSelect" class="form-control max-select" required>
                                                <option value="">Bo'lim tanlang</option>
                                                @foreach($sections as $section)
                                                    <option value="{{ $section->id }}" {{ $section->id == $contract->room->floor->section_id ? 'selected' : '' }}>
                                                        {{ $section->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="floorSelect" class="fw-semibold">Qavat:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="floor_id" id="floorSelect" class="form-control max-select" required>
                                                <option value="">Qavat tanlang</option>
                                                @foreach($floors as $floor)
                                                    <option value="{{ $floor->id }}" {{ $floor->id == $contract->room->floor_id ? 'selected' : '' }}>
                                                        {{ $floor->number }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="roomSelect" class="fw-semibold">Xona:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="room_id" id="roomSelect" class="form-control max-select" required>
                                                <option value="{{ $contract->room_id }}" selected>{{ $contract->room->number }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="clientSelect" class="fw-semibold">Mijoz:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="client_id" id="clientSelect" class="form-control max-select" required>
                                                @foreach($clients as $client)
                                                    <option value="{{ $client->id }}" {{ $client->id == $contract->client_id ? 'selected' : '' }}>
                                                        {{ $client->first_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="startDateInput" class="fw-semibold">Boshlanish sanasi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="date" class="form-control" id="startDateInput" name="start_date" value="{{ $contract->start_date->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="endDateInput" class="fw-semibold">Tugash sanasi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="date" class="form-control" id="endDateInput" name="end_date" value="{{ $contract->end_date->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label class="fw-semibold">To'lov Holati:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="payment_status" class="form-control max-select" required>
                                                <option value="unpaid" {{ $contract->payment_status == 'unpaid' ? 'selected' : '' }} style="color:black;">To'lanmagan</option>
                                                <option value="paid" {{ $contract->payment_status == 'paid' ? 'selected' : '' }} style="color:black;">To'langan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label class="fw-semibold">Holati:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="status" class="form-control max-select" required>
                                                <option value="noactive" {{ $contract->status == 'noactive' ? 'selected' : '' }} style="color:black;">Faol emas</option>
                                                <option value="active" {{ $contract->status == 'active' ? 'selected' : '' }} style="color:black;">Faol</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="discountInput" class="fw-semibold">Chegirma % da:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" step="0.01" class="form-control" id="discountInput" name="discount" value="{{ $contract->discount }}">
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
        </div>
    </main>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#buildingSelect').select2({
                theme: 'bootstrap-5',
                placeholder: "Bino tanlash",
                allowClear: true,
                minimumResultsForSearch: Infinity
            }).on('change', function() {
                updateSections();
            });

            $('#sectionSelect').select2({
                theme: 'bootstrap-5',
                placeholder: "Bo'lim tanlash",
                allowClear: true,
                minimumResultsForSearch: Infinity
            }).on('change', function() {
                updateFloors();
            });

            $('#floorSelect').select2({
                theme: 'bootstrap-5',
                placeholder: "Qavat tanlash",
                allowClear: true,
                minimumResultsForSearch: Infinity
            }).on('change', function() {
                updateRooms();
            });

            $('#roomSelect').select2({
                theme: 'bootstrap-5',
                placeholder: "Xona tanlash",
                allowClear: true,
                minimumResultsForSearch: Infinity
            }).on('change', function() {
                updateRoomDetails();
            });

            $('#clientSelect').select2({
                theme: 'bootstrap-5',
                placeholder: "Mijoz tanlash",
                allowClear: true,
                minimumResultsForSearch: Infinity
            });

            // Boshqa bo'limlar uchun mos ravishda funksiyalarni yaratish va ulardan foydalanish
            function updateSections() {
                var buildingId = $('#buildingSelect').val();
                // AJAX so'rovini amalga oshirish va bo'limlarni yangilash
                // Sektsiyalarni yuklab olgandan keyin `#sectionSelect`ni yangilang
            }

            function updateFloors() {
                var sectionId = $('#sectionSelect').val();
                // AJAX so'rovini amalga oshirish va qavatlarni yangilash
                // Qavatlarni yuklab olgandan keyin `#floorSelect`ni yangilang
            }

            function updateRooms() {
                var floorId = $('#floorSelect').val();
                // AJAX so'rovini amalga oshirish va xonalarni yangilash
                // Xonalarni yuklab olgandan keyin `#roomSelect`ni yangilang
            }

            function updateRoomDetails() {
                var roomId = $('#roomSelect').val();
                // Xona malumotlarini AJAX orqali yuklash va `#roomDetails`ni yangilang
            }
        });
    </script>
@endsection
