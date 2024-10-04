@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Mijozni tahrirlash</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Mijozlar</a></li>
                        <li class="breadcrumb-item">Mijozni tahrirlash</li>
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
                                <a href="javascript:void(0);" class="nav-link text-start">Mijoz ma'lumotlarini tahriring:</a>
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
                                <form action="{{ route('clients.update', $client) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="regionSelect" class="fw-semibold">Manzil :</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control max-select" id="regionSelect" name="region_id" placeholder="Viloyatni tanlang">
                                                <option class="selected" disabled selected>Viloyatni tanlang</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id }}" {{ $client->region_id == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4" id="districtSelectBox" style="display: {{ $client->district_id ? 'block' : 'none' }};">
                                            <select class="form-control max-select" id="districtSelect" name="district_id">
                                                <option value="" disabled selected> Tumanni tanlang </option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}" {{ $client->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="lastNameInput" class="fw-semibold">Familiya:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="lastNameInput" name="last_name" value="{{ $client->last_name }}" placeholder="Familiyangizni kiriting" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="lastNameInput" class="fw-semibold">Otasining ismi:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="lastNameInput" name="middle_name" value="{{ $client->middle_name }}" placeholder="Otasini ismini kiriting" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="firstNameInput" class="fw-semibold">Ism:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="firstNameInput" name="first_name" value="{{ $client->first_name }}" placeholder="Ismingizni kiriting">
                                        </div>
                                    </div>
                                    @if($client->pinfl !== null)
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="pinflInput" class="fw-semibold">PINFL:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="pinflInput" name="pinfl" value="{{ $client->pinfl }}" placeholder="PINFL raqamingizni kiriting" maxlength="14">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="phone_number" class="fw-semibold">Phone Number:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <!-- Pre-populate with existing phone number -->
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $client->phone_number) }}" placeholder="Enter your phone number" required>
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
                                    @if($client->inn !== null)
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="inn" class="fw-semibold">INN:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="inn" name="inn" value="{{ $client->inn }}" placeholder="inn raqamingizni kiriting">
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center company-field">
                                            <div class="col-lg-4">
                                                <label for="companyNameInput" class="fw-semibold">Kompaniya nomi:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="companyNameInput" name="company_name" value="{{ $client->company_name }}" placeholder="Kompaniya nomini kiriting">
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center company-field">
                                            <div class="col-lg-4">
                                                <label for="okedInput" class="fw-semibold">OKED:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="okedInput" name="oked" value="{{ $client->oked }}" placeholder="OKED raqamini kiriting">
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center company-field">
                                            <div class="col-lg-4">
                                                <label for="bankInput" class="fw-semibold">Bank:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="bankInput" name="bank" value="{{ $client->bank }}" placeholder="Bank nomini kiriting">
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center company-field">
                                            <div class="col-lg-4">
                                                <label for="accountInput" class="fw-semibold">Hisob raqami:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="accountInput" name="account" value="{{ $client->account }}" placeholder="Hisob raqamini kiriting">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="passwordInput" class="fw-semibold">Parol:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Parolni kiriting">
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="passwordConfirmationInput" class="fw-semibold">Parolni tasdiqlash:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="password" class="form-control" id="passwordConfirmationInput" name="password_confirmation" placeholder="Parolni tasdiqlang">
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
