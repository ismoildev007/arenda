@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Hodimni Tahrirlash</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Hodimlar</a></li>
                        <li class="breadcrumb-item">Hodimni Tahrirlash</li>
                    </ul>
                </div>
            </div>

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="card border-top-0">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item flex-fill border-top" role="presentation">
                                <a href="javascript:void(0);" class="nav-link text-start">Hodim ma'lumotlarini tahrirlang:</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                            <div class="card-body personal-info">
                                <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="first_name" class="fw-semibold">Ism:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $employee->first_name }}" placeholder="Ismingizni kiriting" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="last_name" class="fw-semibold">Familiya:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $employee->last_name }}" placeholder="Familiyangizni kiriting" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="middle_name" class="fw-semibold">Sharif (ixtiyoriy):</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $employee->middle_name }}" placeholder="Sharifingizni kiriting">
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="pinfl" class="fw-semibold">PINFL:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="pinfl" name="pinfl" value="{{ $employee->pinfl }}" placeholder="PINFL kiriting" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="phone_number" class="fw-semibold">Phone Number:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <!-- Pre-populate with existing phone number -->
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $employee->phone_number) }}" placeholder="Enter your phone number" required>
                                        </div>
                                    </div>

              <script>
        document.addEventListener('DOMContentLoaded', () => {
            const phoneInput = document.getElementById('phone_number');
            const pattern = /^\+998\s?(90|91|93|94|95|98|99|33|97|71)\s?\d{3}\s?\d{2}\s?\d{2}$/;

            phoneInput.addEventListener('input', (e) => {
                let value = e.target.value;

                // Ensure the value starts with +998
                if (!value.startsWith('+998 ')) {
                    value = '+998 ' + value.replace(/^\+998\s*/, '');
                }

                // Remove invalid characters
                value = value.replace(/[^\d\s+()-]/g, '');

                // Format value according to the pattern
                let formattedValue = '+998 ';
                const match = value.match(/^(\+998\s?)(90|91|93|94|95|98|99|33|97|71)?\s?(\d{0,3})?\s?(\d{0,2})?\s?(\d{0,2})?/);
                if (match) {
                    if (match[2]) formattedValue += match[2] + ' ';
                    if (match[3]) formattedValue += match[3] + (match[3].length === 3 ? ' ' : '');
                    if (match[4]) formattedValue += match[4] + (match[4].length === 2 ? ' ' : '');
                    if (match[5]) formattedValue += match[5];
                }

                e.target.value = formattedValue.trim();
            });

            phoneInput.addEventListener('keydown', (e) => {
                const value = e.target.value;
                // Prevent user from deleting +998
                if (e.key === 'Backspace' && value.length <= 5) {
                    e.preventDefault();
                }
            });

            document.getElementById('phone-form').addEventListener('submit', (e) => {
                if (!pattern.test(phoneInput.value)) {
                    e.preventDefault();
                    alert('Please enter a valid phone number: +998 (XX) XXX-XX-XX');
                }
            });
        });
    </script>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="birth_day" class="fw-semibold">Tug'ilgan sana:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="date" class="form-control" id="birth_day" name="birth_day" value="{{ $employee->birth_day }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="branch_id" class="fw-semibold">Building:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="branch_id" id="branch_id" class="form-control max-select" required>
                                                <option disabled>Building tanlang</option>
                                                @foreach($buildings as $branch)
                                                    <option value="{{ $branch->id }}" {{ $employee->branch_id == $branch->id ? 'selected' : '' }}>
                                                        {{ $branch->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="regionSelect" class="fw-semibold">Viloyat:</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control max-select" id="regionSelect" name="region_id" placeholder="Viloyatni tanlang">
                                                <option disabled selected>Viloyatni tanlang</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id }}" {{ $employee->region_id == $region->id ? 'selected' : '' }}>
                                                        {{ $region->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4" id="districtSelectBox" style="{{ $employee->district_id ? 'display: block;' : 'display: none;' }}">
                                            <select class="form-control max-select" id="districtSelect" name="district_id">
                                                <option value="" disabled selected>Tumanni tanlang</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}" {{ $employee->district_id == $district->id ? 'selected' : '' }}>
                                                        {{ $district->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="role" class="fw-semibold">Lavozim:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="role" id="role" class="form-control max-select" required>
                                                <option disabled>Lavozimni tanlang</option>
                                                <option value="manager" {{ $employee->role == 'manager' ? 'selected' : '' }}>Manager</option>
                                                <option value="accountant" {{ $employee->role == 'accountant' ? 'selected' : '' }}>Buhgalter</option>
                                                <option value="staff" {{ $employee->role == 'staff' ? 'selected' : '' }}>Xodim</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4" id="login-fields" style="{{ in_array($employee->role, ['manager', 'accountant']) ? '' : 'display:none;' }}">
                                        <div class="col-lg-4">
                                            <label for="login" class="fw-semibold">Email:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="email" class="form-control" id="login" name="email" value="{{ $employee->email }}" placeholder="Eamilni kiriting">
                                        </div>
                                    </div>
                                    <div class="row mb-4" id="password-fields" style="{{ in_array($employee->role, ['manager', 'accountant']) ? '' : 'display:none;' }}">
                                        <div class="col-lg-4">
                                            <label for="password" class="fw-semibold">Parol:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Parol kiriting">
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
            // Barcha select elementlar uchun Select2 ni ishga tushirish
            $('.max-select').select2({
                theme: 'bootstrap-5',
                placeholder: 'Tanlang...',
                allowClear: true
            });

            // Viloyat tanlanganda tumanlarni yuklash uchun AJAX chaqiruv
            $('#regionSelect').change(function() {
                var regionId = $(this).val();
                if(regionId) {
                    $.ajax({
                        url: '{{ url("/get-districts/") }}' + '/' + regionId, // Viloyat ID bo'yicha tumanlarni olish uchun URL
                        type: "GET", // GET metodi orqali ma'lumot olish
                        dataType: "json", // Ma'lumot turi JSON formatida bo'ladi
                        success: function(data) { // Agar so'rov muvaffaqiyatli bo'lsa
                            $('#districtSelect').empty().append('<option value="" disabled selected>Tumanni tanlang</option>');
                            $.each(data, function(key, district) {
                                $('#districtSelect').append('<option value="'+ district.id +'">'+ district.name +'</option>');
                            });
                            document.getElementById('districtSelectBox').style.display = 'block'; // Tumanni tanlash maydoni ko'rsatiladi
                        },
                        error: function(xhr, status, error) { // Agar so'rovda xatolik yuz bersa
                            console.log("Xatolik yuz berdi: " + error);
                        }
                    });
                } else {
                    $('#districtSelect').empty().append('<option value="" disabled selected>Tumanni tanlang</option>');
                    document.getElementById('districtSelectBox').style.display = 'none'; // Tumanni tanlash maydoni yashiriladi
                }
            });


            // Show/Hide login fields based on role
            $('#role').change(function() {
                var role = $(this).val();
                if(role === 'manager' || role === 'accountant') {
                    $('#login-fields').show();
                    $('#password-fields').show();
                } else {
                    $('#login-fields').hide();
                    $('#password-fields').hide();
                }
            });
        });
    </script>
@endsection
