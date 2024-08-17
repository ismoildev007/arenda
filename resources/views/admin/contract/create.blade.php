@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Yangi Shartnoma qo'shish</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('contracts.index') }}">Shartnomalar</a></li>
                        <li class="breadcrumb-item">Yangi Shartnoma qo'shish</li>
                    </ul>
                </div>
            </div>

            <div class="main-content">
                <div class="card border-top-0">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item flex-fill border-top" role="presentation">
                                <a href="javascript:void(0);" class="nav-link text-start">Shartnoma malumotlarini kiriting:</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                            <div class="card-body personal-info">
                                <form action="{{ route('contracts.store') }}" method="POST" id="contractForm">
                                    @csrf
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="contractNumber" class="fw-semibold">Shartnoma raqami:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="contractNumber" name="contract_number" placeholder="Shartnoma raqamini kiriting" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="roomSelect" class="fw-semibold">Xona:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="room_id" id="roomSelect" class="form-control max-select" required onchange="updateRoomDetails()">
                                                <option class="selected" disabled selected>Xona tanlash</option>
                                                @foreach($rooms as $room)
                                                    <option value="{{ $room->id }}" data-size="{{ $room->size }}" data-price="{{ $room->price_per_sqm }}">{{ $room->number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="clientSelect" class="fw-semibold">Mijoz:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="client_id" id="clientSelect" class="form-control max-select" required>
                                                <option class="selected" disabled selected>Mijoz tanlash</option>
                                                @foreach($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->first_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="startDateInput" class="fw-semibold">Boshlanish sanasi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="date" class="form-control" id="startDateInput" name="start_date" value="{{ old('start_date', $contract->start_date ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="endDateInput" class="fw-semibold">Tugash sanasi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="date" class="form-control" id="endDateInput" name="end_date" value="{{ old('end_date', $contract->end_date ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="discountInput" class="fw-semibold">Chegirma % da:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" step="0.01" class="form-control" id="discountInput" name="discount" placeholder="Chegirma miqdorini kiriting agar 0% bo'lsa ham" value="{{ old('discount', $contract->discount ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary">Saqlash</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="room-details mt-4">
                                    <h5>Xona Malumotlari:</h5>
                                    <p id="roomSize"></p>
                                    <p id="roomPrice"></p>
                                    <h5>Umumiy narx:</h5>
                                    <p id="totalPrice"></p>
                                    <h5>Chegirmadan keyingi narx:</h5>
                                    <p id="discountedPrice"></p>
                                </div>
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
            $('#roomSelect').select2({
                theme: 'bootstrap-5',
                placeholder: "Xona tanlash",
                allowClear: true
            });

            $('#clientSelect').select2({
                theme: 'bootstrap-5',
                placeholder: "Mijoz tanlash",
                allowClear: true
            });

            $('#roomSelect').on('change', updateRoomDetails);
            $('#discountInput').on('input', calculateTotal); // Calculate total when discount changes
        });

        function updateRoomDetails() {
            var roomSelect = document.getElementById('roomSelect');
            var selectedOption = roomSelect.options[roomSelect.selectedIndex];
            var size = selectedOption.getAttribute('data-size');
            var price = selectedOption.getAttribute('data-price');

            document.getElementById('roomSize').innerText = 'Kvadratlik: ' + size + ' m²';
            document.getElementById('roomPrice').innerText = 'Narx: ' + price + ' so\'m/m²';

            calculateTotal();
        }

        function calculateTotal() {
            var roomSelect = document.getElementById('roomSelect');
            var selectedOption = roomSelect.options[roomSelect.selectedIndex];
            var size = selectedOption.getAttribute('data-size');
            var pricePerSqm = selectedOption.getAttribute('data-price');
            var discount = parseFloat(document.getElementById('discountInput').value) || 0;

            var totalDays = (new Date(document.getElementById('endDateInput').value) - new Date(document.getElementById('startDateInput').value)) / (1000 * 60 * 60 * 24) + 1; // 1 kun qo'shiladi
            var pricePerDay = pricePerSqm / 30; // Kunlik narx

            var totalPrice = totalDays * pricePerDay * size;
            var discountedPrice = totalPrice - (totalPrice * discount / 100);

            document.getElementById('totalPrice').innerText = 'Umumiy narx: ' + totalPrice.toFixed(2) + ' so\'m';
            document.getElementById('discountedPrice').innerText = 'Chegirmadan keyingi narx: ' + discountedPrice.toFixed(2) + ' so\'m';
        }

    </script>
@endsection
