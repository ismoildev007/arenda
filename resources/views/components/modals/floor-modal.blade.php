<?php

$buildings = \App\Models\Building::all();
$sections = \App\Models\Section::all();

?>


<div class="offcanvas offcanvas-end w-50" tabindex="-1" id="floorOffcanvas" aria-labelledby="floorOffcanvas">
    <div class="offcanvas-header border-bottom" style="padding-top: 20px; padding-bottom: 20px">
        <div class="d-flex align-items-center">
            <div onclick="closeTempContractCheckSelect()" class="avatar-text avatar-md items-details-close-trigger" id="close-tempContractCheckSelectOffcanvas" data-bs-dismiss="offcanvas" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Details Close"><i class="feather-arrow-left"></i></div>
            <span class="vr text-muted mx-4"></span>
            <a href="javascript:void(0);">Etaj qo'shish</a>
        </div>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <form action="{{ route('floors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Building Select -->
                <div class="row mb-4 align-items-center">
                    <div class="col-lg-4">
                        <label for="regionSelect" class="fw-semibold">Building :</label>
                    </div>
                    <div class="col-lg-8 mb-4">
                        <select name="building_id" id="building_id" class="form-select max-select" required>
                            <option value="" disabled selected>Building tanlang</option>
                            @foreach($buildings as $building)
                                <option value="{{ $building->id }}">{{ $building->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12" id="sectionSelectBox" style="display: none;">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <label for="section_id" class="fw-semibold">Bo'lim</label>
                            </div>
                            <div class="col-lg-8">
                                <select name="section_id" id="section_id" class="form-select max-select" required>
                                    <option value="" disabled selected>Bo'limni tanlang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floor Number (loaded dynamically) -->
                <div class="row mb-4 align-items-center">
                    <div class="col-lg-4">
                        <label for="number" class="fw-semibold">Qavat tanlang:</label>
                    </div>
                    <div class="col-lg-8">
                        <select name="number" id="number" class="form-select max-select" required>
                            <option value="" disabled selected>Qavatni tanlang</option>
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

                <button type="submit" class="btn btn-primary">Saqlash</button>
            </form>
        </div>
    </div>
</div>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Scripts -->
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
                $.ajax({
                    url: "{{ route('getSections', '') }}/" + buildingId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#section_id').empty().append('<option value="" disabled selected>Bo\'limni tanlang</option>');
                        $('#number').empty().append('<option value="" disabled selected>Qavatni tanlang</option>');

                        $.each(data.sections, function(key, value) {
                            $('#section_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });

                        $('#sectionSelectBox').show();
                    }
                });
            }
        });

        // Update the floor select when a section is selected
        $('#section_id').on('change', function() {
            let selectedSectionId = $(this).val();
            let sectionData = @json($sections); // Yoki AJAX orqali olib kelingan section ma'lumotlari

            let selectedSection = sectionData.find(section => section.id == selectedSectionId);
            let floorSelect = $('#number');

            floorSelect.empty().append('<option value="" disabled selected>Qavatni tanlang</option>');

            if (selectedSection) {
                for (let i = 1; i <= selectedSection.floor; i++) {
                    floorSelect.append('<option value="' + i + '">' + i + '</option>');
                }
            }
        });
    });
</script>
