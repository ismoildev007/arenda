@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Yangi mijoz qo'shish</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Mijozlar</a></li>
                        <li class="breadcrumb-item">Yangi mijoz qo'shish</li>
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
                                <a href="javascript:void(0);" class="nav-link text-start">Yangi mijoz ma'lumotlarini kiriting:</a>
                                @error('pinfl')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @error('inn')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                            <div class="card-body personal-info">
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <button id="individualClientBtn" class="btn btn-primary w-100">Jismoniy shaxs qo'shish</button>
                                    </div>
                                    <div class="col-lg-6">
                                        <button id="legalClientBtn" class="btn btn-secondary w-100">Yuridik shaxs qo'shish</button>
                                    </div>
                                </div>
                                <form id="clientForm" action="{{ route('clients.store') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" id="clientType" name="client_type" value="">

                                    <!-- Region and District Fields -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="regionSelect" class="fw-semibold">Manzil:</label>
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
                                                <option value="" disabled selected>Tumanni tanlang</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Last Name Field -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="lastNameInput" class="fw-semibold">Familiya:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="lastNameInput" name="last_name" placeholder="Familiyangizni kiriting" required>
                                        </div>
                                    </div>

                                    <!-- First Name Field -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="firstNameInput" class="fw-semibold">Ism:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="firstNameInput" name="first_name" placeholder="Ismingizni kiriting">
                                        </div>
                                    </div>

                                    <!-- Middle Name Field -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="middleNameInput" class="fw-semibold">Otasining ismi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="middleNameInput" name="middle_name" placeholder="Otasining ismini kiriting">
                                        </div>
                                    </div>
                                     <!-- Company Name Field -->
                                    <div class="row mb-4 align-items-center" id="companyNameField" >
                                        <div class="col-lg-4">
                                            <label for="companyNameInput" class="fw-semibold">Kompaniya nomi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="companyNameInput" name="company_name" placeholder="Kompaniya nomini kiriting">
                                        </div>
                                    </div>
                                    <!-- PINFL Field -->
                                    <div class="row mb-4 align-items-center" id="pinflField" style="display: none;">
                                        <div class="col-lg-4">
                                            <label for="pinflInput" class="fw-semibold">PINFL:</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input id="pinfl" type="text" class="form-control mb-3" placeholder="PINFL" name="pinfl" pattern="\d{14}" title="PINFL should be exactly 14 digits long">
                                            @error('pinfl')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label class="fw-semibold">Telefon Raqam:</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input id="phone_number" type="text" class="form-control mb-3" placeholder="Phone number" name="phone_number" >
                                            @error('phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- OKED Field -->
                                    <div class="row mb-4 align-items-center" id="okedField" style="display: none;">
                                        <div class="col-lg-4">
                                            <label for="okedInput" class="fw-semibold">OKED:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="okedInput" name="oked" placeholder="OKED raqamini kiriting">
                                        </div>
                                    </div>

                                    <!-- Bank Field -->
                                    <div class="row mb-4 align-items-center" id="bankField" style="display: none;">
                                        <div class="col-lg-4">
                                            <label for="bankInput" class="fw-semibold">Bank:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="bankInput" name="bank" placeholder="Bank nomini kiriting">
                                        </div>
                                    </div>

                                    <!-- Account Field -->
                                    <div class="row mb-4 align-items-center" id="accountField" style="display: none;">
                                        <div class="col-lg-4">
                                            <label for="accountInput" class="fw-semibold">Hisob raqami:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="accountInput" name="account" placeholder="Hisob raqamini kiriting">
                                        </div>
                                    </div>

                                    <!-- INN Field -->
                                    <div class="row mb-4 align-items-center" id="innField" style="display: none;">
                                        <div class="col-lg-4">
                                            <label for="innInput" class="fw-semibold">INN:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="innInput" name="inn" placeholder="INN raqamini kiriting" pattern="\d*" title="INN raqamlarni o'z ichiga olishi kerak">
                                            @error('inn')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password Field -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="password-input" class="fw-semibold">Parol:</label>
                                        </div>
                                        <div class="col-lg-8 position-relative">
                                            <input type="password" class="form-control" id="password-input"  name="password" placeholder="Parolni kiriting" required>
                                            <i class="fa fa-eye-slash position-absolute " id="toggle-password" style="right: 30px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                        </div>
                                    </div>


                                    <!-- Confirm Password Field -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="passwordConfirmationInput" class="fw-semibold">Parolni tasdiqlash:</label>
                                        </div>
                                        <div class="col-lg-8 position-relative">
                                            <input type="password" class="form-control" id="passwordConfirmationInput" name="password_confirmation" placeholder="Parolni tasdiqlang" required>
                                            <i class="fa fa-eye-slash position-absolute " id="confirm-toggle-password" style="right: 30px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="row mb-4">
                                        
                                        <div class="col-lg-4">
                                            <button type="submit" class="btn btn-success w-100">Saqlash</button>
                                        </div>
                                        <div class="col-lg-8">
                                            
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
<script>
                                        document.addEventListener('DOMContentLoaded', () => {
                                            const phoneInput = document.getElementById('phone_number');
                                            const pattern = /^\+998\s?(90|91|93|94|95|98|99|33|97|71)\s?\d{3}\s?\d{2}\s?\d{2}$/;

                                            // Initialize value with +998
                                            phoneInput.value = '+998 ';

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
    {{--    @section('scripts')--}}
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Custom Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var pinflInput = document.getElementById('pinfl');

            pinflInput.addEventListener('input', function () {
                var value = pinflInput.value;

                value = value.replace(/\D/g, '').slice(0, 14);
                pinflInput.value = value;

                if (value.length < 14) {
                    pinflInput.classList.add('input-error');
                } else {
                    pinflInput.classList.remove('input-error');
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const innInput = document.getElementById('innInput');

            innInput.addEventListener('input', function() {
                // Faoliyatdagi faqat raqamlarni olish
                let value = innInput.value;
                value = value.replace(/\D/g, ''); // Harflarni olib tashlash
                innInput.value = value;
            });
        });

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('individualClientBtn').addEventListener('click', function () {
                document.getElementById('clientForm').style.display = 'block';
                document.getElementById('clientType').value = 'individual';
                document.getElementById('pinflField').style.display = 'flex';
                document.getElementById('companyNameField').style.display = 'flex';
                document.getElementById('okedField').style.display = 'none';
                document.getElementById('bankField').style.display = 'none';
                document.getElementById('accountField').style.display = 'none';
                document.getElementById('innField').style.display = 'none';
            });

            document.getElementById('legalClientBtn').addEventListener('click', function () {
                document.getElementById('clientForm').style.display = 'block';
                document.getElementById('clientType').value = 'legal';
                document.getElementById('pinflField').style.display = 'none';
                document.getElementById('companyNameField').style.display = 'flex';
                document.getElementById('okedField').style.display = 'flex';
                document.getElementById('bankField').style.display = 'flex';
                document.getElementById('accountField').style.display = 'flex';
                document.getElementById('innField').style.display = 'flex';
            });

            document.getElementById('regionSelect').addEventListener('change', function() {
                const regionId = this.value;
                fetch(`/districts/${regionId}`)
                    .then(response => response.json())
                    .then(data => {
                        const districtSelect = document.getElementById('districtSelect');
                        districtSelect.innerHTML = '<option value="" disabled selected>Tumanni tanlang</option>';
                        data.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.id;
                            option.textContent = district.name;
                            districtSelect.appendChild(option);
                        });
                        document.getElementById('districtSelectBox').style.display = data.length ? 'block' : 'none';
                    })
                    .catch(error => console.error('Xato:', error));
            });
        });
    </script>
    <script>
        function togglePasswordVisibility(inputClassName, iconClassName) {
    var passwordInput = document.getElementById(`${inputClassName}`);
    var toggleIcon = document.getElementById(`${iconClassName}`);

    toggleIcon.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        }
    });
}

togglePasswordVisibility('password-input', 'toggle-password');
togglePasswordVisibility('passwordConfirmationInput', 'confirm-toggle-password');

    </script>
');

    </script>
    {{--    @endsection--}}
@endsection
