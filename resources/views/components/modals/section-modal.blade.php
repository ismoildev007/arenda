<?php

$buildings = \App\Models\Building::all();

?>

<div class="offcanvas offcanvas-end w-50" tabindex="-1" id="sectionOffcanvas" aria-labelledby="section">
    <div class="offcanvas-header border-bottom" style="padding-top: 20px; padding-bottom: 20px">
        <div class="d-flex align-items-center">
            <div onclick="closeTempContractCheckSelect()" class="avatar-text avatar-md items-details-close-trigger" id="close-section" data-bs-dismiss="offcanvas" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Details Close">
                <i class="feather-arrow-left"></i>
            </div>
            <span class="vr text-muted mx-4"></span>
            <a href="javascript:void(0);">Seksiya qo'shish</a>
        </div>
    </div>
    <div class="offcanvas-body">
        <div class="row">
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

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Yopish</button>
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
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
        $('.max-select').select2({
            theme: 'bootstrap-5',
            placeholder: 'Bino tanlang',
            allowClear: true
        });
    });
</script>
