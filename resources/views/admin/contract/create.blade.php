
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
                                @if ($errors->has('error'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('error') }}
                                    </div>
                                @endif
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
                                            <label for="buildingSelect" class="fw-semibold">Bino:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="building_id" id="buildingSelect" class="form-control max-select" required>
                                                <option disabled selected>Bino tanlang</option>
                                                @foreach($buildings as $building)
                                                    <option value="{{ $building->id }}">{{ $building->name }}</option>
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
                                                <option disabled selected>Bo'lim tanlang</option>
                                                <!-- Sections will be populated based on selected building -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="floorSelect" class="fw-semibold">Qavat:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="floor_id" id="floorSelect" class="form-control max-select" required>
                                                <option disabled selected>Qavat tanlang</option>
                                                <!-- Floors will be populated based on selected section -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="roomSelect" class="fw-semibold">Xona:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="room_id" id="roomSelect" class="form-control max-select" required>
                                                <option disabled selected>Xona tanlang</option>
                                                <!-- Rooms will be populated based on selected floor -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="clientSelect" class="fw-semibold">Mijoz:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="client_id" id="clientSelect" class="form-control max-select" required>
                                                <option disabled selected>Mijoz tanlang</option>
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
                                            <input type="date" class="form-control" id="startDateInput" name="start_date" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="endDateInput" class="fw-semibold">Tugash sanasi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="date" class="form-control" id="endDateInput" name="end_date" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label  class="fw-semibold">To'lov Holati:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="payment_status"  class="form-control max-select" required>
                                                <option value="unpaid" >To'lanmagan</option>
                                                <option value="paid" >To'langan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label  class="fw-semibold">Holati:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="status"  class="form-control max-select" required>
                                                <option value="noactive" >Faol emas</option>
                                                <option value="active" >Faol</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="discountInput" class="fw-semibold">Chegirma % da:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" step="0.01" class="form-control" id="discountInput" name="discount" placeholder="Chegirma miqdorini kiriting agar 0% bo'lsa ham" value="{{ old('discount') }}">
                                            <h5 class="mt-4">Chiqirma narxi:</h5>
                                            <small class="form-text text-muted" id="discountAmount"></small>
                                            <h5 class="mt-4">Chegirmadan keyingi narx:</h5>
                                            <p id="discountedPrice"></p>
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
        $(document).ready(function () {
                // Initialize Select2
                $('.max-select').select2({
                    theme: 'bootstrap-5',
                    placeholder: "Xona tanlash",
                    allowClear: true
                });
            $('#buildingSelect').on('change', function () {
                let buildingId = $(this).val();
                $.ajax({
                    url: "{{ route('getSections', '') }}/" + buildingId,
                    type: "GET",
                    success: function (data) {
                        $('#sectionSelect').empty().append('<option disabled selected>Bo\'lim tanlang</option>');
                        data.sections.forEach(section => {
                            $('#sectionSelect').append('<option value="' + section.id + '">' + section.name + '</option>');
                        });
                    }
                });
            });

            $('#sectionSelect').on('change', function () {
                let sectionId = $(this).val();
                $.ajax({
                    url: "{{ route('getFloors', '') }}/" + sectionId,
                    type: "GET",
                    success: function (data) {
                        $('#floorSelect').empty().append('<option disabled selected>Qavat tanlang</option>');
                        data.floors.forEach(floor => {
                            $('#floorSelect').append('<option value="' + floor.id + '">' + floor.number + '</option>');
                        });
                    }
                });
            });

            $('#floorSelect').on('change', function () {
                let floorId = $(this).val();
                $.ajax({
                    url: "{{ route('getRooms', '') }}/" + floorId,
                    type: "GET",
                    success: function (data) {
                        $('#roomSelect').empty().append('<option disabled selected>Xona tanlang</option>');
                        data.rooms.forEach(room => {
                            $('#roomSelect').append('<option value="' + room.id + '">' + room.number + '</option>');
                        });
                    }
                });
            });

            $('#roomSelect').on('change', function () {
                let roomId = $(this).val();
                $.ajax({
                    url: "{{ route('contracts.existing', '') }}/" + roomId,
                    type: "GET",
                    success: function (data) {
                        if (data.room) {
                            $('#roomSize').text('O\'lchami: ' + data.room.size + ' m²');
                            $('#roomPrice').text('Narxi: ' + data.room.price_per_sqm + ' UZS');
                            $('#totalPrice').text('Umumiy narx: ' + data.total_price + ' UZS');
                        } else {
                            alert('Room data not found');
                        }
                    },
                    error: function () {
                        alert('Error retrieving room data');
                    }
                });
            });

            $('#discountInput').on('input', function () {
                // Get the text from #roomPrice
                let roomPriceText = $('#roomPrice').text();
                // Check if the text is in the expected format
                if (roomPriceText) {
                    // Split the text by space and get the second part, which is the price
                    let roomPriceArray = roomPriceText.split(' ');
                    let roomPrice = roomPriceArray.length > 1 ? parseFloat(roomPriceArray[1].replace(/,/g, '')) : NaN;
                    
                    // Proceed only if roomPrice is a valid number
                    if (!isNaN(roomPrice)) {
                        let discount = parseFloat($(this).val());
                        let discountAmount = (discount / 100) * roomPrice;
                        let discountedPrice = roomPrice - discountAmount;

                        // Update the UI with the calculated values
                        $('#discountAmount').text('Chegirma: ' + discountAmount.toFixed(2) + ' UZS');
                        $('#discountedPrice').text('Chegirmali narx: ' + discountedPrice.toFixed(2) + ' UZS');
                    } else {
                        // If roomPrice is NaN, reset the discount display
                        $('#discountAmount').text('Chegirma: 0 UZS');
                        $('#discountedPrice').text('Chegirmali narx: 0 UZS');
                    }
                } else {
                    // If roomPriceText is empty or undefined, reset the discount display
                    $('#discountAmount').text('Chegirma: 0 UZS');
                    $('#discountedPrice').text('Chegirmali narx: 0 UZS');
                }
            });


            $('#buildingSelect, #sectionSelect, #floorSelect, #roomSelect, #clientSelect').select2({
                theme: 'bootstrap-5'
            });

        });
    </script>
@endsection


