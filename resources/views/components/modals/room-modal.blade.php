<?php

$buildings = \App\Models\Building::all();
$sections = \App\Models\Section::all();

?>

<div class="offcanvas offcanvas-end w-50" tabindex="-1" id="roomOffcanvas" aria-labelledby="roomOffcanvasLabel">
    <div class="offcanvas-header border-bottom" style="padding-top: 20px; padding-bottom: 20px">
        <div class="d-flex align-items-center">
            <div onclick="closeRoomModal()" class="avatar-text avatar-md items-details-close-trigger" id="close-roomOffcanvas" data-bs-dismiss="offcanvas" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Close"><i class="feather-arrow-left"></i></div>
            <span class="vr text-muted mx-4"></span>
            <a href="javascript:void(0);">Xona qo'shish</a>
        </div>
    </div>

    <div class="offcanvas-body">
        <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" id="roomForm">
            @csrf
            <!-- Building Select -->
            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="building_id" class="fw-semibold">Building :</label>
                </div>
                <div class="col-lg-8">
                    <select name="building_id" id="building_id" class="form-select max-select" required>
                        <option value="" disabled selected>Building tanlang</option>
                        @foreach($buildings as $building)
                            <option value="{{ $building->id }}">{{ $building->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Section Select -->
            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="section_id" class="fw-semibold">Seksiya :</label>
                </div>
                <div class="col-lg-8">
                    <select name="section_id" id="section_id" class="form-select max-select" required>
                        <option value="" disabled selected>Seksiya tanlang</option>
                    </select>
                </div>
            </div>

            <!-- Floor Select -->
            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="floor_id" class="fw-semibold">Qavat :</label>
                </div>
                <div class="col-lg-8">
                    <select name="floor_id" id="floor_id" class="form-select max-select" required>
                        <option value="" disabled selected>Qavatni tanlang</option>
                    </select>
                </div>
            </div>

            <!-- Room Number -->
            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="number" class="fw-semibold">Xona raqami :</label>
                </div>
                <div class="col-lg-8">
                    <input type="text" name="number" id="number" class="form-control" required>
                </div>
            </div>

            <!-- Size -->
            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="size" class="fw-semibold">O'lchami :</label>
                </div>
                <div class="col-lg-8">
                    <input type="number" name="size" id="size" class="form-control" required>
                </div>
            </div>

            <!-- Price Per Sqm -->
            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="price_per_sqm" class="fw-semibold">Kvadrat metriga narx :</label>
                </div>
                <div class="col-lg-8">
                    <input type="number" name="price_per_sqm" id="price_per_sqm" class="form-control" required>
                </div>
            </div>

            <!-- Status -->
            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="status" class="fw-semibold">Holat :</label>
                </div>
                <div class="col-lg-8">
                    <select name="status" id="status" class="form-select max-select" required>
                        <option value="" disabled selected>Holatni tanlang</option>
                        <option value="noactive">Faol emas</option>
                        <option value="active">Faol</option>
                        <option value="bron">Bronlangan</option>
                    </select>
                </div>
            </div>

            <!-- Type -->
            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="type" class="fw-semibold">Turi :</label>
                </div>
                <div class="col-lg-8">
                    <select name="type" id="type" class="form-select max-select" required>
                        <option value="" disabled selected>Turlarni tanlang</option>
                        <option value="business">Biznes</option>
                        <option value="standard">Standart</option>
                    </select>
                </div>
            </div>

            <!-- Image Upload -->
            <div class="row align-items-center mb-4">
                <div class="col-lg-4">
                    <label for="images" class="fw-semibold">Rasmlar</label>
                </div>
                <div class="col-lg-8">
                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Yaratish</button>
        </form>
    </div>
</div>

<!-- Include Select2 and jQuery -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Custom Script -->
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.max-select').select2({
            theme: 'bootstrap-5',
            placeholder: 'Tanlang...',
            allowClear: true
        });

        // Load sections based on selected building
        $('#building_id').on('change', function() {
            let buildingId = $(this).val();
            if (buildingId) {
                let url = "{{ route('getSections', ':buildingId') }}".replace(':buildingId', buildingId);

                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#section_id').empty().append('<option value="" disabled selected>Bo\'limni tanlang</option>');
                        $('#number').empty().append('<option value="" disabled selected>Qavatni tanlang</option>');

                        // Check if sections are available
                        if (data.sections.length > 0) {
                            $.each(data.sections, function(key, value) {
                                $('#section_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                            $('#sectionSelectBox').show(); // Show section select box
                        } else {
                            $('#sectionSelectBox').hide(); // Hide section select box if no sections
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error: " + status + " - " + error);
                    }
                });
            } else {
                $('#section_id').empty().append('<option value="" disabled selected>Bo\'limni tanlang</option>');
                $('#number').empty().append('<option value="" disabled selected>Qavatni tanlang</option>');
                $('#sectionSelectBox').hide(); // Hide section select box if no building selected
            }
        });

        // Update the floor select when a section is selected
        $('#section_id').on('change', function() {
            let selectedSectionId = $(this).val();
            let sectionData = @json($sections); // Backenddan olib kelingan section ma'lumotlari

            let selectedSection = sectionData.find(section => section.id == selectedSectionId);
            let floorSelect = $('#number');

            floorSelect.empty().append('<option value="" disabled selected>Qavatni tanlang</option>');

            if (selectedSection) {
                // Populate floors based on the section's floor data
                for (let i = 1; i <= selectedSection.floor; i++) {
                    floorSelect.append('<option value="' + i + '">' + i + '</option>');
                }
            } else {
                floorSelect.append('<option value="" disabled selected>No floors available</option>');
            }
        });

        // Form submit event
        $('#roomForm').on('submit', function(e) {
            let floorValue = $('#floor_id').val();
            if (!floorValue) {
                e.preventDefault();
                alert('Iltimos, qavatni tanlang!');
            }
        });
    });
</script>

